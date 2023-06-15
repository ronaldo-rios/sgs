<?php

require '../../conexao.php';
use src\dao\TurmaDaoMySql;

$turmaDao = new TurmaDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $turma = $turmaDao->findById($id);
    if ($turma) {
        $turmaDao->deletarTurma($turma);
        $_SESSION['flash'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
        
        header('Location:'.$baseUrl.'/public/turma.php');
        exit;
        
    }
    else {
        header('Location:'.$baseUrl);
        exit;
    }
} 
header('Location:' . $baseUrl);