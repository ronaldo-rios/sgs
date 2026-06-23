<?php

namespace App\Adms\Models;

use App\Adms\Enum\Permission;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;

class UpdatePermissionModel
{
    private object $conn;
    private const PUBLIC_PAGE = 1;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function update(int $id): bool
    {
        $resultQuery = $this->queryInfoPageLevels($id);

        if (! empty($resultQuery)) {
            $permissionPageLevel = (int) $resultQuery['permission'];
            $pageLevelId = (int) $resultQuery['id'];

            $selectedPermission = $permissionPageLevel === Permission::HAVE_PERMISSION->value
                ? Permission::NO_PERMISSION->value
                : Permission::HAVE_PERMISSION->value;

            if ($this->updatePermission($selectedPermission, $pageLevelId)) {
                return true;
            }
        }

        return false;   
    }

    private function queryInfoPageLevels(int $id): array
    {
        $query = "SELECT pl.id, pl.permission
                  FROM `page_levels` AS pl
                    INNER JOIN `access_levels` AS level
                        ON pl.access_level_id = level.id
                    LEFT JOIN `pages` AS pg
                        ON pl.page_id = pg.id
                  WHERE pl.id = :id
                    AND level.order_level > :order_level
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
                                    pg.public = :public_page
                                )
                            )
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':order_level', (int) $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->bindValue(':access_level_session', (int) $_SESSION['access_level'], \PDO::PARAM_INT);
        $stmt->bindValue(':have_permission', Permission::HAVE_PERMISSION->value, \PDO::PARAM_INT);
        $stmt->bindValue(':public_page', self::PUBLIC_PAGE, \PDO::PARAM_INT);
        $stmt->execute();
        $infoPageLevels = (array) $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            return $infoPageLevels;
        }
        else {
            Flash::danger('Necessário selecionar uma página válida!');
            return [];
        }
    }

    private function updatePermission(int $permission, int $pageLevelsId): void
    {
        $update = "UPDATE `page_levels`
                   SET permission = :permission, updated_at = NOW()
                   WHERE id = :id";

        $stmt = $this->conn->prepare($update);
        $stmt->bindValue(':permission', $permission, \PDO::PARAM_INT);
        $stmt->bindValue(':id', $pageLevelsId, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::success('Permissão alterada com sucesso!');
        }
        else {
            Flash::danger('Erro ao alterar permissão!');
        }
    }
}