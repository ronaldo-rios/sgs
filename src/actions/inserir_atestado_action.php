<?php

namespace src\actions;
require '../../conexao.php';
use src\models\Atestado;
use src\dao\AtestadoDaoMySql;

$atestadoDao = new AtestadoDaoMySql($pdo);

$data_inicio = filter_input(INPUT_POST, 'data_inicio', FILTER_SANITIZE_SPECIAL_CHARS);
$data_final = filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_SPECIAL_CHARS);
$motivo = filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
$atestado_doc = filter_input(INPUT_POST, 'atestado_doc', FILTER_SANITIZE_SPECIAL_CHARS);
$id_paciente = filter_input(INPUT_POST, 'id_paciente ', FILTER_SANITIZE_SPECIAL_CHARS);
$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_SPECIAL_CHARS);



if ($data){
    
    $atestadoDao = new AtestadoDaoMySql($pdo);
    $atestado = new Atestado();
    $data_cadastrada = date('Y-m-d H:i:s');
    $atestado->setDataCadastrada($data_cadastrada);
    $atestado->setDataInicio($data_inicio);
    $atestado->setDataFinal($data_final);
    $atestado->setMotivo($motivo);
    $atestado->setDescricao ($descricao);
    $atestado->setIdPaciente($id_paciente);
    $atestado->setIdUsuario($id_usuario);
    $atestadoDao->adicionarAtestado($atestado);
    $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
    //header("Location: {$baseUrl}/public/prontuario_edit.php?id={$id_prontuario}");
    //exit;
    } 
    else {
        $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel cadastrar</div>";
           // header('Location:'. $baseUrl . '/public/prontuario.php');
            //exit;
        }
