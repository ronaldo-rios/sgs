<?php 

declare(strict_types=1);

namespace src\models;

class PacienteVacina{
    private int $id;
    private int $idPaciente;
    private int $idVacina;
    private string $data;
    private string $dose;

   public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id= $id;
    }

    public function getIdPaciente(): int
    {
        return $this->idPaciente;
    }

    public function setIdPaciente(int $idPaciente): void
    {
        $this->idPaciente = $idPaciente;
    }

    public function getIdVacina(): int
    {
        return $this->idVacina;
    }

    public function setIdVacina(int $idVacina): void
    {
        $this->idVacina = $idVacina;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = trim($data);
    }

    public function getDose(): string
    {
        return $this->dose;
    }

    public function setDose(string $dose): void
    {
        $this->dose = strtoupper(trim($dose));
    }
}