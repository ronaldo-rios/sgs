<?php

require '../vendor/autoload.php';
require '../conexao.php';

use Dotenv\Dotenv;
use src\dao\UsuarioDaoMySql;
use src\models\Auth;
use src\dao\PacienteDaoMySql;
use src\dao\ProntuarioDaoMySql;
use src\models\Paciente;
use src\models\Prontuario;  


//$auth = new Auth($pdo, $baseUrl);
//$psuarioInfo = $auth->checkToken();
//if ($psuarioInfo->getPermissao() !== 'admin') {
//    header('Location: access_denied.php');
  //  exit();
//}

$paciente = new PacienteDaoMySql($pdo);
$prontuario = new ProntuarioDaoMySql($pdo);



?>


<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>SGS - Sistema de Gestão de Saúde</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/libs/apex-charts/apex-charts.css" />
    <script src="assets/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<?=$baseUrl;?>" class="app-brand-link">
                  <defs>
                    <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1" ></path>
                    <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3" ></path>
                    <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                    <path   d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5" ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use></mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use> </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use> </g></g>
                        <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) " >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use> </g></g></g> </g></span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><img src="logo.png " style="width:100px;"></span> </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>

<!-- Inicio Dashbord -->
          <ul class="menu-inner py-1">
      
            <li class="menu-item active">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle red"></i>
                <div data-i18n="Analytics" class="azul">Inicio</div>
              </a>
            </li>
           
  <!-- Menu Usuários -->
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text azul-marinho">Controle de Usuário</span>
  </li>
  <li class="menu-item">

    <a href="adm_principal.php" class="menu-link" >
      <i class="menu-icon tf-icons bx bxs-user-check"></i>
     
      <div data-i18n="Basic" class="azul">Administrador</div>
    </a>


    <a href="servidor.php" class="menu-link">
      <i class="menu-icon bx bx-group"></i>   
      <div data-i18n="Basic" class="azul">Servidores</div>
    </a>
    
    <a href="paciente.php" class="menu-link">
      <i class="menu-icon tf-icons bx bx-face"></i>
     
      <div data-i18n="Basic" class="azul" >Pacientes</div>
    </a>

    <a href="medico.php" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-face-mask"></i>
      <div data-i18n="Basic" class="azul" >Médico</div>
    </a>
  </li>


           

 <!-- Menu Prontuário -->
<li class="menu-header small text-uppercase"><span class="menu-header-text azul-marinho">Prontuário</span></li>

        
<li class="menu-item">

  <a href="atestado.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bx-cabinet red"></i>
    <div data-i18n="User interface"  class="azul" >Atestados</div>
  </a>

  <a href="vacina.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bxs-virus red"></i>
    <div data-i18n="User interface"  class="azul" >Vacinas</div>
  </a>

  
    <a href="prontuario.php" class="menu-link">
      <i class="menu-icon tf-icons bx bx-plus-medical red"></i>
      <div data-i18n="Authentications" class="azul">Consulta</div>
    </a>

    
     
</li>


<!-- Menu Cadastros-->
<li class="menu-header small text-uppercase"><span class="menu-header-text azul-marinho">Cadastros</span></li>
           
<li class="menu-item">
  <a href="curso.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bxs-graduation red"></i>
    <div data-i18n="User interface"  class="azul" >Curso</div>
  </a>
</li>

  <li class="menu-item">
    <a href="turma.php" class="menu-link ">
      <i class="menu-icon tf-icons bx bxs-group red"></i>
      <div data-i18n="User interface"  class="azul" >Turma</div>
    </a>
  </li>




<!-- Relatórios -->
<li class="menu-header small text-uppercase "><span class="menu-header-text azul-marinho">Relatórios</span></li>
           
           
<li class="menu-item">
  <a href="javascript:void(0);" class="menu-link ">
    <i class="menu-icon tf-icons bx bx-capsule red"></i>
    <div data-i18n="Layouts"  class="azul" >Anamnese</div>
  </a>

  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link ">
      <i class="menu-icon tf-icons bx bx-plus-medical red"></i>
      <div data-i18n="Layouts"  class="azul" >Consulta</div>
    </a>


<li class="menu-item">
  <a href="javascript:void(0)" class="menu-link ">
    <i class="menu-icon tf-icons bx bx-cabinet"></i>
    <div data-i18n="User interface"  class="azul" >Atestados</div>
  </a>
</li>
  <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link ">
      <i class="menu-icon tf-icon bx bxs-virus"></i>
      <div data-i18n="User interface"  class="azul" >Vacinas</div>
    </a>
  </li>
          </ul>
        </aside>
<!-- Fim Dashbord -->

