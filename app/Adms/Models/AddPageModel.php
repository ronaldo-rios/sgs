<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\ConvertToCapitularString;
use App\Helpers\Flash;
use App\Validators\ValidateEmptyField;
use Core\Config;
use PDO;

class AddPageModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function add(?array $data): bool
    {
        ValidateEmptyField::validateField($data, ['icon', 'obs']);
        if (! ValidateEmptyField::getResult()) {
            return false;
        }

        return $this->insertNewPage($data);
    }

    /**
     * List all page types to populate the form select.
     * @return array<int, array<string, mixed>>
     */
    public function listPageTypes(): array
    {
        $query = "SELECT `id`, `type_name` FROM `page_types` ORDER BY `order_page_type`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return (array) $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * List all page modules to populate the form select.
     * @return array<int, array<string, mixed>>
     */
    public function listPageModules(): array
    {
        $query = "SELECT `id`, `name` FROM `page_modules` ORDER BY `order_module`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return (array) $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function insertNewPage(array $data): bool
    {
        $insert = "INSERT INTO `pages`
                   (`controller`, `method`, `controller_in_the_main`, `method_in_the_main`,
                    `name_page`, `public`, `enable_in_sidebar`, `icon`, `obs`, `active_status`,
                    `page_type_id`, `page_module_id`, `created_at`)
                   VALUES
                   (:controller, :method, :controller_in_the_main, :method_in_the_main,
                    :name_page, :public, :enable_in_sidebar, :icon, :obs, :active_status,
                    :page_type_id, :page_module_id, NOW())";

        $stmt = $this->conn->prepare($insert);
        $stmt->bindValue(':controller', $data['controller'], PDO::PARAM_STR);
        $stmt->bindValue(':method', $data['method'], PDO::PARAM_STR);
        $stmt->bindValue(':controller_in_the_main', $data['controller_in_the_main'], PDO::PARAM_STR);
        $stmt->bindValue(':method_in_the_main', $data['method_in_the_main'], PDO::PARAM_STR);
        $stmt->bindValue(':name_page', ConvertToCapitularString::format($data['name_page']), PDO::PARAM_STR);
        $stmt->bindValue(':public', (int) $data['public'], PDO::PARAM_INT);
        $stmt->bindValue(':enable_in_sidebar', (int) $data['enable_in_sidebar'], PDO::PARAM_INT);
        $stmt->bindValue(':icon', $data['icon'] ?: null, PDO::PARAM_STR);
        $stmt->bindValue(':obs', $data['obs'] ?: null, PDO::PARAM_STR);
        $stmt->bindValue(':active_status', (int) $data['active_status'], PDO::PARAM_INT);
        $stmt->bindValue(':page_type_id', (int) $data['page_type_id'], PDO::PARAM_INT);
        $stmt->bindValue(':page_module_id', (int) $data['page_module_id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount()) {
            Flash::success('Página cadastrada com sucesso!');
            return true;
        }

        Flash::danger('Erro na criação da página!');
        return false;
    }
}
