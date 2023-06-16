<?php

require '../../conexao.php';
use src\dao\VacinaDaoMySql;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$vacinaDao = new VacinaDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nomevacina', FILTER_SANITIZE_SPECIAL_CHARS);

if($nome){

    $vacina = $vacinaDao->findVacinaById($id);
    
    $vacina->setNome($nome);
    $vacinaDao->editarVacina($vacina);

    $_SESSION['flash'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/vacina.php');
    exit;
}
else {
    $_SESSION['flash'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
    header('Location:'. $baseUrl . '/public/vacina.php');
    exit;
}