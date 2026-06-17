<?php

namespace App\Adms\Models;

use PDO;
use App\Helpers\Pagination;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;

class ListPageModulesModel
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
        $pagination = new Pagination(Config::url() . 'page-modules/index');
        $pagination->condiction($page, self::LIMIT);
        $countModules = $this->countPageModules();
        $pagination->paginate($countModules);
        $resultPage = $pagination->getResult();
        $this->dataPagination = $resultPage;

        $modules = $this->queryAllModules();
        $stmt = $this->conn->prepare($modules);
        $stmt->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $pagination->getOffset(), PDO::PARAM_INT);

        $stmt->execute();
        $dataResult = (array) $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(! empty($dataResult)) {
            return $dataResult;
        }

        Flash::danger('Nenhum módulo de página encontrado!');
        return [];
    }

    private function queryAllModules(): string
    {
        return "SELECT `id`, UPPER(`type`) AS `type`, `name`, `order_module`
                FROM `page_modules`
                    ORDER BY `order_module`
                    LIMIT :limit OFFSET :offset";
    }

    private function countPageModules(): int
    {
        $sql = "SELECT COUNT(`id`) AS num_result
                    FROM `page_modules`";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_result'];
            return $result;
        }

        return 0;
    }
}
