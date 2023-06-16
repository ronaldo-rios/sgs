<?php

declare(strict_types=1);

namespace src\interfaces;

use src\models\Vacina;

interface VacinaDaoInterface
{
    public function adicionarVacina(Vacina $vacina): Vacina;
    public function findAllVacinas(): array;
    public function findVacinaById(int $id): Vacina;
    public function editarVacina(Vacina $vacina): Vacina;
    public function removerVacina(Vacina $id): void;
}