<?php
namespace src\actions;
require '../../conexao.php';
use src\models\Atestado;
use src\dao\AtestadoDaoMySql;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$atestadoDao = new AtestadoDaoMySql($pdo);

$data_inicio = filter_input(INPUT_POST, 'datainicio', FILTER_SANITIZE_SPECIAL_CHARS);
$data_final = filter_input(INPUT_POST, 'datafim', FILTER_SANITIZE_SPECIAL_CHARS);
$motivo = filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
$id_paciente = filter_input(INPUT_POST, 'idpaciente', FILTER_SANITIZE_SPECIAL_CHARS);
$id_usuario = filter_input(INPUT_POST, 'idusuario', FILTER_SANITIZE_SPECIAL_CHARS);


if ($data_inicio && $data_final && $motivo && $descricao && $id_paciente && $id_usuario) {
    $atestado_doc = $_FILES['atestadodoc'];

    // Verificar se foi fornecido um arquivo válido
    if ($atestado_doc['error'] === UPLOAD_ERR_OK) {
        // Verificar se é um arquivo PDF
        $extensao = pathinfo($atestado_doc['name'], PATHINFO_EXTENSION);
        if (strtolower($extensao) === 'pdf') {
            $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/sgs/public/assets/pdf/';
            $nomeArquivo = uniqid() . '.pdf';
            $caminhoCompleto = $diretorioDestino . $nomeArquivo;

            // Mover o arquivo para o diretório de destino
            if (move_uploaded_file($atestado_doc['tmp_name'], $caminhoCompleto)) {
                $atestado = new Atestado();
                $data_cadastrada = date('Y-m-d H:i:s');
        	    $atestado->setDataCadastrada($data_cadastrada);
                $atestado->setDataInicio($data_inicio);
                $atestado->setDataFinal($data_final);
                $atestado->setMotivo($motivo);
                $atestado->setDescricao($descricao);
                $atestado->setAtestadoDoc($nomeArquivo);
                $atestado->setIdPaciente($id_paciente);
                $atestado->setIdUsuario($id_usuario);
                $atestadoDao->adicionarAtestado($atestado);

                $_SESSION['flash'] = "<div style='align-text:center;' class='alert alert-success'>Atestado cadastrado com sucesso!</div>";
                header("Location: {$baseUrl}/public/atestado.php");
                exit;
            } else {
                $_SESSION['flash'] = "<div style='align-text:center;' class='alert alert-danger'>Não foi possível mover o arquivo para o diretório de destino.</div>";
                header('Location:'. $baseUrl . '/public/atestado.php');
                exit;
            }
        } else {
            $_SESSION['flash'] = "<div style='align-text:center;' class='alert alert-danger'>Por favor, envie apenas arquivos PDF.</div>";
            header('Location:'. $baseUrl . '/public/atestado.php');
            exit;
        }
    } else {
        $_SESSION['flash'] = "<div style='align-text:center;' class='alert alert-danger'>Não foi possível fazer o upload do arquivo.</div>";
        header('Location:'. $baseUrl . '/public/atestado.php');
        exit;
    }
} else {
    $_SESSION['flash'] = "<div style='align-text:center;' class='alert alert-danger'>Não foi possível cadastrar.</div>";
    header('Location:'. $baseUrl . '/public/atestado.php');
    exit;
}
