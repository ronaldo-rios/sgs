<?php

namespace src\actions;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\models\Usuario;
use src\dao\UsuarioDaoMySql;

$permissao = filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$siap = filter_input(INPUT_POST, 'siap', FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $permissao && $email && $senha){
    
    $usuarioDao = new UsuarioDaoMySql($pdo);

    if ($usuarioDao->emailExists($email) === false)
    {
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCpf($cpf);
        $usuario->setSiap($siap);
        $usuario->setCrm($crm);
        $usuario->setPermissao($permissao);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $token = bin2hex(random_bytes(16));
        $usuario->setToken($token);
        $usuarioDao->inserirUsuario($usuario);
        $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
        header('Location:'. $baseUrl . '/public/adm_principal.php');
        exit;
    } 
    else {
        header('Location:'.$baseUrl.'/public/adm_principal.php');
        exit;

    }
} else {
    header('Location:'.$baseUrl.'/public/adm_principal.php');
    exit;
}
