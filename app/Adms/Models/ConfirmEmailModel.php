<?php

namespace App\Adms\Models;

use App\Adms\Enum\UserSituation;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class ConfirmEmailModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function confirm(string $key): bool
    {
        if(! empty($key)) {
           
            $resultToHash = $this->queryHashConfirmEmail($key);

            if($resultToHash) {
                $this->updateSituation($resultToHash);
                Flash::success('Email confirmado com sucesso!');
                return true;
            }
            else {
                Flash::danger('Link inválido!');
                return false;
            }
        }
        else {
            Flash::danger('Link inválido!');
            return false;
        }
    }

    private function queryHashConfirmEmail(string $key): int
    {
        $sql = "SELECT `id`
                FROM `users` 
                WHERE `confirm_email` = :hash_confirm_email 
                LIMIT 1";

        $resultToHash = $this->conn->prepare($sql);
        $resultToHash->bindValue(':hash_confirm_email', $key, \PDO::PARAM_STR);
        $resultToHash->execute();
        return (int) $resultToHash->fetchColumn();
    }

    private function updateSituation(int $id): bool
    {
        $confirmEmail = null;
        $update = "UPDATE `users` 
                   SET `confirm_email` = :confirm_email,
                       `user_situation_id` = :user_situation_id, 
                       `updated_at` = NOW()
                   WHERE `id` = :id";

        $updateSituation = $this->conn->prepare($update);
        $updateSituation->bindValue(':confirm_email', $confirmEmail);
        $updateSituation->bindValue(':user_situation_id', UserSituation::CONFIRMED_EMAIL->value, \PDO::PARAM_INT);
        $updateSituation->bindValue(':id', $id, \PDO::PARAM_INT);
        return $updateSituation->execute();
    }
}