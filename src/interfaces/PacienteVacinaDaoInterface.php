<?php
declare(strict_types=1);

namespace src\interfaces;

use src\models\PacienteVacina;

interface PacienteVacinaDaoInterface
{
    public function adicionarPacienteVacina(PacienteVacina $pacienteVacina): PacienteVacina;
}