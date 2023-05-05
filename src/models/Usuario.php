<?php 

declare(strict_types=1);

namespace src\models;

class Usuario
{
    private int $id;
    private string $nome;
    private ?string $cpf;
    private ?string $siap;
    private ?string $crm;
    private string $permissao;
    private string $email;
    private string $senha;
    private ?string $token;

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getNome():string
    {
        return $this->nome;
    }

    public function setNome(string $nome):void
    {
        $this->nome = ucwords(trim($nome));
    }

    public function getCpf():?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf):void
    {
        $this->cpf = $cpf;
    }

    public function getSiap():?string
    {
        return $this->siap;
    }

    public function setSiap(?string $siap):void
    {
        $this->siap = $siap;
    }

    public function getCrm():?string
    {
        return $this->crm;
    }

    public function setCrm(?string $crm):void
    {
        $this->crm = $crm;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setEmail(string $email):void
    {
        $this->email = strtolower(trim($email));
    }

    public function getSenha():string
    {
        return $this->senha;
    }

    public function setSenha(string $senha):void
    {
        $this->senha = $senha;
    }

    public function getPermissao():string
    {
        return $this->permissao;
    }

    public function setPermissao(string $permissao):void
    {
        $this->permissao = $permissao;
    }

    public function getToken():?string
    {
        return $this->token;
    }

    public function setToken(string $token):void
    {
        $this->token = $token;
    }
}