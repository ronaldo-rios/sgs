<?php

namespace src\interfaces;

use src\models\Atestado;

interface AtestadoInterface
{
    public function adicionarAtestado(Atestado $atestado);
}