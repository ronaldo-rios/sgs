<?php

namespace src\interfaces;

use src\reports\RelatoriosDao;


Interface RelatoriosDaoInterface
{
    public function gerarRelatorioAtestados(
        $idCurso, $idTurma, $dataCadastrada, $dataCadastradaLimite
    );
    public function gerarRelatorioVacinas($idCurso, $idTurma);
}