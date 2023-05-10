<?php 

declare(strict_types=1);

namespace src\models;

class Atestado{
    private int $id;
    private string $data_cadastro;
    private string $descricao;
    private string $cid;
    private string $atestado_doc;
    private int $id_paciente;
    private int $id_usuario;


    /**
     * Get the value of data_cadastro
     */
    public function getDataCadastro(): string
    {
        return $this->data_cadastro;
    }

    /**
     * Set the value of data_cadastro
     */
    public function setDataCadastro(string $data_cadastro): self
    {
        $this->data_cadastro = $data_cadastro;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of cid
     */
    public function getCid(): string
    {
        return $this->cid;
    }

    /**
     * Set the value of cid
     */
    public function setCid(string $cid): self
    {
        $this->cid = $cid;

        return $this;
    }

    /**
     * Get the value of atestado_doc
     */
    public function getAtestadoDoc(): string
    {
        return $this->atestado_doc;
    }

    /**
     * Set the value of atestado_doc
     */
    public function setAtestadoDoc(string $atestado_doc): self
    {
        $this->atestado_doc = $atestado_doc;

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
}