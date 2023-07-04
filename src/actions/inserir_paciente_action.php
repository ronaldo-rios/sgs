<?php

namespace src\actions;
require '../../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use src\models\Paciente;
use src\dao\PacienteDaoMySql;

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_SPECIAL_CHARS);
$nascimento = filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
$foto = filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_SPECIAL_CHARS);
$id_curso = filter_input(INPUT_POST, 'id_curso', FILTER_SANITIZE_SPECIAL_CHARS);
$id_turma= filter_input(INPUT_POST, 'id_turma', FILTER_SANITIZE_SPECIAL_CHARS);



if (isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])) {
    // Define o diretório de destino do upload
    $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/sgs/public/assets/img/uploads/';
    
    // Gera um nome único para o arquivo com a extensao
    $nomeArquivo = uniqid() . '_' . $_FILES["foto"]["name"];

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $diretorioDestino . $nomeArquivo)) {
        $foto = $nomeArquivo;
        echo "<div class='alert alert-success'>Upload realizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Não foi possivel realizar o upload da foto</div>";
        exit;
    }
}

if ($nome){
    
    $pacienteDao = new PacienteDaoMySql($pdo);

    if ($pacienteDao->matriculaExists($matricula) === false)
    {
        $paciente = new paciente();
        $paciente->setNome($nome);
        $paciente->setMatricula($matricula);
        $paciente->setNascimento($nascimento);
        $paciente->setEmail($email);
        $paciente->setEndereco($endereco);
        $paciente->setTelefone($telefone);
        $paciente->setFoto($foto) ?? null;
        $paciente->setIdCurso($id_curso);
        $paciente->setIdTurma($id_turma);
        $pacienteDao->inserirpaciente($paciente);
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-success'>Cadastrado com sucesso!</div>";
            header('Location:'. $baseUrl . '/public/paciente.php');
            exit;
            
        }  else {
            $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel cadastrar</div>";
                header('Location:'. $baseUrl . '/public/paciente.php');
                exit;
            }
    } 
    else {
        $_SESSION['flash'] = "<div style='text-align:center;' class='alert alert-danger'>Não foi possivel cadastrar</div>";
            header('Location:'. $baseUrl . '/public/paciente.php');
            exit;
        }

    