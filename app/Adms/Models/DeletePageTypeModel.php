<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class DeletePageTypeModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function delete(int $id): void
    {
        $pageTypeIsNotInUse = $this->checkIfPageTypeIsLinkedToPage($id);

        if ($pageTypeIsNotInUse) {
            $this->deletePageType($id);
        }
    }

    /**
     * Check if the page type is linked to a page. If it is, it is not possible to delete it.
     */
    private function checkIfPageTypeIsLinkedToPage(int $id): bool
    {
        $select = "SELECT `id`
                   FROM `pages`
                   WHERE page_type_id = :id";

        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::danger('Não é possível excluir este tipo de página, pois ele está vinculado a uma ou mais páginas!');
            return false;
        }

        return true;
    }

    private function deletePageType(int $id): bool
    {
        $delete = "DELETE FROM `page_types`
                   WHERE id = :id";

        $stmt = $this->conn->prepare($delete);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::success('Tipo de página excluído com sucesso!');
            return true;
        }
        else {
            Flash::danger('Erro ao tentar excluir tipo de página!');
            return false;
        }
    }
}
