<?php

namespace src\interfaces;

use src\models\Curso;


interface CursoInterface
{
    public function add(Curso $curso);
}