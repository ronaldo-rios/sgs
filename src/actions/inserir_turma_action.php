<?php

namespace src\actions;
require '../../conexao.php';
use src\models\Turma;
use src\dao\TurmaDaoMySql;

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);


if ($nome){
    
    $turmaDao = new TurmaDaoMySql($pdo);

    if ($turmaDao->nameExists($nome) === false)
    {
        $turma = new Turma();
        $turma->setNome($nome);
        $turmaDao->inserirTurma($turma);
        $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/turma.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel cadastrar</div>";
                header('Location:'. $baseUrl . '/public/turma.php');
                exit;
            }
    } 
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel cadastrar</div>";
            header('Location:'. $baseUrl . '/public/turma.php');
            exit;
        }

    