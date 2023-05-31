<?php

namespace src\interfaces;

use src\models\Curso;


interface CursoDaoInterface
{
    public function inserirCurso(Curso $curso);
    public function atualizarCurso(Curso $curso);
    public function deletarCurso(Curso $curso);
    public function findById($id);
    public function findAll();
}