<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use Core\Config;
use PDO;

class ViewPageModuleModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function viewInfo(int $id): ?array
    {
        return $this->detailsPageModule($id);
    }

    private function detailsPageModule(int $id): array
    {
        $query = "SELECT `id`, `type_module`, `name_module`, `order_module`, `obs`, `created_at`, `updated_at`
                  FROM `page_modules`
                  WHERE id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = (array) $stmt->fetch(PDO::FETCH_ASSOC);

        return (! empty($result)) ? $result : [];
    }
}
