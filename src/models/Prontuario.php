<?php 

declare(strict_types=1);

namespace src\models;
// É a classe com os atributos da Tabela do Banco
class Prontuario
{
    private int $id;
    private int $matriculaPaciente;
    private string $esf;
    private string $planoSaude;
    private string $numeroCartaoSus;
    private string $alergiaMedicamento;
    private string $nomeMedicamentoAlergia;
    private string $medicamentoControlado;
    private string $nomeMedicamentoControlado;
    private string $diabetes;
    private  string $pressaoAlta;
    private string $pressaoBaixa;
    private string $asma;
    private string $bronquite;
    private string $anemia;
    private string $ansiedade;
    private string $depressao;
    private string $insonia;
    private string $hemofilia;
    private string $tuberculose;
    private string $eplepsia;
    private string $desmaios;
    private string $fumante;
    private string $outro;
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

    public function getMatriculaPaciente(): int
    {
        return $this->matriculaPaciente;
    }

    public function setMatriculaPaciente(int $matriculaPaciente): void
    {
        $this->matriculaPaciente = $matriculaPaciente;
    }

    public function getEsf(): string
    {
        return $this->esf;
    }

    public function setEsf(string $esf): void
    {
        $this->esf = $esf;
    }

    public function getPlanoSaude(): string
    {
        return $this->planoSaude;
    }

    public function setPlanoSaude(string $planoSaude): void
    {
        $this->planoSaude = $planoSaude;
    }

    public function getNumeroCartaoSus(): string
    {
        return $this->numeroCartaoSus;
    }

    public function setNumeroCartaoSus(string $numeroCartaoSus): void
    {
        $this->numeroCartaoSus = $numeroCartaoSus;
    }

    public function getAlergiaMedicamento(): string
    {
        return $this->alergiaMedicamento;
    }

    public function setAlergiaMedicamento(string $alergiaMedicamento): void
    {
        $this->alergiaMedicamento = $alergiaMedicamento;
    }

    public function getNomeMedicamentoAlergia(): string
    {
        return $this->nomeMedicamentoAlergia;
    }

    public function setNomeMedicamentoAlergia(string $nomeMedicamentoAlergia): void
    {
        $this->nomeMedicamentoAlergia = $nomeMedicamentoAlergia;
    }

    public function getMedicamentoControlado(): string
    {
        return $this->medicamentoControlado;
    }

    public function setMedicamentoControlado(string $medicamentoControlado): void
    {
        $this->medicamentoControlado = $medicamentoControlado;
    }

    public function getNomeMedicamentoControlado(): string
    {
        return $this->nomeMedicamentoControlado;
    }

    public function setNomeMedicamentoControlado(string $nomeMedicamentoControlado): void
    {
        $this->nomeMedicamentoControlado = $nomeMedicamentoControlado;
    }
    public function getDiabetes(): string
    {
        return $this->diabetes;
    }

    public function setDiabetes(string $diabetes): void
    {
        $this->diabetes = $diabetes;
    }

    public function getPressaoAlta(): string
    {
        return $this->pressaoAlta;
    }

    public function setPressaoAlta(string $pressaoAlta): void
    {
        $this->pressaoAlta = $pressaoAlta;
    }

    public function getPressaoBaixa(): string
    {
        return $this->pressaoBaixa;
    }

    public function setPressaoBaixa(string $pressaoBaixa): void
    {
        $this->pressaoBaixa = $pressaoBaixa;
    }

    public function getAsma(): string
    {
        return $this->asma;
    }

    public function setAsma(string $asma): void
    {
        $this->asma = $asma;
    }

    public function getBronquite(): string
    {
        return $this->bronquite;
    }

    public function setBronquite(string $bronquite): void
    {
        $this->bronquite = $bronquite;
    }

    public function getAnemia(): string
    {
        return $this->anemia;
    }

    public function setAnemia(string $anemia): void
    {
        $this->anemia = $anemia;
    }

    public function getAnsiedade(): string
    {
        return $this->ansiedade;
    }

    public function setAnsiedade(string $ansiedade): void
    {
        $this->ansiedade = $ansiedade;
    }

    public function getDepressao(): string
    {
        return $this->depressao;
    }

    public function setDepressao(string $depressao): void
    {
        $this->depressao = $depressao;
    }

    public function getInsonia(): string
    {
        return $this->insonia;
    }

    public function setInsonia(string $insonia): void
    {
        $this->insonia = $insonia;
    }

    public function getHemofilia(): string
    {
        return $this->hemofilia;
    }

    public function setHemofilia(string $hemofilia): void
    {
        $this->hemofilia = $hemofilia;
    }

    public function getTuberculose(): string
    {
        return $this->tuberculose;
    }

    public function setTuberculose(string $tuberculose): void
    {
        $this->tuberculose = $tuberculose;
    }

    public function getEplepsia(): string
    {
        return $this->eplepsia;
    }

    public function setEplepsia(string $eplepsia): void
    {
        $this->eplepsia = $eplepsia;
    }

    public function getDesmaios(): string
    {
        return $this->desmaios;
    }

    public function setDesmaios(string $desmaios): void
    {
        $this->desmaios = $desmaios;
    }

    public function getFumante(): string
    {
        return $this->fumante;
    }

    public function setFumante(string $fumante): void
    {
        $this->fumante = $fumante;
    }

    public function getOutro(): string
    {
        return $this->outro;
    }

    public function setOutro(string $outro): void
    {
        $this->outro = $outro;
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