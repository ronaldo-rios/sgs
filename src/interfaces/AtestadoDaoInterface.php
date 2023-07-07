<?php

namespace src\interfaces;

use src\models\Atestado;

interface AtestadoDaoInterface
{
    public function adicionarAtestado(Atestado $atestado);
    public function atualizarAtestado(Atestado $atestado);
    public function deletarAtestado(Atestado $atestado);
    public function findPaciente($id);
}