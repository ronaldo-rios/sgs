<?php 

namespace src\dao;

use src\config\Config;
use src\models\Prontuario;
use src\interfaces\ProntuarioInterface;

// Implementação do CRUD:
class ProntuarioDaoMySql implements ProntuarioInterface
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Config::getDb();
    }

    public function add(Prontuario $prontuario)
    {
        $sql = $this->pdo->prepare("INSERT INTO prontuario 
        (matricula_paciente,esf,plano_saude,numero_cartao_sus,alergia_medicamento
        nome_medicamento_alergia,medicamento_controlado,nome_medicamento_controlado
        diabetes,pressao_alta,pressao_baixa,asma,anemia,ansiedade,depressao,insonia
        hemofilia,tubercoluse,eplepsia,desmaio,fumante,outro,id_paciente,id_usuario)

         VALUES (:matricula_paciente,esf,plano_saude,numero_cartao_sus,alergia_medicamento
        nome_medicamento_alergia,medicamento_controlado,nome_medicamento_controlado
        diabetes,pressao_alta,pressao_baixa,asma,anemia,ansiedade,depressao,insonia
        hemofilia,tubercoluse,eplepsia,desmaio,fumante,outro,id_paciente,id_usuario))");

        $sql->bindValue(':matricula_paciente', $prontuario->getMatriculaPaciente());
        $sql->bindValue(':esf', $prontuario->getEsf());
        $sql->bindValue(':plano_saude', $prontuario->getPlanoSaude());
        $sql->bindValue(':numero_cartao_sus', $prontuario->getNumeroCartaoSus());
        $sql->bindValue(':alergia_medicamento', $prontuario->getAlergiaMedicamento());
        $sql->bindValue(':nome_medicamento_alergia', $prontuario->getNomeMedicamentoAlergia());
        $sql->bindValue(':nome_medicamento_controlado', $prontuario->getNomeMedicamentoControlado());
        $sql->bindValue(':diabetes', $prontuario->getDiabetes());
        $sql->bindValue(':pressao_alta', $prontuario->getPressaoAlta());
        $sql->bindValue(':pressao_baixa', $prontuario->getPressaoBaixa());
        $sql->bindValue(':asma', $prontuario->getAsma());
        $sql->bindValue(':anemia', $prontuario->getAnemia());
        $sql->bindValue(':ansiedade', $prontuario->getAnsiedade());
        $sql->bindValue(':depressao', $prontuario->getInsonia());
        $sql->bindValue(':hemofilia', $prontuario->getHemofilia());
        $sql->bindValue(':tuberculose', $prontuario->getTubercoluse());
        $sql->bindValue(':eplepsia', $prontuario->getEplepsia());
        $sql->bindValue(':desmaio', $prontuario->getDesmaios());
        $sql->bindValue(':fumante', $prontuario->getFumante());
        $sql->bindValue(':id_usuario', $prontuario->getIdUsuario());
        $sql->bindValue(':id_paciente', $prontuario->getIdPaciente());
        $sql->execute();
        return $prontuario;
    }
}