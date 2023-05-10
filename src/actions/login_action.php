<?php

// verificação e validação de dados:
require '../../conexao.php';

use src\models\Auth;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

// Verificar se os dados batem com os dados do usuário no banco para fazer o login:
if($email && $senha){

    $auth = new Auth($pdo, $baseUrl);
    if($auth->validateLogin($email, $senha)){
        header("Location:".$baseUrl);
        exit;
    }
    
}
$_SESSION['flash'] = 'E-mail e/ou senha incorreta!';
header("Location:".$baseUrl."/public/login.php");