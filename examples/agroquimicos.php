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
   header('location:../php/logout1.php');
 }
// ############################################################# 
}else{
  header('location:../login.php');
}

$_SESSION['saber'] = false;

if (isset($_POST['cargar'])) {
 $_SESSION['saber'] = true;  
}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
        <meta name="author" content="Creative Tim">
        <title>Agrosyst</title>
        <!-- Favicon -->
        <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../assets/css/scrollbar.css">
        <!-- Argon CSS -->
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
        <!-- jquery -->
        <script src="../assets/jquery/jquery-3.4.1.min.js"></script>
        <!-- sweet_alert -->
        <script src="../assets/sweetalert/sweetalert.min.js"></script>
        <!-- toastr -->
        <script src="../assets/toastr/toastr.min.js"></script>
        <link type="text/css" href="../assets/toastr/toastr.css" rel="stylesheet">
    </head>

    <body>
        <!-- Sidenav -->
        <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white " id="sidenav-main">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                    aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand pt-0" href="../home.php">
                    <img src="../assets/img/brand/agrosyst.gif" class="navbar-brand-img" alt="...">
                </a>
                <!-- User -->
                <!-- User -->
                <ul class="nav align-items-center d-md-none" id="actions-sm-scr">

                </ul>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Collapse header -->
                    <div class="navbar-collapse-header d-md-none">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="../index.html">
                                    <img src="../assets/img/brand/agrosyst.gif">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#sidenav-collapse-main" aria-controls="sidenav-main"
                                    aria-expanded="false" aria-label="Toggle sidenav">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Navigation -->
                    <div id="menu">

                    </div>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="main-content">
            <!-- Top navbar -->
            <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <?php 
                      require '../php/conexion.php';
                      $ide_ter= $_SESSION['ide_finca'];
                      $sql="SELECT fincas.cod_fin,fincas.nom_fin,fincas.det_fin,departamento.nom_dep,municipio.nom_mun,
                      fincas.med_fin,unidad_de_medida.des_unm,terceros.ide_ter,terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter
                      FROM public.fincas, public.departamento, public.unidad_de_medida, public.terceros, 
                      public.municipio, public.dueño, public.tipo_unidad_medida
                      WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
                      AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
                      AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter and fincas.cod_fin='$ide_ter'";
                      $result=pg_query($conexion,$sql);
                      $finca=pg_fetch_row($result);
                    ?>
                    <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i
                            class="fas fa-angle-right"></i> Agroquímicos</a>
                    <!-- Form -->
                    <form class="navbar-search navbar-search-dark form-inline mr-3 d-md-flex ml-lg-auto">
                        <div class="form-group mb-0" id="date-hour">
                        </div>
                    </form>
                    <!-- User -->
                    <ul class="navbar-nav align-items-center d-none d-md-flex" id="actions-lg-scr">

                    </ul>
                </div>
            </nav>
            <!-- Header -->
            <div class="header pb-8 pt-5 pt-md-8"
                style="background: url('../assets/img/theme/compras.jpg'); no-repeat; background-size: cover;">
                <span class="mask bg-gradient-opaco opacity-8"></span>
                <!--END HEADER-->
                <!----------------------------------Ingresar agroquimicos------------------------------>
                <div class="containter-fluid" id="crear_agroq">

                </div> 
            </div>
            
            <!-- Page content -->

            <div class="container-fluid mt--7">
                <!-- modal para ingresar datos -->
                <!-- Div Formulario Agregar Datos-->

                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <strong text>Lista de agroquímicos</strong>
                            </div>
                            <div class="table-responsive" id="tab_agroquimicos">

                            </div>
                            <div style="display: flex; justify-content: center;" id="div-btn-add" name="div-btn-add">
                                <button id="bt-add-agr" name="bt-add-agr" class="btn btn-success"
                                    onclick="cargarAgro()">Agregar</button>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="row align-items-center justify-content-xl-between">
                        <div class="col-xl-6">
                            <div class="copyright text-center text-xl-left text-muted">
                                &copy; 2019 <a href="#" class="font-weight-bold ml-1" target="_blank">Agrosyst</a>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                                <li class="nav-item">
                                    <a href="#" class="nav-link" target="_blank">Ver manual</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" target="_blank">Sobre nosotros</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Argon Scripts -->
        <!-- Core -->
        <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Argon JS -->
        <script src="../assets/js/argon.js?v=1.0.0"></script>
        <!-- funciones -->
        <script src="../js/funciones_agroquimicos.js"></script>

    </body>
    <script type="text/javascript">


    </script>

</html>