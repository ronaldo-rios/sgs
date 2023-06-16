<?php

declare(strict_types=1);

namespace src\interfaces;

use src\models\Turma;

// A interface vai criar as funções para usar no DAO e o DAO vai ser forçado a implementar
// A Model Usuario vai fazer injeção de dependencia diretamente no parâmetro dos métodos.
// Basicamente a Interface vai fazer o intermédio entre o Model que é a representação
// da tabela e o DAO que é a implementação do CRUD em si e persistência no banco de dados.
interface TurmaDaoInterface
{
    public function inserirTurma(Turma $turma): Turma;
    public function atualizarTurma(Turma $turma): Turma;
    public function deletarTurma(Turma $turma): bool;
    public function findById(int $id): Turma;
    public function findAll(): array;
}