<?php 

namespace src\dao;

use src\config\Config;
use src\models\Turma;
use src\interfaces\TurmaInterface;

// Implementação do CRUD:
class TurmaDaoMySql implements TurmaInterface
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Config::getDb();
    }
//função para cadastrar turma
    public function add(Turma $turma)
    {
        $sql = $this->pdo->prepare("INSERT INTO turma (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $turma->getNome());
        $sql->execute();
        return $turma;
    }
}