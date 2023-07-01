<?php 

namespace src\dao;

use src\models\Curso;
use src\interfaces\CursoDaoInterface;

class CursoDaoMySql implements CursoDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Inserção de novo curso:
    public function inserirCurso(Curso $curso)
    {
        $sql = $this->pdo->prepare("INSERT INTO cursos (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $curso->getNome());
        $sql->execute();
        $curso->setId($this->pdo->lastInsertId());
        return $curso;
    }

    // Editar um curso:
    public function atualizarCurso(Curso $curso)
    {
        $sql = $this->pdo->prepare("UPDATE cursos SET nome = :nome WHERE id = :id");
        print_r($sql->bindValue(':nome', $curso->getNome()));
        $sql->bindValue(':id', $curso->getId());
        $sql->execute();
        return $curso;
    }

    // Exclusão de curso:
    public function deletarCurso(Curso $curso)
    {
        $sql = $this->pdo->prepare("DELETE FROM cursos WHERE id = :id");
        $sql->bindValue(':id', $curso->getId());
        
        $sql->execute();
        return true;
    }

    // Buscar por id retonando o nome:
    public function findCurso($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM cursos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $curso = new Curso();
            $curso->setId($data['id']);
            $curso->setNome($data['nome']);
            $lista[] = $curso;
            return $data['nome'];
        } else {
          return null;
        }
    }


    // Buscar por nome:
    public function findByName($nome)
    {
        $sql = $this->pdo->prepare("SELECT * FROM cursos WHERE nome = :nome");
        $sql->bindValue(':nome', $nome);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $curso = new Curso();
            $curso->setId($data['id']);
            $curso->setNome($data['nome']);
            $lista[] = $curso;
            return $lista;
        } else {
          return [];
        }
    }

    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM cursos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $curso= new Curso();
            $curso->setId($data['id']);
            $curso->setNome($data['nome']);
            return $curso;
        } else {
            return [];
        }
   
    }

    // Buscar todos os cursos:
    public function findAll()
    {
        $arrayCursos = [];

        $sql = $this->pdo->query("SELECT * FROM cursos");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();

            foreach($data as $item){
                $curso = new Curso();
                $curso->setId($item['id']);
                $curso->setNome($item['nome']);

                $arrayCursos[] = $curso;
            }
        }
        return $arrayCursos;
    }

 //Curso existe 
 public function nameExists($nome)
 {
     if(!empty($nome)){
         $sql = $this->pdo->prepare("SELECT * FROM cursos WHERE nome = :nome");
         $sql->bindValue(':nome', $nome);
         $sql->execute();
         if($sql->rowCount() > 0){
             return true;
         }
     }
     return false;
 }
}

