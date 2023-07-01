<?php 

namespace src\dao;

use src\models\Paciente;
use src\interfaces\PacienteDaoInterface;

class PacienteDaoMySql implements PacienteDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Adicionar novo paciente:
    public function adicionarPaciente(Paciente $paciente): Paciente
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO 
            paciente (nome, matricula, foto, email, data_nascimento, telefone, id_usuario) 
            VALUES 
            (:nome, :matricula, :foto, :email, :data_nascimento, :telefone, :id_usuario)"
            );
        $sql->bindValue(':nome', $paciente->getNome());
        $sql->bindValue(':matricula', $paciente->getMatricula());
        $sql->bindValue(':foto', $paciente->getFoto());
        $sql->bindValue(':email', $paciente->getEmail());
        $sql->bindValue(':data_nascimento', $paciente->getNascimento());
        $sql->bindValue(':telefone', $paciente->getTelefone());
        $sql->bindValue(':id_usuario', $paciente->getIdUsuario());
        $sql->execute();
        $paciente->setId($this->pdo->lastInsertId());
        return $paciente;
    }

    // Editar um paciente:
    public function atualizarPaciente(Paciente $paciente): Paciente
    {
        $sql = $this->pdo->prepare(
            "UPDATE paciente SET 
            nome = :nome, 
            matricula = :matricula,
            foto = :foto,
            email = :email,
            data_nascimento = :data_nascimento,
            telefone = :telefone,
            id_usuario = :id_usuario
            WHERE id = :id"
        );
        $sql->bindValue(':nome', $paciente->getNome());
        $sql->bindValue(':matricula', $paciente->getMatricula());
        $sql->bindValue(':foto', $paciente->getFoto());
        $sql->bindValue(':email', $paciente->getEmail());
        $sql->bindValue(':data_nascimento', $paciente->getNascimento());
        $sql->bindValue(':telefone', $paciente->getTelefone());
        $sql->bindValue(':id_usuario', $paciente->getIdUsuario());
        $sql->bindValue(':id', $paciente->getId());
        $sql->execute();
        return $paciente;
          
    }

    // Exclusão de paciente:
    public function deletarPaciente(Paciente $paciente): bool
    {
        $sql = $this->pdo->prepare("DELETE FROM paciente WHERE id = :id");
        $sql->bindValue(':id', $paciente->getId());
        $sql->execute();
        return true;
    }

    // Buscar por ID:
    public function findById(int $id): Paciente
    {
        $sql = $this->pdo->prepare("SELECT * FROM paciente WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $dados = $sql->fetch(\PDO::FETCH_ASSOC);
            $paciente = new Paciente();
            $paciente->setId($dados['id']);
            $paciente->setNome($dados['nome']);
            $paciente->setMatricula($dados['matricula']);
            $paciente->setFoto($dados['foto']);
            $paciente->setEmail($dados['email']);
            $paciente->setNascimento($dados['data_nascimento']);
            $paciente->setTelefone($dados['telefone']);
            $paciente->setIdUsuario($dados['id_usuario']);

            return $paciente;
        } else {
            echo "Paciente não encontrado!";
        }
    }

    // Buscar todos os pacientes:
    public function findAll(): array
    {
        $arrayPacientes = [];

        $sql = $this->pdo->query("SELECT * FROM paciente");
        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
            foreach($dados as $dado){
                $paciente = new Paciente();
                $paciente->setId($dado['id']);
                $paciente->setNome($dado['nome']);
                $paciente->setMatricula($dado['matricula']);
                $paciente->setFoto($dado['foto']);
                $paciente->setEmail($dado['email']);
                $paciente->setNascimento($dado['data_nascimento']);
                $paciente->setTelefone($dado['telefone']);
                $paciente->setIdUsuario($dado['id_usuario']);
                $arrayPacientes[] = $paciente;
            }
            return $arrayPacientes;
        }else {
            echo "Não há pacientes cadastrados!";
        }
        
    }
}