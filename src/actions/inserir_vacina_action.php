<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\models\Vacina;
use src\dao\VacinaDaoMySql;

$nomeVacina = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nomeVacina) {

    $vacinaDao = new VacinaDaoMySql($pdo);

    $vacina = new Vacina();
    $vacina->setNome($nomeVacina);
    $vacinaDao->adicionarVacina($vacina);

    $_SESSION['flash'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
    header('Location:'. $baseUrl . '/public/vacina.php');
    exit;

}
else {
    header('Location:'. $baseUrl);
    exit;
}
