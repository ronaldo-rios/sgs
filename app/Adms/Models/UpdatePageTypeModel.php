<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class UpdatePageTypeModel
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

            return $this->updatePageType($formData);
        }

        return false;
    }

    public function viewInfoPageType(int $id): ?array
    {
        return $this->detailsPageType($id);
    }

    private function detailsPageType(int $id): array
    {
        $query = "SELECT * FROM `page_types`
                  WHERE id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $finalResult = (array) $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            return $finalResult;
        }

        return [];
    }

    private function updatePageType(array $formData): bool
    {
        $query = "UPDATE `page_types`
                  SET type_name = :type_name, updated_at = NOW()
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $formData['id'], \PDO::PARAM_INT);
        $stmt->bindValue(':type_name', ConvertToCapitularString::format($formData['type_name']), \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Tipo de página atualizado com sucesso!');
            return true;
        }
        else {
            Flash::danger('Tipo de página não atualizado!');
            return false;
        }
    }
}
