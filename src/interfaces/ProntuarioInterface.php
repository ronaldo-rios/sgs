<?php

namespace src\interfaces;

use src\models\Prontuario;

interface ProntuarioInterface
{
    public function criarProntuario(Prontuario $prontuario);
    public function findAll();
    public function verificarAlergiaMedicamento($alergia_medicamento);
    public function verificarMedicamentoControlado($medicamento_controlado);
    public function verificarDiabetes($diabetes);
    public function verificarPressaoAlta($pressao_alta);
    public function verificarPressaoBaixa($pressao_baixa);
    public function verificarAsma($asma);
    public function verificarBronquite($bronquite);
    public function verificarAnemia($anemia);
    public function verificarAnsiedade($ansiedade);
    public function verificarDepressao($depressao);
    public function verificarInsonia($insonia);
    public function verificarHemofilia($hemofilia);
    public function verificarTuberculose($tuberculose);
    public function verificarEplepsia($eplepsia);
    public function verificarDesmaios($desmaios);
    public function verificarFumante($fumante);
    public function atualizarProntuario(Prontuario $prontuario);  
    public function findPaciente($id);  
    
}