<?php

namespace src\dao;

use src\models\PacienteVacina;
use src\models\Paciente;
use src\models\Vacina;
use src\interfaces\PacienteVacinaDaoInterface;

class PacienteVacinaDaoMySql implements PacienteVacinaDaoInterface
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Inserção de nova vacinação:
    public function adicionarPacienteVacina(PacienteVacina $pacienteVacina)
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO pacientes_vacinas (id_paciente, id_vacina, data_vacina, dose) 
                VALUES (:id_paciente, :id_vacina, :data_vacina, :dose)"
            );
        $sql->bindValue(':id_paciente', $pacienteVacina->getIdPaciente());
        $sql->bindValue(':id_vacina',   $pacienteVacina->getIdVacina());
        $sql->bindValue(':data_vacina', $pacienteVacina->getData());
        $sql->bindValue(':dose',        $pacienteVacina->getDose() ?? null);
        $sql->execute();
    }

    // Editar uma vacinação:
    public function editarPacienteVacina(PacienteVacina $pvacina)
    {
        $sql = $this->pdo->prepare("UPDATE paciente_vacinas SET
         id_paciente = :id_paciente, id_vacina = :id_vacina, data = :data, dose = :dose
          WHERE id = :id");
        $sql->bindValue(':id_paciente', $pvacina->getIdPaciente());
        $sql->bindValue(':id_vacina', $pvacina->getIdVacina());
        $sql->bindValue(':data', $pvacina->getData());
        $sql->bindValue(':dose', $pvacina->getDose());
        $sql->execute();
        return $pvacina;
    }

    // Deletar uma vacinação:
    public function removerPacienteVacina(int $idPaciente, int $idVacina)
    {
        $sql = $this->pdo->prepare(
            "DELETE FROM paciente_vacinas 
                WHERE id_paciente = :id_paciente 
                AND id_vacina = :id_vacina"
                );
        $sql->bindValue(':id_paciente', $idPaciente);
        $sql->bindValue(':id_vacina', $idVacina);
        $sql->execute();
    }

    // Listar todas as vacinações:
    public function findAll()
    {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM paciente_vacinas");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach ($data as $item) {
                $pacienteVacina = new PacienteVacina();
                $pacienteVacina->setIdPaciente($item['id_paciente']);
                $pacienteVacina->setIdVacina($item['id_vacina']);
                $pacienteVacina->setData($item['data']);
                $pacienteVacina->setDose($item['dose']);
                $array[] = $pacienteVacina;
            }
        }
        return $array;
    }

    // Buscar uma vacinação pelo id do paciente:
    public function buscarPacienteVacinaPorIdPaciente(int $idPaciente)
    {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM paciente_vacinas WHERE id_paciente = :id_paciente");
        $sql->bindValue(':id_paciente', $idPaciente);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach ($data as $item) {
                $pacienteVacina = new PacienteVacina();
                $pacienteVacina->setIdPaciente($item['id_paciente']);
                $pacienteVacina->setIdVacina($item['id_vacina']);
                $pacienteVacina->setData($item['data']);
                $pacienteVacina->setDose($item['dose']);
                $array[] = $pacienteVacina;
            }
        }
        return $array;
    }

    // Buscar uma vacinação pelo id da vacina:
    public function buscarPacienteVacinaPorIdVacina(int $idVacina)
    {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM paciente_vacinas WHERE id_vacina = :id_vacina");
        $sql->bindValue(':id_vacina', $idVacina);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach ($data as $item) {
                $pacienteVacina = new PacienteVacina();
                $pacienteVacina->setIdPaciente($item['id_paciente']);
                $pacienteVacina->setIdVacina($item['id_vacina']);
                $pacienteVacina->setData($item['data']);
                $pacienteVacina->setDose($item['dose']);
                $array[] = $pacienteVacina;
            }
        }
        return $array;
    }
}