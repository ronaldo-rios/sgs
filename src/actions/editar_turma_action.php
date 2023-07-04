<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\dao\TurmaDaoMySql;

$turmaDao = new TurmaDaoMySql($pdo);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome) {

    $turma = $turmaDao->findById($id);
    $turma->setNome($nome);
    $turmaDao->atualizarTurma($turma);

    $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Alterado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/turma.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel editar</div>";
                header('Location:'. $baseUrl . '/public/turma.php');
                exit;
            }

