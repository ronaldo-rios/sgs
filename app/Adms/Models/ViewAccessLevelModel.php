<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use Core\Config;
use PDO;

class ViewAccessLevelModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function viewInfo(int $id): ?array
    {
        return $this->detailsLevel($id);
    }

    private function detailsLevel(int $id): array
    {
        $query = "SELECT `id`, `access_level`, `order_level`, `created_at`, `updated_at`
                  FROM `access_levels`
                  WHERE id = :id AND order_level > :order_level
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':order_level', $_SESSION['order_level'], PDO::PARAM_INT);
        $stmt->execute();
        $result = (array) $stmt->fetch(PDO::FETCH_ASSOC);

        return (! empty($result)) ? $result : [];
    }
}
