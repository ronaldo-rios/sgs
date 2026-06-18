<?php

namespace App\Adms\Models;

use App\Adms\Enum\Permission;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO; 

class SyncPageLevelsModel
{
    private PDO $conn;
    private const PUBLIC_PAGE = 1;

    private int $created = 0;
    private int $existing = 0;
    private int $failed = 0;
    private ?int $superAdmLevelId = null;

    public function sync(): void
    {
        $this->conn = Connection::connect(Config::db());

        try {
            $this->conn->beginTransaction();
            $this->queryDataAccessLevels();
            $this->conn->commit();
            $this->flashSummary();
        }
        catch (\Throwable $error) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            Flash::danger('Erro ao sincronizar as permissões. Nenhuma alteração foi aplicada.');
        }
    }

    private function flashSummary(): void
    {
        if (($this->created + $this->existing + $this->failed) === 0) {
            return;
        }

        if ($this->failed > 0) {
            Flash::danger("Sincronização concluída com erros: {$this->created} criada(s), {$this->existing} já existente(s), {$this->failed} com erro.");
        }
        elseif ($this->created > 0) {
            Flash::success("Sincronização concluída: {$this->created} permissão(ões) criada(s), {$this->existing} já existente(s).");
        }
        else {
            Flash::info("Tudo já estava sincronizado! ({$this->existing} permissão(ões))");
        }
    }

    private function queryDataAccessLevels(): void
    {
        $sql = "SELECT `id` FROM `access_levels`";

        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $accessLevels = (array) $statement->fetchAll();

        if (!empty($accessLevels)) {
            $this->queryDataPages($accessLevels);
        }
        else {
            Flash::danger('Nenhum nível de acesso encontrado!');
        }
    }

    private function queryDataPages(?array $accessLevels): void
    {
        $sql = "SELECT `id`, `public` FROM `pages`";

        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $pages = (array) $statement->fetchAll();

        if (!empty($pages)) {
            $this->readAccesLevels($accessLevels, $pages);
        }
        else {
            Flash::danger('Nenhuma página encontrada!');
        }
    }

    private function readAccesLevels(?array $resultLevels, ?array $pages): void
    {
        foreach($resultLevels as $level) {
            $this->readPages($pages, (int) $level['id']);
        }
    }

    private function readPages(?array $resultPages, ?int $accessLevelId): void
    {
        foreach($resultPages as $page) {
            $this->searchListPageLevel($page, $accessLevelId);
        }
    }

    /**
     * Returns the id of the most privileged access level 
     * (top of the hierarchy, i.e. the lowest order_level).
     */
    private function getSuperAdmAccessLevelId(): int
    {
        if ($this->superAdmLevelId === null) {
            $sql = "SELECT `id`
                FROM `access_levels`
                ORDER BY `order_level` ASC
                LIMIT 1";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $this->superAdmLevelId = (int) $statement->fetchColumn();
        }

        return $this->superAdmLevelId;
    }

    /**
     * Searches for page levels to check whether a given access level already 
     * has registration for a given page in page_levels, 
     * so it doesn't add it to avoid creating duplication
     * If you don't already have it, it synchronizes to make the addition
     */
    private function searchListPageLevel(?array $page, ?int $accessLevelId): void
    {
        $sql = "SELECT `id` FROM `page_levels` 
                WHERE `access_level_id` = :access_level_id
                AND `page_id` = :page_id";

        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':access_level_id', $accessLevelId, \PDO::PARAM_INT);
        $statement->bindValue(':page_id', (int) $page['id'], \PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $this->existing++;
        }
        else {
            $this->addLevelPermission($accessLevelId, (int) $page['public'], (int) $page['id']);
        }
    }

    private function queryLastOrderLevelPage(int $accessLevelId): int
    {
        $sql = "SELECT `order_level_page`
                FROM `page_levels`
                WHERE `access_level_id` = :access_level_id
                ORDER BY `order_level_page` DESC
                LIMIT 1";

        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':access_level_id', $accessLevelId, \PDO::PARAM_INT);
        $statement->execute();
        $lastOrder = (int) $statement->fetchColumn();

        return $lastOrder ? $lastOrder : 0;
    }

    private function addLevelPermission(int $accessLevelId, int $public, int $pageId): void
    {
        $lastOrderResult = $this->queryLastOrderLevelPage($accessLevelId);
        // As soon as a new page is registered, it is automatically released to the master user
        $permission = ($accessLevelId === $this->getSuperAdmAccessLevelId()) || ($public === self::PUBLIC_PAGE)
            ? Permission::HAVE_PERMISSION->value : Permission::NO_PERMISSION->value;

        if ($permission === Permission::NO_PERMISSION->value) {
            $permission = $this->searchLevelDefault($pageId);
        }

        $orderLevelPage = $lastOrderResult + 1;
        $this->insertLevelPage($permission, $orderLevelPage, $accessLevelId, $pageId);
    }

    private function insertLevelPage(int $permission, int $orderLevelPage, int $accessLevelId, int $pageId)
    {
        $sql = "INSERT IGNORE INTO `page_levels`
                (`permission`, `order_level_page`, `access_level_id`, `page_id`, `created_at`)
                VALUES
                (:permission, :order_level_page, :access_level_id, :page_id, NOW())";

        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':permission', $permission, \PDO::PARAM_INT);
        $statement->bindValue(':order_level_page', $orderLevelPage, \PDO::PARAM_INT);
        $statement->bindValue(':access_level_id', $accessLevelId, \PDO::PARAM_INT);
        $statement->bindValue(':page_id', $pageId, \PDO::PARAM_INT);
        $statement->execute();

        ($statement->rowCount() > 0) 
            ? $this->created++ : $this->failed++;
    }

    private function searchLevelDefault(int $pageId): int
    {
        $sql = "SELECT `permission`
                    FROM `page_levels`
                WHERE `page_id` = :page_id
                AND `access_level_id` = :access_level_default
                LIMIT 1";

        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':page_id', $pageId, \PDO::PARAM_INT);
        $statement->bindValue(':access_level_default', Config::ACCESS_LEVEL_USER_DEFAULT, \PDO::PARAM_INT);
        $statement->execute();
        $resultLevelDefault = $statement->fetchColumn();

        return $resultLevelDefault !== false
            ? (int) $resultLevelDefault
            : Permission::NO_PERMISSION->value;
    }
}