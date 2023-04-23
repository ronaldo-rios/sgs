<?php

namespace src\config;

class Config 
{
    public static function getDb() 
    {  
        try {
            $conn = new \PDO(
                "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']
            );
            return $conn;
        } catch (\PDOException $e) 
        {
            echo "Erro: {$e->getMessage()}";
        }
    }
}