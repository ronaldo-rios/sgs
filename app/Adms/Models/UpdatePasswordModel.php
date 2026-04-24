<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use App\Validators\ValidatePassword;
use Core\Config;
use PDO;


class UpdatePasswordModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function validate(?string $keyHash): bool
    {
        $resultOfHash = $this->verifyKeyHash($keyHash);
        return $resultOfHash ? true : false;
    }

    public function update(?array $data): bool
    {
        ValidateEmptyField::validateField($data);
        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        ValidatePassword::validate($data['password']);
        if (! ValidatePassword::getResult()) {
            return false;
        }
        
        if (! empty($data)) {
            $password = (string) password_hash($data['password'], PASSWORD_ARGON2ID);
            $key = (string) $data['key'];
            $userInfo = $this->verifyKeyHash($key);
            $this->updatePassword($password, $key, $userInfo);
            return true;
        }
        else {
            Flash::danger('Link inválido! Solicite um novo link.');
            return false;
        }
    }

    private function verifyKeyHash(string $key): array
    {
        $query = "SELECT `id`, `name`, `email`, `recover_password` 
                  FROM `users` 
                  WHERE `recover_password` = :recover_password 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':recover_password', $key, PDO::PARAM_STR);
        $stmt->execute();
        $resultHash = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($stmt->rowCount() > 0) {
            return (array) $resultHash;
        }
       
        return [];
    }

    private function updatePassword(string $hashPassword, string $key, array $userInfo): bool
    {
        $id = $userInfo['id'];

        $update = "UPDATE `users` 
                        SET `password` = :password,
                            `updated_at` = NOW()
                        WHERE `recover_password` = :recover_password
                        AND `id` = :id";

        $stmt = $this->conn->prepare($update);
        $stmt->bindValue(':password', $hashPassword, PDO::PARAM_STR);
        $stmt->bindValue(':recover_password', $key, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::success('Senha atualizada com sucesso!');
            return true;
        }
        else {
            Flash::danger('Link inválido! Solicite um novo link.');
            return false;
        }
    }

}