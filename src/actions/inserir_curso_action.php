<?php

namespace src\actions;
require '../../conexao.php';
use src\models\Curso;
use src\dao\CursoDaoMySql;

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);


if ($nome){
    
    $cursoDao = new CursoDaoMySql($pdo);

    if ($cursoDao->nameExists($nome) === false)
    {
        $curso = new Curso();
        $curso->setNome($nome);
        $cursoDao->inserircurso($curso);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Cadastrado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/curso.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel cadastrar</div>";
                header('Location:'. $baseUrl . '/public/curso.php');
                exit;
            }
    } 
    else {
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel cadastrar</div>";
            header('Location:'. $baseUrl . '/public/curso.php');
            exit;
        }

    