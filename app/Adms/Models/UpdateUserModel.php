<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Helpers\UploadImage;
use App\Validators\ValidateEmptyField;
use App\Validators\ValidatePassword;
use Core\Config;
use PDO;

class UpdateUserModel
{
    private PDO $conn;
    private ?array $data;
    private string $encriptPassword;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function viewInfoUser(int $id): ?array
    {
        return $this->detailsUser($id);
    }

    public function update(?array $formData): bool
    {
        $this->data = $formData;
        $ignoreFields = ['image'];
        ValidateEmptyField::validateField($this->data, $ignoreFields);

        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $user = $this->queryUser();

        if ($user) {
            $this->verifyIfEmailExists($user);
            $this->verifyIfUserExists($user);
            return false;
        }

        ValidatePassword::validate($this->data['password']);
        if (ValidatePassword::getResult() === false) {
            return false;
        }

        $this->data['image'] = !empty($_FILES['image']['name']) ? $_FILES['image'] : null;
        $this->encriptPassword = password_hash($this->data['password'], PASSWORD_ARGON2ID);
        $this->data['email'] = trim(filter_var($this->data['email'], FILTER_VALIDATE_EMAIL));

        if (! $this->data['email']) {
            Flash::danger('Email inválido!');
            return false;
        }

        return $this->updateUser();
    }

    public function listSelectSituation(): ?array
    {
        $sql = "SELECT `id`, `situation_name` 
                FROM `users_situation`
                ORDER BY `id` ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listSelectAccessLevel(): ?array
    {
        $sql = "SELECT `id`, `access_level` 
                FROM `access_levels`
                WHERE `order_level` > :order_level
                ORDER BY `order_level` ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':order_level', $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function detailsUser(int $id): ?array
    {
        $queryUser = "SELECT u.id, u.name, u.email, u.password,
                             u.user, u.image, u.access_level_id, 
                             u.user_situation_id, u.updated_at
                      FROM `users` AS u
                        INNER JOIN `access_levels` AS al
                            ON u.access_level_id = al.id
                      WHERE u.id = :id AND al.order_level > :order_level
                      LIMIT 1";

        $stmt = $this->conn->prepare($queryUser);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':order_level', $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->execute();
        $dataResult = (array) $stmt->fetch(\PDO::FETCH_ASSOC);

        if (! empty($dataResult)) {
            return $dataResult;
        }

        Flash::danger("Usuário não encontrado!");
        return [];
    }

    private function fetchCurrentUserImage(int $id): ?string
    {
        $queryImage = "SELECT `image` 
                       FROM `users` WHERE `id` = :id";

        $statement = $this->conn->prepare($queryImage);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchColumn();
        return !empty($result) ? (string) $result : null;
    }

    private function queryUser(): array
    {
        $sql = "SELECT `id`, `user`, `email`
                FROM `users` 
                WHERE `id` <> :id
                AND (
                        (UPPER(`user`) = UPPER(:user)) 
                        OR 
                        (LOWER(`email`) = LOWER(:email))
                    )
                LIMIT 1";

        $sqlUser = $this->conn->prepare($sql);
        $sqlUser->bindValue(':user', $this->data['user'], \PDO::PARAM_STR);
        $sqlUser->bindValue(':email', $this->data['email'], \PDO::PARAM_STR);
        $sqlUser->bindValue(':id', $this->data['id'], \PDO::PARAM_INT);
        $sqlUser->execute();
        $user = (array) $sqlUser->fetch(\PDO::FETCH_ASSOC);

        if ($sqlUser->rowCount() > 0) {
            return $user;
        }

        return [];
    }

    private function updateUser(): bool
    {
        
        if($this->data['image'] !== null) {
            // Get user details to delete old image if !empty
            $oldImage = $this->fetchCurrentUserImage((int) $this->data['id']);
           
            if ($oldImage) {
                UploadImage::deleteBeforeImage($this->data, $oldImage);
            } 

            $this->data['image'] = UploadImage::uploadUserImage($this->data);
        }
     
        $update = "UPDATE `users`
                        SET `name` = :name, `email` = :email, `password` = :password,
                            `user` = :user, `access_level_id` = :access_level_id,
                            `image` = :image, `user_situation_id` = :user_situation_id, 
                            `updated_at` = NOW()
                        WHERE `id` = :id";

        $stmt = $this->conn->prepare($update);
        $stmt->bindValue(':name', ConvertToCapitularString::format($this->data['name']), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->data['email'], \PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->encriptPassword, \PDO::PARAM_STR);
        $stmt->bindValue(':user', $this->data['user'], \PDO::PARAM_STR);
        $stmt->bindValue(':image', $this->data['image'], \PDO::PARAM_STR);
        $stmt->bindValue(':user_situation_id', $this->data['user_situation_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':access_level_id', $this->data['access_level_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $this->data['id'], \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success("Usuário atualizado com sucesso!");
            return true;
        } else {
            Flash::danger("Erro ao atualizar usuário!");
            return false;
        }
    }

    private function verifyIfEmailExists(?array $userExists): void
    {
        if($userExists['email'] && $userExists['email'] === $this->data['email']) {
            Flash::danger("Email já existe. Tente outro e-mail.");
        } 
    }

    private function verifyIfUserExists(?array $userExists): void
    {
        if($userExists['user'] && $userExists['user'] === $this->data['user']) {
            Flash::danger("Usuário já existe!");
        }
    }
}