<?php 

declare(strict_types=1);

namespace src\models;

class PacienteVacina{
    private int $id;
    private int $id_paciente;
    private int $id_vacina;
    private string $data;
    private string $dose;

   

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

    /**
     * Get the value of id_vacina
     */
    public function getIdVacina(): int
    {
        return $this->id_vacina;
    }

    /**
     * Set the value of id_vacina
     */
    public function setIdVacina(int $id_vacina): self
    {
        $this->id_vacina = $id_vacina;

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
     * Get the value of dose
     */
    public function getDose(): string
    {
        return $this->dose;
    }

    /**
     * Set the value of dose
     */
    public function setDose(string $dose): self
    {
        $this->dose = $dose;

        return $this;
    }
}