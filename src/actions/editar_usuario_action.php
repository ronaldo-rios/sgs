<?php

require '../../conexao.php';
use src\dao\UsuarioDaoMySql;

$usuarioDao = new UsuarioDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($id && $nome && $cpf && $email) {

    $usuario = $usuarioDao->findById($id);
    
    $usuario->setNome($nome);
    $usuario->setCpf($cpf);
    $usuario->setEmail($email);
    $usuarioDao->atualizarUsuario($usuario);

    $_SESSION['flash'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/adm_principal.php');
    exit;
}
else {
    header('Location:'.$baseUrl.'/public/adm_principal.php');
    exit;

}