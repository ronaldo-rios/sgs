<?php

namespace App\Adms\Models;

use App\Mail\SendEmail;
use App\Helpers\Connection;
use Core\Config;
use PDO;

class EmailCredencialsModel
{
    private bool $result = false;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::connect(Config::db());
    }

    public function getResult(): bool
    {
        return $this->result;
    }

    public function readEmailCredencials(array $emailData, int $optionConfigEmail): void
    {
        $readEmailCredencials = $this->conn->prepare(self::queryCredentials());
        $readEmailCredencials->bindValue(':id', $optionConfigEmail, \PDO::PARAM_INT);
        $readEmailCredencials->execute();
        $resultDb = (array) $readEmailCredencials->fetch();

        if ($resultDb) {
            $sendEmail = new SendEmail();
            $sendEmail->send($resultDb, $emailData);
            self::$result = true;
        }
        else {
            self::$result = false;
        }
    }

    private function queryCredentials(): string
    {
        return "SELECT `id`, `name`, `email`, `host`, `username`, `password`, `port`, `smtp_secure` 
                    FROM `config_emails` 
                    WHERE id = :id LIMIT 1";
    }
}