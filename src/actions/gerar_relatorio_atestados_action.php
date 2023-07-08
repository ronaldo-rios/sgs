<?php 

require '../../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use src\reports\RelatoriosDaoMySql;
use Dompdf\Dompdf;

$idCurso = filter_input(INPUT_POST, 'idcurso', FILTER_SANITIZE_SPECIAL_CHARS);
$idTurma = filter_input(INPUT_POST, 'idturma', FILTER_SANITIZE_SPECIAL_CHARS);
$dataCadastrada = filter_input(INPUT_POST, 'data_cadastrada', FILTER_SANITIZE_SPECIAL_CHARS);
$dataCadastradaLimite = filter_input(INPUT_POST, 'data_cadastrada_limite', FILTER_SANITIZE_SPECIAL_CHARS);

// nova instancia de relatoriosDaoMySql:
$relatoriosDao = new RelatoriosDaoMySql($pdo);
$relatorioAtestados = $relatoriosDao->gerarRelatorioAtestados($idCurso, $idTurma, $dataCadastrada, $dataCadastradaLimite);

if(!empty($relatorioAtestados)) {
    
    // Criação da estrutura HTML
    $estruturaHtml = '<!DOCTYPE html>
                    <head>
                        <meta charset="utf-8">
                        <link rel="stylesheet" href="http://localhost/sgs/src/reports/css/relatorio.css" >
                    </head>
                    <body>   
                    <div class="box-image">     
                        <img src="http://localhost/sgs/public/logo.png" alt="Logo">
                    </div>
                    <h1>Relatorio de atestados de alunos</h1>
                    <table border=1>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Motivo</th>
                                <th>Curso</th>
                                <th>Turma</th>
                                <th>Data Início do Atestado</th>
                                <th>Data Final do Atestado</th>
                            </tr>
                        </thead>
                        <tbody>';

    foreach($relatorioAtestados as $atestado) {
        $estruturaHtml .= '<tr>
                            <td>' . $atestado['nome']   . '</td>
                            <td>' . $atestado['motivo'] . '</td>
                            <td>' . $atestado['curso']  . '</td>
                            <td>' . $atestado['turma']  . '</td>
                            <td>' . date('d/m/Y', strtotime($atestado['data_inicio'])) . '</td>
                            <td>' . date('d/m/Y', strtotime($atestado['data_final']))  . '</td>
                          </tr>';
    }

    $estruturaHtml .=   '</tbody>
                      </table>
                      </body>';

    // Nova instancia para gerar o PDF
    $dompdf = new Dompdf(['enable_remote' => true]);
    $dompdf->loadHtml($estruturaHtml);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream(
        "relatorio_atestados.pdf",
        ["Attachment" => true]
    );
} 
else {
    $_SESSION['flash'] = '<div style="text-align:center;" class="alert alert-danger" role="alert">
                            Nenhum registro com as condições solicitadas foi encontrado.
                          </div>';
    header('Location:' . $baseUrl . '/public/relatorio_atestados.php');
    exit;
}



