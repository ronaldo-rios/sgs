<?php

namespace App\adms\Models;

use App\Adms\Enum\ConfigEmails;
use App\Adms\Models\ConfigEmailCredencialsModel;
use App\Validators\ValidateEmptyField;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class NewConfirmEmailModel
{
    private ?array $data = null;
    private string $firstName;
    private array $emailData;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function newConfirmEmail(?array $data): bool
    {
        $this->data = $data;
        ValidateEmptyField::validateField($this->data);

        if(ValidateEmptyField::getResult() === false) {
            return false;
        }
        
        $resultUser = $this->queryUserInfo();
      
        if (! empty($resultUser)) {
            return $this->validateNewConfirmEmail($resultUser);
        }

        Flash::danger("Email não cadastrado na base de dados!");
        return false;    
    }

    private function queryUserInfo(): array
    {
        $sql = "SELECT `id`, `name`, `email`, `confirm_email` 
                FROM `users` 
                WHERE LOWER(`email`) = LOWER(:email)
                LIMIT 1";
        
        $resultUserInfo = $this->conn->prepare($sql);
        $resultUserInfo->bindValue(':email', $this->data['email'], \PDO::PARAM_STR);
        $resultUserInfo->execute();
        $finalResult = $resultUserInfo->fetch(PDO::FETCH_ASSOC);
        
        if ($resultUserInfo->rowCount() > 0) {
            return (array) $finalResult;
        }
        
        return [];
    }

    private function validateNewConfirmEmail(array $result): bool
    {
        if ((empty($result['confirm_email']) || ($result['confirm_email'] === null))) {
            $this->registerNewHashKey($result);
            return true;
        }
        else {
            return $this->sendNewConfirmEmail($result);
        }
    }

    private function registerNewHashKey(array $result): bool
    {
        $id = $result['id'];
        $newKey = password_hash($result['email'] . date('Y-m-d H:i:s'), PASSWORD_BCRYPT);
        $result['confirm_email'] = $newKey;

        $update = "UPDATE `users` 
                    SET `confirm_email` = :confirm_email, 
                       `updated_at` = NOW() 
                    WHERE `id` = :id";

        $updateHashKey = $this->conn->prepare($update);
        $updateHashKey->bindValue(':confirm_email', $result['confirm_email'], \PDO::PARAM_STR);
        $updateHashKey->bindValue(':id', $id, \PDO::PARAM_INT);
        $resultUpdate = $updateHashKey->execute();

        if ($resultUpdate) {
            $this->sendNewConfirmEmail($result);
            return true;
        }
        else {
            Flash::danger('Erro ao enviar novo link. Por favor, tente novamente.');
            return false;
        }
    }

    private function sendNewConfirmEmail(array $result): bool
    {
        $this->emailHtml($result);
        $this->emailText($result);

        $configEmailCredencials = new ConfigEmailCredencialsModel();
        $sent = $configEmailCredencials->readEmailCredencials(
            $this->emailData, 
            ConfigEmails::REGISTER_CONFIRMATION->value
        );

        if($sent) {
            Flash::success("Novo link enviado para o e-mail {$result['email']}! Confira sua caixa de entrada.");
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
        $this->emailData['subject'] = 'Confirmação de cadastro';

        $url = Config::url() . "/confirm-email/index?key={$result['confirm_email']}";
        $this->emailData['contentHtml'] = "<a><p>Olá <Strong>{$this->firstName}</strong>! Clique no link para confirmar seu cadastro!</p>";
        $this->emailData['contentHtml'] .= "<a href='$url'>{$url}</a><br><br>";
    }

    private function emailText(array $result): void
    {
        $url = Config::url() . "/conf-email/index?key={$result['confirm_email']}";
        $this->emailData['contentText'] = "Olá {$this->firstName}! Clique no link para confirmar seu cadastro!";
        $this->emailData['contentText'] .= $url . "\n\n";
    }
}