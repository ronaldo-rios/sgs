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
    private bool $alergiaMedicamento;
    private string $nomeMedicamentoAlergia;
    private bool $medicamentoControlado;
    private string $nomeMedicamentoControlado;
    private bool $diabetes;
    private bool $pressaoAlta;
    private bool $pressaoBaixa;
    private bool $asma;
    private bool $bronquite;
    private bool $anemia;
    private bool $ansiedade;
    private bool $depressao;
    private bool $insonia;
    private bool $hemofilia;
    private bool $tubercoluse;
    private bool $eplepsia;
    private bool $desmaios;
    private bool $fumante;
    private string $outro;
    private int $idPaciente;

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

    public function getAlergiaMedicamento(): bool
    {
        return $this->alergiaMedicamento;
    }

    public function setAlergiaMedicamento(bool $alergiaMedicamento): void
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

    public function getMedicamentoControlado(): bool
    {
        return $this->medicamentoControlado;
    }

    public function setMedicamentoControlado(bool $medicamentoControlado): void
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
    public function getDiabetes(): bool
    {
        return $this->diabetes;
    }

    public function setDiabetes(bool $diabetes): void
    {
        $this->diabetes = $diabetes;
    }

    public function getPressaoAlta(): bool
    {
        return $this->pressaoAlta;
    }

    public function setPressaoAlta(bool $pressaoAlta): void
    {
        $this->pressaoAlta = $pressaoAlta;
    }

    public function getPressaoBaixa(): bool
    {
        return $this->pressaoBaixa;
    }

    public function setPressaoBaixa(bool $pressaoBaixa): void
    {
        $this->pressaoBaixa = $pressaoBaixa;
    }

    public function getAsma(): bool
    {
        return $this->asma;
    }

    public function setAsma(bool $asma): void
    {
        $this->asma = $asma;
    }

    public function getBronquite(): bool
    {
        return $this->bronquite;
    }

    public function setBronquite(bool $bronquite): void
    {
        $this->$bronquite = $bronquite;
    }

    public function getAnemia(): bool
    {
        return $this->anemia;
    }

    public function setAnemia(bool $anemia): void
    {
        $this->anemia = $anemia;
    }

    public function getAnsiedade(): bool
    {
        return $this->ansiedade;
    }

    public function setAnsiedade(bool $ansiedade): void
    {
        $this->ansiedade = $ansiedade;
    }

    public function getDepressao(): bool
    {
        return $this->depressao;
    }

    public function setDepressao(bool $depressao): void
    {
        $this->depressao = $depressao;
    }

    public function getInsonia(): bool
    {
        return $this->insonia;
    }

    public function setInsonia(bool $insonia): void
    {
        $this->insonia = $insonia;
    }

    public function getHemofilia(): bool
    {
        return $this->hemofilia;
    }

    public function setHemofilia(bool $hemofilia): void
    {
        $this->hemofilia = $hemofilia;
    }

    public function getTubercoluse(): bool
    {
        return $this->tubercoluse;
    }

    public function setTubercoluse(bool $tubercoluse): void
    {
        $this->tubercoluse = $tubercoluse;
    }

    public function getEplepsia(): bool
    {
        return $this->eplepsia;
    }

    public function setEplepsia(bool $eplepsia): void
    {
        $this->eplepsia = $eplepsia;
    }

    public function getDesmaios(): bool
    {
        return $this->desmaios;
    }

    public function setDesmaios(bool $desmaios): void
    {
        $this->desmaios = $desmaios;
    }

    public function getFumante(): bool
    {
        return $this->fumante;
    }

    public function setFumante(bool $fumante): void
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

}