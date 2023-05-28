<?php

require '../vendor/autoload.php';
require '../conexao.php';
use Dotenv\Dotenv;
use src\config\Conexao;
use src\models\Auth;

?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SGS - Sistema de Gestão de Saúde</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"
                    ></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"
                    ></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"
                    ></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"
                    ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><img src="logo.png " style="width:100px;"></span>
            </a>

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

    <a href="adm_principal.php" class="menu-link" id="admin-link" >
      <i class="menu-icon tf-icons bx bxs-user-check"></i>
     
      <div data-i18n="Basic" class="azul">Administrador</div>
    </a>


    <a href="servidor.php" class="menu-link">
      <i class="menu-icon bx bx-group"></i>   
      <div data-i18n="Basic" class="azul">Servidores</div>
    </a>
    
    <a href="aluno.php" class="menu-link">
      <i class="menu-icon tf-icons bx bx-face"></i>
     
      <div data-i18n="Basic" class="azul" >Alunos</div>
    </a>

    <a href="medico.php" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-face-mask"></i>
      <div data-i18n="Basic" class="azul" >Médico</div>
    </a>
  </li>


           

 <!-- Menu Prontuário -->
<li class="menu-header small text-uppercase"><span class="menu-header-text azul-marinho">Prontuário</span></li>

        
<li class="menu-item">
  <a href="anamnese.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bx-capsule red"></i>
    <div data-i18n="Layouts" class="azul">Anamnese</div>
  </a>

  <a href="atestado.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bx-cabinet red"></i>
    <div data-i18n="User interface"  class="azul" >Atestados</div>
  </a>

  <a href="vacina.php" class="menu-link ">
    <i class="menu-icon tf-icons bx bxs-virus red"></i>
    <div data-i18n="User interface"  class="azul" >Vacinas</div>
  </a>

  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-plus-medical red"></i>
      <div data-i18n="Authentications" class="azul">Consulta</div>
    </a>

    <ul class="menu-sub">
      <li class="menu-item">
        <a href="consulta_aluno.php" class="menu-link" target="_blank">
          <div data-i18n="Basic" class="azul">Aluno</div>
        </a>
      </li>
      
      <li class="menu-item">
        <a href="consulta_anamnese.php" class="menu-link" target="_blank">
          <div data-i18n="Basic" class="azul">Anamnese</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="consulta_soap.php" class="menu-link" target="_blank" style="color:#017EC3;">
          <div data-i18n="Basic" class="azul">SOAP</div>
        </a>
      </li>
    </ul>
  </li>
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
      <i class="menu-icon tf-icons bx bxs-band-aid"></i>
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
       <h4 class="fw-bold py-3 mb-4 azul-marinho">Gerenciamento Turma</h4>

 <!-- Inicio Barra Pesquisa-->      
         <div class="navbar-nav align-items-left" >
            <div class="nav-item d-flex align-items-left pesquisa" style="margin:20px;width:300px;">
              
              <i class="bx bx-search fs-3 lh-0 pesquisa " style="margin: 3px;"></i>
              <input type="text" class="form-control border-0 shadow-none"  placeholder="Pesquise" aria-label="Pesquise"  />
          
              </div>
                </div>
 

<!-- Inicio da Tabela -->
  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
<!-- Cabeçalho da Tabela -->
    <thead>
      <tr>

         <th style="color:#2B5AAD;;font-weight:bold;">Nome</th>
        <th style="color:#2B5AAD;;font-weight:bold;">Editar</th>
        <th style="color:#2B5AAD;;font-weight:bold;">Excluir</th>
        
      </tr>
        </thead>

<!-- Corpo da Tabela -->
<tbody class="table-border-bottom-0 gray">

<tr>

<td>
  <i class="fab fa-angular fa-lg text-danger me-3"></i> 
  <strong>Danilo Escobar</strong>
</td>


<!--Incio Modal Editar-->
 <td>

<button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#editar" style="background-color:#cdf3fb;border:none">
  <i class="bx bx-edit-alt" ></i>
 </button>

 <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


<div class="modal-header">
  <h5 class="modal-title azul-marinho" id="exampleModalLabel1">Cadastro Turma</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"style="background-color:#F14349;"></button>
      </div>

<div class="modal-body">

<div class="row">
  <div class="col mb-3">
   <label for="nameBasic" class="form-label">Nome</label>
    <input type="text" id="nameBasic" class="form-control" value="" /> 
    </div>
      </div>
          </div>
      
<div class="modal-footer">
<button type="button" class="btn btn-outline-secondary botao-red" data-bs-dismiss="modal" style="background-color:#F14349;color: white;">Cancelar </button>

 <button type="button" class="btn btn-primary azul" style="background-color:#2B5AAD">Editar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </td>

                    
<!-- Inicio Modal Excluir--> 
<td>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluir" style="background-color:#cdf3fb;border:none">
  <i class="bx bx-trash-alt"  ></i>
</button>

<div class="modal fade" id="excluir" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title azul-marinho" id="exampleModalLabel1">Cadastro Turma</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#F14349;" ></button>
          </div>

<div class="modal-body">
  <div class="alert alert-danger" role="alert">Tem certeza que deseja excluir?</div>
   </div>

<div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"   style="background-color:#F14349;color: white;">
    Excluir 
  </button>

  <button type="button" class="btn btn-primary"   style="background-color:#2B5AAD">
    Cancelar
  </button>
     </div>
        </div>
          </div>
            </div>
              </div>
                </div>
 </td>
    </tr>
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
           <h5 class="modal-title azul-marinho" id="exampleModalLabel1">Cadastro Turma</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"style="background-color:#F14349;"></button>
                    </div>

<div class="modal-body">

<div class="row">
  <div class="col mb-3">
<form action="/src/dao/TurmaDaoMySql.php" method="post"  enctype="multipart/form-data">
    <label for="nameBasic" class="form-label">Nome</label>
    <input type="text" id="nome" class="form-control" placeholder="Informe o nome completo do adiministrador" />
</form>
      </div>
        </div>

              </div>

<div class="modal-footer">

<button type="button" class="btn btn-outline-secondary botao-red" data-bs-dismiss="modal" style="background-color:#F14349;color: white;" >
  Cancelar 
    </button>
<button type="button" class="btn btn-primary azul" style="background-color:#2B5AAD">
  Salvar
    </button>
        </div>
          </div>
            </div>
              </div>
            </div>
          </div>

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
