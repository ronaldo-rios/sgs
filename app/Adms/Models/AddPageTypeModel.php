<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;

class AddPageTypeModel
{
    private object $conn;

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

        $this->insertNewPageType($data);
        return true;
    }

    private function queryToLastOrderPageType(): ?int
    {
        $select = "SELECT `order_page_type` 
                   FROM `page_types`
                   ORDER BY `order_page_type` DESC 
                   LIMIT 1";

        $stmt = $this->conn->prepare($select);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    private function insertNewPageType(array $data): void
    {
        $orderType = $this->queryToLastOrderPageType();
        $orderType += 1;

        $insert = "INSERT INTO `page_types` (`type_name`, `order_page_type`, `created_at`) 
                   VALUES (:type_name, :order_page_type, NOW())";

        $stmt = $this->conn->prepare($insert);
        $stmt->bindValue(
            ':type_name', 
            ConvertToCapitularString::format($data['type_name']), 
            \PDO::PARAM_STR
        );
        $stmt->bindValue(
            ':order_page_type', 
            $orderType, 
            \PDO::PARAM_INT
        );
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Grupo cadastrado com sucesso!');
        } else {
            Flash::danger('Erro na criação de Grupo');
        }
    }
}