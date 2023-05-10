<?php 

declare(strict_types=1);

namespace src\models;

class Vacina {
    private int $id;
    private int $id_usuario;
    private string $nome;



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
}