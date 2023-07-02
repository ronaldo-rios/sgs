<?php 

namespace src\dao;

use src\models\Prontuario;
use src\models\Paciente;
use src\interfaces\ProntuarioInterface;


// Implementação do CRUD:
class ProntuarioDaoMySql implements ProntuarioInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarProntuario(Prontuario $prontuario)
    {

        $sql = $this->pdo->prepare("INSERT INTO prontuarios
        (matricula_paciente, esf, plano_saude, numero_cartao_sus, alergia_medicamento,nome_medicamento_alergia, medicamento_controlado, nome_medicamento_controlado, diabetes, pressao_alta, pressao_baixa, asma,bronquite, anemia, ansiedade, depressao, insonia, hemofilia, tuberculose, eplepsia, desmaios, fumante, outro, id_paciente, id_usuario)

         VALUES
        (:matricula_paciente, :esf, :plano_saude, :numero_cartao_sus, :alergia_medicamento,:nome_medicamento_alergia, :medicamento_controlado, :nome_medicamento_controlado,  :diabetes, :pressao_alta, :pressao_baixa, :asma, :bronquite, :anemia, :ansiedade, :depressao, :insonia, :hemofilia, :tuberculose, :eplepsia, :desmaios, :fumante, :outro, :id_paciente,:id_usuario)");

        $sql->bindValue(':matricula_paciente', $prontuario->getMatriculaPaciente());
        $sql->bindValue(':esf', $prontuario->getEsf());
        $sql->bindValue(':plano_saude', $prontuario->getPlanoSaude());
        $sql->bindValue(':numero_cartao_sus', $prontuario->getNumeroCartaoSus());
        $sql->bindValue(':alergia_medicamento', $prontuario->getAlergiaMedicamento());
        $sql->bindValue(':nome_medicamento_alergia', $prontuario->getNomeMedicamentoAlergia());
        $sql->bindValue(':medicamento_controlado', $prontuario->getMedicamentoControlado());
        $sql->bindValue(':nome_medicamento_controlado', $prontuario->getNomeMedicamentoControlado());
        $sql->bindValue(':diabetes', $prontuario->getDiabetes());
        $sql->bindValue(':pressao_alta', $prontuario->getPressaoAlta());
        $sql->bindValue(':pressao_baixa', $prontuario->getPressaoBaixa());
        $sql->bindValue(':asma', $prontuario->getAsma());
        $sql->bindValue(':bronquite', $prontuario->getBronquite());
        $sql->bindValue(':anemia', $prontuario->getAnemia());
        $sql->bindValue(':ansiedade', $prontuario->getAnsiedade());
        $sql->bindValue(':depressao', $prontuario->getInsonia());
        $sql->bindValue(':insonia', $prontuario->getInsonia());
        $sql->bindValue(':hemofilia', $prontuario->getHemofilia());
        $sql->bindValue(':tuberculose', $prontuario->getTuberculose());
        $sql->bindValue(':eplepsia', $prontuario->getEplepsia());
        $sql->bindValue(':desmaios', $prontuario->getDesmaios());
        $sql->bindValue(':fumante', $prontuario->getFumante());
        $sql->bindValue(':outro', $prontuario->getOutro());
        $sql->bindValue(':id_paciente', $prontuario->getIdPaciente());
        $sql->bindValue(':id_usuario', $prontuario->getIdUsuario());
        $sql->execute();
        $prontuario->setId($this->pdo->lastInsertId());
        return $prontuario;
    }

    //Atualizar:

    public function atualizarProntuario(Prontuario $prontuario){
        $sql = $this->pdo->prepare(
            "UPDATE prontuarios SET 
            matricula_paciente = :matricula_paciente,
            esf = :esf, 
            plano_saude = :plano_saude,
            numero_cartao_sus = :numero_cartao_sus,
            alergia_medicamento = :alergia_medicamento,
            nome_medicamento_alergia = :nome_medicamento_alergia,
            medicamento_controlado = :medicamento_controlado,
            nome_medicamento_controlado = :nome_medicamento_controlado,
            diabetes = :diabetes,
            pressao_alta = :pressao_alta,
            pressao_baixa = :pressao_baixa,
            asma = :asma,
            bronquite = :bronquite,
            anemia = :anemia,
            ansiedade = :ansiedade,
            depressao = :depressao,
            insonia = :insonia,
            hemofilia = :hemofilia,
            tuberculose = :tuberculose,
            eplepsia = :eplepsia,
            desmaios = :desmaios,
            fumante = :fumante,
            outro = :outro,
            id_paciente = :id_paciente,
            id_usuario = :id_usuario
            WHERE id = :id"
            );
            $sql->bindValue(':id', $prontuario->getId());
            $sql->bindValue(':matricula_paciente', $prontuario->getMatriculaPaciente());
            $sql->bindValue(':esf', $prontuario->getEsf());
            $sql->bindValue(':plano_saude', $prontuario->getPlanoSaude());
            $sql->bindValue(':numero_cartao_sus', $prontuario->getNumeroCartaoSus());
            $sql->bindValue(':alergia_medicamento', $prontuario->getAlergiaMedicamento());
            $sql->bindValue(':nome_medicamento_alergia', $prontuario->getNomeMedicamentoAlergia());
            $sql->bindValue(':medicamento_controlado', $prontuario->getMedicamentoControlado());
            $sql->bindValue(':nome_medicamento_controlado', $prontuario->getNomeMedicamentoControlado());
            $sql->bindValue(':diabetes', $prontuario->getDiabetes());
            $sql->bindValue(':pressao_alta', $prontuario->getPressaoAlta());
            $sql->bindValue(':pressao_baixa', $prontuario->getPressaoBaixa());
            $sql->bindValue(':asma', $prontuario->getAsma());
            $sql->bindValue(':bronquite', $prontuario->getBronquite());
            $sql->bindValue(':anemia', $prontuario->getAnemia());
            $sql->bindValue(':ansiedade', $prontuario->getAnsiedade());
            $sql->bindValue(':depressao', $prontuario->getInsonia());
            $sql->bindValue(':insonia', $prontuario->getInsonia());
            $sql->bindValue(':hemofilia', $prontuario->getHemofilia());
            $sql->bindValue(':tuberculose', $prontuario->getTuberculose());
            $sql->bindValue(':eplepsia', $prontuario->getEplepsia());
            $sql->bindValue(':desmaios', $prontuario->getDesmaios());
            $sql->bindValue(':fumante', $prontuario->getFumante());
            $sql->bindValue(':outro', $prontuario->getOutro());
            $sql->bindValue(':id_paciente', $prontuario->getIdPaciente());
            $sql->bindValue(':id_usuario', $prontuario->getIdUsuario());
            $sql->execute();
            return $prontuario;


    }
     // Buscar por ID:
     public function findById($id)
     {
         $sql = $this->pdo->prepare("SELECT * FROM prontuarios WHERE id = :id");
         $sql->bindValue(':id', $id);
         $sql->execute();
         if($sql->rowCount() > 0){
             $data = $sql->fetch();
             $prontuario = new Prontuario();
             $prontuario->setId($data['id']);
             $prontuario->setMatriculaPaciente($data['matricula_paciente']);
             $prontuario->setEsf($data['esf']);
             $prontuario->setPlanoSaude($data['plano_saude']);
             $prontuario->setNumeroCartaoSus($data['numero_cartao_sus']);
             $prontuario->setNomeMedicamentoAlergia($data['nome_medicamento_alergia']);
             $prontuario->setNomeMedicamentoControlado($data['nome_medicamento_controlado']);
             $prontuario->setMedicamentoControlado($data['medicamento_controlado']);
             $prontuario->setAlergiaMedicamento($data['alergia_medicamento']);
             $prontuario->setDiabetes($data['diabetes']);
             $prontuario->setPressaoBaixa($data['pressao_baixa']);
             $prontuario->setPressaoAlta($data['pressao_alta']);
             $prontuario->setAsma($data['asma']);
             $prontuario->setBronquite($data['bronquite']);
             $prontuario->setAnemia($data['anemia']);
             $prontuario->setAnsiedade($data['ansiedade']);
             $prontuario->setDepressao($data['depressao']);
             $prontuario->setInsonia($data['insonia']);
             $prontuario->setHemofilia($data['hemofilia']);
             $prontuario->setTuberculose($data['tuberculose']);
             $prontuario->setEplepsia($data['eplepsia']);
             $prontuario->setDesmaios($data['desmaios']);
             $prontuario->setFumante($data['fumante']);
             $prontuario->setOutro($data['outro']);
             $prontuario->setIdPaciente($data['id_paciente']);
 
             return $prontuario;
         } else {
             return false;
         }
     }
//Buscando por todos
public function findAll()
{
    $sql = $this->pdo->prepare("SELECT * FROM prontuarios");
    $sql->execute();
    if($sql->rowCount() > 0) {
        $data = $sql->fetch();
        $prontuario = new  Prontuario();
        $prontuario->setId($data['id']);
        $prontuario->setMatriculaPaciente($data['matricula_paciente']);
        $prontuario->setEsf($data['esf']);
        $prontuario->setPlanoSaude($data['plano_saude']);
        $prontuario->setNumeroCartaoSus($data['numero_cartao_sus']);
        $prontuario->setNomeMedicamentoAlergia($data['nome_medicamento_alergia']);
        $prontuario->setNomeMedicamentoControlado($data['nome_medicamento_controlado']);
        $prontuario->setMedicamentoControlado($data['medicamento_controlado']);
        $prontuario->setAlergiaMedicamento($data['alergia_medicamento']);
        $prontuario->setDiabetes($data['diabetes']);
        $prontuario->setPressaoBaixa($data['pressao_baixa']);
        $prontuario->setPressaoAlta($data['pressao_alta']);
        $prontuario->setAsma($data['asma']);
        $prontuario->setBronquite($data['bronquite']);
        $prontuario->setAnemia($data['anemia']);
        $prontuario->setAnsiedade($data['ansiedade']);
        $prontuario->setDepressao($data['depressao']);
        $prontuario->setInsonia($data['insonia']);
        $prontuario->setHemofilia($data['hemofilia']);
        $prontuario->setTuberculose($data['tuberculose']);
        $prontuario->setEplepsia($data['eplepsia']);
        $prontuario->setDesmaios($data['desmaios']);
        $prontuario->setFumante($data['fumante']);
        $prontuario->setOutro($data['outro']);
        $prontuario->setIdPaciente($data['id_paciente']);
        $lista[] = $prontuario;
        return $lista;

    } else {
        return[];
    }
}

//Buscando por nome do paciente
public function findByName(string $nome): array
{
    $sql = $this->pdo->prepare("SELECT 
    pr.id AS 'id', pr.matricula_paciente AS 'matricula_paciente', pr.esf AS 'esf', 
    pr.plano_saude AS 'plano_saude', pr.numero_cartao_sus AS 'numero_cartao_sus', 
    pr.nome_medicamento_alergia AS 'nome_medicamento_alergia', 
    pr.nome_medicamento_controlado AS 'nome_medicamento_controlado',
    pr.medicamento_controlado AS 'medicamento_controlado',
    pr.alergia_medicamento AS 'alergia_medicamento', 
    pr.diabetes AS 'diabetes', pr.pressao_baixa AS 'pressao_baixa', 
    pr.pressao_alta AS 'pressao_alta', pr.asma AS 'asma', 
    pr.bronquite AS 'bronquite', pr.anemia AS 'anemia', 
    pr.ansiedade AS 'ansiedade', pr.depressao AS 'depressao', 
    pr.insonia AS 'insonia', pr.hemofilia AS 'hemofilia', 
    pr.tuberculose AS 'tuberculose', 
    pr.eplepsia AS 'eplepsia', 
    pr.desmaios AS 'desmaios', pr.fumante AS 'fumante', pr.outro AS 'outro', 
    pr.id_paciente AS 'id_paciente'
    FROM prontuarios AS pr
    INNER JOIN pacientes ON pr.id_paciente = pacientes.id
     WHERE pacientes.nome = :nome");
    $sql->bindValue(':nome', $nome);
    $sql->execute();
    if($sql->rowCount() > 0) {
        $lista = [];
        $data = $sql->fetch();
        $prontuario = new  Prontuario();
        $prontuario->setId($data['id']);
        $prontuario->setMatriculaPaciente($data['matricula_paciente']);
        $prontuario->setEsf($data['esf']);
        $prontuario->setPlanoSaude($data['plano_saude']);
        $prontuario->setNumeroCartaoSus($data['numero_cartao_sus']);
        $prontuario->setNomeMedicamentoAlergia($data['nome_medicamento_alergia']);
        $prontuario->setNomeMedicamentoControlado($data['nome_medicamento_controlado']);
        $prontuario->setMedicamentoControlado($data['medicamento_controlado']);
        $prontuario->setAlergiaMedicamento($data['alergia_medicamento']);
        $prontuario->setDiabetes($data['diabetes']);
        $prontuario->setPressaoBaixa($data['pressao_baixa']);
        $prontuario->setPressaoAlta($data['pressao_alta']);
        $prontuario->setAsma($data['asma']);
        $prontuario->setBronquite($data['bronquite']);
        $prontuario->setAnemia($data['anemia']);
        $prontuario->setAnsiedade($data['ansiedade']);
        $prontuario->setDepressao($data['depressao']);
        $prontuario->setInsonia($data['insonia']);
        $prontuario->setHemofilia($data['hemofilia']);
        $prontuario->setTuberculose($data['tuberculose']);
        $prontuario->setEplepsia($data['eplepsia']);
        $prontuario->setDesmaios($data['desmaios']);
        $prontuario->setFumante($data['fumante']);
        $prontuario->setOutro($data['outro']);
        $prontuario->setIdPaciente($data['id_paciente']);
        $lista[] = $prontuario;
        return $lista;

    } else {
        return[];
    }
}

public function findPaciente($id)
{
    $sql = $this->pdo->prepare("SELECT 
    pa.id AS 'id' FROM pacientes AS pa
    INNER JOIN prontuarios as pr ON pr.id_paciente = pa.id
     WHERE pr.id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    if($sql->rowCount() > 0) {
        $data = $sql->fetch();
        $prontuario = new  Paciente();
        $prontuario->setId($data['id']);
        return $data['id'];

    } else {
        return null;
    }
}

public function verificarDiabetes($diabetes): string
{
    if ($diabetes="S") {
        return "Diabetes";
    } else {
        return "";
    }
}

public function verificarPressaoBaixa($pressaoBaixa): string
{
    if ($pressaoBaixa="S") {
        return "Pressão Baixa";
    } else {
        return "";
    }
}

public function verificarPressaoAlta($pressaoAlta): string
{
    if ($pressaoAlta="S") {
        return "Pressão Alta";
    } else {
        return "";
    }
}

public function verificarBronquite($bronquite): string
{
    if ($bronquite="S") {
        return "Bronquite";
    } else {
        return "";
    }
}

public function verificarAnemia($anemia): string
{
    if ($anemia="S") {
        return "Anemia";
    } else {
        return "";
    }
}

public function verificarAnsiedade($ansiedade): string
{
    if ($ansiedade="S") {
        return "Ansiedade";
    } else {
        return "";
    }
}

public function verificarDepressao($depressao): string
{
    if ($depressao="S") {
        return "Depressão";
    } else {
        return "";
    }
}

public function verificarInsonia($insonia): string
{
    if ($insonia="S") {
        return "Insonia";
    } else {
        return "";
    }
}

public function verificarHemofilia($hemofilia): string
{
    if ($hemofilia="S") {
        return "Hemofilia";
    } else {
        return "";
    }
}

public function verificarTuberculose($tuberculose): string
{
    if ($tuberculose="S") {
        return "Tuberculose";
    } else {
        return "";
    }
}

public function verificarEplepsia($eplepsia): string
{
    if ($eplepsia="S") {
        return "Eplepsia";
    } else {
        return "";
    }
}

public function verificarDesmaios($desmaios): string
{
    if ($desmaios="S") {
        return "Desmaios";
    } else {
        return "";
    }
}

public function verificarFumante($fumante): string
{
    if ($fumante="S") {
        return "Fumante";
    } else {
        return "";
    }

}


public function verificarAsma($asma): string
{
    if ($asma="S") {
        return "Asma";
    } else {
        return "";
    }

}

public function verificarAlergiaMedicamento($alergiaMedicamento): string
{
    if ($alergiaMedicamento="S") {
        return "Alergia a Medicamento";
    } else {
        return "";
    }
}

public function verificarMedicamentoControlado($medicamento_controlado)
{
    if ($medicamento_controlado="S") {
        return "Medicamento Controlado";
    } else {
        return "";
    }
}
}