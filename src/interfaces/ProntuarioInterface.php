<?php

namespace src\interfaces;

use src\models\Prontuario;

interface ProntuarioInterface
{
    public function add(Prontuario $prontuario);
}