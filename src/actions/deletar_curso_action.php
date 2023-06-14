<?php

require '../../conexao.php';
use src\dao\CursoDaoMySql;

$cursoDao = new CursoDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $curso = $cursoDao->findById($id);
    if ($curso) {
        $cursoDao->deletarCurso($curso);
        $_SESSION['flash'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
        
        header('Location:'.$baseUrl.'curso.php');
        exit;
        
    }
    else {
        header('Location:'.$baseUrl);
        exit;
    }
} 
header('Location:' . $baseUrl);