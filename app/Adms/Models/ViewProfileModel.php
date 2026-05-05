<?php

namespace App\Adms\Models;

use App\Helpers\Connection;
use Core\Config;

class ViewProfileModel
{
    private object $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function get(): ?array
    {
        return $this->getInfoUserLoged();
    }

    private function getInfoUserLoged(): ?array
    {   
        $query = "SELECT u.name, u.email, u.user,
                         u.image, u.image, al.access_level 
                  FROM `users` AS u
                  INNER JOIN `access_levels` AS al
                    ON u.access_level_id = al.id
                  WHERE u.id = :id 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_SESSION['user_id'], \PDO::PARAM_INT);
        $stmt->execute();
        $result = (array) $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result !== []) {
            return $result;
        } 
        
        return [];
    }
}