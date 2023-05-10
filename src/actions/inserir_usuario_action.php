<?php

namespace src\actions;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\models\Usuario;
use src\dao\UsuarioDaoMySql;

echo "Helooo";
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$siap = filter_input(INPUT_POST, 'siap', FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_SPECIAL_CHARS);
$permissao = filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $permissao && $email && $senha){
    
    $usuarioDao = new UsuarioDaoMySql($pdo);

    if ($usuarioDao->findByEmail($email))
    {
        $$usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCpf($cpf);
        $usuario->setSiap($siap);
        $usuario->setCrm($crm);
        $usuario->setPermissao($permissao);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuarioDao->inserirUsuario($usuario);

        header('Location:'.$baseUrl);
        exit;
    } 
    else {
        echo "Email já cadastrado";
        header('Location:'.$baseUrl.'/public/adm_principal.php');
        exit;

    }
} else {
    echo "Dados não preenchidos";
    header('Location:'.$baseUrl.'/public/adm_principal.php');
    exit;
}
