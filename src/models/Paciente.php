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
    private int $id_paciente;

    /**
     * Get the value of matricula
     */
    public function getMatricula(): string
    {
        return $this->matricula;
    }

    /**
     * Set the value of matricula
     */
    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of nascimento
     */
    public function getNascimento(): string
    {
        return $this->nascimento;
    }

    /**
     * Set the value of nascimento
     */
    public function setNascimento(string $nascimento): self
    {
        $this->nascimento = $nascimento;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     */
    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     */
    public function setIdUsuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of id_paciente
     */
    public function getIdPaciente(): int
    {
        return $this->id_paciente;
    }

    /**
     * Set the value of id_paciente
     */
    public function setIdPaciente(int $id_paciente): self
    {
        $this->id_paciente = $id_paciente;

        return $this;
    }
}