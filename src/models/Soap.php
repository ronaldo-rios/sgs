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
    private int $idProntuario;

    public function getSubjetivo(): string
    {
        return $this->subjetivo;
    }

    public function setSubjetivo(string $subjetivo): void
    {
        $this->subjetivo = trim($subjetivo);
    }

    public function getObjetivo(): string
    {
        return $this->objetivo;
    }

    public function setObjetivo(string $objetivo): void
    {
        $this->objetivo = trim($objetivo);
    }

    public function getAvaliacao(): string
    {
        return $this->avaliacao;
    }

    public function setAvaliacao(string $avaliacao): void
    {
        $this->avaliacao = trim($avaliacao);
    }

    public function getPlano(): string
    {
        return $this->plano;
    }

    public function setPlano(string $plano): void
    {
        $this->plano = trim($plano);
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function getIdProntuario(): int
    {
        return $this->idProntuario;
    }

    public function setIdProntuario(int $idProntuario): void
    {
        $this->idProntuario = $idProntuario;
    }
}