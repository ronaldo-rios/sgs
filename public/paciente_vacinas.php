<?php

require '../vendor/autoload.php';
require '../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use src\dao\PacienteDaoMySql;
use src\dao\VacinaDaoMySql;
use src\dao\PacienteVacinaDaoMySql;

$paciente = new PacienteDaoMySql($pdo);
$alunos = $paciente->findAll();

$vacina = new VacinaDaoMySql($pdo);
$vacinas = $vacina->findAllVacinas();

$pacienteVacina = new PacienteVacinaDaoMySql($pdo);
$vacinasPaciente = $pacienteVacina->findAll();

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
              <a href="<?=$baseUrl;?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle red"></i>
                <div data-i18n="Analytics" class="azul">Inicio</div>
              </a>
            </li>
            <li class="menu-item">
                <a href="<?=$baseUrl;?>/public/alterar_senha.php" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cog red"></i>
                <div data-i18n="Basic" class="azul">Configurações</div>
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

  <a href="paciente_vacinas.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bxs-virus red"></i>
    <div data-i18n="User interface"  class="azul" >Vacinas dos Pacientes</div>
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

    <a href="vacina.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bxs-virus red"></i>
    <div data-i18n="User interface"  class="azul" >Vacinas</div>
  </a>

  </li>




<!-- Relatórios -->
<li class="menu-header small text-uppercase "><span class="menu-header-text azul-marinho">Relatórios</span></li>
           
           
<li class="menu-item">

  <li class="menu-item">

<li class="menu-item">
  <a href="relatorio_atestados.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bx-cabinet"></i>
    <div data-i18n="User interface"  class="azul" >Atestados</div>
  </a>
</li>
  <li class="menu-item">
    <a href="relatorio_vacinas.php" class="menu-link ">
      <i class="menu-icon tf-icon bx bxs-virus"></i>
      <div data-i18n="User interface"  class="azul" >Vacinas</div>
    </a>
  </li>

  <li class="menu-item">
  <a href="<?=$baseUrl?>/src/actions/logout_action.php" style="background-color:#d6d2fc;" class="menu-link">
    <i class="menu-icon tf-icon bx bx-exit"></i>
    <div data-i18n="User interface" class="azul" >Sair</div>
  </a>
</li>
          </ul>
        </aside>
<!-- Fim Dashbord -->
<!-- Inicio da Página -->
  <div class="layout-page">
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4 azul-marinho">Gerenciamento Vacinas dos Pacientes</h4>

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
  <input type="search" class="form-control " id="search"  placeholder="Informe o nome do paciente que deseja pesquisar" aria-label="Pesquise"  />
    <button  onclick="searchData()" class="btn btn-primary ">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
         <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
              </button>
                 </div>
<?php
//Se campo de pesquisa for diferente de vazio, ele faz a pesquisa
if(!empty ($_GET['search'])){
  $data = $_GET['search'];
//Se o retorno da função findByName for diferente de vazio, ele mostra os cursos que aencontrou
if (!empty($paciente->findByName($data))) {
    $alunos = $paciente->findByName($data);

}else{
  echo "<div class='alert alert-danger' role='alert'>
  Nenhum paciente encontrado!";
  $alunos = [];
} 

}else {
  $alunos = $paciente->findAll();
}

?>
 

<!-- Inicio da Tabela -->

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
      
<!-- Cabeçalho da Tabela -->
    <thead>
      <tr>

        <th style="color:#2B5AAD;;font-weight:bold;">Nome</th>
        <th style="color:#2B5AAD;;font-weight:bold;">Visualizar</th>
        <th style="color:#2B5AAD;;font-weight:bold;">Editar</th>

        
      </tr>
    </thead>

<!-- Corpo da Tabela -->
<tbody class="table-border-bottom-0 gray">

<tr>
<!-- INÍCIO DO LOOP FOREACH DE VACINAS POR PACIENTES -->
<?php foreach($alunos as $al): ?> 

  <td>
    <i class="fab fa-angular fa-lg text-danger me-3"></i> 
<!-- Busca de todos os alunos -->
    <strong>
      <?php 
            echo $al->getNome(); 
    
      ?>
    </strong>
  </td>

 
<!-- Modal Visualizar-->
<td>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show-<?=$al->getId();?>" style="background-color:#cdf3fb;border:none">
  <i class="bx bx-show-alt"></i>
</button>
  
<div class="modal fade" id="show-<?=$al->getId();?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="modalFullTitle">Cadastro Vacinas do Paciente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close" style="background-color:#F14349;"></button>
            </div>
  
<!-- Corpo Modal -->
<div class="modal-body">
<div class="list-group list-group-flush">

