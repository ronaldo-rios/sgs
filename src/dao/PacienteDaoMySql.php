<?php 

namespace src\dao;

use src\models\Paciente;
use src\interfaces\PacienteDaoInterface;
use src\models\Curso;
use src\interfaces\CursoDaoInterface;
use src\models\Turma;
use src\models\TurmaDaoInterface;

class PacienteDaoMySql implements PacienteDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Inserção de novo paciente:
    public function inserirPaciente(Paciente $paciente)
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO pacientes
            (matricula, nome, email, nascimento, telefone, endereco, foto, id_turma, id_curso) 
            VALUES 
            (:matricula,:nome, :email, :nascimento, :telefone, :endereco,:foto, :id_turma, :id_curso)"
            );
            $sql->bindValue(':matricula', $paciente->getMatricula());
            $sql->bindValue(':nome', $paciente->getNome());
            $sql->bindValue(':email', $paciente->getEmail());
            $sql->bindValue(':nascimento', $paciente->getNascimento());
            $sql->bindValue(':telefone', $paciente->getTelefone());
            $sql->bindValue(':endereco', $paciente->getEndereco());
            $sql->bindValue(':foto', $paciente->getFoto());
            $sql->bindValue(':id_turma', $paciente->getIdTurma());
            $sql->bindValue(':id_curso', $paciente->getIdCurso());
            $sql->execute();
            $paciente->setId($this->pdo->lastInsertId());
            return $paciente;
    }

    // Editar um paciente:
    public function atualizarPaciente(Paciente $paciente)
    {
        $sql = $this->pdo->prepare(
            "UPDATE pacientes SET 
            matricula = :matricula, 
            nome = :nome, 
            email = :email, 
            nascimento = :nascimento, 
            telefone = :telefone, 
            endereco = :endereco, 
            foto = :foto,
            id_turma = :id_turma, 
            id_curso = :id_curso
            WHERE id = :id"
            );
        
        $sql->bindValue(':matricula', $paciente->getMatricula());
        $sql->bindValue(':nome', $paciente->getNome());
        $sql->bindValue(':email', $paciente->getEmail());
        $sql->bindValue(':nascimento', $paciente->getNascimento());
        $sql->bindValue(':telefone', $paciente->getTelefone());
        $sql->bindValue(':endereco', $paciente->getEndereco());
        $sql->bindValue(':foto', $paciente->getFoto());
        $sql->bindValue(':id_turma', $paciente->getIdTurma());
        $sql->bindValue(':id_curso', $paciente->getIdCurso());
        $sql->bindValue(':id', $paciente->getId());
        $sql->execute();
        return $paciente;
    }

    // Exclusão de paciente:
    public function deletarPaciente(Paciente $paciente)
    {
        $sql = $this->pdo->prepare("DELETE FROM pacientes WHERE id = :id");
        $sql->bindValue(':id', $paciente->getId());
        $sql->execute();
        return true;
    }

    // Buscar por ID:
    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM pacientes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $paciente = new Paciente();
            $paciente->setId($data['id']);
            $paciente->setNome($data['nome']);
            $paciente->setEmail($data['email']);
            $paciente->setNascimento($data['nascimento']);
            $paciente->setTelefone($data['telefone']);
            $paciente->setEndereco($data['endereco']);
            $paciente->setFoto($data['foto']);
            $paciente->setIdTurma($data['id_turma']);
            $paciente->setIdCurso($data['id_curso']);
            $paciente->setMatricula($data['matricula']);

            return $paciente;
        } else {
            return false;
        }
    }

     // Buscar a matricula pelo ID:
     public function findMatricula($id)
     {
         $sql = $this->pdo->prepare("SELECT * FROM pacientes WHERE id = :id");
         $sql->bindValue(':id', $id);
         $sql->execute();
         if($sql->rowCount() > 0){
             $data = $sql->fetch();
             $paciente = new Paciente();
             $paciente->setId($data['id']);
             $paciente->setNome($data['nome']);
             $paciente->setEmail($data['email']);
             $paciente->setNascimento($data['nascimento']);
             $paciente->setTelefone($data['telefone']);
             $paciente->setEndereco($data['endereco']);
             $paciente->setFoto($data['foto']);
             $paciente->setIdTurma($data['id_turma']);
             $paciente->setIdCurso($data['id_curso']);
             $paciente->setMatricula($data['matricula']);
 
             return $data['matricula'];
         } else {
             return false;
         }
     }
    
    // Buscar nome curso por ID:
    public function findCurso($id)
    {
        $sql = $this->pdo->prepare(
            "SELECT * FROM pacientes
            INNER JOIN cursos ON pacientes.id_curso = cursos.id
            WHERE pacientes.id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $curso = new Curso();
            $curso->setId($data['id']);
            $curso->setNome($data['nome']);
            return $curso;
        } else {
            echo"Curso não encontrado";
        }
    }

 // Buscar nome curso por ID:
    public function findTurma($id)
    {
        $sql = $this->pdo->prepare(
            "SELECT * FROM turmas
            INNER JOIN pacientes ON pacientes.id_turma = turmas.id
            WHERE turmas.id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $lista = [];
        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $turma = new Turma();
            $turma->setId($data['id']);
            $turma->setNome($data['nome']);
            $lista[] = $turma;
            return $turma;
        } else {
            echo "Turma não encontrada";
        }
    }
    // Buscar todos os pacientes:
    public function findAll()
    {
        $arrayPacientes = [];

        $sql = $this->pdo->query("SELECT * FROM pacientes");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();

            foreach($data as $item){
                $paciente = new Paciente();
                $paciente->setId($item['id']);
                $paciente->setMatricula($item['matricula']);
                $paciente->setNome($item['nome']);
                $paciente->setEmail($item['email']);
                $paciente->setNascimento($item['nascimento']);
                $paciente->setTelefone($item['telefone']);
                $paciente->setEndereco($item['endereco']);
                $paciente->setFoto($item['foto']);
                $paciente->setIdTurma($item['id_turma']);
                $paciente->setIdCurso($item['id_curso']);


                $arrayPacientes[] = $paciente;
            }
        }
        return $arrayPacientes;
    }
    
// Buscar por nome:
    public function findByName($nome)
    {
        $sql = $this->pdo->prepare("SELECT * FROM pacientes WHERE nome LIKE :nome");
        $sql->bindValue(':nome', '%' . $nome . '%');
        $sql->execute();
        if($sql->rowCount() > 0){
            $item = $sql->fetch();
            $paciente = new Paciente();
            $paciente->setId($item['id']);
            $paciente->setMatricula($item['matricula']);
            $paciente->setNome($item['nome']);
            $paciente->setEmail($item['email']);
            $paciente->setNascimento($item['nascimento']);
            $paciente->setTelefone($item['telefone']);
            $paciente->setEndereco($item['endereco']);
            $paciente->setFoto($item['foto']);
            $paciente->setIdTurma($item['id_turma']);
            $paciente->setIdCurso($item['id_curso']);
            $lista[] = $paciente;
            return $lista;
        } else {
          return [];
        }
    }

  

 //Verificando se paciente existe 
 public function matriculaExists($matricula)
 {
     if(!empty($nome)){
         $sql = $this->pdo->prepare("SELECT * FROM pacientes WHERE matricula = :matricula");
         $sql->bindValue(':matricula', $matricula);
         $sql->execute();
         if($sql->rowCount() > 0){
             return true;
         }
     }
     return false;
 }


}