<!-- Inicio da Página -->
  <div class="layout-page">
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

       <h4 class="fw-bold py-3 mb-4 azul-marinho">Gerenciamento Prontuários</h4>
    
       <?php if(!empty($_SESSION['flash'])) : ?>
      <div class="flash-message">
        <?= $_SESSION['flash']; ?>
      </div>
        <?= $_SESSION['flash'] = ''; ?> 
    <?php endif; ?>
    <script>
        setTimeout(function() {
            var flashMessages = document.getElementsByClassName('flash-message');
            for (var i = 0; i < flashMessages.length; i++) {
                flashMessages[i].parentNode.removeChild(flashMessages[i]);
            }
        }, 3000);
    </script>

 <!-- Inicio Barra Pesquisa-->      
 <div class="box-search" style=" display: flex;justify-content:center;margin-bottom:30px">    
  <input type="search" class="form-control " id="search"  placeholder="Informe o nome do aluno que deseja pesquisar" aria-label="Pesquise"  />
    <button  onclick="searchData()" class="btn btn-primary ">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
         <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
              </button>
                 </div>
 

<!-- Inicio da Tabela -->

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
      
<!-- Cabeçalho da Tabela -->
    <thead>
      <tr>

         <th style="color:#2B5AAD;;font-weight:bold;">Nome</th>
         <th style="color:#2B5AAD;;font-weight:bold;">Matricula</th>
         <th style="color:#2B5AAD;;font-weight:bold;">Visualizar</th>
        <th style="color:#2B5AAD;;font-weight:bold;">Editar</th>
      
        
      </tr>
    </thead>

    <tr>

<!-- Corpo da Tabela -->
<tbody class="table-border-bottom-0 gray">
<div style="text-align:center;">
<?php
      //Se campo de pesquisa for diferente de vazio, ele faz a pesquisa
      if(!empty ($_GET['search'])){
        $data= $_GET['search'];
      //Se o retorno da função findByName for diferente de vazio, ele mostra os cursos que encontrou
      if (!empty($prontuario->findByName($data))) {
      
          $prontuarios = $prontuario->findByName($data);
          $pacientes = $paciente->findByName($data);

      }else{
        echo "<div class='alert alert-danger' role='alert'>
        Não há prontuário vinculado ao aluno informado. Favor cadastrar!";
        $pacientes = [];
      } 

      }else {
        $pacientes = [];
        
      }
      ?>
</div>

<!-- INÍCIO DO LOOP FOREACH DE USUÁRIOS -->
<?php foreach($pacientes as $p):;?>

  <td>
    <i class="fab fa-angular fa-lg text-danger me-3"></i> 
    <strong>
      <?php 
        echo $p->getNome();
      ?>
    </strong>
  </td>

  <td>
    <i class="fab fa-angular fa-lg text-danger me-3"></i> 
    <strong>
      <?php 
        echo $p->getMatricula();
      ?>
    </strong>
  </td>
 
<!--  Visualizar-->
<td>
  <a href="<?=$baseUrl;?>/public/prontuario_view.php?id=<?=$p->getId();?>">
<button type="button" class="btn btn-primary" data-bs-toggle="modal"  style="background-color:#cdf3fb;border:none">
  <i class="bx bx-show-alt"></i>
</button>
</a>
 
</td>

<!--Incio Modal Editar-->
 <td>
 <a href="<?=$baseUrl;?>/public/prontuario_edit.php?id=<?=$p->getId();?>">
<button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#editar-<?= $p->getId(); ?>" style="background-color:#cdf3fb;border:none">
  <i class="bx bx-edit-alt" ></i>
 </button>
 </a>
        </td>
      
                    
    </tr>
    <!-- FIM DO LOOP DE USUARIOS -->
    <?php endforeach; ?>
       </tbody>
          </table>
              </div>
                </div>
</div>

<!-- Inicio Modal Cadastrar -->
<div class="col-lg-4 col-md-6" style="margin:20px;">
  <div class="mt-3">

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"style="background-color:#017EC3">
  Cadastrar
  </button>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">

     
        <div class="modal-header">
           <h5 class="modal-title azul-marinho" id="exampleModalLabel1">Cadastro de Prontuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"style="background-color:#F14349;"></button>
                    </div>

<?php 

$alunos=$paciente->findAll();?>
<div class="modal-body">
<form action="<?=$baseUrl;?>/src/actions/inserir_prontuario_action.php" id="cad" method="POST">

