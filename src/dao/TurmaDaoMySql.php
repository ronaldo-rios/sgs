<?php 

namespace src\dao;

use src\models\Turma;
use src\interfaces\TurmaDaoInterface;

// Implementação do CRUD:
class TurmaDaoMySql implements TurmaDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Inserção de nova turma:
    public function inserirTurma(Turma $turma)
    {
        $sql = $this->pdo->prepare("INSERT INTO turmas (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $turma->getNome());
        $sql->execute();
        $turma->setId($this->pdo->lastInsertId());
        return $turma;
    }

    // Editar uma turma:
    public function atualizarTurma(Turma $turma)
    {
        $sql = $this->pdo->prepare("UPDATE turmas SET nome = :nome WHERE id = :id");
        $sql->bindValue(':nome', $turma->getNome());
        $sql->bindValue(':id', $turma->getId());
        $sql->execute();
        return $turma;
    }

    // Exclusão de turma:
    public function deletarTurma(Turma $turma)
    {
        $sql = $this->pdo->prepare("DELETE FROM turmas WHERE id = :id");
        $sql->bindValue(':id', $turma->getId());
        $sql->execute();
        return true;
    }

    // Buscar por ID:
    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM turmas WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $turma = new Turma();
            $turma->setId($data['id']);
            $turma->setNome($data['nome']);
            return $turma;
        } else {
            return false;
        }
    }

    // Buscar todos:
    public function findAll()
    {
        $sql = $this->pdo->prepare("SELECT * FROM turmas");
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();
            foreach($data as $item){
                $turma = new Turma();
                $turma->setId($item['id']);
                $turma->setNome($item['nome']);
                $lista[] = $turma;
            }
            return $lista;
        } else {
            return false;
        }
    }
}