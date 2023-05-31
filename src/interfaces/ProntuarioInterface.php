<?php

namespace src\interfaces;

use src\models\Prontuario;

interface ProntuarioInterface
{
    public function criarProntuario(Prontuario $prontuario);
}