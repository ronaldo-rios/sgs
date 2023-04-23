<?php

namespace src\interfaces;

use src\models\Usuario;

interface UsuarioInterface
{
    public function add(Usuario $u);
}