<?php

namespace App\Adms\Models;

use App\Adms\Enum\AccessLevels;
use App\Adms\Enum\ConfigEmails;
use App\Adms\Enum\UserSituation;
use App\Adms\Models\ConfigEmailCredencialsModel;
use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use App\Validators\ValidatePassword;
use Core\Config;

class AddNewUserModel 
{
    private ?array $data;
    private object $conn;
    private string $firstName;
    private array $emailData;
    private string $confirmEmail;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function create(?array $data): bool
    {
        $this->data = $data;
        ValidateEmptyField::validateField($this->data);

        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $sqlUser = $this->conn->prepare($this->queryUser());
        $sqlUser->bindValue(':user', trim($this->data['user']), \PDO::PARAM_STR);
        $sqlUser->bindValue(':email', trim($this->data['email']), \PDO::PARAM_STR);
        $sqlUser->execute();
        $ifExists = $sqlUser->fetch();

        if ($ifExists) {
            $this->verifyIfEmailExists($ifExists);
            $this->verifyIfUserExists($ifExists);
            return false;
        }

        ValidatePassword::validate($this->data['password']);
        if (ValidatePassword::getResult() === false) {
            return false;
        }
        
        $encriptPassword = password_hash($this->data['password'], PASSWORD_ARGON2ID);
        $email = trim(filter_var($this->data['email'], FILTER_VALIDATE_EMAIL));
        $this->confirmEmail = password_hash($encriptPassword . date('Y-m-d H:i:s'), PASSWORD_BCRYPT);

        if (! $email) {
            Flash::danger("Email inválido!");
            return false;
        }

        $sqlInsert = $this->insertUser($email, $encriptPassword, $this->confirmEmail);

        if (! $sqlInsert) {
            Flash::danger("Erro ao cadastrar usuário!");
            return false;
        }

        return $this->sendEmail();
    }

    private function queryUser(): string
    {
        return "SELECT `id`, `user`, `email` 
            FROM `users` 
            WHERE 
            (UPPER(`user`) = UPPER(:user)) OR (`email` = :email)
            LIMIT 1";
    }

    private function verifyIfEmailExists(?array $emailExists): void
    {
        if($emailExists['email'] && $emailExists['email'] === $this->data['email']) {
            Flash::danger("Email já existe. Tente outro e-mail.");
        } 
    }

    private function verifyIfUserExists(?array $userExists): void
    {
        if($userExists['user'] && $userExists['user'] === $this->data['user']) {
            Flash::danger("Usuário já existe!");
        }
    }

    private function insertUser($email, $encriptPassword, $confirmEmail): string
    {
        $insert = "INSERT INTO `users` 
            (`name`, `email`, `user`, `password`, `confirm_email`, `user_situation_id`, `access_level_id`, `created_at`) 
            VALUES 
            (:name, LOWER(:email), UPPER(:user), :password, :confirm_email, :user_situation, :access_level_id, NOW())";

        $sqlInsert = $this->conn->prepare($insert);
        $sqlInsert->bindValue(':name', ConvertToCapitularString::format($this->data['name']), \PDO::PARAM_STR);
        $sqlInsert->bindValue(':email', $email, \PDO::PARAM_STR);
        $sqlInsert->bindValue(':user', trim($this->data['user']), \PDO::PARAM_STR);
        $sqlInsert->bindValue(':password', $encriptPassword, \PDO::PARAM_STR);
        $sqlInsert->bindValue(':confirm_email', $confirmEmail, \PDO::PARAM_STR);
        $sqlInsert->bindValue(':access_level_id', AccessLevels::USER_DEFAULT->value, \PDO::PARAM_INT);
        $sqlInsert->bindValue(':user_situation', UserSituation::WAITING_FOR_CONFIRMATION->value, \PDO::PARAM_INT);
        return $sqlInsert->execute();
    }

    private function sendEmail(): bool
    {
        $this->contentEmailHtml();
        $this->contentEmailText();

        $emailCreencials = new ConfigEmailCredencialsModel();
        $sent = $emailCreencials->readEmailCredencials(
            $this->emailData, 
            ConfigEmails::REGISTER_CONFIRMATION->value
        );

        if ($sent) {
            Flash::success("
                Usuário cadastrado com sucesso! 
                Um email de confirmação foi enviado para o email informado."
            );
            return true;
        }

        Flash::danger("Erro ao enviar e-mail de confirmação! Entre em contato com " . Config::admEmail());
        return false;
    }

    private function contentEmailHtml(): void
    {
        $name = explode(" ", $this->data['name']);
        $this->firstName = $name[0];
        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->data['name'];
        $this->emailData['subject'] = 'Confirmação de cadastro';

        $url = Config::url() . "/confirm-email/index?key={$this->confirmEmail}";
        $this->emailData['contentHtml'] = "<a><p>Olá <Strong>{$this->firstName}</strong>! Clique no link para confirmar seu cadastro!</p>";
        $this->emailData['contentHtml'] .= "<a href='$url'>{$url}</a><br><br>";
    }

    private function contentEmailText(): void
    {
        $url = Config::url() . "/conf-email/index?key={$this->confirmEmail}";
        $this->emailData['contentText'] = "Olá {$this->firstName}! Clique no link para confirmar seu cadastro!";
        $this->emailData['contentText'] .= $url . "\n\n";
    }
}