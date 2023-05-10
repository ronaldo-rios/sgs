<?php

namespace src\interfaces;

use src\models\Vacina;

interface VacinaInterface
{
    public function add(Vacina $vacina);
}