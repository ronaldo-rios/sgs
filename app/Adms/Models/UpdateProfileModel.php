<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Upload\FileUpload;
use App\Upload\UploadPathResolver;
use App\Validators\ValidateEmptyField;
use App\Validators\ValidatePassword;
use Core\Config;
use PDO;

class UpdateProfileModel
{
    private PDO $conn;
    private ?array $data = [];
    private string $encriptPassword;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function viewProfile(): array
    {
        return $this->getInfoProfile();
    }

    private function getInfoProfile(): array
    {
        $query = "SELECT `name`, `email`, `image`, `password`, `user`
                  FROM `users`
                  WHERE `id` = :id LIMIT 1";

        $statement = $this->conn->prepare($query);
        $statement->bindValue(':id', (int) $_SESSION['user_id'], \PDO::PARAM_INT);
        $statement->execute();
        $resultProfile = (array) $statement->fetch(\PDO::FETCH_ASSOC);

        return $resultProfile !== [] ? $resultProfile : [];
    }

    public function update(?array $formData): bool
    {
        $this->data = $formData ?? [];
        $userId = (int) $_SESSION['user_id'];

        $ignoreFields = ['image'];
        ValidateEmptyField::validateField($this->data, $ignoreFields);

        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        $user = $this->queryUser($userId);

        if ($user !== []) {
            $this->verifyIfEmailExists($user);
            $this->verifyIfUserExists($user);

            return false;
        }

        ValidatePassword::validate($this->data['password']);
        if (ValidatePassword::getResult() === false) {
            return false;
        }

        $file = FileUpload::requestUploadedFile('image');
        if ($file === false) {
            return false;
        }

        $this->data['image'] = $file;
        $this->encriptPassword = password_hash($this->data['password'], PASSWORD_ARGON2ID);
        $this->data['email'] = trim(filter_var($this->data['email'], FILTER_VALIDATE_EMAIL));

        if (! $this->data['email']) {
            Flash::danger('Email inválido!');
            return false;
        }

        return $this->updateUser($userId);
    }

    private function updateUser(int $userId): bool
    {
        $existingImage = $this->fetchCurrentUserImage($userId);

        if ($this->data['image'] !== null) {
            $dir = UploadPathResolver::directoryFromConfiguredBase(
                basePath: Config::PATH_USER_IMAGE,
                relativeSegments: [(string) $userId]
            );

            $uploaded = FileUpload::upload(
                file: $this->data['image'], 
                directoryAbsolute: $dir, 
                allowedExtensions: ['jpg', 'jpeg', 'png'], 
            );

            if ($uploaded === false) {
                return false;
            }

            if ($existingImage !== null && $existingImage !== '' && $existingImage !== $uploaded) {
                FileUpload::unlinkIfExists($dir . basename($existingImage));
            }

            $this->data['image'] = $uploaded;
        } 
        else {
            $this->data['image'] = $existingImage;
        }

        $update = "UPDATE `users`
                        SET `name` = :name, `email` = :email,
                            `password` = :password, `user` = :user,
                            `image` = :image, `updated_at` = NOW()
                        WHERE `id` = :id";

        $stmt = $this->conn->prepare($update);
        $stmt->bindValue(':name', ConvertToCapitularString::format($this->data['name']), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->data['email'], \PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->encriptPassword, \PDO::PARAM_STR);
        $stmt->bindValue(':user', $this->data['user'], \PDO::PARAM_STR);

        (! empty($this->data['image']))
            ? $stmt->bindValue(':image', (string) $this->data['image'], \PDO::PARAM_STR)
            : $stmt->bindValue(':image', null, \PDO::PARAM_NULL);

        $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $_SESSION['user_name'] = $this->data['name'];
            $_SESSION['user_email'] = $this->data['email'];
            $_SESSION['user_image'] = $this->data['image'] ?? '';

            Flash::success('Perfil atualizado com sucesso!');
            return true;
        }

        Flash::danger('Erro ao atualizar usuário!');
        return false;
    }

    private function fetchCurrentUserImage(int $id): ?string
    {
        $queryImage = "SELECT `image`
                       FROM `users` WHERE `id` = :id";

        $statement = $this->conn->prepare($queryImage);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchColumn();

        return ! empty($result) ? (string) $result : null;
    }

    private function queryUser(int $currentUserId): array
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
        $sqlUser->bindValue(':id', $currentUserId, \PDO::PARAM_INT);
        $sqlUser->execute();
        $user = $sqlUser->fetch(\PDO::FETCH_ASSOC);

        return $user !== false ? (array) $user : [];
    }

    private function verifyIfEmailExists(?array $userExists): void
    {
        if($userExists['email'] && $userExists['email'] === $this->data['email']) {
            Flash::danger('Email já existe. Tente outro e-mail.');
        }
    }

    private function verifyIfUserExists(?array $userExists): void
    {
        if($userExists['user'] && $userExists['user'] === $this->data['user']) {
            Flash::danger('Usuário já existe!');
        }
    }
}
