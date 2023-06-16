<?php 

namespace src\dao;

use src\models\Vacina;
use src\interfaces\VacinaDaoInterface;

// Implementação do CRUD:
class VacinaDaoMySql implements VacinaDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Adicionar nova vacina:
    public function adicionarVacina(Vacina $vacina): Vacina
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO vacinas (nome_vacina) VALUES (:nome)");
        $sql->bindValue(':nome', $vacina->getNome());
        $sql->execute();

        $vacina->setId($this->pdo->lastInsertId());
        return $vacina;
    }

    // Listar todas as vacinas:
    public function findAllVacinas(): array
    {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM vacinas");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach ($data as $item) {
                $vacina = new Vacina();
                $vacina->setId($item['id']);
                $vacina->setNome($item['nome_vacina']);

                $array[] = $vacina;
            }
            return $array;
        }else {
            return [];
        }
        
    }

    // Buscar vacina pelo ID:
    public function findVacinaById(int $id): Vacina
    {
        $sql = $this->pdo->prepare("SELECT * FROM vacinas WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $vacina = new Vacina();
            $vacina->setId($data['id']);
            $vacina->setNome($data['nome_vacina']);

            return $vacina;
        } else {
            echo "Vacina não encontrada!";
        }
    }

    // Editar vacina:
    public function editarVacina(Vacina $vacina): Vacina
    {
        $sql = $this->pdo->prepare(
            "UPDATE vacinas SET nome_vacina = :nome WHERE id = :id");
        $sql->bindValue(':nome', $vacina->getNome());
        $sql->bindValue(':id', $vacina->getId());
        $sql->execute();

        return $vacina;
    }

    // Remover vacina:
    public function removerVacina(Vacina $vacina): void
    {
        $sql = $this->pdo->prepare("DELETE FROM vacinas WHERE id = :id");
        $sql->bindValue(':id', $vacina->getId());
        $sql->execute();
    }
}