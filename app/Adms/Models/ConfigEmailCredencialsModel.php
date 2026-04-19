<?php

namespace App\Adms\Models;

use App\Mail\SendEmail;
use App\Helpers\Connection;
use Core\Config;
use PDO;

class ConfigEmailCredencialsModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function readEmailCredencials(array $emailData, int $optionConfigEmail): bool
    {
        $readEmailCredencials = $this->conn->prepare(self::queryCredentials());
        $readEmailCredencials->bindValue(':id', $optionConfigEmail, \PDO::PARAM_INT);
        $readEmailCredencials->execute();
        $resultDb = (array) $readEmailCredencials->fetch();

        if (!empty($resultDb)) {
            $sendEmail = new SendEmail();
            return $sendEmail->send($resultDb, $emailData);
        }

        return false;
    }

    private function queryCredentials(): string
    {
        return "SELECT `id`, `name`, `email`, `host`, `username`, `password`, `port`, `smtp_secure` 
                    FROM `config_emails` 
                    WHERE id = :id LIMIT 1";
    }
}