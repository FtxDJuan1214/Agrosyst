<?php
session_start();
if (isset($_SESSION['usuario'])) { 
 // comprobación de dias de logueo ###########################
  date_default_timezone_set('America/Bogota');
  $d = date("d");
  $m = date("m");
  $y = date("Y");
  $fecha_act=$y."-".$m."-".$d;

  function calcularTiempo($fi,$ff){
    $fecha1= date_create($fi);
    $fecha2= date_create($ff);
    $intervalo= date_diff($fecha1,$fecha2);

    $tiempo=array();
    foreach ($intervalo as $valor) {
      $tiempo[]=$valor;
    }

    return $tiempo;
  }

  $datos = calcularTiempo($_SESSION['fecha_log'],$fecha_act);

  if ($datos[2] != 0) {
   header('location:php/logout1.php');
 }
// #############################################################
}else{
  header('location:login.php');
}
?>

<?php 
require 'php/conexion.php';
$ide_ter= $_SESSION['ide_finca'];
$sql2="SELECT fincas.cod_fin,fincas.nom_fin,fincas.det_fin,departamento.cod_dep,departamento.nom_dep,municipio.cod_mun,municipio.nom_mun,
fincas.med_fin,unidad_de_medida.cod_unm,unidad_de_medida.des_unm,terceros.ide_ter,terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter,fincas.fot_fin
FROM public.fincas, public.departamento, public.unidad_de_medida, public.terceros, 
public.municipio, public.dueño, public.tipo_unidad_medida
WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter and fincas.cod_fin='$ide_ter'";
$r=pg_query($conexion,$sql2);
$vere=pg_fetch_row($r);
$datos=$vere[0]."||".$vere[1]."||".$vere[2]."||".$vere[3]."||".$vere[4]."||".
$vere[5]."||".$vere[6]."||".$vere[7]."||".$vere[8]."||".$vere[9]."||".
$vere[10]."||".$vere[11]."||".$vere[12]."||".$vere[13]."||".$vere[14]."||".$vere[15];
?>


