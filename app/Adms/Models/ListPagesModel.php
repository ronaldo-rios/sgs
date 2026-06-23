<?php

namespace App\Adms\Models;

use PDO;
use App\Helpers\Pagination;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;

class ListPagesModel
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
        $pagination = new Pagination(Config::url() . '/pages/index');
        $pagination->condiction($page, self::LIMIT);
        $countPages = $this->countPages();
        $pagination->paginate($countPages);
        $resultPage = $pagination->getResult();
        $this->dataPagination = $resultPage;

        $pages = $this->queryAllPages();
        $stmt = $this->conn->prepare($pages);
        $stmt->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $pagination->getOffset(), PDO::PARAM_INT);

        $stmt->execute();
        $dataResult = (array) $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(! empty($dataResult)) {
            return $dataResult;
        }

        Flash::danger('Nenhuma página encontrada!');
        return [];
    }

    private function queryAllPages(): string
    {
        return "SELECT p.`id`, p.`name_page`, p.`active_status`,
                       pt.`type_name`, pm.`name` AS module_name
                FROM `pages` p
                INNER JOIN `page_types` pt ON pt.`id` = p.`page_type_id`
                INNER JOIN `page_modules` pm ON pm.`id` = p.`page_module_id`
                ORDER BY p.`name_page`
                LIMIT :limit OFFSET :offset";
    }

    private function countPages(): int
    {
        $sql = "SELECT COUNT(`id`) AS num_result
                    FROM `pages`";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_result'];
            return $result;
        }

        return 0;
    }
}
