<?php 

namespace src\dao;

use src\config\Conexao;
use src\models\Usuario;
use src\interfaces\UsuarioDaoInterface;

class UsuarioDaoMySql implements UsuarioDaoInterface
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getDb();
    }
    
    // Método auxiliar para gerar um objeto de Usuario existente no banco de dados a partir de um array:
    private function gerarUsuario($array)
    {
        $usuario = new Usuario();
        $usuario->setId($array['id']);
        $usuario->setNome($array['nome']);
        $usuario->setCpf($array['cpf'] ?? null);
        $usuario->setSiap($array['siap'] ?? null);
        $usuario->setCrm($array['crm'] ?? null);
        $usuario->setPermissao($array['permissao']);
        $usuario->setEmail($array['email']);
        $usuario->setSenha($array['senha']);
        $usuario->setToken($array['token'] ?? null);
        return $usuario;
    }

    // procurar usuário por e-mail:
    public function findByEmail($email)
    {
        if(!empty($email)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch(\PDO::FETCH_ASSOC);
                $usuario = $this->gerarUsuario($dados);
                return $usuario;
            }
        }
    }

    // prourar usuário por token:
    public function findByToken($token)
    {
        if(!empty($token)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE token = :token");
            $sql->bindValue(':token', $token);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch(\PDO::FETCH_ASSOC);
                $usuario = $this->gerarUsuario($dados);
                return $usuario;
            }
        }
    }

    // procurar usuário por CPF:
    public function findByCpf($cpf)
    {
        if(!empty($cpf)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");
            $sql->bindValue(':cpf', $cpf);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch(\PDO::FETCH_ASSOC);
                $usuario = $this->gerarUsuario($dados);
                return $usuario;
            }
        }
    }

    // procurar usuário por SIAP:
    public function findBySiap($siap)
    {
        if(!empty($siap)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE siap = :siap");
            $sql->bindValue(':siap', $siap);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch(\PDO::FETCH_ASSOC);
                $usuario = $this->gerarUsuario($dados);
                return $usuario;
            }
        }
    }

    // procurar usuário por CRM:
    public function findByCrm($crm)
    {
        if(!empty($crm)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE crm = :crm");
            $sql->bindValue(':crm', $crm);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch(\PDO::FETCH_ASSOC);
                $usuario = $this->gerarUsuario($dados);
                return $usuario;
            }
        }
    }

    public function findById($id)
    {
        if(!empty($id)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch(\PDO::FETCH_ASSOC);
                $usuario = $this->gerarUsuario($dados);
                return $usuario;
            }
        }
    }

    // procurar todos os usuários:
    public function findAll()
    {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
            foreach($dados as $item){
                $array[] = $this->gerarUsuario($item);
            }
        }
        return $array;
    }

    // adicionar novo usuário
    public function inserirUsuario(Usuario $u)
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO usuarios 
            (nome, cpf, siap, crm, permissao, email, senha, token) 
            VALUES 
            (:nome, :cpf, :siap, :crm, :permissao, :email, :senha, :token)"
            );

        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':cpf', $u->getCpf());
        $sql->bindValue(':siap', $u->getSiap());
        $sql->bindValue(':crm', $u->getCrm());
        $sql->bindValue(':permissao', $u->getPermissao());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':senha', password_hash($u->getSenha(), PASSWORD_BCRYPT));
        $sql->bindValue(':token', $u->getToken());
        $sql->execute();
        $u->setId($this->pdo->lastInsertId());
        return $u;
    }

    // atualizar usuário:
    public function atualizarUsuario(Usuario $u)
    {
        $sql = $this->pdo->prepare(
            "UPDATE usuarios SET 
            nome = :nome, 
            cpf = :cpf, 
            siap = :siap, 
            crm = :crm, 
            permissao = :permissao, 
            email = :email, 
            senha = :senha, 
            token = :token 
            WHERE id = :id"
            );

        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':cpf', $u->getCpf());
        $sql->bindValue(':siap', $u->getSiap());
        $sql->bindValue(':crm', $u->getCrm());
        $sql->bindValue(':permissao', $u->getPermissao());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':senha', password_hash($u->getSenha(), PASSWORD_BCRYPT));
        $sql->bindValue(':token', $u->getToken());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();
        return true;
    }

    // remover usuário:
    public function deletarUsuario(Usuario $u)
    {
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $u->getId());
        $sql->execute();
        return true;
    }
}