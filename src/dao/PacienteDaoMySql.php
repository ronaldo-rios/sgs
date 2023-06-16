<?php 

namespace src\dao;

use src\models\Paciente;
use src\interfaces\CursoDaoInterface;

class PacienteDaoMySql
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
            paciente (nome, cpf, data_nascimento, telefone, email, endereco, comorbidade, profissao, foto) 
            VALUES 
            (:nome, :cpf, :data_nascimento, :telefone, :email, :endereco, :comorbidade, :profissao, :foto)"
            );
        $sql->bindValue(':nome', $paciente->getNome());
        $sql->bindValue(':cpf', $paciente->getCpf());
        $sql->bindValue(':data_nascimento', $paciente->getNascimento());
        $sql->bindValue(':telefone', $paciente->getTelefone());
        $sql->bindValue(':email', $paciente->getEmail());
        $sql->bindValue(':foto', $paciente->getFoto());
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
            cpf = :cpf, 
            data_nascimento = :data_nascimento, 
            telefone = :telefone, 
            email = :email, 
            endereco = :endereco, 
            comorbidade = :comorbidade, 
            profissao = :profissao, 
            foto = :foto 
            WHERE id = :id"
            );
        $sql->bindValue(':nome', $paciente->getNome());
        $sql->bindValue(':cpf', $paciente->getCpf());
        $sql->bindValue(':data_nascimento', $paciente->getNascimento());
        $sql->bindValue(':telefone', $paciente->getTelefone());
        $sql->bindValue(':email', $paciente->getEmail());
        $sql->bindValue(':endereco', $paciente->getEndereco());
        $sql->bindValue(':comorbidade', $paciente->getComorbidade());
        $sql->bindValue(':profissao', $paciente->getProfissao());
        $sql->bindValue(':foto', $paciente->getFoto());
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
            $paciente->setCpf($dados['cpf']);
            $paciente->setNascimento($dados['data_nascimento']);
            $paciente->setTelefone($dados['telefone']);
            $paciente->setEmail($dados['email']);
            $paciente->setEndereco($dados['endereco']);
            $paciente->setComorbidade($dados['comorbidade']);
            $paciente->setProfissao($dados['profissao']);
            $paciente->setFoto($dados['foto']);
            return $paciente;
        } else {
            throw new \Exception("Paciente não encontrado!");
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
                $paciente->setCpf($dado['cpf']);
                $paciente->setNascimento($dado['data_nascimento']);
                $paciente->setTelefone($dado['telefone']);
                $paciente->setEmail($dado['email']);
                $paciente->setEndereco($dado['endereco']);
                $paciente->setComorbidade($dado['comorbidade']);
                $paciente->setProfissao($dado['profissao']);
                $paciente->setFoto($dado['foto']);
                $arrayPacientes[] = $paciente;
            }
        }
        return $arrayPacientes;
    }
}