<?php 

namespace src\dao;

use src\models\PacienteVacina;
use src\interfaces\PacienteVacinaDaoInterface;

// Implementação do CRUD:
class PacienteVacinaDaoMySql implements PacienteVacinaDaoInterface
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Adicionar nova vacina:
    public function adicionarPacienteVacina(PacienteVacina $pacienteVacina): PacienteVacina
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO 
            paciente_vacina (id_paciente, id_vacina, data, dose) 
            VALUES 
            (:id_paciente, :id_vacina, :data_vacinacao, :dose)"
            );
        $sql->bindValue(':id_paciente', $pacienteVacina->getIdPaciente());
        $sql->bindValue(':id_vacina', $pacienteVacina->getIdVacina());
        $sql->bindValue(':data_vacinacao', $pacienteVacina->getData());
        $sql->bindValue(':dose', $pacienteVacina->getDose());
        $sql->execute();
        return $pacienteVacina;
    }
}