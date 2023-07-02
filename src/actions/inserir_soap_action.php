<?php

namespace src\actions;
require '../../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use src\models\Soap;
use src\dao\SoapDaoMySql;
use src\dao\ProntuarioDaoMySql;

$soapDao = new SoapDaoMySql($pdo);
$prontuarioDao = new ProntuarioDaoMySql($pdo);
$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
$subjetivo = filter_input(INPUT_POST, 'subjetivo', FILTER_SANITIZE_SPECIAL_CHARS);
$objetivo = filter_input(INPUT_POST, 'objetivo', FILTER_SANITIZE_SPECIAL_CHARS);
$avaliacao = filter_input(INPUT_POST, 'avaliacao', FILTER_SANITIZE_SPECIAL_CHARS);
$plano = filter_input(INPUT_POST, 'plano', FILTER_SANITIZE_SPECIAL_CHARS);
$id_prontuario = filter_input(INPUT_POST, 'id_prontuario', FILTER_SANITIZE_SPECIAL_CHARS);


if ($data){
    
    $soapDao = new SoapDaoMySql($pdo);
    $soap = new Soap();
    $soap->setData($data);
    $soap->setSubjetivo($subjetivo);
    $soap->setObjetivo($objetivo);
    $soap->setAvaliacao($avaliacao);
    $soap->setPlano($plano);
    $soap->setIdProntuario($id_prontuario);
    $soapDao->inserirSoap($soap);
    $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
 
    $id_paciente= $prontuarioDao->findPaciente($id_prontuario);
    header("Location: {$baseUrl}/public/prontuario_edit.php?id={$id_paciente}");
            exit;
    } 
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel cadastrar</div>";
          
    $id_paciente= $prontuarioDao->findPaciente($id_prontuario);
    header("Location: {$baseUrl}/public/prontuario_edit.php?id={$id_paciente}");
            exit;
        }