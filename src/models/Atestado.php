<?php 

declare(strict_types=1);

namespace src\models;

class Atestado{
    private int $id;
    private string $data_cadastrada;
    private string $data_inicio;
    private string $data_final;
    private string $descricao;
    private string $atestadoDoc;
    private string $motivo;
    private int $id_paciente;
    private int $id_usuario;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDataCadastrada(): string
    {
        return $this->data_cadastrada;
    }

    public function setDataCadastrada(string $data_cadastrada): void
    {
        $this->data_cadastrada = $data_cadastrada;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


    public function getAtestadoDoc(): string
    {
        return $this->atestadoDoc;
    }

    public function setAtestadoDoc(string $atestadoDoc): void
    {
        $this->atestadoDoc = $atestadoDoc;
    }

    public function getIdPaciente(): int
    {
        return $this->id_paciente;
    }

    public function setIdPaciente(int $id_paciente): void
    {
        $this->id_paciente = $id_paciente;
    }

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

 
    public function getDataInicio(): string
    {
        $data_inicio = $this->data_inicio; 
        $data_inicio_formatada = date('d/m/Y', strtotime($data_inicio));
        return $data_inicio_formatada;
    }

 
    public function setDataInicio(string $data_inicio): void
    {
        $this->data_inicio = $data_inicio;

    }

    public function getDataFinal(): string
    {
        $data_final = $this->data_final;
        $data_final_formatada = date('d/m/Y', strtotime($data_final));
        return $data_final_formatada;
    }

   
    public function setDataFinal(string $data_final): void
    {
        $this->data_final = $data_final;

    }


    public function getMotivo(): string
    {
        return $this->motivo;
    }

    /**
     * Set the value of motivo
     */
    public function setMotivo(string $motivo): void
    {
        $this->motivo = $motivo;
    }
}