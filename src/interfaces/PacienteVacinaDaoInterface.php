<?php

namespace src\interfaces;

use src\models\PacienteVacina;

interface PacienteVacinaDaoInterface
{
    public function adicionarPacienteVacina(PacienteVacina $pvacina);
    public function editarPacienteVacina(PacienteVacina $pvacina);
    public function removerPacienteVacina(int $idPaciente, int $idVacina);
    public function buscarPacienteVacinaPorIdPaciente(int $idPaciente);
    public function buscarPacienteVacinaPorIdVacina(int $idVacina);
    public function findAll();
}