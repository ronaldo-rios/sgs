<?php
declare(strict_types=1);

namespace src\interfaces;

use src\models\Prontuario;

interface ProntuarioInterface
{
    public function criarProntuario(Prontuario $prontuario): Prontuario;
    public function atualizarProntuario(Prontuario $prontuario): Prontuario;
    public function deletarProntuario(Prontuario $prontuario): bool;
    public function buscarProntuarioPorId(int $id): Prontuario;
    public function buscarTodosProntuarios(): array;
}