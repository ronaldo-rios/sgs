<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class UpdatePageModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function update(?array $formData): bool
    {
        if ($formData) {
            ValidateEmptyField::validateField($formData, ['icon', 'obs']);
            if (! ValidateEmptyField::getResult()) {
                return false;
            }

            return $this->updatePage($formData);
        }

        return false;
    }

    public function viewInfoPage(int $id): ?array
    {
        return $this->detailsPage($id);
    }

    public function listPageTypes(): array
    {
        $query = "SELECT `id`, `type_name` FROM `page_types` ORDER BY `order_page_type`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return (array) $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listPageModules(): array
    {
        $query = "SELECT `id`, `name` FROM `page_modules` ORDER BY `order_module`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return (array) $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function detailsPage(int $id): array
    {
        $query = "SELECT * FROM `pages`
                  WHERE id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $finalResult = (array) $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            return $finalResult;
        }

        return [];
    }

    private function updatePage(array $formData): bool
    {
        $query = "UPDATE `pages`
                  SET `controller` = :controller,
                      `method` = :method,
                      `controller_in_the_main` = :controller_in_the_main,
                      `method_in_the_main` = :method_in_the_main,
                      `name_page` = :name_page,
                      `public` = :public,
                      `enable_in_sidebar` = :enable_in_sidebar,
                      `icon` = :icon,
                      `obs` = :obs,
                      `active_status` = :active_status,
                      `page_type_id` = :page_type_id,
                      `page_module_id` = :page_module_id,
                      `updated_at` = NOW()
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $formData['id'], PDO::PARAM_INT);
        $stmt->bindValue(':controller', $formData['controller'], PDO::PARAM_STR);
        $stmt->bindValue(':method', $formData['method'], PDO::PARAM_STR);
        $stmt->bindValue(':controller_in_the_main', $formData['controller_in_the_main'], PDO::PARAM_STR);
        $stmt->bindValue(':method_in_the_main', $formData['method_in_the_main'], PDO::PARAM_STR);
        $stmt->bindValue(':name_page', ConvertToCapitularString::format($formData['name_page']), PDO::PARAM_STR);
        $stmt->bindValue(':public', (int) $formData['public'], PDO::PARAM_INT);
        $stmt->bindValue(':enable_in_sidebar', (int) $formData['enable_in_sidebar'], PDO::PARAM_INT);
        $stmt->bindValue(':icon', $formData['icon'] ?: null, PDO::PARAM_STR);
        $stmt->bindValue(':obs', $formData['obs'] ?: null, PDO::PARAM_STR);
        $stmt->bindValue(':active_status', (int) $formData['active_status'], PDO::PARAM_INT);
        $stmt->bindValue(':page_type_id', (int) $formData['page_type_id'], PDO::PARAM_INT);
        $stmt->bindValue(':page_module_id', (int) $formData['page_module_id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Página atualizada com sucesso!');
            return true;
        }
        else {
            Flash::danger('Página não atualizada!');
            return false;
        }
    }
}
