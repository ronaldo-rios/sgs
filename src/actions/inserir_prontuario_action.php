<?php

namespace src\actions;
require '../../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use src\models\Prontuario;
use src\dao\ProntuarioDaoMySql;

$matricula_paciente = filter_input(INPUT_POST, 'matricula_paciente', FILTER_SANITIZE_SPECIAL_CHARS);
$esf = filter_input(INPUT_POST, 'esf', FILTER_SANITIZE_SPECIAL_CHARS);
$plano_saude = filter_input(INPUT_POST, 'plano_saude', FILTER_SANITIZE_SPECIAL_CHARS);
$numero_cartao_sus = filter_input(INPUT_POST, 'numero_cartao_sus', FILTER_SANITIZE_SPECIAL_CHARS);
$alergia_medicamento = filter_input(INPUT_POST, 'alergia_medicamento', FILTER_SANITIZE_SPECIAL_CHARS);
$nome_medicamento_alergia = filter_input(INPUT_POST, 'nome_medicamento_alergia', FILTER_VALIDATE_EMAIL);
$medicamento_controlado = filter_input(INPUT_POST, 'medicamento_controlado', FILTER_SANITIZE_SPECIAL_CHARS);
$nome_medicamento_controlado = filter_input(INPUT_POST, 'nome_medicamento_controlado', FILTER_SANITIZE_SPECIAL_CHARS);
$diabetes = filter_input(INPUT_POST, 'diabetes', FILTER_SANITIZE_SPECIAL_CHARS);
$pressao_alta = filter_input(INPUT_POST, 'pressao_alta', FILTER_SANITIZE_SPECIAL_CHARS);
$pressao_baixa = filter_input(INPUT_POST, 'pressao_baixa', FILTER_SANITIZE_SPECIAL_CHARS);
$asma = filter_input(INPUT_POST, 'asma', FILTER_SANITIZE_SPECIAL_CHARS);
$bronquite = filter_input(INPUT_POST, 'bronquite', FILTER_SANITIZE_SPECIAL_CHARS);
$anemia = filter_input(INPUT_POST, 'anemia', FILTER_SANITIZE_SPECIAL_CHARS);
$ansiedade = filter_input(INPUT_POST, 'ansiedade', FILTER_SANITIZE_SPECIAL_CHARS);
$depressao = filter_input(INPUT_POST, 'depressao', FILTER_SANITIZE_SPECIAL_CHARS);
$insonia = filter_input(INPUT_POST, 'insonia', FILTER_SANITIZE_SPECIAL_CHARS);
$hemofilia = filter_input(INPUT_POST, 'hemofilia', FILTER_SANITIZE_SPECIAL_CHARS);
$tuberculose = filter_input(INPUT_POST, 'tuberculose', FILTER_SANITIZE_SPECIAL_CHARS);
$eplepsia = filter_input(INPUT_POST, 'eplepsia', FILTER_SANITIZE_SPECIAL_CHARS);
$desmaios = filter_input(INPUT_POST, 'desmaios', FILTER_SANITIZE_SPECIAL_CHARS);
$fumante = filter_input(INPUT_POST, 'fumante', FILTER_SANITIZE_SPECIAL_CHARS);
$outro = filter_input(INPUT_POST, 'outro', FILTER_SANITIZE_SPECIAL_CHARS);
$id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_SANITIZE_SPECIAL_CHARS);
$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_SPECIAL_CHARS);



if ($matricula_paciente) {

    $prontuarioDao = new ProntuarioDaoMySql($pdo);

    $prontuario = new Prontuario();
    $prontuario->setMatriculaPaciente($matricula_paciente);
    $prontuario->setEsf($esf);
    $prontuario->setPlanoSaude($plano_saude);
    $prontuario->setNumeroCartaoSus($numero_cartao_sus);
    $prontuario->setAlergiaMedicamento($alergia_medicamento);
    $prontuario->setNomeMedicamentoAlergia($nome_medicamento_alergia);
    $prontuario->setMedicamentoControlado($medicamento_controlado);
    $prontuario->setNomeMedicamentoControlado($nome_medicamento_controlado);
    $prontuario->setDiabetes($diabetes);
    $prontuario->setPressaoAlta($pressao_alta);
    $prontuario->setPressaoBaixa($pressao_baixa);
    $asma = isset($asma) ? (bool)$asma : false;
    $prontuario->setAsma($asma);
    $bronquite = isset($bronquite) ? (bool)$bronquite : false;
    $prontuario->setBronquite($bronquite);
    $prontuario->setAnemia($anemia);
    $prontuario->setAnsiedade($ansiedade);
    $prontuario->setDepressao($depressao);
    $prontuario->setInsonia($insonia);
    $prontuario->setHemofilia($hemofilia);
    $tuberculose = isset($tuberculose) ? (bool)$tuberculose : false;
    $prontuario->setTuberculose($tuberculose);
    $prontuario->setEplepsia($eplepsia);
    $prontuario->setDesmaios($desmaios);
    $prontuario->setFumante($fumante);
    $prontuario->setOutro($outro);
    $prontuario->setIdPaciente($id_paciente);
    $prontuario->setIdUsuario($id_usuario);
    $prontuarioDao->criarProntuario($prontuario);

    $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Cadastrado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/prontuario.php');
    exit;

}else{
    $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel cadastrar</div>";
    header('Location:'. $baseUrl . '/public/prontuario.php');
    exit;
}

        

