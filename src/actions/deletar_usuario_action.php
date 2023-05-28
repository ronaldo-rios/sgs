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
        
        if($usuario->getPermissao() == 'admin'){
            header('Location:'.$baseUrl.'/public/adm_principal.php');
            exit;
        }
        elseif($usuario->getPermissao() == 'medico'){
            header('Location:'.$baseUrl.'/public/medico.php');
            exit;
        }
        elseif($usuario->getPermissao() == 'servidor'){
            header('Location:'.$baseUrl.'/public/servidor.php');
            exit;
        }
    }
    else {
        header('Location:'.$baseUrl);
        exit;
    }
} 
header('Location:' . $baseUrl);
