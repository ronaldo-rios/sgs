<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class DeleteConfigEmailModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function delete(int $id): bool
    {
        $emalServer = $this->queryEmailConfig($id);

        if (! empty($emalServer)) {
            $this->deleteEmailConfig($id);
            return true;
        }

        return false;
    }

    private function deleteEmailConfig(int $id): void
    {
        $delete = "DELETE FROM `config_emails` WHERE id = :id";

        $stmt = $this->conn->prepare($delete);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $stmt->rowCount()
            ? Flash::success('E-mail de configuração excluído com sucesso!')
            : Flash::danger('Erro ao tentar excluir e-mail! de configuração');
    }

    private function queryEmailConfig(int $id): array
    {
        $sqlquery = "SELECT `id`
                        FROM `config_emails` 
                        WHERE id = :id";

        $stmt = $this->conn->prepare($sqlquery);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return (array) $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}