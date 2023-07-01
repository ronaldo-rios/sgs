<?php

require '../../conexao.php';
use src\dao\CursoDaoMySql;

$cursoDao = new CursoDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $curso = $cursoDao->findById($id);
    if ($curso) {
        $cursoDao->deletarcurso($curso);
        $_SESSION['flash'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
        
            header('Location:'.$baseUrl.'/public/curso.php');
            exit;
    }
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
            header('Location:'.$baseUrl.'/public/curso.php');
            exit;
    }
} 
$_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
header('Location:'.$baseUrl.'/public/curso.php');
exit;