<?php

namespace src\interfaces;

use src\models\PacienteVacina;

interface PacienteVacinaInterface
{
    public function adicionarPacienteVacina(PacienteVacina $pacienteVacina);
}