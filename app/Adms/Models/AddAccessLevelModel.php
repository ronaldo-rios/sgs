<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;


class AddAccessLevelModel
{
    private bool $result;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function add(?array $data): bool
    {
        ValidateEmptyField::validateField($data);
        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        return $this->insertAccessLevel($data);
    }

    private function queryToLastOrder(): ?int
    {
        $select = "SELECT `order_level` 
                   FROM `access_levels` 
                   ORDER BY `order_level` DESC 
                   LIMIT 1";

        $stmt = $this->conn->prepare($select);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    private function insertAccessLevel(array $data): bool
    {
        $orderLevel = $this->queryToLastOrder();
        $orderLevel += 1;

        $insert = "INSERT INTO `access_levels` (`access_level`, `order_level`, `created_at`) 
                   VALUES (:access_level, :order_level, NOW())";

        $stmt = $this->conn->prepare($insert);
        $stmt->bindValue(':access_level', ConvertToCapitularString::format($data['name']), \PDO::PARAM_STR);
        $stmt->bindValue(':order_level', $orderLevel, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success("Nível de acesso cadastrado com sucesso!");
            return true;
        } else {
            Flash::danger("Erro na criação de nível de acesso!");
            return false;
        }
    }

}