<?php 

namespace src\models;

class Usuario
{
    private $id;
    private $nome;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}