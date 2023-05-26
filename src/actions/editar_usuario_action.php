<?php

require '../../conexao.php';
use src\dao\UsuarioDaoMySql;
use src\models\Usuario;

$usuarioDao = new UsuarioDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$permissao = filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$siap = filter_input(INPUT_POST, 'siap', FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $permissao && $email && $senha) {

    $usuario = $usuarioDao->findById($id);
    
    if($usuario) {
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
        $usuarioDao->atualizarUsuario($usuario);

        $_SESSION['flash'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
        header('Location:'. $baseUrl . '/public/adm_principal.php');
        exit;
    }
}
else {
    header('Location:'.$baseUrl.'/public/adm_principal.php');
    exit;

}