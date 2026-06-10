<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class DeleteAccessLevelModel
{
    private PDO $conn;
    
    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function delete(int $id): void
    {
        $accessLevelIsNotInUse = $this->checkIfAccessLevelIsLinkedToUser($id);

        if ($accessLevelIsNotInUse) {
            $this->deleteAccessLevel($id);
        }
    }

    /**
     * Check if the access level is linked to a user. If it is, it is not possible to delete it.
     * @param int $id
     * @return bool
     */
    private function checkIfAccessLevelIsLinkedToUser(int $id): bool
    {
        $select = "SELECT `id` 
                   FROM `users` 
                   WHERE access_level_id = :id";

        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::danger('Não é possível excluir este nível de acesso, pois ele está vinculado a um ou mais usuários!');
            return false;
        }
        
        return true; 
    }

    private function deleteAccessLevel(int $id): bool
    {
        $delete = "DELETE FROM `access_levels` 
                   WHERE id = :id AND `order_level` > :order_level";

        $stmt = $this->conn->prepare($delete);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':order_level', $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::success('Nível de acesso excluído com sucesso!');
            return true;
        }
        else {
            Flash::danger('Erro ao tentar excluir nível de acesso!');
            return false;
        }
    }
}