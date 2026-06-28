<?php

namespace App\Helpers;

use App\Adms\Enum\Permission;
use PDO;
use App\Helpers\Connection;
use Core\Config;

class ButtonPermissions
{
    /**
     * Validate button permission. If the user has permission to access the page, the button will be displayed.
     * Else the button will not visible.
     */
    public static function checkPermissionsButtons(?array $data): array
    {
        $result = [];

        foreach((array) $data as $key => $button) {
            $resultButtonPermissions = self::query(
                (string) $button['menu_controller'], (string) $button['menu_method']
            );

            $result[$key] = !empty($resultButtonPermissions);
        }

        return $result;
    }

    private static function query(?string $menuController, ?string $menuMethod): array
    {
        $query = "SELECT p.id 
                    FROM `pages` AS p
                        INNER JOIN `page_levels` AS pl 
                            ON pl.page_id = p.id
                        WHERE p.controller_in_the_main = :controller_in_the_main
                            AND p.method_in_the_main = :method_in_the_main
                            AND pl.permission = :have_permission
                            AND pl.access_level_id = :access_level_id
                        LIMIT 1";

        $conn = Connection::connect(Config::db());
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':controller_in_the_main', $menuController, PDO::PARAM_STR);
        $stmt->bindValue(':method_in_the_main', $menuMethod, PDO::PARAM_STR);
        $stmt->bindValue(':have_permission', Permission::HAVE_PERMISSION->value, PDO::PARAM_INT);
        $stmt->bindValue(':access_level_id', (int) $_SESSION['access_level'], PDO::PARAM_INT);
        $stmt->execute();
        $queryResult = (array) $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $queryResult;
    }
}