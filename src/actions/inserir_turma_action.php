<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\models\Turma;
use src\dao\TurmaDaoMySql;

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome) {

    $turmaDao = new TurmaDaoMySql($pdo);

    $turma = new Turma();
    $turma->setNome($nome);
    $turmaDao->inserirTurma($turma);

    $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/turma.php');
    exit;

}
else {
    header('Location:'. $baseUrl);
    exit;
}
