<?php 

declare(strict_types=1);

namespace src\models;

class Paciente {
    private int $id;
    private string $matricula;
    private string $nome;
    private string $email;
    private string $nascimento;
    private string $telefone;
    private int $id_usuario;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): void
    {
        $this->matricula = trim($matricula);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = ucwords(trim($nome));
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    public function getNascimento(): string
    {
        return $this->nascimento;
    }

    public function setNascimento(string $nascimento): void
    {
        $this->nascimento = trim($nascimento);

    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): void
    {
        $this->telefone = trim($telefone);

    }

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

}