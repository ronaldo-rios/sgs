<?php

require '../vendor/autoload.php';
require '../conexao.php';
use Dotenv\Dotenv;
use src\config\Conexao;
use src\models\Auth;
use src\dao\PacienteDaoMySql;
use scr\models\Paciente;
use scr\models\Prontuario;
use src\dao\ProntuarioDaoMySql;
use src\dao\TurmaDaoMySql;
use src\dao\CursoDaoMySql;
use src\dao\SoapDaoMySql;

$auth = new Auth($pdo, $baseUrl);
$usuarioInfo = $auth->checkToken();
if ($usuarioInfo->getPermissao() !== 'medico') {
   header('Location: access_denied.php');
    exit();
}

$paciente = new PacienteDaoMySql($pdo);
$pacientes = $paciente->findById($_GET['id']);

$prontuario = new ProntuarioDaoMySql($pdo);
$prontuarios = $prontuario->findByName($pacientes->getNome());

$turma = new TurmaDaoMySql($pdo);
$curso = new CursoDaoMySql($pdo);
$soap = new SoapDaoMySql($pdo);
$soaps = $soap->findPaciente($_GET['id']);
?>


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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Prontuário Eletrônico</h4>
       <div class="row">
         <div class="col-md-12">
        

<div class="card mb-4">

    <h5 class="card-header">Dados do Aluno</h5>
      <div class="card-body">
         <div class="d-flex align-items-start align-items-sm-center gap-4">

            <img src="../public/assets/img/uploads/<?= $pacientes->getFoto(); ?>" 
            class="d-block rounded" height="100" width="100" id="uploadedAvatar"/> 
            
                </div>
                 </div>



<hr class="my-0" />
   <div class="card-body">
      <form id="formAccountSettings" method="POST" onsubmit="return false">

<div class="row">
  <div class="mb-3 col-md-6">
      <label for="nome" class="form-label">Nome Completo</label>
       <input class="form-control" type="text" id="nome" name="nome" value="<?= $pacientes->getNome(); ?>" />
      
          </div>
 <div class="mb-3 col-md-6">
    <label for="matricula" class="form-label">Matricula</label>
    <input class="form-control" type="text" name="matricula" id="matricula" value="<?= $pacientes->getMatricula(); ?>"/>
      </div>

<?php 
$idd = $pacientes->getIdCurso();
$nomecurso = $curso->findCurso($idd);
 ?>
  <div class="mb-3 col-md-6">
    <label for="curso" class="form-label">Curso</label>
    <input class="form-control" type="text" name="curso" id="curso" value="<?= $nomecurso ?>"/>
      </div>
<?php 
$idd = $pacientes->getIdTurma();
$nometurma = $turma->findTurma($idd);
 ?>

<div class="mb-3 col-md-6">
    <label for="turma" class="form-label">Turma</label>
    <input class="form-control" type="text" name="turma" id="turma" value="<?= $nometurma; ?>"/>
      </div>

<?php foreach($prontuarios as $p): ?>
<div class="mb-3 col-md-6">
  <label for="lastName" class="form-label">Cartão do SUS</label>
    <input class="form-control" type="text" name="numero_cartao_sus" id="numero_cartao_sus" value="<?= $p->getNumeroCartaoSus(); ?>"  />
        </div>

 <div class="mb-3 col-md-6">
  <label for="nascimento" class="form-label">Data Nascimento</label>
    <input class="form-control" type="date" name="nascimento" id="nascimento" value="<?= $pacientes->getNascimento(); ?>" />
        </div>
        
<div class="mb-3 col-md-6">
  <label class="form-label" for="telefone">Telefone</label>
   <div class="input-group input-group-merge">
         <input type="text" id="telefone" name="telefone" class="form-control" value="<?= $pacientes->getTelefone(); ?>"/>
            </div>
              </div>

<div class="mb-3 col-md-6">
   <label for="endereco" class="form-label">Endereço</label>
      <input type="text" class="form-control" id="endereco" name="endereco" value="<?= $pacientes->getEndereco(); ?>" />
        </div>

<div class="mb-3 col-md-6">
  <label for="lastName" class="form-label">ESF</label>
    <input class="form-control" type="text" name="esf" id="esf"  value="<?=$p->getEsf();?>" />
        </div>

<div class="mb-3 col-md-6">
  <label for="lastName" class="form-label">Plano de Saúde</label>
    <input class="form-control" type="text" name="plano_saude" id="plano_saude" value="<?=$p->getPlanoSaude();?>" />
        </div>

