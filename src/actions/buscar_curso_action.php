<?php
require '../../conexao.php';
use src\models\Curso;
use src\dao\CursoDaoMySql;

$cursoDao = new CursoDaoMySql($pdo);
$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);


if($nome){
   
    $curso = $cursoDao->findByName($nome);

    $_SESSION['flash'] = "<div class='alert alert-success'>Curso  econtrado</div>";
        
    header('Location:'.$baseUrl.'/public/curso.php');
    exit;
  
  
}else{
    $_SESSION['flash'] = "<div class='alert alert-danger'>Curso não econtrado</div>";
        
    header('Location:'.$baseUrl.'/public/curso.php');
    exit;
}