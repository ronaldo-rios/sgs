<?php

namespace src\interfaces;

use src\models\Vacina;

interface VacinaDaoInterface
{
    public function adicionarVacina(Vacina $vacina);
    public function findAllVacinas();
    public function findVacinaById(int $id);
    public function editarVacina(Vacina $vacina);
    public function removerVacina(Vacina $id);
}