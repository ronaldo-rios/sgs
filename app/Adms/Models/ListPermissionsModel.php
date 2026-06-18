<?php

namespace App\Adms\Models;

use App\Adms\Enum\Permission;
use PDO;
use App\Helpers\Connection;
use App\Helpers\Flash;
use App\Helpers\Pagination;
use Core\Config;
use App\Helpers\VerifyAccessLevel;

class ListPermissionsModel
{
    private PDO $conn;
    private ?string $dataPagination;
    private string $accessLevel;
    private const LIMIT = 10;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function getPagination(): ?string
    {
        return $this->dataPagination;
    }

    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    public function listPermissions(?int $accessLevelId = null, ?int $page = null): ?array
    {
        $verifiedHasPermission = VerifyAccessLevel::verifyAccessLevel($accessLevelId);
        
        if (! empty($verifiedHasPermission)){
            $pagination = new Pagination(Config::url() . 'permissions/index', '?level=' . $accessLevelId);
            $pagination->condiction($page, self::LIMIT);
            $countConfEmails = $this->countPermissions($accessLevelId);
            $pagination->paginate($countConfEmails);
            $resultPage = $pagination->getResult();
            $this->dataPagination = $resultPage;
            
            $this->accessLevel = $verifiedHasPermission['access_level'];
            return $this->queryPermissions($pagination, $accessLevelId);
        }
        
        return [];
    }

    private function queryPermissions(Pagination $pagination, int $accessLevelId): array
    {
        $permissions = "SELECT 
                            pl.id, 
                            CASE pl.permission
                                WHEN 1 THEN 'Liberado'
                                ELSE 'Bloqueado'
                            END AS permission,
                            CASE p.enable_in_sidebar
                                WHEN 1 THEN 'Sim'
                                ELSE 'Não'
                            END AS sidebar,
                            pl.order_level_page, 
                            pl.page_id,
                            p.name_page, 
                            pl.access_level_id
                        FROM `page_levels` AS pl
                            INNER JOIN `pages` AS p
                                ON pl.page_id = p.id
                            INNER JOIN `access_levels` AS al
                                ON pl.access_level_id = al.id
                        WHERE pl.access_level_id = :access_level_id
                            AND al.order_level >= :order_level
                            AND 
                            (
                                (
                                    (
                                        SELECT pagelevels.permission
                                            FROM `page_levels` AS pagelevels
                                            WHERE pagelevels.page_id = pl.page_id
                                            AND pagelevels.access_level_id = :access_level_session
                                    ) = :have_permission
                                )
                                OR 
                                (
                                    p.public = 1
                                )
                            )
                        GROUP BY 
                            pl.id,
                            pl.permission,
                            p.enable_in_sidebar,
                            pl.order_level_page,
                            pl.page_id,
                            p.name_page,
                            pl.access_level_id
                        ORDER BY pl.order_level_page ASC
                        LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($permissions);
        $stmt->bindValue(':access_level_id', $accessLevelId, PDO::PARAM_INT);
        $stmt->bindValue(':order_level', $_SESSION['access_level'], PDO::PARAM_INT);
        $stmt->bindValue(':access_level_session', $_SESSION['access_level'], PDO::PARAM_INT);
        $stmt->bindValue(':have_permission', Permission::HAVE_PERMISSION->value, PDO::PARAM_INT);
        $stmt->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $pagination->getOffset(), PDO::PARAM_INT);
        $stmt->execute();

        $dataResult = (array) $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (! empty($dataResult)) {
            return $dataResult;
        }

        Flash::danger("Nenhuma permissão encontrada para o nível de acesso!");
        return [];
    }

    private function countPermissions(int $accessLevel): int
    {
        $sql = "SELECT COUNT(pl.id) AS num_result
                    FROM `page_levels` AS pl
                    INNER JOIN `pages` AS p
                        ON pl.page_id = p.id
                WHERE pl.access_level_id = :access_level_id
                    AND 
                    (
                        (
                            (
                                SELECT pagelevels.permission
                                    FROM `page_levels` AS pagelevels
                                    WHERE pagelevels.page_id = pl.page_id
                                    AND pagelevels.access_level_id = :access_level_session
                            ) = :have_permission
                        )
                        OR 
                        (
                            p.public = 1
                        )
                    )";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':access_level_id', $accessLevel, PDO::PARAM_INT);
        $stmt->bindValue(':access_level_session', $_SESSION['access_level'], PDO::PARAM_INT);
        $stmt->bindValue(':have_permission', Permission::HAVE_PERMISSION->value, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_result'];
            return $result;
        }

        return 0;
    }
}