<p href="javascript:void(0);" class="list-group-item list-group-item-action">
    <p>Vacinas do Paciente</p>

    <?php

      $pacienteEncontrado = false;
      // foreach de $vacinasPaciente
      foreach($vacinasPaciente as $pacienteVacina):
        $pacienteVacina->getIdPaciente();
        // Se o idPaciente for igual ao id do aluno então:
        if($pacienteVacina->getIdPaciente() == $al->getId()):
          $pacienteEncontrado = true;
          // Faça um foreach de $vacinas
          foreach($vacinas as $vacina):
            // Se o id da vacina for igual ao idVacina então exiba finalmente as vacinas:
            if($vacina->getId() == $pacienteVacina->getIdVacina()):
              $dataVacinaFormatada = date('d/m/Y', strtotime($pacienteVacina->getData()));
              echo "<br> Vacina: " . $vacina->getNome() . 
                   "<br> Data da Vacinação: " . $dataVacinaFormatada . 
                   "<br> Dose: " . $pacienteVacina->getDose() . "ª <br>"."<br>"; 
            endif;
          endforeach;
        endif;
      endforeach;

      if(!$pacienteEncontrado):
            echo "<p style='color:#346bc9;'>Nenhuma Vacina cadastrada para esse paciente até o momento.</p>";
      endif;
    
    ?>

        </p>  
  
     </div>
          </div>

<div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="background-color:#F14349;color: white;">Fechar</button>
    </div>
      </div>
       </div>
       </div>
        </div>
</td>



<!--Incio Modal Editar-->
 <td>
<button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#editar-<?=$al->getId();?>" style="background-color:#cdf3fb;border:none">
  <i class="bx bx-edit-alt" ></i>
 </button>

 <div class="modal fade" id="editar-<?=$al->getId();?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


<div class="modal-header">
  <h5 class="modal-title azul-marinho" id="exampleModalLabel1">Cadastro de Vacinas em Pacientes</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"style="background-color:#F14349;"></button>
      </div>

<div class="modal-body">
<form action="<?=$baseUrl;?>/src/actions/editar_paciente_vacinas_action.php" id="edit" method="POST" >


      <?php foreach($alunos as $a): ?>
        <input type="hidden" name="id" value="<?= $a->getId(); ?>">    
      <?php endforeach; ?>

<br>

<div id="vacinaContainer" class="row">
  <div class="col mb-1">
    <label for="nameBasic" class="form-label"><b>Vacinas</b></label>
    <select class="form-select" name="vacinas[]" aria-label="Selecione a Vacina" required >
      <?php foreach($vacinas as $v): ?>
        <option value="<?= $v->getId(); ?>" <?php if ($v->getId() == $v->getId()) echo 'selected'; ?> >
          <?= $v->getNome(); ?>
        </option>
      <?php endforeach; ?>
    </select>

    <div class="mt-2">
      <label for="dataVacina<?= $v->getId(); ?>" class="form-label">Data da realização da vacina</label>
      <input type="date" class="form-control" name="datas[]" required >
    </div>
    <div class="mt-2">
      <label for="doseVacina<?= $v->getId(); ?>" class="form-label">Dose</label >
      <select class="form-select" name="doses[]" id="doseVacina<?= $v->getId(); ?>" >
        <option value="">Selecione a dose</option>
        <option value="1">Primeira</option>
        <option value="2">Segunda</option>
        <option value="3">Terceira</option>
        <option value="4">Quarta</option>
      </select>
      <br>
    </div>
  </div>
</div>

<div style="display:flex; justify-content:center;">
  <button class="btn btn-primary azul" style="background-color:#2B5AAD" type="button" id="addVacinaInput">
    Adicionar outra vacina
  </button>
  <button class="btn btn-outline-secondary btnRemoverGlobal" style="background-color:#F14349;color: white;" type="button">
    Remover vacina
  </button>
</div>

<script>
function adicionarVacina() {
  // Obtém o elemento pai dos campos de vacina
  const vacinaContainer = document.getElementsByClassName('vacinaContainer');

  // Clona o último conjunto de campos de vacina
  const ultimoVacina = vacinaContainer.lastElementChild.cloneNode(true);

  // Limpa os valores dos campos clonados
  const camposClonados = ultimoVacina.querySelectorAll('select, input');
  camposClonados.forEach((campo) => {
    campo.value = '';
  });

  // Adiciona o conjunto de campos clonados ao elemento pai
  vacinaContainer.appendChild(ultimoVacina);
}

function removerVacina() {
  const vacinaContainer = document.getElementsByClassName('vacinaContainer');

  // Certifica-se que há mais de um campo de vacina, para que sempre permaneça ao menos um
  if (vacinaContainer.childElementCount > 1) {
    // Remove o último conjunto de campos de vacina
    vacinaContainer.removeChild(vacinaContainer.lastElementChild);
  }
}

// Obtém o botão "Adicionar outra vacina"
const btnAdicionarVacinaEdit = document.getElementsByClassName('addVacinaInput');
btnAdicionarVacinaEdit.addEventListener('click', adicionarVacina);

