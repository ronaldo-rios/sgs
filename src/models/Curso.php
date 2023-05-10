<?php 

declare(strict_types=1);

namespace src\models;
// É a classe com os atributos da Tabela do Banco
class Curso
{
    private int $id;
    private string $nome;

    public function getNome():string
    {
        return $this->nome;
    }

    public function setNome(string $nome):void
    {
        $this->nome = $nome;
    }

   
}