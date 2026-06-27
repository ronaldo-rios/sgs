<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use Core\Config;
use PDO;

class ViewPageModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function viewInfo(int $id): ?array
    {
        return $this->detailsPage($id);
    }

    private function detailsPage(int $id): array
    {
        $query = "SELECT p.`id`, p.`controller`, p.`method`, p.`controller_in_the_main`,
                         p.`method_in_the_main`, p.`name_page`, p.`public`, p.`enable_in_sidebar`,
                         p.`icon`, p.`obs`, p.`active_status`, p.`created_at`, p.`updated_at`,
                         pt.`type_name`, pm.`name_module` AS module_name
                  FROM `pages` p
                  INNER JOIN `page_types` pt ON pt.`id` = p.`page_type_id`
                  INNER JOIN `page_modules` pm ON pm.`id` = p.`page_module_id`
                  WHERE p.`id` = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = (array) $stmt->fetch(PDO::FETCH_ASSOC);

        return (! empty($result)) ? $result : [];
    }
}
