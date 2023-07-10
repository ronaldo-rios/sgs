<?php

namespace src\interfaces;

use src\models\Soap;

interface SoapDaoInterface
{
    public function inserirSoap(Soap $soap);
    public function atualizarSoap(Soap $soap);
    public function deletarSoap(Soap $soap);
    public function findAll();
    public function findPaciente($id);
    public function findById($id);
}