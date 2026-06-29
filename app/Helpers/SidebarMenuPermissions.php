<?php

namespace App\Helpers;

use App\Adms\Enum\Permission;
use App\Helpers\Connection;
use Core\Config;

class SidebarMenuPermissions
{
    private const TRUE = 1;

    /**
     * Return the sidebar menu items the logged-in access level is allowed to see.
     * The menu is identical for the whole session, so it is queried once and
     * cached in the session. The cache is cleared on logout (see Logout controller).
     * @return array
     */
    public static function checkPermissionsSidebarMenus(): array
    {
        if (isset($_SESSION['sidebar']) && is_array($_SESSION['sidebar'])) {
            return $_SESSION['sidebar'];
        }

        return $_SESSION['sidebar'] = self::querySidebarMenus();
    }

    private static function querySidebarMenus(): array
    {
        $sidebarMenus = "SELECT pl.id AS page_level_id,
                                p.id AS page_id,
                                p.name_page,
                                p.icon,
                                p.controller_in_the_main,
                                p.method_in_the_main
                            FROM `page_levels` AS pl
                                INNER JOIN `pages` AS p
                                    ON pl.page_id = p.id
                            WHERE pl.access_level_id = :access_level_id
                                AND pl.permission = :permission
                                AND p.enable_in_sidebar = :enable_in_sidebar
                            ORDER BY pl.order_level_page ASC";

        $conn = Connection::connect(Config::db());
        $statement = $conn->prepare($sidebarMenus);
        $statement->bindValue(':access_level_id', (int) $_SESSION['access_level'], \PDO::PARAM_INT);
        $statement->bindValue(':permission', Permission::HAVE_PERMISSION->value, \PDO::PARAM_INT);
        $statement->bindValue(':enable_in_sidebar', self::TRUE, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