<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Agrosyst</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- jquery -->
  <script src="assets/jquery/jquery-3.4.1.min.js"></script>
  <!-- sweet_alert -->
  <script src="assets/sweetalert/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/scrollbar.css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white " id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="index.php">
        <img src="assets/img/brand/agrosyst.gif" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.png">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Acciones!</h6>
            </div>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Mi Perfil</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="index.php">
                <img src="assets/img/brand/agrosyst.gif">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav headroom">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="fas fa-home" style="color: #2dce8a;"></i> Inicio
            </a>
          </li>
        </ul>
        <ul class="navbar-nav headroom">
          <li class="nav-item">
            <a class="nav-link" href="examples/terceros.php">
              <i class="fas fa-users" style="color: #2dce8a;"></i> Terceros
            </a>
          </li>
        </ul>
        <ul class="navbar-nav">
         <li class="nav-item">
          <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
            <i class="fas fa-map" style="color: #2dce8a;"></i>
            <span class="nav-link-text">Terrenos</span>
          </a>
          <div class="collapse" id="navbar-dashboards">
            <ul class="nav nav-sm flex-column">
              <!-- <li class="nav-item">
                <a href="examples/fincas.php" class="nav-link">Finca</a>
              </li> -->
              <li class="nav-item">
                <a href="examples/lotes.php" class="nav-link">Lotes</a>
              </li>
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modal-form-ed" class="nav-link" onclick="llenarform('<?php echo $datos ?>');" >Editar Finca</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav headroom">
        <li class="nav-item">
          <a class="nav-link" href="examples/cultivos.php">
            <i class="fas fa-spa" style="color: #2dce8a;"></i>Cultivos
          </a>
        </li>
      </ul>
      <ul class="navbar-nav headroom">
        <li class="nav-item">
          <a class="nav-link" href="examples/convenios.php">
            <i class="fas fa-handshake" style="color: #2dce8a;"></i>Convenios
          </a>
        </li>
      </ul>
      <ul class="navbar-nav">
       <li class="nav-item">
        <a class="nav-link" href="#navbar-dashboards1" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards1">
          <i class="fas fa-map" style="color: #2dce8a;"></i>
          <span class="nav-link-text">Insumos</span>
        </a>
        <div class="collapse" id="navbar-dashboards1">
          <ul class="nav nav-sm flex-column">
            <li class="nav-item">
              <a href="examples/semillas.php" class="nav-link">Semillas</a>
            </li>              
          </ul>
        </div>
        <div class="collapse" id="navbar-dashboards1">
          <ul class="nav nav-sm flex-column">
            <li class="nav-item">
              <a href="examples/semilleros.php" class="nav-link">Semilleros</a>
            </li>              
          </ul>
        </div>
        <div class="collapse" id="navbar-dashboards1">
          <ul class="nav nav-sm flex-column">
            <li class="nav-item">
              <a href="examples/agroquimicos.php" class="nav-link">Agroquímicos</a>
            </li>              
          </ul>
        </div>
        <div class="collapse" id="navbar-dashboards1">
          <ul class="nav nav-sm flex-column">
            <li class="nav-item">
              <a href="examples/otros.php" class="nav-link">Otros</a>
            </li>              
          </ul>
        </div>
      </li>
    </ul>

    <ul class="navbar-nav">
     <li class="nav-item">
      <a class="nav-link" href="#navbar-dashboards2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards2">
        <i class="fas fa-boxes" style="color: #2dce8a;"></i>
        <span class="nav-link-text">Bodega</span>
      </a>
      <div class="collapse" id="navbar-dashboards2">
        <ul class="nav nav-sm flex-column">
          <li class="nav-item">
            <a class="nav-link" href="examples/compras.php">Compras</a>
          </li>
        </ul>
      </div>
      <div class="collapse" id="navbar-dashboards2">
        <ul class="nav nav-sm flex-column">
          <li class="nav-item">
            <a class="nav-link" href="examples/stock.php">Stock</a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
  <ul class="navbar-nav">
   <li class="nav-item">
    <a class="nav-link" href="#navbar-dashboards3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards3">
      <i class="fas fa-map" style="color: #2dce8a;"></i>
      <span class="nav-link-text">Actividades</span>
    </a>
    <div class="collapse" id="navbar-dashboards3">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a href="examples/labores.php" class="nav-link">Labores</a>
        </li>              
      </ul>
    </div>
    <div class="collapse" id="navbar-dashboards3">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a href="examples/actividades.php" class="nav-link">Tareas</a>
        </li>              
      </ul>
    </div>
  </li>
</ul>
<ul class="navbar-nav">
 <li class="nav-item">
  <a class="nav-link" href="#navbar-dashboards4" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards4">
    <i class="fas fa-lemon" style="color: #2dce8a;"></i>
    <span class="nav-link-text">Producción</span>
  </a>
  <div class="collapse" id="navbar-dashboards4">
    <ul class="nav nav-sm flex-column">
      <li class="nav-item">
        <a href="examples/tipo_produccion.php" class="nav-link">Tipos de dproducción</a>
      </li>              
    </ul>
  </div>
  <div class="collapse" id="navbar-dashboards4">
    <ul class="nav nav-sm flex-column">
      <li class="nav-item">
        <a href="examples/produccion.php" class="nav-link">Producción</a>
      </li>              
    </ul>
  </div>
</li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="index.php">
     <i class="fas fa-retweet"></i> Cambiar finca
   </a>
 </li>
 <li class="nav-item">
  <a class="nav-link" href="php/logout.php">
    <i class="ni ni-spaceship"></i> logout
  </a>
</li>
</ul>
</div>
</div>
</nav>

