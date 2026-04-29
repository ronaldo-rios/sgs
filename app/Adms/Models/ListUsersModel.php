<?php

namespace App\Adms\Models;

use PDO;
use App\Adms\Enum\UserSituation;
// use App\adms\Models\helpers\Pagination;
use App\Helpers\Connection;
use App\Helpers\Flash;
use Core\Config;

class ListUsersModel
{
    private const LIMIT = 10;
    private PDO $conn;
    // private ?string $dataPagination;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    // public function getPagination(): ?string
    // {
    //     return $this->dataPagination;
    // }

    public function list(?int $page): ?array
    {
        // $pagination = new Pagination(URL . 'users/index');
        // $pagination->condiction($page, self::LIMIT);
        // $countUsers = $this->countUsers();
        // $pagination->paginate($countUsers);
        // $resultPage = $pagination->getResult();
        // $this->dataPagination = $resultPage;

        $users = $this->queryAllUsers();
        $stmt = $this->conn->prepare($users);
        $stmt->bindValue(':confirmed', UserSituation::CONFIRMED_EMAIL->value, PDO::PARAM_INT);
        $stmt->bindValue(':pending', UserSituation::WAITING_FOR_CONFIRMATION->value, PDO::PARAM_INT);
        $stmt->bindValue(':order_level', $_SESSION['order_level'], PDO::PARAM_INT);
        $stmt->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
        // $stmt->bindValue(':offset', $pagination->getOffset(), PDO::PARAM_INT);

        $stmt->execute();
        $dataResult = (array) $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(! empty($dataResult)) {
            return $dataResult;
        }

        Flash::danger('Nenhum usuário encontrado!');
        return [];
    }

    private function queryAllUsers(): string
    {
        return "SELECT 
                    user.id, user.name, user.email, user.user
                FROM `users` AS user
                INNER JOIN `access_levels` AS access
                    ON user.access_level_id = access.id
                WHERE `user_situation_id` in (:confirmed, :pending)
                    AND access.order_level > :order_level
                ORDER BY user.id ASC
                LIMIT :limit";
    }

    // private function countUsers(): int
    // {
    //     $sql = "SELECT COUNT(u.id) AS num_result 
    //                 FROM `users` AS u
    //                 INNER JOIN `access_levels` AS access
    //                     ON u.access_level_id = access.id
    //                 WHERE u.user_situation_id IN (:confirmed, :pending)
    //                 AND access.order_level > :order_level";

    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindValue(':confirmed', UserSituation::CONFIRMED_EMAIL->value, PDO::PARAM_INT);
    //     $stmt->bindValue(':pending', UserSituation::WAITING_FOR_CONFIRMATION->value, PDO::PARAM_INT);
    //     $stmt->bindValue(':order_level', $_SESSION['order_level'], PDO::PARAM_INT);
    //     $stmt->execute();

    //     if ($stmt->rowCount() > 0) {
    //         $result = (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_result'];
    //         return $result;
    //     }

    //     return 0;
    // }
}