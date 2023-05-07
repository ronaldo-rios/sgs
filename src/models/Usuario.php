<?php 

declare(strict_types=1);

namespace src\models;
// É a classe com os atributos da Tabela do Banco
class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $nivelAcesso;

    public function getNome():string
    {
        return $this->nome;
    }

    public function setNome(string $nome):void
    {
        $this->nome = $nome;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setEmail(string $email):void
    {
        $this->email = $email;
    }

    public function getSenha():string
    {
        return $this->senha;
    }

    public function setSenha(string $senha):void
    {
        $this->senha = $senha;
    }

    public function getNivelAcesso():string
    {
        return $this->nivelAcesso;
    }

    public function setNivelAcesso(string $nivelAcesso):void
    {
        $this->nivelAcesso = $nivelAcesso;
    }
}