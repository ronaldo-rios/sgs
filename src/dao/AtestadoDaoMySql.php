<?php 

namespace src\dao;

use src\models\Atestado;
use src\models\Paciente;
use src\interfaces\AtestadoDaoInterface;

class AtestadoDaoMySql implements AtestadoDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Inserção de novo atestado:
    public function adicionarAtestado(Atestado $atestado)
    {
        $sql = $this->pdo->prepare("INSERT INTO atestados
        (data_cadastrada,data_inicio,data_final,motivo,descricao,atestado_doc,id_paciente,id_usuario)
        VALUES (:data_cadastrada,
                :data_inicio,:data_final,:motivo,:descricao,
                :atestado_doc,:id_paciente,:id_usuario)"
            );
        $sql->bindValue(':data_cadastrada', $atestado->getDataCadastrada());
        $sql->bindValue(':data_inicio', $atestado->getDataInicio());
        $sql->bindValue(':data_final', $atestado->getDataFinal());
        $sql->bindValue(':motivo', $atestado->getMotivo());
        $sql->bindValue(':descricao', $atestado->getDescricao());
        $sql->bindValue(':atestado_doc',$atestado->getAtestadoDoc());
        $sql->bindValue(':id_paciente',$atestado->getIdPaciente());
        $sql->bindValue(':id_usuario',$atestado->getIdUsuario());
        $sql->execute();
        $atestado->setId($this->pdo->lastInsertId());
        return $atestado;
    }

    // Editar um atestado:
    public function atualizarAtestado(Atestado $atestado)
    {
        $sql = $this->pdo->prepare("UPDATE atestados SET
         data_cadastrada = :data_cadastrada, data_inicio = :data_inicio, data_final = :data_final, 
         motivo = :motivo, descricao = :descricao, atestado_doc = :atestado_doc,
          id_paciente = :id_paciente, id_usuario = :id_usuario
          WHERE id = :id");
        $sql->bindValue(':data_cadastrada', $atestado->getDataCadastrada());
        $sql->bindValue(':data_inicio', $atestado->getDataInicio());
        $sql->bindValue(':data_final', $atestado->getDataFinal());
        $sql->bindValue(':motivo', $atestado->getMotivo());
        $sql->bindValue(':descricao', $atestado->getDescricao());
        $sql->bindValue(':atestado_doc',$atestado->getAtestadoDoc());
        $sql->bindValue(':id_paciente',$atestado->getIdPaciente());
        $sql->bindValue(':id_usuario',$atestado->getIdUsuario());
        $sql->bindValue(':id', $atestado->getId());
        $sql->execute();
        return $atestado;
    }

    // Exclusão de atestado:
    public function deletarAtestado(Atestado $atestado)
    {
        $sql = $this->pdo->prepare("DELETE FROM atestados WHERE id = :id");
        $sql->bindValue(':id', $atestado->getId());
        
        $sql->execute();
        return true;
    }

    // Buscar por id 
    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM atestados WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $atestado = new Atestado();
            $atestado->setId($data['id']);
            $atestado->setDataCadastrada($data['data_cadastrada']);
            $atestado->setDataInicio($data['data_inicio']);
            $atestado->setDataFinal($data['data_final']);
            $atestado->setMotivo($data['motivo']);
            $atestado->setDescricao($data['descricao']);
            $atestado->setAtestadoDoc($data['atestado_doc']);
            $atestado->setIdPaciente($data['id_paciente']);
            $atestado->setIdUsuario($data['id_usuario']);
            return $atestado;
        } else {
          return null;
        }
    }

    // Buscar todos os atestados:
    public function findAll()
    {
        $arrayAtestados = [];

        $sql = $this->pdo->query("SELECT * FROM atestados");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();

            foreach($data as $data){
                $atestado = new Atestado();
                $atestado->setId($data['id']);
                $atestado->setDataCadastrada($data['data_cadastrada']);
                $atestado->setDataInicio($data['data_inicio']);
                $atestado->setDataFinal($data['data_final']);
                $atestado->setMotivo($data['motivo']);
                $atestado->setDescricao($data['descricao']);
                $atestado->setAtestadoDoc($data['atestado_doc']);
                $atestado->setIdPaciente($data['id_paciente']);
                $atestado->setIdUsuario($data['id_usuario']);
                

                $arrayAtestados[] = $atestado;
            }
        }
        return $arrayAtestados;
    }
//Buscando por nome do paciente
public function findPaciente($id){
    $sql = $this->pdo->prepare("SELECT 
    a.id AS 'id', a.data_cadastrada AS 'data_cadastrada', a.data_inicio AS 'data_inicio',
    a.data_final AS 'data_final', a.motivo AS 'motivo', a.descricao AS 'descricao',
    a.atestado_doc AS 'atestado_doc', a.id_paciente AS 'id_paciente', a.id_usuario AS 'id_usuario'
    FROM pacientes AS p 
    INNER JOIN atestados AS a ON a.id_paciente = p.id
    WHERE p.id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    if($sql->rowCount() > 0) {
        $data = $sql->fetch();
        $paciente = new  Paciente();
        $paciente->setId($data['id']);
        $paciente->setMatricula($data['matricula']);
        $paciente->setNome($data['nome']);
        $paciente->setEmail($data['email']);
        $paciente->setNascimento($data['nascimento']);
        $paciente->setTelefone($data['telefone']);
        $paciente->setEndereco($data['endereco']);
        $paciente->setFoto($data['foto']);
        $paciente->setIdTurma($data['id_turma']);
        $paciente->setIdCurso($data['id_curso']);
        $lista[] = $paciente;
        return $data['nome'];

    } else {
        return null;
    }
}  

}