<div class="row">
   <div class="mb-3 col-md-6">
      <label for="firstName" class="form-label">Alergia a Medicamento</label>
         <input class="form-control" type="text" id="nome_medicamento_alergia" name="nome_medicamento_alergia" value="<?= $p->getNomeMedicamentoAlergia(); ?>"/>
           </div>
<div class="mb-3 col-md-6">
   <label for="lastName" class="form-label">Medicação Controlada</label>
      <input class="form-control" type="text" name="nome_medicamento_controlado" id="nome_medicamento_controlado"  value="<?= $p->getNomeMedicamentoControlado(); ?>"/>
        </div>

<?php 
$diabetes= $prontuario->verificarDiabetes($p->getDiabetes());
$pressaoAlta= $prontuario->verificarPressaoAlta($p->getPressaoAlta());
$pressaoBaixa= $prontuario->verificarPressaoBaixa($p->getPressaoBaixa());
$asma= $prontuario->verificarAsma($p->getAsma());
$bronquite= $prontuario->verificarBronquite($p->getBronquite());
$anemia= $prontuario->verificarAnemia($p->getAnemia());
$ansiedade = $prontuario->verificarAnsiedade($p->getAnsiedade());
$depressao= $prontuario->verificarDepressao($p->getDepressao());
$insonia= $prontuario->verificarInsonia($p->getInsonia());
$hemofilia = $prontuario->verificarHemofilia($p->getHemofilia());
$tuberculose = $prontuario->verificarTuberculose($p->getTuberculose());
$eplepsia= $prontuario->verificarEplepsia($p->getEplepsia());
$desmaios = $prontuario->verificarDesmaios($p->getDesmaios());
$fumante = $prontuario->verificarFumante($p->getFumante());
?>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Doenças</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">
    <?= $diabetes; ?>, <?= $pressaoAlta; ?>, <?= $pressaoBaixa; ?>, <?= $asma; ?>, <?= $bronquite; ?>, <?= $ansiedade; ?>, <?= $depressao; ?>, <?= $insonia; ?>, <?= $tuberculose; ?>, <?= $hemofilia; ?>, <?= $eplepsia; ?>, <?= $desmaios; ?>, <?= $fumante; ?>
  </textarea>
        </div>
          </form>
          <?php endforeach; ?>   
            </div>
                </div>
                  </div>  
                    </div>
                     </div>
                       </div>  
                       <!-- Inicio da Tabela -->

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
      
<!-- Cabeçalho da Tabela -->
    <thead>
      <tr>
         <th style="color:#2B5AAD;;font-weight:bold;">Data e hora</th>
         <th style="color:#2B5AAD;;font-weight:bold;">Visualizar</th> 
      </tr>
    </thead>

<!-- Corpo da Tabela -->
<tbody class="table-border-bottom-0 gray">

<tr>

<?php foreach($soaps as $s):;?>
  <td>
    <i class="fab fa-angular fa-lg text-danger me-3"></i> 
    <strong>
      <?php echo $s->getData(); ?>
    </strong>
  </td>


 
<!-- Modal Visualizar-->
<td>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show-<?= $s->getId() ?>" style="background-color:#cdf3fb;border:none">
  <i class="bx bx-show-alt"></i>
</button>
  
<div class="modal fade" id="show-<?= $s->getId(); ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close" style="background-color:#F14349;"></button>
            </div>
  
<!-- Corpo Modal -->
<div class="modal-body">
<div class="row">
  <div class="col-md-12 col-12 mb-md-0 mb-4">
     <div class="card">
          <div class="card-body">
         
          <div class="mb-3 row">
            <label for="html5-datetime-local-input" class="col-md-2 col-form-label">Data</label>
                <div class="col-md-10">
                    <input class="form-control" type="date-time" name="data"  id="html5-datetime-local-input" value="<?= $s->getData(); ?>" />
                       </div>
                          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Subjetivo</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $s->getSubjetivo(); ?></textarea>
                  </div>

         <div class=" mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Objetivo</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $s->getObjetivo(); ?></textarea>
                </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Avaliação</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $s->getAvaliacao(); ?></textarea>
                </div>
                      
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Plano</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $s->getPlano(); ?></textarea>
               </div>    
                  </div>
                    </div>
                     </div>
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
      
                    

    </tr>
    <!-- FIM DO LOOP DE USUARIOS -->
    <?php endforeach; ?>
       </tbody>
          </table>
              </div>
                </div>
                  </div>       
                    </div>
                        

    <!-- Core JS -->
    <!-- build:js assets/js/core.js -->
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
  
</html>
