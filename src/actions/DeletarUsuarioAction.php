<?php

use src\config\Conexao;
use src\dao\UsuarioDaoMySql;

$usuarioDao = new UsuarioDaoMySql(Conexao::getDb());

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $usuarioDao->deletarUsuario($id);  
} 
header('Location: /public/adm_principal.php');
