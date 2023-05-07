<?php

// verificação e validação de dados:
use src\config\Conexao;
use src\models\Auth;

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

// Verificar se os dados batem com os dados do usuário no banco para fazer o login:
if($email && $senha){

    $auth = new Auth($pdo);
    if($auth->validateLogin($email, $senha)){
        header("Location:".$_ENV['BASE_URL']."/index.php");
        exit;
    }
    
}
header("Location:".$_ENV['BASE_URL']."/login.php");