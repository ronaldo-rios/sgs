<?php

require '../../conexao.php';
use src\dao\TurmaDaoMySql;

$turmaDao = new TurmaDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $turma = $turmaDao->findById($id);
    if ($turma) {
        $turmaDao->deletarTurma($turma);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Deletado com sucesso!</div>";
        
            header('Location:'.$baseUrl.'/public/turma.php');
            exit;
    }
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
            header('Location:'.$baseUrl.'/public/turma.php');
            exit;
    }
} 
$_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
header('Location:'.$baseUrl.'/public/turma.php');
exit;
