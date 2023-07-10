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
$fotoedit = filter_input(INPUT_POST, 'fotoedit', FILTER_SANITIZE_SPECIAL_CHARS);
$id_curso = filter_input(INPUT_POST, 'id_curso', FILTER_SANITIZE_SPECIAL_CHARS);
$id_turma= filter_input(INPUT_POST, 'id_turma', FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_FILES["fotoedit"]) && !empty($_FILES["fotoedit"]["name"])) {
    // Define o diretório de destino do upload
    $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/public/assets/img/uploads/';
    
    // Gera um nome único para o arquivo com a extensao
    $nomeArquivo = uniqid() . '_' . $_FILES["fotoedit"]["name"];

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES["fotoedit"]["tmp_name"], $diretorioDestino . $nomeArquivo)) {
        $foto = $nomeArquivo;
        echo "<div style='text-align:center;' class='alert alert-success'>Upload realizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Não foi possivel realizar o upload da foto</div>";
        exit;
    }
}

if ($nome) {
  
    $paciente = $pacienteDao->findById($id);
    $paciente->setMatricula($matricula);
    $paciente->setNome($nome);
    $paciente->setEmail($email);
    $paciente->setNascimento($nascimento);
    $paciente->setTelefone($telefone);
    $paciente->setEndereco($endereco);
    $paciente->setFoto($fotoedit) ?? null;
    $paciente->setIdTurma($id_turma);
    $paciente->setIdCurso($id_curso);
  
    $pacienteDao->atualizarPaciente($paciente);


    $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Alterado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/paciente.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel editar</div>";
                header('Location:'. $baseUrl . '/public/paciente.php');
                exit;
            }

