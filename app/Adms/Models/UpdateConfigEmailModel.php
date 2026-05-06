<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class UpdateConfigEmailModel
{
    private array $data;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }
    
    public function viewInfoEmailServer(int $id): ?array
    {
        return $this->detailsUser($id);
    }

    public function edit(?array $formData): bool
    {
        $this->data = $formData;
        ValidateEmptyField::validateField($this->data);
        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $this->data['title'] = filter_var($this->data['title'], FILTER_DEFAULT);
        $this->data['name'] = filter_var($this->data['name'], FILTER_DEFAULT);
        $this->data['password'] = trim($this->data['password']);
        $this->data['email'] = trim(filter_var($this->data['email'], FILTER_VALIDATE_EMAIL));

        if (! $this->data['email']) {
            Flash::danger('Email inválido!');
            return false;
        }

        $this->updateEmailConfig(); 
        return true; 
    }

    private function detailsUser(int $id): array
    {
        $query = "SELECT * FROM `config_emails` WHERE `id` =:id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $finalResult = (array) $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0){
            return $finalResult;
        }

        return [];
    }

    private function updateEmailConfig(): void
    {
        $update = "UPDATE `config_emails` 
                   SET `name` = :name, `host` = :host, 
                       `username` = :username, `title` = :title, 
                       `smtp_secure` = :smtp_secure,`password` = :password, 
                       `port` = :port, `updated_at` = NOW()
                   WHERE `id` = :id";

        $stmt = $this->conn->prepare($update);
        $stmt->bindParam(':id', $this->data['id'], \PDO::PARAM_INT);
        $stmt->bindParam(':title', $this->data['title'], \PDO::PARAM_STR);
        $stmt->bindParam(':name', $this->data['name'], \PDO::PARAM_STR);
        $stmt->bindParam(':host', $this->data['host'], \PDO::PARAM_STR);
        $stmt->bindParam(':username', $this->data['username'], \PDO::PARAM_STR);
        $stmt->bindParam(':smtp_secure', $this->data['smtp_secure'], \PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->data['password'], \PDO::PARAM_STR);
        $stmt->bindParam(':port', $this->data['port'], \PDO::PARAM_INT);
        $stmt->execute();

        $stmt->rowCount()
            ? Flash::success('Email de configuração atualizado com sucesso!')
            : Flash::danger('Erro ao atualizar e-mail server!');
    }
}