<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;

class AddPageModuleModel
{
    private object $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function add(?array $data): bool
    {
        ValidateEmptyField::validateField($data, ['obs']);
        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $this->insertNewPageModule($data);
        return true;
    }

    private function queryToLastOrderModule(): ?int
    {
        $select = "SELECT `order_module`
                   FROM `page_modules`
                   ORDER BY `order_module` DESC
                   LIMIT 1";

        $stmt = $this->conn->prepare($select);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    private function insertNewPageModule(array $data): void
    {
        $orderModule = $this->queryToLastOrderModule();
        $orderModule += 1;

        $insert = "INSERT INTO `page_modules` (`type`, `name`, `order_module`, `obs`, `created_at`)
                   VALUES (:type, :name, :order_module, :obs, NOW())";

        $stmt = $this->conn->prepare($insert);
        $stmt->bindValue(':type', ConvertToCapitularString::format($data['type']), \PDO::PARAM_STR);
        $stmt->bindValue(':name', ConvertToCapitularString::format($data['name']), \PDO::PARAM_STR);
        $stmt->bindValue(':order_module', $orderModule, \PDO::PARAM_INT);
        $stmt->bindValue(':obs', ucfirst(mb_strtolower($data['obs'],'UTF-8')) ?: null, \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Módulo de página cadastrado com sucesso!');
        } else {
            Flash::danger('Erro na criação do módulo de página!');
        }
    }
}
