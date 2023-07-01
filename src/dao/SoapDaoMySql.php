<?php 

namespace src\dao;

use src\models\Soap;
use src\interfaces\SoapDaoInterface;



class SoapDaoMySql implements SoapDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Inserção de novo soap:
    public function inserirSoap(Soap $soap)
    {
        $sql = $this->pdo->prepare("INSERT INTO soap 
        (data,subjetivo,objetivo,avaliacao,plano,id_prontuario)
         VALUES (:data, :subjetivo,:objetivo, :avaliacao, :plano,:id_prontuario)");
        $sql->bindValue(':data', $soap->getData());
        $sql->bindValue(':subjetivo', $soap->getSubjetivo());
        $sql->bindValue(':objetivo', $soap->getObjetivo());
        $sql->bindValue(':avaliacao', $soap->getAvaliacao());
        $sql->bindValue(':plano', $soap->getPlano());
        $sql->bindValue(':id_prontuario', $soap->getIdProntuario());
        $sql->execute();
        $soap->setId($this->pdo->lastInsertId());
        return $soap;
    }

    // Editar um soap:
    public function atualizarSoap(Soap $soap)
    {
        $sql = $this->pdo->prepare("UPDATE soap SET
         data = :data, 
         subjetivo = :subjetivo,
         objetivo = :objetivo,  
         avaliacao = :avaliacao, 
         plano = :plano, 
         id_prontuario = :id_prontuario
         WHERE id = :id");
        $sql->bindValue(':data', $soap->getData());
        $sql->bindValue(':subjetivo', $soap->getSubjetivo());
        $sql->bindValue(':objetivo', $soap->getObjetivo());
        $sql->bindValue(':avaliacao', $soap->getAvaliacao());
        $sql->bindValue(':plano', $soap->getPlano());
        $sql->bindValue(':id_prontuario', $soap->getIdProntuario());
        $sql->bindValue(':id', $soap->getId());
        $sql->execute();
        return $soap;
    }

    // Exclusão de soap:
    public function deletarSoap(Soap $soap)
    {
        $sql = $this->pdo->prepare("DELETE FROM soap WHERE id = :id");
        $sql->bindValue(':id', $soap->getId());
        $sql->execute();
        return true;
    }



 // Buscar por ID:
 public function findById($id)
 {
     $sql = $this->pdo->prepare("SELECT * FROM soap WHERE id = :id");
     $sql->bindValue(':id', $id);
     $sql->execute();
     if($sql->rowCount() > 0) {
         $data = $sql->fetch();
         $soap= new Soap();
         $soap->setData($data['data']);
         $soap->setSubjetivo($data['subjetivo']);
         $soap->setObjetivo($data['objetivo']);
         $soap->setAvaliacao($data['avaliacao']);
         $soap->setPlano($data['plano']);
         $soap->setIdProntuario($data['id_prontuario']);
         return $soap;
     } else {
         return [];
     }

 }
    // Buscar todos:
    public function findAll()
    {
        $arraysoap = [];

        $sql = $this->pdo->query("SELECT * FROM soap");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $soap = new Soap();
                $soap->setId($item['id']);
                $soap->setData($item['data']);
                $soap->setObjetivo($item['objetivo']);
                $soap->setSubjetivo($item['subjetivo']);
                $soap->setAvaliacao($item['avaliacao']);
                $soap->setPlano($item['plano']);
                $arraysoap[] = $soap;
            }
        }
        return $arraysoap;
    }

    public function findPaciente($id)
    {
        $sql = $this->pdo->prepare(
            "SELECT s.id AS 'id', s.data AS 'data', s.subjetivo AS 'subjetivo', 
            s.objetivo AS 'objetivo', s.avaliacao AS 'avaliacao', s.plano AS 'plano',
            s.id_prontuario AS 'id_prontuario'
            FROM soap AS s
            INNER JOIN prontuarios AS pr ON s.id_prontuario = pr.id
            INNER JOIN pacientes AS pa ON pr.id_paciente = pa.id
            WHERE pa.id = :id"
        );
        $sql->bindValue(':id', $id);
        $sql->execute();
        $data = $sql->fetchAll();
    
        $lista = array();
        foreach ($data as $row) {
            $soap = new Soap();
            $soap->setId($row['id']);
            $soap->setData($row['data']);
            $soap->setSubjetivo($row['subjetivo']);
            $soap->setObjetivo($row['objetivo']);
            $soap->setPlano($row['plano']);
            $soap->setAvaliacao($row['avaliacao']);
            $lista[] = $soap;
        }
    
        return $lista;
    }
    



    
}  



