<?php

namespace App\Adms\Models;

use App\Adms\Enum\UserSituation;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class LoginModel
{
    private ?array $data = null;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function login(array $data): bool
    {
        $this->data = $data;
        $sqlUser = $this->conn->prepare(query: $this->validateUser());
        $sqlUser->bindValue(param: ':user', value: trim($this->data['user']), type: PDO::PARAM_STR);
        $sqlUser->execute();
        $resultUser = $sqlUser->fetch();

        if ($resultUser) {
            return $this->validateIfEmailConfirm($resultUser);
        }

        Flash::danger("Usuário ou senha incorretos");
        return false;
    }

    private function validateUser(): string
    {
        return "SELECT 
                    u.id, u.name, u.email, 
                    u.password, u.image, u.user_situation_id, 
                    u.access_level_id, al.order_level
                FROM `users` AS u
                INNER JOIN `access_levels` AS al
                    ON u.access_level_id = al.id
                    WHERE UPPER(u.user) = UPPER(:user)
                    LIMIT 1";
    }

    private function validatePassword(?array $resultUser): bool
    {
        $hash = trim((string) ($resultUser['password']));
        if (password_verify($this->data['password'], $hash)) {
            $_SESSION['user_id']           = $resultUser['id'];
            $_SESSION['user_name']         = $resultUser['name'];
            $_SESSION['user_email']        = $resultUser['email'];
            $_SESSION['user_image']        = $resultUser['image'];
            $_SESSION['user_situation_id'] = $resultUser['user_situation_id'];
            $_SESSION['access_level']      = $resultUser['access_level_id'];
            $_SESSION['order_level']       = $resultUser['order_level'];
            return true;
        } 
        else {
            Flash::danger("Usuário ou senha incorretos");
            return false;
        }
    }

    private function validateIfEmailConfirm(array $resultUser): bool
    {
        $userSituationId = (int) $resultUser['user_situation_id'];

        if ($userSituationId === UserSituation::CONFIRMED_EMAIL->value) {
            return $this->validatePassword($resultUser);
        }

        $message = match ($userSituationId) {
            UserSituation::WAITING_FOR_CONFIRMATION->value => "Você precisa confirmar seu e-mail para acessar. 
            Clique <a href='" . Config::url() . "/new-confirm-email/index'> aqui </a> para reenviar o e-mail de confirmação.",
            UserSituation::INACTIVE->value => "Usuário inativo ou não cadastrado. Entre em contato com a empresa.",
            default => "Usuário não cadastrado. Entre em contato com a empresa.",
        };

        Flash::danger($message);
        return false;
    }
}