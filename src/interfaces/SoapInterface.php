<?php

namespace src\interfaces;

use src\models\Soap;

interface SoapInterface
{
    public function inserirSoap(Soap $soap);
}