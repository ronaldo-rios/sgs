<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\dao\UsuarioDaoMySql;
echo "entour";
$usuarioDao = new UsuarioDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$permissao = filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$siap = filter_input(INPUT_POST, 'siap', FILTER_VALIDATE_EMAIL);


if ($nome && $cpf && $email) {

    $usuario = $usuarioDao->findById($id);

    $usuario->setPermissao($permissao);
    $usuario->setNome($nome);
    $usuario->setCpf($cpf);
    $usuario->setEmail($email);
    $usuario->setSiap($siap);

    $usuarioDao->atualizarUsuario($usuario);

    $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Atualizado com sucesso!</div>";
    if ($permissao == 'admin') {
        header('Location:'. $baseUrl . '/public/adm_principal.php');
        exit;
    } elseif($permissao == 'medico') {
        header('Location:'. $baseUrl . '/public/medico.php');
        exit;
    } elseif($permissao == 'servidor') {
        header('Location:'. $baseUrl . '/public/servidor.php');
        exit;
    }
}
else 
{
    if ($permissao == 'admin'){
        header('Location:'. $baseUrl . '/public/adm_principal.php');
        exit;
    } 
    elseif($permissao == 'medico'){
        header('Location:'. $baseUrl . '/public/medico.php');
        exit;
    }
    elseif($permissao == 'servidor'){
        header('Location:'. $baseUrl . '/public/servidor.php');
        exit;
    }

}