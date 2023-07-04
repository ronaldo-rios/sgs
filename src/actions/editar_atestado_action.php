<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\dao\AtestadoDaoMySql;

$atestadoDao = new AtestadoDaoMySql($pdo);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$data_cadastrada = filter_input(INPUT_POST, 'data_cadastrada', FILTER_SANITIZE_SPECIAL_CHARS);
$data_inicio = filter_input(INPUT_POST, 'data_inicio', FILTER_SANITIZE_SPECIAL_CHARS);
$data_final = filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_SPECIAL_CHARS);
$motivo = filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
$atestado_doc = filter_input(INPUT_POST, 'atestado_doc', FILTER_SANITIZE_SPECIAL_CHARS);
$id_paciente = filter_input(INPUT_POST, 'id_paciente ', FILTER_SANITIZE_SPECIAL_CHARS);
$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_SPECIAL_CHARS);


if ($data_cadastrada) {

    $atestado = $atestadoDao->findById($id_atestado);
    $atestado->setDataCadastrada($data_cadastrada);
    $atestado->setDataInicio($data_inicio);
    $atestado->setDataFinal($data_final);
    $atestado->setMotivo($motivo);
    $atestado->setDescricao ($descricao);
    $atestado->setIdPaciente($id_paciente);
    $atestado->setIdUsuario($id_usuario);
    $atestadoDao->atualizarAtestado($atestado);

    $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Alterado com sucesso!</div>";
           // header('Location:'. $baseUrl . '/public/atestado.php');
            //exit;
            
        }  else {
            $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel editar</div>";
               // header("Location:". $baseUrl . "/public/atestado.php);
               // exit;
            }