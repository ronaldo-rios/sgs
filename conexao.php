<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

session_start();
$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$baseUrl = getenv('BASE_URL');
$db_name = getenv('DB_NAME');
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASSWORD');
$port    = getenv('PORT');

try {
    
    $dsn = "mysql:host={$db_host};dbname={$db_name};port={$port}";
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $server_version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    $client_version = $pdo->getAttribute(PDO::ATTR_CLIENT_VERSION);
    //echo "Conectado ao banco de dados: {$db_name} com sucesso!";

    } 
    catch (PDOException $e) {
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
