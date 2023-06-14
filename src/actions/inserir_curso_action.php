<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\models\Curso;
use src\dao\CursoDaoMySql;

$nomeCurso = filter_input(INPUT_POST, 'nomecurso', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nomeCurso) {

    $cursoDao = new CursoDaoMySql($pdo);

    $curso = new Curso();
    $curso->setNome($nomeCurso);
    $cursoDao->inserirCurso($curso);

    $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/curso.php');
    exit;

}
else {
    header('Location:'. $baseUrl);
    exit;
}