// Obtém o botão "Remover vacina"
const btnRemoverVacinaEdit = document.getElementsByClassName('btnRemoverGlobal');
btnRemoverVacinaEDit.addEventListener('click', removerVacina);
</script>

<div style="display:flex; justify-content:center;" class="modal-footer">
  <button type="button" class="btn btn-outline-secondary botao-red" data-bs-dismiss="modal" style="background-color:#F14349;color: white;">
    Cancelar 
  </button>
  <button type="submit" class="btn btn-primary azul" style="background-color:#2B5AAD" form="edit" id="edit">
    Salvar
  </button> 
</div>

</form>
        </td>
      
                    

<td>


 </td>
    </tr>
    <!-- FIM DO LOOP DE ATESTADOS -->
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
           <h5 class="modal-title azul-marinho" id="exampleModalLabel1">Cadastro de Vacinas em Pacientes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"style="background-color:#F14349;"></button>
                    </div>

<div class="modal-body">
<form action="<?=$baseUrl;?>/src/actions/inserir_paciente_vacinas_action.php" id="cad" method="POST" >

<div class="row">
            <div class="col mb-1">
              <label for="nameBasic" class="form-label"><b>Aluno</b></label>
              <select class="form-select" name="idpaciente" aria-label="Selecione o aluno" required >
              <?php foreach($alunos as $a): ?>
                <option value="<?= $a->getId(); ?>" <?php if ($a->getId() == $a->getId()) echo 'selected'; ?>>
                    <?= $a->getNome(); ?>
                </option>
              <?php endforeach; ?>
        </select>
            </div>
          </div>
    
          <br>

<div id="vacinaContainer" class="row">
    <div class="col mb-1">
    
    <label for="nameBasic" class="form-label"><b>Vacinas</b></label>
              <select class="form-select" name="vacinas[]" aria-label="Selecione a Vacina" required >
              <?php foreach($vacinas as $v): ?>
                <option value="<?= $v->getId(); ?>" <?php if ($v->getId() == $v->getId()) echo 'selected'; ?> >
                    <?= $v->getNome(); ?>
                </option>
              <?php endforeach; ?>
        </select>

        <div class="mt-2">
          <label for="dataVacina<?= $v->getId(); ?>" class="form-label">Data da realização da vacina</label>
          <input type="date" class="form-control" name="datas[]" required >
        </div>
        <div class="mt-2">
          <label for="doseVacina<?= $v->getId(); ?>" class="form-label">Dose</label >
          <select class="form-select" name="doses[]" id="doseVacina<?= $v->getId(); ?>" >
            <option value="">Selecione a dose</option>
            <option value="1">Primeira</option>
            <option value="2">Segunda</option>
            <option value="3">Terceira</option>
            <option value="4">Quarta</option>
          </select>
          <br>
        </div>

  
    </div>
  </div>

<div style="display:flex; justify-content:center;" >
  <button class="btn btn-primary azul" style="background-color:#2B5AAD" type="button" id="addVacinaInput">
  Adicionar outra vacina
  </button>


  <button id="btnRemoverGlobal" class="btn btn-outline-secondary botao-red" style="background-color:#F14349;color: white;" type="button">
  Remover vacina
  </button>
</div>

<script>
function adicionarVacina() {
  // Obtém o elemento pai dos campos de vacina
  const vacinaContainer = document.getElementById('vacinaContainer');

  // Clona o último conjunto de campos de vacina
  const ultimoVacina = vacinaContainer.lastElementChild.cloneNode(true);

  // Limpa os valores dos campos clonados
  const camposClonados = ultimoVacina.querySelectorAll('select, input');
  camposClonados.forEach((campo) => {
    campo.value = '';

  });

  // Adiciona o conjunto de campos clonados ao elemento pai
  vacinaContainer.appendChild(ultimoVacina);

}

function removerVacina() {
  const vacinaContainer = document.getElementById('vacinaContainer');

  // Certifica-se que há mais de um campo de vacina, para que sempre permaneça ao menos um
  if (vacinaContainer.childElementCount > 1) {
    // Remove o último conjunto de campos de vacina
    vacinaContainer.removeChild(vacinaContainer.lastElementChild);
  }
}

// Obtém o botão "Adicionar outra vacina"
const btnAdicionarVacina = document.getElementById('addVacinaInput');
btnAdicionarVacina.addEventListener('click', adicionarVacina);

// Obtém o botão "Remover vacina"
const btnRemoverVacina = document.getElementById('btnRemoverGlobal');
btnRemoverVacina.addEventListener('click', removerVacina);

  </script>


<div style="display:flex; justify-content:center;" class="modal-footer">
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
<div class="content-backdrop fade">

</div>

  </div>
<!-- Content wrapper -->
        </div>
         <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

 

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
      window.location.href = '<?=$baseUrl;?>/public/paciente_vacinas.php?search='+search.value;
    }
  </script>

</html>