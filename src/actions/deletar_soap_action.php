<?php

require '../../conexao.php';
use src\dao\SoapDaoMySql;

$soapDao = new SoapDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $soap = $soapDao->findById($id);
    if ($soap) {
        $soapDao->deletarSoap($soap);
        $_SESSION['flash'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
        
            header('Location:'.$baseUrl.'/public/prontuario.php');
            exit;
    }
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
            header('Location:'.$baseUrl.'/public/prontuario.php');
            exit;
    }
} 
$_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
header('Location:'.$baseUrl.'/public/prontuario.php');
exit;