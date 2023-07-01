<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '../../conexao.php';
use src\dao\PacienteDaoMySql;

$pacienteDao = new PacienteDaoMySql($pdo);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$nascimento = filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_SPECIAL_CHARS);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
$foto = filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_SPECIAL_CHARS);
$id_curso = filter_input(INPUT_POST, 'id_curso', FILTER_SANITIZE_SPECIAL_CHARS);
$id_turma= filter_input(INPUT_POST, 'id_turma', FILTER_SANITIZE_SPECIAL_CHARS);


if ($nome) {
  
    $paciente = $pacienteDao->findById($id);
    $paciente->setMatricula($matricula);
    $paciente->setNome($nome);
    $paciente->setEmail($email);
    $paciente->setNascimento($nascimento);
    $paciente->setTelefone($telefone);
    $paciente->setEndereco($endereco);
    $paciente->setFoto($foto);
    $paciente->setIdTurma($id_turma);
    $paciente->setIdCurso($id_curso);

  
    $pacienteDao->atualizarPaciente($paciente);


    $_SESSION['flash'] = "<div class='alert alert-success'>Alterado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/paciente.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div class='alert alert-danger'>Não foi possivel editar</div>";
                header('Location:'. $baseUrl . '/public/paciente.php');
                exit;
            }

