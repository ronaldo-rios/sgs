<?php

namespace App\Adms\Models;

use PDO;
use App\Helpers\Pagination;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;

class ListPageTypesModel
{
    private const LIMIT = 10;
    private PDO $conn;
    private ?string $dataPagination;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function getPagination(): ?string
    {
        return $this->dataPagination;
    }

    public function list(?int $page): ?array
    {
        $pagination = new Pagination(Config::url() . '/page-types/index');
        $pagination->condiction($page, self::LIMIT);
        $countUsers = $this->countpageTypes();
        $pagination->paginate($countUsers);
        $resultPage = $pagination->getResult();
        $this->dataPagination = $resultPage;

        $users = $this->queryAllTypes();
        $stmt = $this->conn->prepare($users);
        $stmt->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $pagination->getOffset(), PDO::PARAM_INT);

        $stmt->execute();
        $dataResult = (array) $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(! empty($dataResult)) {
            return $dataResult;
        }

        Flash::danger('Nenhum tipo de página encontrado!');
        return [];
    }

    private function queryAllTypes(): string
    {
        return "SELECT `id`, `type_name`, `order_page_type`
                FROM `page_types`
                    ORDER BY `order_page_type`
                    LIMIT :limit OFFSET :offset";
    }

    private function countpageTypes(): int
    {
        $sql = "SELECT COUNT(`id`) AS num_result 
                    FROM `page_types`";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_result'];
            return $result;
        }

        return 0;
    }
}