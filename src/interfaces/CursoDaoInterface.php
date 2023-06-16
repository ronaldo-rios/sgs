<?php

declare(strict_types=1);

namespace src\interfaces;

use src\models\Curso;


interface CursoDaoInterface
{
    public function inserirCurso(Curso $curso): Curso;
    public function atualizarCurso(Curso $curso): Curso;
    public function deletarCurso(Curso $curso): bool;
    public function findById(int $id): Curso;
    public function findAll(): array;
}