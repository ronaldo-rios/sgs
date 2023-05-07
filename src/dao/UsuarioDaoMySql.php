<?php 

namespace src\dao;

use src\config\Config;
use src\models\Usuario;
use src\interfaces\UsuarioInterface;

// Implementação do CRUD:
class UsuarioDaoMySql implements UsuarioInterface
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Config::getDb();
    }

    public function add(Usuario $u)
    {
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $u->getNome());
        $sql->execute();
        return $u;
    }
}