<!-- Main content -->
<div class="main-content">
  <!-- Top navbar -->
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <form class="navbar-search navbar-search-dark form-inline mr-3 d-md-flex ml-lg-auto">
        <div class="form-group mb-0" id="date-hour">
        </div>
      </form>
      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.png">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">Administrador</span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Bienvenido!</h6>
            </div>
            <a  id="ver1"href="#" class="dropdown-item" onclick="cerrar_menu();">
              <i class="ni ni-align-left-2"></i>
              <span>Cerrar menu</span>
            </a>
            <a id="ver2" href="" class="dropdown-item">
              <i class="ni ni-align-left-2"></i>
              <span>Ver menu</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Mi Perfil</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Header -->
  <div class="header pb-8 pt-5 d-flex align-items-center" style="min-height: 600px; background-image: url(imagenes/<?php echo $vere[15]?>); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-opaco opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class=" col-md-12">
          <h1 class="display-2 text-white"> BIENVENIDO <br> Finca: <?php echo strtoupper($vere[1])?></h1>
          <a href="#!" data-toggle="modal" data-target="#modal-form-ed" class="btn btn-info" onclick="llenarform('<?php echo $datos ?>');">Editar finca</a>
        </div>
      </div>
    </div>
  </div>
  <a href="javascript:pruebaDivAPdf()" class="button">Pasar a PDF</a>
  <div class="container-fluid mt--6" id="imprimir">
    <div class="row">
      <div class="col-xl-8 mb-5 mb-xl-0">
        <div class="card bg-gradient-default shadow">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                <h2 class="text-white mb-0">Sales value</h2>
              </div>
              <div class="col">
                <ul class="nav nav-pills justify-content-end">
                  <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update="{&quot;data&quot;:{&quot;datasets&quot;:[{&quot;data&quot;:[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}" data-prefix="$" data-suffix="k">
                    <a href="#" class="nav-link py-2 px-3 active show" data-toggle="tab">
                      <span class="d-none d-md-block">Month</span>
                      <span class="d-md-none">M</span>
                    </a>
                  </li>
                  <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update="{&quot;data&quot;:{&quot;datasets&quot;:[{&quot;data&quot;:[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}" data-prefix="$" data-suffix="k">
                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                      <span class="d-none d-md-block">Week</span>
                      <span class="d-md-none">W</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <!-- Chart wrapper -->
            <canvas id="chart-sales" class="chart-canvas chartjs-render-monitor" width="619" height="350" style="display: block; width: 619px; height: 350px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
              <h2 class="mb-0">Total orders</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <canvas id="chart-orders" class="chart-canvas chartjs-render-monitor" width="270" height="350" style="display: block; width: 270px; height: 350px;"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-4">
    <!-- Members list group card -->
    <div class="card">
      <!-- Card header -->
      <div class="card-header">
        <!-- Title -->
        <h5 class="h3 mb-0">Team m-800x800embers</h5>
      </div>
      <!-- Card body -->
      <div class="card-body">
        <!-- List group -->
        <ul class="list-group list-group-flush list my--3">
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                </a>
              </div>
              <div class="col ml--2">
                <h4 class="mb-0">
                  <a href="#!">John Michael</a>
                </h4>
                <span class="text-success">●</span>
                <small>Online</small>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-primary">Add</button>
              </div>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                </a>
              </div>
              <div class="col ml--2">
                <h4 class="mb-0">
                  <a href="#!">Alex Smith</a>
                </h4>
                <span class="text-warning">●</span>
                <small>In a meeting</small>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-primary">Add</button>
              </div>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                </a>
              </div>
              <div class="col ml--2">
                <h4 class="mb-0">
                  <a href="#!">Samantha Ivy</a>
                </h4>
                <span class="text-danger">●</span>
                <small>Offline</small>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-primary">Add</button>
              </div>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                </a>
              </div>
              <div class="col ml--2">
                <h4 class="mb-0">
                  <a href="#!">John Michael</a>
                </h4>
                <span class="text-success">●</span>
                <small>Online</small>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-primary">Add</button>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <!-- Checklist -->
    <div class="card">
      <!-- Card header -->
      <div class="card-header">
        <!-- Title -->
        <h5 class="h3 mb-0">To do list</h5>
      </div>
      <!-- Card body -->
      <div class="card-body p-0">
        <!-- List group -->
        <ul class="list-group list-group-flush" data-toggle="checklist">
          <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
            <div class="checklist-item checklist-item-success checklist-item-checked">
              <div class="checklist-info">
                <h5 class="checklist-title mb-0">Call with Dave</h5>
                <small>10:30 AM</small>
              </div>
              <div>
                <div class="custom-control custom-checkbox custom-checkbox-success">
                  <input class="custom-control-input" id="chk-todo-task-1" type="checkbox" checked="">
                  <label class="custom-control-label" for="chk-todo-task-1"></label>
                </div>
              </div>
            </div>
          </li>
          <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
            <div class="checklist-item checklist-item-warning">
              <div class="checklist-info">
                <h5 class="checklist-title mb-0">Lunch meeting</h5>
                <small>10:30 AM</small>
              </div>
              <div>
                <div class="custom-control custom-checkbox custom-checkbox-warning">
                  <input class="custom-control-input" id="chk-todo-task-2" type="checkbox">
                  <label class="custom-control-label" for="chk-todo-task-2"></label>
                </div>
              </div>
            </div>
          </li>
          <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
            <div class="checklist-item checklist-item-info">
              <div class="checklist-info">
                <h5 class="checklist-title mb-0">Argon Dashboard Launch</h5>
                <small>10:30 AM</small>
              </div>
              <div>
                <div class="custom-control custom-checkbox custom-checkbox-info">
                  <input class="custom-control-input" id="chk-todo-task-3" type="checkbox">
                  <label class="custom-control-label" for="chk-todo-task-3"></label>
                </div>
              </div>
            </div>
          </li>
          <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
            <div class="checklist-item checklist-item-danger checklist-item-checked">
              <div class="checklist-info">
                <h5 class="checklist-title mb-0">Winter Hackaton</h5>
                <small>10:30 AM</small>
              </div>
              <div>
                <div class="custom-control custom-checkbox custom-checkbox-danger">
                  <input class="custom-control-input" id="chk-todo-task-4" type="checkbox" checked="">
                  <label class="custom-control-label" for="chk-todo-task-4"></label>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <!-- Progress track -->
    <div class="card">
      <!-- Card header -->
      <div class="card-header">
        <!-- Title -->
        <h5 class="h3 mb-0">Progress track</h5>
      </div>
      <!-- Card body -->
      <div class="card-body">
        <!-- List group -->
        <ul class="list-group list-group-flush list my--3">
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/bootstrap.jpg">
                </a>
              </div>
              <div class="col">
                <h5>Argon Design System</h5>
                <div class="progress progress-xs mb-0">
                  <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/angular.jpg">
                </a>
              </div>
              <div class="col">
                <h5>Angular Now UI Kit PRO</h5>
                <div class="progress progress-xs mb-0">
                  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/sketch.jpg">
                </a>
              </div>
              <div class="col">
                <h5>Black Dashboard</h5>
                <div class="progress progress-xs mb-0">
                  <div class="progress-bar bg-red" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="row align-items-center">
              <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar rounded-circle">
                  <img alt="Image placeholder" src="assets/img/theme/react.jpg">
                </a>
              </div>
              <div class="col">
                <h5>React Material Dashboard</h5>
                <div class="progress progress-xs mb-0">
                  <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-5">
    <div class="card">
      <div class="card-header">
        <h5 class="h3 mb-0">Activity feed</h5>
      </div>
      <div class="card-header d-flex align-items-center">
        <div class="d-flex align-items-center">
          <a href="#">
            <img src="assets/img/theme/team-1-800x800.jpg" class="avatar">
          </a>
          <div class="mx-3">
            <a href="#" class="text-dark font-weight-600 text-sm">John Snow</a>
            <small class="d-block text-muted">3 days ago</small>
          </div>
        </div>
        <div class="text-right ml-auto">
          <button type="button" class="btn btn-sm btn-primary btn-icon">
            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
            <span class="btn-inner--text">Follow</span>
          </button>
        </div>
      </div>
      <div class="card-body">
        <p class="mb-4">
          Personal profiles are the perfect way for you to grab their attention and persuade recruiters to continue reading your CV because you’re telling them from the off exactly why they should hire you.
        </p>
        <img alt="Image placeholder" src="assets/img/theme/germinando.jpg" class="img-fluid rounded">
        <div class="row align-items-center my-3 pb-3 border-bottom">
          <div class="col-sm-6">
            <div class="icon-actions">
              <a href="#" class="like active">
                <i class="ni ni-like-2"></i>
                <span class="text-muted">150</span>
              </a>
              <a href="#">
                <i class="ni ni-chat-round"></i>
                <span class="text-muted">36</span>
              </a>
              <a href="#">
                <i class="ni ni-curved-next"></i>
                <span class="text-muted">12</span>
              </a>
            </div>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <div class="d-flex align-items-center justify-content-sm-end">
              <div class="avatar-group">
                <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland">
                  <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg" class="">
                </a>
                <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Audrey Love">
                  <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg" class="rounded-circle">
                </a>
                <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis">
                  <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg" class="rounded-circle">
                </a>
              </div>
              <small class="pl-2 font-weight-bold">and 30+ more</small>
            </div>
          </div>
        </div>
        <!-- Comments -->
        <div class="mb-1">
          <div class="media media-comment">
            <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="assets/img/theme/team-1-800x800.jpg">
            <div class="media-body">
              <div class="media-comment-text">
                <h6 class="h5 mt-0">Michael Lewis</h6>
                <p class="text-sm lh-160">Cras sit amet nibh libero nulla vel metus scelerisque ante sollicitudin. Cras purus odio vestibulum in vulputate viverra turpis.</p>
                <div class="icon-actions">
                  <a href="#" class="like active">
                    <i class="ni ni-like-2"></i>
                    <span class="text-muted">3 likes</span>
                  </a>
                  <a href="#">
                    <i class="ni ni-curved-next"></i>
                    <span class="text-muted">2 shares</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="media media-comment">
            <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="assets/img/theme/team-2-800x800.jpg">
            <div class="media-body">
              <div class="media-comment-text">
                <h6 class="h5 mt-0">Jessica Stones</h6>
                <p class="text-sm lh-160">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                <div class="icon-actions">
                  <a href="#" class="like active">
                    <i class="ni ni-like-2"></i>
                    <span class="text-muted">10 likes</span>
                  </a>
                  <a href="#">
                    <i class="ni ni-curved-next"></i>
                    <span class="text-muted">1 share</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="media align-items-center">
            <img alt="Image placeholder" class="avatar avatar-lg rounded-circle mr-4" src="assets/img/theme/team-3-800x800.jpg">
            <div class="media-body">
              <form>
                <textarea class="form-control" placeholder="Write your comment" rows="1"></textarea>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-7">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">Light table</h3>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">Project</th>
                  <th scope="col" class="sort" data-sort="budget">Budget</th>
                  <th scope="col" class="sort" data-sort="status">Status</th>
                  <th scope="col">Users</th>
                  <th scope="col" class="sort" data-sort="completion">Completion</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody class="list">
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/bootstrap.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Argon Design System</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2500 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-warning"></i>
                      <span class="status">pending</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">60%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/angular.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Angular Now UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $1800 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/sketch.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Black Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $3150 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-danger"></i>
                      <span class="status">delayed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">72%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/react.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">React Material Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $4400 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-info"></i>
                      <span class="status">on schedule</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">90%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/vue.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Vue Paper UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2200 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/bootstrap.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Argon Design System</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2500 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-warning"></i>
                      <span class="status">pending</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">60%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/angular.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Angular Now UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $1800 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/sketch.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Black Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $3150 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-danger"></i>
                      <span class="status">delayed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">72%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="assets/img/theme/angular.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Angular Now UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $1800 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="assets/img/theme/team-2-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="assets/img/theme/team-3-800x800.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card-deck">
      <div class="card bg-gradient-default">
        <div class="card-body">
          <div class="mb-2">
            <sup class="text-white">$</sup> <span class="h2 text-white">3,300</span>
            <div class="text-light mt-2 text-sm">Your current balance</div>
            <div>
              <span class="text-success font-weight-600">+ 15%</span> <span class="text-light">($250)</span>
            </div>
          </div>
          <button class="btn btn-sm btn-block btn-neutral">Add credit</button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <small class="text-light">Orders: 60%</small>
              <div class="progress progress-xs my-2">
                <div class="progress-bar bg-success" style="width: 60%"></div>
              </div>
            </div>
            <div class="col"><small class="text-light">Sales: 40%</small>
              <div class="progress progress-xs my-2">
                <div class="progress-bar bg-warning" style="width: 40%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Username card -->
      <div class="card bg-gradient-danger">
        <!-- Card body -->
        <div class="card-body">
          <div class="row justify-content-between align-items-center">
            <div class="col">
              <i class="fas fa-money-bill-alt" style="color:green; font-size:32px;"></i>
            </div>
            <div class="col-auto">
              <span class="badge badge-lg badge-success">Active</span>
            </div>
          </div>
          <div class="my-4">
            <span class="h6 surtitle text-light">
              Username
            </span>
            <div class="h1 text-white">@johnsnow</div>
          </div>
          <div class="row">
            <div class="col">
              <span class="h6 surtitle text-light">Name</span>
              <span class="d-block h3 text-white">John Snow</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-8">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Page visits</h3>
          </div>
          <div class="col text-right">
            <a href="#!" class="btn btn-sm btn-primary">See all</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Page name</th>
              <th scope="col">Visitors</th>
              <th scope="col">Unique users</th>
              <th scope="col">Bounce rate</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                /argon/
              </th>
              <td>
                4,569
              </td>
              <td>
                340
              </td>
              <td>
                <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
              </td>
            </tr>
            <tr>
              <th scope="row">
                /argon/index.html
              </th>
              <td>
                3,985
              </td>
              <td>
                319
              </td>
              <td>
                <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
              </td>
            </tr>
            <tr>
              <th scope="row">
                /argon/charts.html
              </th>
              <td>
                3,513
              </td>
              <td>
                294
              </td>
              <td>
                <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
              </td>
            </tr>
            <tr>
              <th scope="row">
                /argon/tables.html
              </th>
              <td>
                2,050
              </td>
              <td>
                147
              </td>
              <td>
                <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
              </td>
            </tr>
            <tr>
              <th scope="row">
                /argon/profile.html
              </th>
              <td>
                1,795
              </td>
              <td>
                190
              </td>
              <td>
                <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Social traffic</h3>
          </div>
          <div class="col text-right">
            <a href="#!" class="btn btn-sm btn-primary">See all</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Referral</th>
              <th scope="col">Visitors</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                Facebook
              </th>
              <td>
                1,480
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">60%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                Facebook
              </th>
              <td>
                5,480
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">70%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                Google
              </th>
              <td>
                4,807
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">80%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                Instagram
              </th>
              <td>
                3,678
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">75%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                twitter
              </th>
              <td>
                2,645
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">30%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
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
</div>
<!-- Footer -->
<footer class="footer pt-0">
  <div class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6">
      <div class="copyright text-center text-lg-left text-muted">
        © 2019 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
      </div>
    </div>
    <div class="col-lg-6">
      <ul class="nav nav-footer justify-content-center justify-content-lg-end">
        <li class="nav-item">
          <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
        </li>
        <li class="nav-item">
          <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
        </li>
        <li class="nav-item">
          <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
        </li>
        <li class="nav-item">
          <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
        </li>
      </ul>
    </div>
  </div>
