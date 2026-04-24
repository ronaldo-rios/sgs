<?php

namespace App\Adms\Models;

use App\Adms\Enum\ConfigEmails;
use App\Adms\Models\ConfigEmailCredencialsModel;
use App\Helpers\Connection;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class RecoverPasswordModel
{
    private PDO $conn;
    private array $emailData;
    private string $firstName;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function recover(?array $data): bool
    {
        ValidateEmptyField::validateField($data);

        if(! ValidateEmptyField::getResult()) {
            return false;
        }

        $resultUser = $this->validateUser($data);

        if(! empty($resultUser)) {
            return $this->updateRecoverPassword($resultUser);
        }
        else {
            Flash::danger('Email não cadastrado na base de dados!');
            return false;
        }

    }

    private function validateUser(array $data): array
    {
        $query = "SELECT `id`, `name`, `email`, `recover_password` 
                  FROM `users` 
                  WHERE `email` = :email 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->execute();
        $resultUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if (! empty($resultUser)) {
            return (array) $resultUser;
        }

        return [];
    }

    private function updateRecoverPassword(array $resultUser): bool
    {
        $recoverPasswordHash = password_hash($resultUser['email'] . date('Y-m-d H:i:s'), PASSWORD_BCRYPT);
        $resultUser['recover_password'] = $recoverPasswordHash;
        $id = $resultUser['id'];

        $update = "UPDATE `users` 
                  SET `recover_password` = :recover_password,
                      `updated_at` = NOW()
                  WHERE `id` = :id";

        $stmt = $this->conn->prepare($update);
        $stmt->bindValue(':recover_password', $resultUser['recover_password'], \PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $this->sendEmail($resultUser);
        }

        Flash::danger('Link para recuperação de senha não foi enviado. Por favor, tente novamente');
        return false;   
    }

    private function sendEmail(array $resultUser): bool
    {
        $this->emailHtml($resultUser);
        $this->emailText($resultUser);

        $emailCreencials = new ConfigEmailCredencialsModel();
        $sent = $emailCreencials->readEmailCredencials(
            $this->emailData, 
            ConfigEmails::RECOVER_PASSWORD->value
        );

        if ($sent) {
            Flash::success("Novo link enviado para o e-mail {$resultUser['email']}! Confira sua caixa de entrada.");
            return true;
        }
        else {
            Flash::danger("Erro ao enviar e-mail de confirmação! Entre em contato com " . Config::admEmail());
            return false;
        }
    }

    private function emailHtml(array $result): void
    {
        $name = explode(" ", $result['name']);
        $this->firstName = $name[0];
        $this->emailData['toEmail'] = $result['email'];
        $this->emailData['toName'] = $result['name'];
        $this->emailData['subject'] = 'Recuperar Senha';

        $url = Config::url() . "/update-password/index?key={$result['recover_password']}";
        $this->emailData['contentHtml'] = "<a><p>Olá <Strong>{$this->firstName}</strong>! Você solicitou a recuperação de seu acesso. 
        Clique no link para atualizar sua senha!</p>";
        $this->emailData['contentHtml'] .= "<a href='$url'>{$url}</a><br><br>";
    }

    private function emailText(array $result): void
    {
        $url = Config::url() . "/update-password/index?key={$result['recover_password']}";
        $this->emailData['contentText'] = "Olá {$this->firstName}! Você solicitou a recuperação de seu acesso. 
        Clique no link para atualizar sua senha!";
        $this->emailData['contentText'] .= $url . "\n\n";
    }
}