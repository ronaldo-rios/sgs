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
    public function inserirCurso(Curso $curso): Curso
    {
        $sql = $this->pdo->prepare("INSERT INTO cursos (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $curso->getNome());
        $sql->execute();
        $curso->setId($this->pdo->lastInsertId());
        return $curso;
    }

    // Editar um curso:
    public function atualizarCurso(Curso $curso): Curso
    {
        $sql = $this->pdo->prepare("UPDATE cursos SET nome = :nome WHERE id = :id");
        $sql->bindValue(':nome', $curso->getNome());
        $sql->bindValue(':id', $curso->getId());
        $sql->execute();
        return $curso;
    }

    // Exclusão de curso:
    public function deletarCurso(Curso $curso): bool
    {
        $sql = $this->pdo->prepare("DELETE FROM cursos WHERE id = :id");
        $sql->bindValue(':id', $curso->getId());
        $sql->execute();
        return true;
    }

    // Buscar por ID:
    public function findById(int $id): Curso
    {
        $sql = $this->pdo->prepare("SELECT * FROM cursos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $dados = $sql->fetch(\PDO::FETCH_ASSOC);
            $curso = new Curso();
            $curso->setId($dados['id']);
            $curso->setNome($dados['nome']);
            return $curso;
        } else {
            echo "Curso não encontrado!";
        }
    }

    // Buscar todos os cursos:
    public function findAll(): array
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
}