</footer>
</div>

<!-- modal para editar datos -->

<div class="col-md-4">
  <div class="modal fade" id="modal-form-ed" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card bg-secondary shadow border-0">
            <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
              <span aria-hidden="true" style="left: 0;">×</span>
            </a>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h2>Editar Finca</h2>
              </div>
              <form id="form-up-fin" method="POST" enctype="multipart/form-data">

               <div class="row">
                 <div class="col-md-6">

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative" style="display: none;">
                      <input id="fin_cod_up" name="fin_cod_up" type="text" class="form-control" placeholder="Nombre" readonly autocomplete="off" >
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <input id="cod_ver" name="cod_ver" type="text" class="form-control" placeholder="Nombre" readonly autocomplete="off" >
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <input id="nom_finup" name="nom_finup" type="text" class="form-control" placeholder="Nombre" autocomplete="off" >
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <textarea id="det_finup" name="det_finup" class="form-control" rows="1"></textarea>
                    </div>
                  </div>



                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                     <select id="dep_finup" name="dep_finup" class="form-control"data-live-search="true">
                      <option value=""  selected>Selecciona un departamento</option>
                      <?php 
                      $query="SELECT cod_dep,nom_dep FROM departamento";
                      $result =pg_query($conexion,$query);
                      while ($ver=pg_fetch_row($result)) {
                       ?>
                       <option value="<?php echo intval($ver[0]); ?>"><?php echo $ver[1]; ?></option>
                       <?php 
                     }
                     ?>
                   </select>
                 </div>
               </div>    
             </div>

             <div class="col-md-6">

               <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                  <select id="mun_fin_up" name="mun_fin_up" class="form-control"data-live-search="true">
                    <option  value="" >Selecciona municipio</option>
                    <?php 
                    $query="SELECT cod_mun,nom_mun FROM municipio";
                    $result =pg_query($conexion,$query);
                    while ($ver=pg_fetch_row($result)) {
                     ?>
                     <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
                     <?php 
                   }
                   ?>
                 </select>
               </div>
             </div>

             <div class="form-group mb-3">
              <div class="input-group input-group-alternative">
                <select id="ide_ter_up" name="ide_ter_up" class="form-control"data-live-search="true">
                  <option  value="" >Selecciona dueño</option>
                  <?php 
                  $like = $_SESSION['idusuario'];
                  $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter FROM public.terceros INNER JOIN dueño ON terceros.ide_ter=dueño.ide_ter where terceros.ide_ter LIKE '$like%'";
                  $result =pg_query($conexion,$query);
                  while ($ver=pg_fetch_row($result)) {
                   ?>
                   <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]." ".$ver[2]." ".$ver[3]." ".$ver[4]; ?></option>
                   <?php 
                 }
                 ?>
               </select>
             </div>
           </div>

           <div class="form-group mb-3">
            <div class="input-group input-group-alternative">
             <select id="uni_medup" name="uni_medup" class="form-control"data-live-search="true">
              <option  value=""  selected>Selecciona Uni. de medida</option>
              <?php 
              $query="SELECT cod_unm, des_unm FROM unidad_de_medida WHERE cod_tum='1'";
              $result =pg_query($conexion,$query);
              while ($ver=pg_fetch_row($result)) {
               ?>
               <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
               <?php 
             }
             ?>
           </select>
         </div>
       </div>

       <div class="form-group mb-3">
        <div class="input-group input-group-alternative">
          <input id="med_finup" name="med_finup"type="number" class="form-control" placeholder="Medida" autocomplete="off">
        </div>

      </div>
    </div>
  </div>

  <div class="form-group mb-3">
    <div class="input-group input-group-alternative">
      <input style="display: none;" id="nom_fot" name="nom_fot" type="text" class="form-control" placeholder="Foto" autocomplete="off">
    </div>
  </div>

  <div class="form-group mb-3">
    <label for="Logo_Semillero">Foto de la finca:     </label><br>
    <input id="foto_fin_up" name="foto_fin_up" type="file" class="validate" autocomplete="off"  accept="image/*">
  </div>

  <input style="display: none;" type="text" id="result">

  <div class="text-center">
    <button type="button" class="btn btn-default my-4" id="btn_up" onclick="preloaderup();">Guardar</button>
  </div>
</form>
<img src="assets/img/icons/preloader.gif" id="preloaderup" style="margin: 10px auto;">
<script>
  jQuery('#preloaderup').hide();
</script>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Footer -->
<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.0.0"></script>

<!-- div to pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<!-- funciones -->
<script src="js/funciones_terceros.js"></script>
<script src="js/funciones_fincas.js"></script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#date-hour').load('php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('php/componentes/menu/actions-sm-scr.php');
    jQuery('#ver2').hide();
  });
</script>
<script>
  function cerrar_menu(){
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
  }
</script>

<script>
  function pruebaDivAPdf() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#imprimir')[0];

    specialElementHandlers = {
      '#bypassme': function (element, renderer) {
        return true
      }
    };
    margins = {
      top: 80,
      bottom: 60,
      left: 40,
      width: 522
    };

    pdf.fromHTML(
      source, 
            margins.left, // x coord
            margins.top, { // y coord
              'width': margins.width, 
              'elementHandlers': specialElementHandlers
            },

            function (dispose) {
              pdf.save('Prueba.pdf');
            }, margins
            );
  }
</script>