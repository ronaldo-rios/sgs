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
        $row = $this->detailsUser($id);

        return $row !== [] ? $row : null;
    }

    public function edit(?array $formData): bool
    {
        $this->data = $formData ?? [];
        ValidateEmptyField::validateField($this->data, ['password']);
        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $this->data['title'] = filter_var($this->data['title'], FILTER_DEFAULT);
        $this->data['name'] = filter_var($this->data['name'], FILTER_DEFAULT);
        $this->data['password'] = isset($this->data['password'])
            ? trim((string) $this->data['password'])
            : '';
        $this->data['email'] = trim(filter_var($this->data['email'], FILTER_VALIDATE_EMAIL));

        if (! $this->data['email']) {
            Flash::danger('Email inválido!');
            return false;
        }

        return $this->updateEmailConfig();
    }

    private function detailsUser(int $id): array
    {
        $query = "SELECT * FROM `config_emails` WHERE `id` =:id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $finalResult = (array) $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            return $finalResult;
        }

        return [];
    }

    private function updateEmailConfig(): bool
    {
        // If the password is empty, the password column is not updated.
        $update = 'UPDATE `config_emails` SET
            `name` = :name,
            `host` = :host,
            `username` = :username,
            `title` = :title,
            `smtp_secure` = :smtp_secure,
            `email` = :email,
            `port` = :port,
            `password` = COALESCE(NULLIF(:password, \'\'), `password`),
            `updated_at` = NOW()
            WHERE 
                `id` = :id';

        $stmt = $this->conn->prepare($update);
        $stmt->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':host', $this->data['host'], PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->data['username'], PDO::PARAM_STR);
        $stmt->bindValue(':smtp_secure', $this->data['smtp_secure'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':port', (int) $this->data['port'], PDO::PARAM_INT);
        $stmt->bindValue(':password', $this->data['password'], PDO::PARAM_STR);

        if (! $stmt->execute()) {
            Flash::danger('Erro ao atualizar e-mail server!');
            return false;
        }

        if ($stmt->rowCount() > 0) {
            Flash::success('Email de configuração atualizado com sucesso!');
            return true;
        }

        Flash::danger('Email de configuração não encontrado!');
        return false;
    }
}
