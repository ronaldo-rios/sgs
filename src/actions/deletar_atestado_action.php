<?php

require '../../conexao.php';
use src\dao\AtestadoDaoMySql;

$atestadoDao = new AtestadoDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $atestado = $atestadoDao->findById($id);
    if ($atestado) {
        $atestadoDao->deletaratestado($atestado);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Deletado com sucesso!</div>";
        
            header('Location:'.$baseUrl.'/public/atestado.php');
            exit;
    }
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
            header('Location:'.$baseUrl.'/public/atestado.php');
            exit;
    }
} 
$_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
header('Location:'.$baseUrl.'/public/atestado.php');
exit;