<?php

namespace src\interfaces;

use src\models\Vacina;

interface VacinaInterface
{
    public function adicionarVacina(Vacina $vacina);
}