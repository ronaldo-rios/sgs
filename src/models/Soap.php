<?php 

declare(strict_types=1);

namespace src\models;

class Soap{
    private int $id;
    private string $subjetivo;
    private string $objetivo;
    private string $avaliacao;
    private string $plano;
    private string $data;
    private int $id_prontuario;

    /**
     * Get the value of subjetivo
     */
    public function getSubjetivo(): string
    {
        return $this->subjetivo;
    }

    /**
     * Set the value of subjetivo
     */
    public function setSubjetivo(string $subjetivo): self
    {
        $this->subjetivo = $subjetivo;

        return $this;
    }

    /**
     * Get the value of objetivo
     */
    public function getObjetivo(): string
    {
        return $this->objetivo;
    }

    /**
     * Set the value of objetivo
     */
    public function setObjetivo(string $objetivo): self
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get the value of avaliacao
     */
    public function getAvaliacao(): string
    {
        return $this->avaliacao;
    }

    /**
     * Set the value of avaliacao
     */
    public function setAvaliacao(string $avaliacao): self
    {
        $this->avaliacao = $avaliacao;

        return $this;
    }

    /**
     * Get the value of plano
     */
    public function getPlano(): string
    {
        return $this->plano;
    }

    /**
     * Set the value of plano
     */
    public function setPlano(string $plano): self
    {
        $this->plano = $plano;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Set the value of data
     */
    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of id_prontuario
     */
    public function getIdProntuario(): int
    {
        return $this->id_prontuario;
    }

    /**
     * Set the value of id_prontuario
     */
    public function setIdProntuario(int $id_prontuario): self
    {
        $this->id_prontuario = $id_prontuario;

        return $this;
    }
}