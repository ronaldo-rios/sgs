<?php

namespace src\interfaces;

use src\models\Paciente;

interface PacienteDaoInterface
{
    public function findById($id);
    public function findCurso($id);
    public function findTurma($id);
    public function findAll();
    public function inserirPaciente(Paciente $paciente);
    public function atualizarPaciente(Paciente $paciente);
    public function deletarPaciente(Paciente $paciente);


}