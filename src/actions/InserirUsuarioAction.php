<?php

namespace src\actions;

use src\config\Conexao;
use src\models\Usuario;
use src\dao\UsuarioDaoMySql;

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$siap = filter_input(INPUT_POST, 'siap', FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_SPECIAL_CHARS);
$permissao = filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $permissao && $email && $senha){

    $pdo = Conexao::getDb();
    $usuarioDao = new UsuarioDaoMySql($pdo);

    if ($usuarioDao->findByEmail($email) === false 
    && $usuarioDao->findByCpf($cpf) === false 
    && $usuarioDao->findBySiap($siap) === false 
    && $usuarioDao->findByCrm($crm) === false)
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

        header('Location:'.$_ENV['BASE_URL'].'/index.php');
        exit;
    } 
    else {
        header('Location:'.$_ENV['BASE_URL'].'/adm_principal.php');
        exit;

    }
} else {
    header('Location:'.$_ENV['BASE_URL'].'/adm_principal.php');
    exit;
}
