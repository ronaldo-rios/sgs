<?php

namespace App\Helpers;

use Core\Config;
use PDO;
use PDOException;

final class Connection 
{
    private static ?PDO $connect = null;

    public static function connect(array $db): PDO
    {
        if (self::$connect === null) {
            try {
                self::$connect = new PDO(
                    'mysql:host=' . $db['host'] . ';dbname=' . $db['database'] . ';port=' . $db['port'],
                    $db['user'],
                    $db['password'],
                    [
                        PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION, 
                        PDO::ATTR_EMULATE_PREPARES => false, 
                    ]
                );
            } 
            catch (PDOException $error) {
                die(
                    "Erro Código: {$error->getCode()}. <br>
                    Entre em contato com o administrador: " . Config::admEmail()
                );
            }
        }
        
        return self::$connect;
    }
}