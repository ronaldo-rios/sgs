<?php

require '../../conexao.php';
use src\dao\TurmaDaoMySql;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$turmaDao = new TurmaDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nometurma', FILTER_SANITIZE_SPECIAL_CHARS);

if($nome){

    $turma = $turmaDao->findById($id);
    
    $turma->setNome($nome);
    $turmaDao->atualizarTurma($turma);

    $_SESSION['flash'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/turma.php');
    exit;
}
else {
    header('Location:'. $baseUrl . '/public/turma.php');
    exit;
}