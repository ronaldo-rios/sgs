<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;
use PDO;

class DeletePageModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function delete(int $id): void
    {
        $pageIsNotInUse = $this->checkIfPageIsLinkedToLevel($id);

        if ($pageIsNotInUse) {
            $this->deletePage($id);
        }
    }

    /**
     * Check if the page is linked to an access level (page_levels).
     * If it is, it is not possible to delete it.
     */
    private function checkIfPageIsLinkedToLevel(int $id): bool
    {
        $select = "SELECT `id`
                   FROM `page_levels`
                   WHERE page_id = :id";

        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::danger('Não é possível excluir esta página, pois ela está vinculada a um ou mais níveis de acesso!');
            return false;
        }

        return true;
    }

    private function deletePage(int $id): bool
    {
        $delete = "DELETE FROM `pages`
                   WHERE id = :id";

        $stmt = $this->conn->prepare($delete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            Flash::success('Página excluída com sucesso!');
            return true;
        }
        else {
            Flash::danger('Erro ao tentar excluir página!');
            return false;
        }
    }
}
