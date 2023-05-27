<?php 

namespace src\dao;

use src\models\Usuario;
use src\interfaces\UsuarioDaoInterface;

class UsuarioDaoMySql implements UsuarioDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
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
        throw new \Exception("E-mail não cadastrado!");
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
        }else {
            return false;
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
        $sql->bindValue(':senha', $u->getSenha());
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

    public function emailExists($email)
    {
        if(!empty($email)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();
            if($sql->rowCount() > 0){
                return true;
            }
        }
        return false;
    }

}