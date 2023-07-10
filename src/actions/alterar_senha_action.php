<?php

namespace src\actions;

require '../../conexao.php';


use src\models\Usuario;
use src\models\Auth;

$senhaAtual = filter_input(INPUT_POST, 'senhaatual', FILTER_SANITIZE_SPECIAL_CHARS);
$novaSenha = filter_input(INPUT_POST, 'novasenha', FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_POST, 'id');

if ($senhaAtual && $novaSenha && $id) {

    $usuarioDao = new Auth($pdo, $baseUrl);
    $usuario = $usuarioDao->checkToken();
    if (password_verify($senhaAtual, $usuario->getSenha())) {
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setSenha($novaSenha);
        $usuarioDao->atualizarSenha($usuario);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>
            Senha alterada com sucesso!
            </div>";
        header('Location: ' . $baseUrl);
        exit;
    }
    else {
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>
            Senha atual incorreta!
            </div>";
        header('Location: ' . $baseUrl . '/public/alterar_senha.php');
        exit;
    }

}

