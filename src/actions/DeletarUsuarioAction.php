<?php

require '../../conexao.php';
use src\dao\UsuarioDaoMySql;

$usuarioDao = new UsuarioDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $usuarioDao->deletarUsuario($id);  
} 
header('Location:' . $baseUrl .'/adm_principal.php');