<div class="row">
    <div class="mb-3">
        <label for="exampleFormControlSelect1" class="form-label">Aluno</label>
        <select class="form-select" id="id_aluno" name="id_paciente" aria-label="Selecione o aluno">
            <?php foreach($alunos as $a): ?>
                <option value="<?= $a->getId(); ?>" <?php if ($a->getId() == $a->getId()) echo 'selected'; ?>>
                    <?= $a->getNome(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="mb-3">
        <label for="exampleFormControlSelect1" class="form-label">Matricula</label>
        <select class="form-select" id="id_matricula" name="matricula_paciente" aria-label="Selecione a matrícula">
            <?php foreach($alunos as $a): ?>
                <option value="<?= $a->getMatricula(); ?>" data-aluno-id="<?= $a->getId(); ?>">
                    <?= $a->getMatricula(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>



<input type="hidden" name="id_usuario" value="1">

<div class="row">
<div class="col mb-0">
    <label for="dobBasic" class="form-label">ESF</label>
     <input type="text" name="esf" class="form-control" placeholder="Informe o ESF que o aluno recebe atendimento" />
       </div>
        </div>

<div class="row">
<div class="col mb-0">
    <label for="emailBasic" class="form-label">Plano de Saúde</label>
    <input type="text" name="plano_saude" class="form-control" placeholder="Informe o plano de saúde do aluno" required />
      </div>
         </div>

<div class ="row">
<div class="col mb-0">
  <label for="emailBasic" class="form-label">Cartão do SUS</label>
    <input type= "text" name="numero_cartao_sus" class="form-control" placeholder="Informe o número do cartão do SUS do aluno" required />
      </div>
        </div>
        
<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Alergia Medicamentos</label>
    <select class="form-select" name="alergia_medicamento" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class ="row">
<div class="col mb-0">
  <label for="emailBasic" class="form-label">Nome medicamento que possui alergia</label>
    <input type= "text" name="nome_medicamento_alergia" class="form-control" placeholder="Informe o nome do medicamento que o aluno possui alergia"  />
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Uso de medicamento controlado</label>
    <select class="form-select" name="medicamento_controlado" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class ="row">
<div class="col mb-0">
  <label for="emailBasic" class="form-label">Nome medicamento controlado</label>
    <input type= "text" name="nome_medicamento_controlado" class="form-control" placeholder="Informe o nome do medicamento que o aluno faz uso "  />
      </div>
        </div>

    
<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Diabetes</label>
    <select class="form-select" name="diabetes" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Pressão Alta</label>
    <select class="form-select" name="pressao_alta" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Pressão Baixa</label>
    <select class="form-select" name="pressao_baixa" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Asma</label>
    <select class="form-select" name="asma" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

 <div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Bronquite</label>
    <select class="form-select" name="bronquite" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Anemia</label>
    <select class="form-select" name="anemia" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Ansiedade</label>
    <select class="form-select" name="ansiedade" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Depressão</label>
    <select class="form-select" name="depressao" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

 <div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Insonia</label>
    <select class="form-select" name="insonia" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Hemofilia</label>
    <select class="form-select" name="hemofilia" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Tuberculose</label>
    <select class="form-select" name="tuberculose" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Diagnostico de Eplepsia</label>
    <select class="form-select" name="eplepsia" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Desmaios Recorrentes</label>
    <select class="form-select" name="desmaios" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class="row">
<div class="mb-3">
    <label for="exampleFormControlSelect1" class="form-label">Fumante</label>
    <select class="form-select" name="fumante" aria-label="Selecione a opção">
         <option > Selecione </option>
        <option value="S"> Sim </option>
        <option value="N"> Não </option>
    </select>
      </div>
        </div>

<div class ="row">
<div class="col mb-0">
  <label for="emailBasic" class="form-label">Outro</label>
    <input type= "text" name="outro" class="form-control" placeholder="Outra Informação que achar relevante"  />
      </div>
        </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-secondary botao-red" data-bs-dismiss="modal" style="background-color:#F14349;color: white;" >
  Cancelar 
    </button>
<button type="submit" class="btn btn-primary azul" style="background-color:#2B5AAD" form="cad" id="cad">
  Salvar
    </button> 
        </div>
          </div>
            </div>
              </div>
                </div>
                 </div>
                 </form>

      </div>
<!-- Content wrapper -->
    </div>
     <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
   

 

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/libs/jquery/jquery.js"></script>
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>

  <script>
    var search = document.getElementById('search');

    search.addEventListener('keydown', function(event){
      if(event.key === "Enter"){
        searchData();
      }
    });

    function searchData(){
      window.location.href = '<?=$baseUrl;?>/public/prontuario.php?search='+search.value;
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#id_aluno').change(function() {
            var alunoId = $(this).val();
            $('#id_matricula').val('');
            $('#id_matricula option[data-aluno-id="' + alunoId + '"]').prop('selected', true);
        });
    });
</script>
</html>