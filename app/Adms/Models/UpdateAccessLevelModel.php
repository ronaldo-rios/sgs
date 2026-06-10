<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class UpdateAccessLevelModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function update(?array $formData): bool
    {
        if ($formData) {
            ValidateEmptyField::validateField($formData);
            if (! ValidateEmptyField::getResult()) {
                return false;
            }

            return $this->updateAccessLevel($formData);
        }

        return false;
    }

    public function viewInfoAccessLevel(int $id): ?array
    {
        return $this->detailsLevel($id);
    }

    private function detailsLevel(int $id): array
    {
        $query = "SELECT * FROM `access_levels` 
                  WHERE id = :id AND order_level > :order_level
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':order_level', $_SESSION['order_level'], \PDO::PARAM_INT);
        $stmt->execute();
        $finalResult = (array) $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            return $finalResult;
        }

        return [];
    }

    private function updateAccessLevel(array $formData): bool
    {
        $query = "UPDATE `access_levels` 
                  SET access_level = :access_level, updated_at = NOW() 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $formData['id'], \PDO::PARAM_INT);
        $stmt->bindValue(':access_level', ConvertToCapitularString::format($formData['name']), \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Nível de acesso atualizado com sucesso!');
            return true;
        } 
        else {
            Flash::danger('Nível de acesso não atualizado!');
            return false;
        }
    }
}