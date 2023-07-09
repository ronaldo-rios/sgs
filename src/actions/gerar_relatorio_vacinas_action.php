<?php 

require '../../conexao.php';

use src\reports\RelatoriosDaoMySql;
use Dompdf\Dompdf;

$idCurso = filter_input(INPUT_POST, 'idcurso', FILTER_SANITIZE_SPECIAL_CHARS);
$idTurma = filter_input(INPUT_POST, 'idturma', FILTER_SANITIZE_SPECIAL_CHARS);


// nova instancia de relatoriosDaoMySql:
$relatoriosDao = new RelatoriosDaoMySql($pdo);
$relatorioVacinas= $relatoriosDao->gerarRelatorioVacinas($idCurso, $idTurma);

if(!empty($relatorioVacinas)) {
    
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
                                <th>Vacina</th>
                                <th>Dose</th>
                                <th>Data da Vacina</th>
                                <th>Paciente</th>
                                <th>Matrícula</th>
                                <th>Curso</th>
                                <th>Turma</th>
                            </tr>
                        </thead>
                        <tbody>';

    foreach($relatorioVacinas as $vacinas) {
        $estruturaHtml .= '<tr>
                            <td>' . $vacinas['VACINA']   . '</td>
                            <td>' . $vacinas['DOSE'] . '</td>
                            <td>' . date('d/m/Y', strtotime($vacinas['DATA_VACINACAO'])) . '</td>
                            <td>' . $vacinas['PACIENTE']  . '</td>
                            <td>' . $vacinas['MATRICULA'] . '</td>
                            <td>' . $vacinas['CURSO'] . '</td>
                            <td>' . $vacinas['TURMA']  . '</td>
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
        "relatorio_vacinas.pdf",
        ["Attachment" => true]
    );
} 
else {
    $_SESSION['flash'] = '<div style="text-align:center;" class="alert alert-danger" role="alert">
                            Nenhum registro com as condições solicitadas foi encontrado.
                          </div>';
    header('Location:' . $baseUrl . '/public/relatorio_vacinas.php');
    exit;
}



