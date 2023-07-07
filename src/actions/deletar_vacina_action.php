<?php

require '../../conexao.php';
use src\dao\VacinaDaoMySql;

$vacinaDao = new VacinaDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $vacina = $vacinaDao->findVacinaById($id);
    if ($vacina) {
        $vacinaDao->removerVacina($vacina);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Removido com sucesso!</div>";
        
        header('Location:'.$baseUrl.'/public/vacina.php');
        exit;
        
    }
    else {
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Erro ao deletar!</div>";
        header('Location:'.$baseUrl);
        exit;
    }
} 
header('Location:' . $baseUrl);