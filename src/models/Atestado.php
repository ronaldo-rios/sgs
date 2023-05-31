<?php 

declare(strict_types=1);

namespace src\models;

class Atestado{
    private int $id;
    private string $dataCadastro;
    private string $descricao;
    private string $cid;
    private string $atestadoDoc;
    private int $idPaciente;
    private int $idUsuario;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDataCadastro(): string
    {
        return $this->dataCadastro;
    }

    public function setDataCadastro(string $dataCadastro): void
    {
        $this->dataCadastro = trim($dataCadastro);
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = trim($descricao);
    }

    public function getCid(): string
    {
        return $this->cid;
    }

    public function setCid(string $cid): void
    {
        $this->cid = trim($cid);
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
        return $this->idPaciente;
    }

    public function setIdPaciente(int $idPaciente): void
    {
        $this->idPaciente = $idPaciente;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }
}