<?php

require '../../conexao.php';
use src\dao\PacienteDaoMySql;

$pacienteDao = new PacienteDaoMySql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    $paciente = $pacienteDao->findById($id);
    if ($paciente) {
        $pacienteDao->deletarpaciente($paciente);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Deletado com sucesso!</div>";
        
            header('Location:'.$baseUrl.'/public/paciente.php');
            exit;
    }
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
            header('Location:'.$baseUrl.'/public/paciente.php');
            exit;
    }
} 
$_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel deletar!</div>";
        
header('Location:'.$baseUrl.'/public/paciente.php');
exit;
