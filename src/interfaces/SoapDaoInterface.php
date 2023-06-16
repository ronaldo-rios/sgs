<?php

declare(strict_types=1);

namespace src\interfaces;

use src\models\Soap;

interface SoapInterface
{
    public function inserirSoap(Soap $soap): Soap;
    public function atualizarSoap(Soap $soap): Soap;
    public function deletarSoap(Soap $soap): bool;
    public function findById(int $id): Soap;
    public function findAllSoap(): array;
}