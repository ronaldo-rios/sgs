<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class DeletePageModuleModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function delete(int $id): void
    {
        $pageModuleIsNotInUse = $this->checkIfPageModuleIsLinkedToPage($id);

        if ($pageModuleIsNotInUse) {
            $this->deletePageModule($id);
        }
    }

    /**
     * Check if the page module is linked to a page. If it is, it is not possible to delete it.
     */
    private function checkIfPageModuleIsLinkedToPage(int $id): bool
    {
        $select = "SELECT `id`
                   FROM `pages`
                   WHERE page_module_id = :id";

        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::danger('Não é possível excluir este módulo de página, pois ele está vinculado a uma ou mais páginas!');
            return false;
        }

        return true;
    }

    private function deletePageModule(int $id): bool
    {
        $delete = "DELETE FROM `page_modules`
                   WHERE id = :id";

        $stmt = $this->conn->prepare($delete);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::success('Módulo de página excluído com sucesso!');
            return true;
        }
        else {
            Flash::danger('Erro ao tentar excluir módulo de página!');
            return false;
        }
    }
}
