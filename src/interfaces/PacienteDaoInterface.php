<?php

declare(strict_types=1);

namespace src\interfaces;

use src\models\Paciente;

// A interface vai criar as funções para usar no DAO e o DAO vai ser forçado a implementar
// A Model Usuario vai fazer injeção de dependencia diretamente no parâmetro dos métodos.
// Basicamente a Interface vai fazer o intermédio entre o Model que é a representação
// da tabela e o DAO que é a implementação do CRUD em si e persistência no banco de dados.
interface PacienteDaoInterface
{
    public function adicionarPaciente(Paciente $paciente): Paciente;
    public function atualizarPaciente(Paciente $paciente): Paciente;
    public function deletarPaciente(Paciente $paciente): bool;
    public function findById(int $id): Paciente;
    public function findAll(): array;
}