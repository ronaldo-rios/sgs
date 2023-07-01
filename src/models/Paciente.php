<?php 

declare(strict_types=1);

namespace src\models;

class Paciente {
    private int $id;
    private string $matricula;
    private ?string $foto;
    private string $nome;
    private string $email;
    private string $nascimento;
    private ?string $telefone;
    private ?string $endereco;
   

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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): void
    {
        $this->foto = $foto;
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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): void
    {
        $this->endereco = trim($endereco);

    }

}