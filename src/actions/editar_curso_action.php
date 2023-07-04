<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\dao\CursoDaoMySql;

$cursoDao = new CursoDaoMySql($pdo);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome) {

    $curso = $cursoDao->findById($id);
    $curso->setNome($nome);
    $cursoDao->atualizarcurso($curso);

    $_SESSION['flash'] = "<div style='align-items:center;' style='text-align:center;' class='alert alert-success'>Alterado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/curso.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel editar</div>";
                header('Location:'. $baseUrl . '/public/curso.php');
                exit;
            }
