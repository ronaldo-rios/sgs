<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use App\Helpers\Pagination;
use Core\Config;
use PDO;

class ListConfigEmailsModel
{
    private object $conn; 
    private ?string $dataPagination;
    private const LIMIT = 5;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function getPagination(): ?string
    {
        return $this->dataPagination;
    }

    public function getEmails(int $page): array
    {
        $pagination = new Pagination(Config::url() . '/config-emails/index');
        $pagination->condiction($page, self::LIMIT);
        $countConfEmails = $this->contEmailServers();
        $pagination->paginate($countConfEmails);
        $resultPage = $pagination->getResult();
        $this->dataPagination = $resultPage;
        
        return $this->emailServers($pagination);
    }

    private function emailServers(Pagination $pagination): array
    {
        $query = "SELECT * FROM `config_emails` 
                  ORDER BY `id`
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $pagination->getOffset(), PDO::PARAM_INT);
        $stmt->execute();
        $resultEmails = (array) $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        if ($resultEmails !== []) {
            return $resultEmails;
        }
      
        return [];
    }

    private function contEmailServers(): int
    {
        $query = "SELECT COUNT(id) AS count FROM `config_emails`";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['count'];
    }
}