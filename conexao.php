<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
session_start();
// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

$baseUrl = 'http://127.0.0.1/sgs';
$db_name = 'sgs';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$port = 3306;

try {
    
    $dsn = "mysql:host={$db_host};dbname={$db_name};port={$port}";
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $server_version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    $client_version = $pdo->getAttribute(PDO::ATTR_CLIENT_VERSION);
    // echo "Conectado ao banco de dados: {$db_name} com sucesso!";

    } 
    catch (PDOException $e) {
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
