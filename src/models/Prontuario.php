<?php 

declare(strict_types=1);

namespace src\models;
// É a classe com os atributos da Tabela do Banco
class Prontuario
{
    private int $id;
    private int $matricula_paciente;
    private string $esf;
    private string $plano_saude;
    private string $numero_cartao_sus;
    private bool $alergia_medicamento;
    private string $nome_medicamento_alergia;
    private bool $medicamento_controlado;
    private string $nome_medicamento_controlado;
    private bool $diabetes;
    private bool $pressao_alta;
    private bool $pressao_baixa;
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

    public function getMatriculaPaciente(): int
    {
        return $this->matricula_paciente;
    }

    public function setMatriculaPaciente(int $matricula_paciente): void
    {
        $this->matricula_paciente = $matricula_paciente;
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
        return $this->plano_saude;
    }

    public function setPlanoSaude(string $plano_saude): void
    {
        $this->plano_saude = $plano_saude;
    }

    public function getNumeroCartaoSus(): string
    {
        return $this->numero_cartao_sus;
    }

    public function setNumeroCartaoSus(string $numero_cartao_sus): void
    {
        $this->numero_cartao_sus = $numero_cartao_sus;
    }

    public function getAlergiaMedicamento(): bool
    {
        return $this->alergia_medicamento;
    }

    public function setAlergiaMedicamento(bool $alergia_medicamento): void
    {
        $this->alergia_medicamento = $alergia_medicamento;
    }

    public function getNomeMedicamentoAlergia(): string
    {
        return $this->nome_medicamento_alergia;
    }

    public function setNomeMedicamentoAlergia(string $nome_medicamento_alergia): void
    {
        $this->nome_medicamento_alergia = $nome_medicamento_alergia;
    }

    public function getMedicamentoControlado(): bool
    {
        return $this->medicamento_controlado;
    }

    public function setMedicamentoControlado(bool $medicamento_controlado): void
    {
        $this->medicamento_controlado = $medicamento_controlado;
    }

    public function getNomeMedicamentoControlado(): string
    {
        return $this->nome_medicamento_controlado;
    }

    public function setNomeMedicamentoControlado(string $nome_medicamento_controlado): void
    {
        $this->nome_medicamento_controlado = $nome_medicamento_controlado;
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
        return $this->pressao_alta;
    }

    public function setPressaoAlta(bool $pressao_alta): void
    {
        $this->pressao_alta = $pressao_alta;
    }

    public function getPressaoBaixa(): bool
    {
        return $this->pressao_baixa;
    }

    public function setPressaoBaixa(bool $pressao_baixa): void
    {
        $this->pressao_baixa = $pressao_baixa;
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
        return $this->id_paciente;
    }

    public function setIdPaciente(int $id_paciente): void
    {
        $this->id_paciente = $id_paciente;
    }

    public function setIdUsuario(int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }
}