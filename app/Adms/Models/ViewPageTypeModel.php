<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use Core\Config;
use PDO;

class ViewPageTypeModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function viewInfo(int $id): ?array
    {
        return $this->detailsPageType($id);
    }

    private function detailsPageType(int $id): array
    {
        $query = "SELECT `id`, `type_name`, `order_page_type`, `created_at`, `updated_at`
                  FROM `page_types`
                  WHERE id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = (array) $stmt->fetch(PDO::FETCH_ASSOC);

        return (! empty($result)) ? $result : [];
    }
}
