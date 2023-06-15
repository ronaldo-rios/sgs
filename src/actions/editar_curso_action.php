<?php

require '../../conexao.php';
use src\dao\CursoDaoMySql;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$cursoDao = new CursoDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

if($nome){

    $curso = $cursoDao->findById($id);
    
    $curso->setNome($nome);
    $cursoDao->atualizarCurso($curso);

    $_SESSION['flash'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/curso.php');
    exit;
}
else {
    header('Location:'. $baseUrl . '/public/curso.php');
    exit;
}