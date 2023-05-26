<?php

require '../../conexao.php';
use src\dao\UsuarioDaoMySql;

$usuarioDao = new UsuarioDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $usuario = $usuarioDao->findById($id);
    if ($usuario) {
        $usuarioDao->deletarUsuario($usuario);
        $_SESSION['flash'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
        header('Location:'. $baseUrl . '/public/adm_principal.php');
        exit;
    }
    else {
    header('Location:'.$baseUrl.'/public/adm_principal.php');
    exit;
    }
} 
header('Location:' . $baseUrl .'/public/adm_principal.php');
