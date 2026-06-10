<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use Core\Config;
use PDO;

class ListAccessLevelsModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function listLevels(): ?array
    {
        return $this->queryAccessLevels();
    }

    private function queryAccessLevels(): ?array
    {
        $query = "SELECT `id`, `access_level`, `order_level` 
                  FROM access_levels 
                  WHERE order_level > :order_level
                  ORDER BY id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':order_level', $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->execute();
        $result = (array) $stmt->fetchAll();

        return (! empty($result)) ? $result : [];
    }
}