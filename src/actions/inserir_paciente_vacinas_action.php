<?php 

require '../../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use src\dao\PacienteVacinaDaoMySql;
use src\models\PacienteVacina;

$idPaciente = filter_input(INPUT_POST, 'idpaciente', FILTER_VALIDATE_INT);
$idVacinas  = filter_input(INPUT_POST, 'vacinas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$datas      = filter_input(INPUT_POST, 'datas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$doses      = filter_input(INPUT_POST, 'doses', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

if ($idPaciente && $idVacinas && $datas) {

    $pacienteVacinaDao = new PacienteVacinaDaoMySql($pdo); 

    // Percorrendo os arrays para inserir cada registro
    for ($i = 0; $i < count($idVacinas); $i++) {
    $pacienteVacina = new PacienteVacina();
    $pacienteVacina->setIdPaciente($idPaciente);
    $pacienteVacina->setIdVacina($idVacinas[$i]);
    $pacienteVacina->setData($datas[$i]);
    $pacienteVacina->setDose($doses[$i]);

    $pacienteVacinaDao->adicionarPacienteVacina($pacienteVacina); 
    }

    $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Dados inseridos com sucesso!</div>";
    header('Location: ' . $baseUrl . '/public/paciente_vacinas.php');
    exit;

}

$_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Os arrays de dados não têm o mesmo tamanho.</div>";
header('Location: ' . $baseUrl . '/public/paciente_vacinas.php');
exit;