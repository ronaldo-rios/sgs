<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class UpdatePageModuleModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function update(?array $formData): bool
    {
        if ($formData) {
            ValidateEmptyField::validateField($formData, ['obs']);
            if (! ValidateEmptyField::getResult()) {
                return false;
            }

            return $this->updatePageModule($formData);
        }

        return false;
    }

    public function viewInfoPageModule(int $id): ?array
    {
        return $this->detailsPageModule($id);
    }

    private function detailsPageModule(int $id): array
    {
        $query = "SELECT * FROM `page_modules`
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

    private function updatePageModule(array $formData): bool
    {
        $query = "UPDATE `page_modules`
                  SET type_module = :type_module, name_module = :name_module, obs = :obs, updated_at = NOW()
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $formData['id'], \PDO::PARAM_INT);
        $stmt->bindValue(':type_module', ConvertToCapitularString::format($formData['type_module']), \PDO::PARAM_STR);
        $stmt->bindValue(':name_module', ConvertToCapitularString::format($formData['name_module']), \PDO::PARAM_STR);
        $stmt->bindValue(':obs', ucfirst(mb_strtolower($formData['obs'],'UTF-8')) ?: null, \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Módulo de página atualizado com sucesso!');
            return true;
        }
        else {
            Flash::danger('Módulo de página não atualizado!');
            return false;
        }
    }
}
