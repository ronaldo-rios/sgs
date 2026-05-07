<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class AddConfiEmailModel
{
    private bool $result;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function add(?array $formData): bool
    {
        $formData;
        ValidateEmptyField::validateField($formData);

        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $formData['title'] = trim($formData['title']);
        $formData['name'] = trim($formData['name']);
        $formData['password'] = trim((string) $formData['password']);
        $formData['email'] = trim(filter_var($formData['email'], FILTER_VALIDATE_EMAIL));

        if (! $formData['email']) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Email inválido!</div>";
            return false;
        }

        return $this->insertConfigEmail($formData);
    }

    private function insertConfigEmail(?array $formData): bool
    {
        $insert = "INSERT INTO `config_emails` 
                  (
                    `title`, `name`, `email`, `host`, `username`, 
                    `password`, `smtp_secure`, `port`, `created_at`
                  ) 
                  VALUES 
                  (
                    :title, :name, :email, :host, :username,
                    :password, :smtp_secure, :port, NOW()
                  )";

        $stmt = $this->conn->prepare($insert);
        $stmt->bindValue(':title', ConvertToCapitularString::format(($formData['title'])), \PDO::PARAM_STR);
        $stmt->bindValue(':name', ConvertToCapitularString::format($formData['name']), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $formData['email'], \PDO::PARAM_STR);
        $stmt->bindValue(':host', trim($formData['host']), \PDO::PARAM_STR);
        $stmt->bindValue(':username', trim($formData['username']), \PDO::PARAM_STR);
        $stmt->bindValue(':password', $formData['password'], \PDO::PARAM_STR);
        $stmt->bindValue(':smtp_secure', trim($formData['smtp_secure']), \PDO::PARAM_STR);
        $stmt->bindValue(':port', $formData['port'], \PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount()) {
            Flash::success('E-mail de Configuração cadastrado com sucesso!');
            return true;
        }
        else {
            Flash::danger('Houve algum erro ao tentar cadastrar E-mail de Configuração!');
            return false;
        }
    }
}