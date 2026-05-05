<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\DeleteDirectoryAndFiles;
use App\Helpers\Flash;
use App\Upload\UploadPathResolver;
use Core\Config;
use PDO;

class DeleteUserModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function delete(int $id): bool
    {
        $user = $this->getUser($id);

        if (! empty($user) && ((int) $user['order_level'] > (int) $_SESSION['order_level'])) {
            $deleted = $this->deleteUser($id);
            if (! $deleted) {
                return false;
            }

            if (! empty($user['image'])) {
                $imagePath = UploadPathResolver::directoryFromConfiguredBase(
                    Config::PATH_USER_IMAGE,
                    [(string) $user['id']]
                );
                DeleteDirectoryAndFiles::delete($imagePath);
            }
            return true;
        }
        else {
            Flash::danger('Usuário não encontrado!');
            return false;
        }
    }

    private function getUser(int $id): array
    {
        $query = "SELECT user.id, user.image, access.order_level
                  FROM `users` AS user
                    INNER JOIN `access_levels` AS access
                      ON user.access_level_id = access.id
                  WHERE user.id = :id 
                    AND access.order_level > :order_level
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':order_level', $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->execute();
        return (array) $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function deleteUser(int $id): bool
    {
        $delete = "DELETE FROM users 
                   WHERE id = :id";

        $stmt = $this->conn->prepare($delete);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount()) {
            Flash::success('Usuário excluído com sucesso!');
            return true;
        }
        else {
            Flash::danger('Erro ao tentar excluir usuário!');
            return false;
        }
    }
}