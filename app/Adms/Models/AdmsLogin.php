<?php

namespace App\Adms\Models;

use App\Adms\Enum\UserSituation;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class AdmsLogin
{
    private ?array $data = null;
    private bool $result = false;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function getResult(): bool
    {
        return $this->result;
    }

    public function login(array $data): void
    {
        $this->data = $data;
        $sqlUser = $this->conn->prepare(query: $this->validateUser());
        $sqlUser->bindValue(param: ':user', value: trim($this->data['user']), type: PDO::PARAM_STR);
        $sqlUser->execute();
        $resultUser = $sqlUser->fetch();

        if ($resultUser) {
            $this->validateIfEmailConfirm($resultUser);
        } 
        else {
            Flash::danger("Usuário ou senha incorretos");
            $this->result = false;
        }
    }

    private function validateUser(): string
    {
        return "SELECT 
                    user.id, user.name, user.nickname,
                    user.email, user.password, user.image,
                    user.user_situation_id, user.access_level_id, 
                    access.order_level
                FROM `users` AS user
                INNER JOIN `access_levels` AS access
                    ON user.access_level_id = access.id
                    WHERE UPPER(`user`) = UPPER(:user)
                    LIMIT 1";
    }

    private function validatePassword(?array $resultUser): void
    {
        $hash = trim((string) ($resultUser['password']));
        if (password_verify($this->data['password'], $hash)) {
            $_SESSION['user_id']           = $resultUser['id'];
            $_SESSION['user_name']         = $resultUser['name'];
            $_SESSION['user_nickname']     = $resultUser['nickname'];
            $_SESSION['user_email']        = $resultUser['email'];
            $_SESSION['user_image']        = $resultUser['image'];
            $_SESSION['user_situation_id'] = $resultUser['user_situation_id'];
            $_SESSION['access_level']      = $resultUser['access_level_id'];
            $_SESSION['order_level']       = $resultUser['order_level'];
            $this->result = true;
        }
        else {
            Flash::danger("Usuário ou senha incorretos");
            $this->result = false;
        }
    }

    private function validateIfEmailConfirm(array $resultUser): void
    {
        $userSituationId = $resultUser['user_situation_id'];
        $message = "";

        $message = match ($userSituationId) {
            UserSituation::CONFIRMED_EMAIL->value => $this->validatePassword($resultUser),
            UserSituation::WAITING_FOR_CONFIRMATION->value => "Você precisa confirmar seu e-mail para acessar. 
            Clique <a href='" . Config::url() . "new-confirm-email/index'> aqui </a> para reenviar o e-mail de confirmação.",
            UserSituation::NOT_REGISTERED->value => "Usuário não cadastrado. Entre em contato com a empresa",
            default => "Usuário inativo. Entre em contato com a empresa",
        };

        if (is_string($message)) {
            Flash::danger($message);
        }
    }
}