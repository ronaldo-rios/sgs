<?php

namespace src\config;

session_start();

class Conexao 
{
    public static function getDb() 
    {  
        try {
            $conn = new \PDO(
                "mysql:host=" . getEnv('DB_HOST') . ";dbname=" . getEnv('DB_NAME'),
                getEnv('DB_USER'),
                getEnv('DB_PASSWORD')
            );
            return $conn;
        } 
        catch (\PDOException $e) 
        {
            echo "Erro: {$e->getMessage()}";
        }
    }
}