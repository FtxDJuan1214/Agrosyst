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
?>

<!DOCTYPE html>
<html>

<head>
<<<<<<< HEAD
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Agrosyst Co</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/css/scrollbar.css">
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- jquery -->
  <script src="../assets/jquery/jquery-3.4.1.min.js"></script>
  <!-- sweet_alert -->
  <script src="../assets/sweetalert/sweetalert.min.js"></script>
  <!-- toastr -->
  <script src="../assets/toastr/toastr.min.js"></script>
  <link type="text/css" href="../assets/toastr/toastr.css" rel="stylesheet">
=======
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
    <!-- Argon CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/scrollbar.css">
    <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
    <!-- jquery -->
    <script src="../assets/jquery/jquery-3.4.1.min.js"></script>
    <!-- sweet_alert -->
    <script src="../assets/sweetalert/sweetalert.min.js"></script>
    <!-- toastr -->
    <script src="../assets/toastr/toastr.min.js"></script>
    <link type="text/css" href="../assets/toastr/toastr.css" rel="stylesheet">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
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
                            <a href="../home.php">
                                <img src="../assets/img/brand/agrosyst.gif">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
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
        public.municipio, public.duenio, public.tipo_unidad_medida
        WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
        AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
        AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter and fincas.cod_fin='$ide_ter'";
        $result=pg_query($conexion,$sql);
        $finca=pg_fetch_row($result);
        ?>
<<<<<<< HEAD
        <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i class="fas fa-angle-right"></i> CULTIVOS</a>
        <!-- Form -->
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
    <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/cultivos.png'); no-repeat;
    background-size: cover;">
    <span class="mask bg-gradient-opaco opacity-8"></span>
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--7">
    <!-- modal para ingresar datos -->
    <div class="col-md-4">
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary shadow border-0">
                <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
                  <span aria-hidden="true" style="left: 0;">×</span>
                </a>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <h3>Crear Cultivo</h3>
                  </div>
                  <form role="form" id="form-add-cultivo">
                    <div class="row " style="margin-bottom: 10px;">
                      <div class="col-md-12 c">
                        <a style="font-size: 1em;" href="lotes.php" class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Crear lostes"><i class="fas fa-map"></i></a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div id="nombre_cultivo">
=======
                <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i
                        class="fas fa-angle-right"></i> CULTIVOS</a>
                <!-- Form -->
                <!-- Form -->
                <form class="navbar-search navbar-search-dark form-inline mr-3 d-md-flex ml-lg-auto">
                    <div class="form-group mb-0" id="date-hour">
                    </div>
                </form>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex" id="actions-lg-scr">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894

                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/cultivos.png'); no-repeat;
    background-size: cover;">
            <span class="mask bg-gradient-opaco opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <!-- modal para ingresar datos -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-secondary shadow border-0">
                                    <a href="#" data-dismiss="modal" aria-label="Close"
                                        style="margin: 10px 20px 0 0; text-align: right;">
                                        <span aria-hidden="true" style="left: 0;">×</span>
                                    </a>
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
                                            <h3>Crear Cultivo</h3>
                                        </div>
                                        <form role="form" id="form-add-cultivo">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div id="nombre_cultivo">

                                                    </div>
                                                    <div class="form-group">
                                                        <label> fecha de inicio:</label>
                                                        <div class="input-group input-group-alternative">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="ni ni-calendar-grid-58"></i></span>
                                                            </div>
                                                            <?php 
                            date_default_timezone_set('America/Bogota');
                            $d = date("d");
                            $m = date("m");
                            $y = date("Y");
                            $fecha=$y."-".$m."-".$d;

                        // $script_tz = date_default_timezone_get();

                        // if (strcmp($script_tz, ini_get('date.timezone'))){
                        //   echo 'La zona horaria del script difiere de la zona horaria de la configuracion ini.';
                        // } else {
                        //   echo 'La zona horaria del script y la zona horaria de la configuración ini coinciden.';
                        // }
                            ?>
<<<<<<< HEAD
                            <input class="form-control datepicker" id="fin_cul" placeholder="Select date" type="text" value="<?php echo $fecha?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label > fecha de Finalización:</label>
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" id="fif_cul" placeholder="Select date" type="text" value="<?php echo $fecha?>">
                          </div>
                        </div>
                        <div class="form-group mb-3">
                          <div class="input-group input-group-alternative">
                            <input id="dur_cul" type="text" class="form-control" disabled placeholder="Duración del cultivo" autocomplete="off">
                          </div>
                        </div>        
                      </div>
                      <!-- ------------------------------------ -->
                      <div class="col-sm-6">
                        <div class="form-group mb-3">
                          <div class="input-group input-group-alternative" id="div_npl_cul">
                            <input style="border-color: #fb6340;"  id="npl_cul" type="text" class="form-control" placeholder="Numero de plantas" autocomplete="off">
                          </div>
                        </div>
                        <div class="form-group mb-3">
                          <div class="input-group input-group-alternative">
                            <select id="est_cul" disabled class="form-control"data-live-search="true">
                              <option value="" disabled selected>Estado del cultivo</option>
                              <option value="1">Inicio</option>
                              <option value="2">Crecimiento</option>
                              <option value="3">Inicio afloración</option>
                              <option value="4">Maxima afloración</option>
                              <option value="5">Inicio fructificación</option>
                              <option value="6">Cosecha</option>
                              <option value="7">Finalización</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group mb-3" >
                          <div class="input-group input-group-alternative">
                            <select id="tip_cul" disabled class="form-control"data-live-search="true" >
                              <option value="" disabled selected>Tipo de cultivo</option>
                              <option value="1">Transitorio</option>
                              <option value="2">Perenne</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <div class="input-group input-group-alternative">
                            <select id="cod_lot" class="form-control"data-live-search="true">
                              <option value="" disabled selected>Selecciona lote</option>
                              <?php 
=======
                                                            <input class="form-control datepicker" id="fin_cul"
                                                                placeholder="Select date" type="text"
                                                                value="<?php echo $fecha?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label> fecha de Finalización:</label>
                                                        <div class="input-group input-group-alternative">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="ni ni-calendar-grid-58"></i></span>
                                                            </div>
                                                            <input class="form-control datepicker" id="fif_cul"
                                                                placeholder="Select date" type="text"
                                                                value="<?php echo $fecha?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <input id="dur_cul" type="text" class="form-control"
                                                                disabled placeholder="Duración del cultivo"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ------------------------------------ -->
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative"
                                                            id="div_npl_cul">
                                                            <input style="border-color: #fb6340;" id="npl_cul"
                                                                type="text" class="form-control"
                                                                placeholder="Numero de plantas" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="est_cul" class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Estado del cultivo
                                                                </option>
                                                                <option value="1">Inicio</option>
                                                                <option value="2">Crecimiento</option>
                                                                <option value="3">Produccion</option>
                                                                <option value="4">Finalización</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3" data-toggle="tooltip"
                                                        data-placement="top" title="Tipo de cultivo">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="tip_cul" disabled class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Tipo de cultivo
                                                                </option>
                                                                <option value="1">Transitorio</option>
                                                                <option value="2">Perenne</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="cod_lot" class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Selecciona lote
                                                                </option>
                                                                <?php 
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                              $codi_fin=$_SESSION['ide_finca'];
                              require '../php/conexion.php';
                              $query="SELECT cod_lot, nom_lot
                              FROM public.lotes where cod_fin='$codi_fin'";
                              $result =pg_query($conexion,$query);
                              while ($ver=pg_fetch_row($result)) {
                               ?>
                                                                <option value="<?php echo $ver[0] ?>">
                                                                    <?php echo $ver[1] ?></option>

                                                                <?php 
                             }
                             ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="mod_cul" class="form-control"
                                                                data-live-search="true" data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Aqui se especifica cuantas plantas se siembran en un mismo hueco.">
                                                                <option value="" disabled selected>Selecciona la
                                                                    modalida de siembra</option>
                                                                <option value="1">Una planta</option>
                                                                <option value="2">Dos planta</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-default my-4" id="btn_save"
                                                    onclick="preloader();">Guardar</button>
                                            </div>
                                        </form>
                                        <img src="../assets/img/icons/preloader.gif" id="preloader"
                                            style="margin: 10px auto;">
                                        <script>
                                        jQuery('#preloader').hide();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <form role="form" id="form-up-cultivo">
                  <div class="row " style="margin-bottom: 10px;">
                    <div class="col-md-12 c">
                      <a style="font-size: 1em;" href="lotes.php" class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Crear lostes"><i class="fas fa-map"></i></a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">

                      <div id="nombre_cultivo2">

                      </div>
                      <div id="fecha1"></div>
                      <div id="fecha2"></div>
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="dur_cul_up" type="text" class="form-control" disabled placeholder="Duración del cultivo" autocomplete="off">
                        </div>
                      </div>        
                    </div>
                    <!-- ------------------------------------ -->
                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative" id="div_npl_cul_up">
                          <input style="border-color: #fb6340;" id="npl_cul_up" type="text" class="form-control" placeholder="Numero de plantas" autocomplete="off">
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <select id="est_cul_up" disabled class="form-control"data-live-search="true">
                            <option value="" disabled selected>Estado del cultivo</option>
                            <option value="1">Inicio</option>
                            <option value="2">Crecimiento</option>
                            <option value="3">Inicio afloración</option>
                            <option value="4">Maxima afloración</option>
                            <option value="5">Inicio fructificación</option>
                            <option value="6">Cosecha</option>
                            <option value="7">Finalización</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <select id="tip_cul_up" disabled class="form-control"data-live-search="true" >
                            <option value="" disabled selected>Tipo de cultivo</option>
                            <option value="1">Transitorio</option>
                            <option value="2">Perenne</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <select id="cod_lot_up" class="form-control"data-live-search="true">
                            <option value="" disabled selected>Selecciona lote</option>
                            <?php 
=======
            </div>
            <!-- modal para Editar datos -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-form-up" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-secondary shadow border-0">
                                    <a href="#" data-dismiss="modal" aria-label="Close"
                                        style="margin: 10px 20px 0 0; text-align: right;">
                                        <span aria-hidden="true" style="left: 0;">×</span>
                                    </a>
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
                                            <h3>Editar Cultivo</h3>
                                        </div>
                                        <form role="form" id="form-up-cultivo">

                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <div id="nombre_cultivo2">

                                                    </div>
                                                    <div id="fecha1"></div>
                                                    <div id="fecha2"></div>
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <input id="dur_cul_up" type="text" class="form-control"
                                                                disabled placeholder="Duración del cultivo"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ------------------------------------ -->
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative"
                                                            id="div_npl_cul_up">
                                                            <input style="border-color: #fb6340;" id="npl_cul_up"
                                                                type="text" class="form-control"
                                                                placeholder="Numero de plantas" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="est_cul_up" class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Estado del cultivo
                                                                </option>
                                                                <option value="1">Inicio</option>
                                                                <option value="2">Crecimiento</option>
                                                                <option value="3">Produccion</option>
                                                                <option value="4">Finalización</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3" data-toggle="tooltip"
                                                        data-placement="top" title="Tipo de cultivo">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="tip_cul_up" disabled class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Tipo de cultivo
                                                                </option>
                                                                <option value="1">Transitorio</option>
                                                                <option value="2">Perenne</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="cod_lot_up" class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Selecciona lote
                                                                </option>
                                                                <?php 
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                            require '../php/conexion.php';
                            $query="SELECT cod_lot, nom_lot
                            FROM public.lotes where cod_fin='$codi_fin'";
                            $result =pg_query($conexion,$query);
                            while ($ver=pg_fetch_row($result)) {
                             ?>
                                                                <option value="<?php echo $ver[0] ?>">
                                                                    <?php echo $ver[1] ?></option>

                                                                <?php 
                           }
                           ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="mod_cul_up" class="form-control"
                                                                data-live-search="true" data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Aqui se especifica cuantas plantas se siembran en un mismo hueco.">
                                                                <option value="" disabled selected>Selecciona la
                                                                    modalida de siembra</option>
                                                                <option value="1">Una planta</option>
                                                                <option value="2">Dos planta</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3"
                                                        style="display: flex; justify-content: center;">
                                                        <a href="#" onclick="crud_socios();" class="btn btn-info my-4"
                                                            style="margin-top: 20px;">Socios</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-default my-4" id="btn_up"
                                                    onclick="preloaderup();">Guardar</button>
                                            </div>
                                        </form>
                                        <img src="../assets/img/icons/preloader.gif" id="preloaderup"
                                            style="margin: 10px auto;">
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

            <!-- modal para agregar nombres de cultivo -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-cultivos" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-secondary shadow border-0">
                                    <a href="#" data-dismiss="modal" aria-label="Close"
                                        style="margin: 10px 20px 0 0; text-align: right;">
                                        <span aria-hidden="true" style="left: 0;">×</span>
                                    </a>
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
                                            <h3>Crear Cultivo</h3>
                                        </div>
                                        <form role="form" id="form-nom-cultivo">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <input id="nomb_cultivo" type="text" class="form-control"
                                                                placeholder="Nombre del cultivo" autocomplete="off"
                                                                maxlength="45">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="#!" id="btn_guardar" onclick="agregar_nom_cul();"
                                                        class="btn btn-info">Añadir</a>
                                                    <a href="#!" id="btn_actualizar" onclick="actualizar_nom_cul();"
                                                        class="btn btn-info" style="font-size: 0.8rem">Actualizar</a>
                                                </div>
                                            </div>

                                        </form>
                                        <div id="cultivos">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal para socios -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-socios" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-secondary shadow border-0">
                                    <a href="#" data-dismiss="modal" aria-label="Close"
                                        style="margin: 10px 20px 0 0; text-align: right;">
                                        <span aria-hidden="true" style="left: 0;">×</span>
                                    </a>
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
                                            <h3>Socios del cultivo </h3>
                                        </div>
                                        <form role="form" id="form-crud_soc">
                                            <div class="row">
                                                <div class="col sm-9">
                                                    <div class="form-group mb-3">
                                                        <div class="input-group input-group-alternative">
                                                            <select id="cod_ter_soc" class="form-control"
                                                                data-live-search="true">
                                                                <option value="" disabled selected>Selecciona Socio
                                                                </option>
                                                                <?php 
                        $like = $_SESSION['idusuario'];
                        require '../php/conexion.php';
                        $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter FROM terceros,socio
                        where terceros.ide_ter=socio.ide_ter AND  terceros.ide_ter LIKE'$like%' ";
                        $result =pg_query($conexion,$query);
                        while ($ver=pg_fetch_row($result)) {
                         ?>
                                                                <option value="<?php echo $ver[0] ?>">
                                                                    <?php echo $ver[1]." ". $ver[2]." ". $ver[3]." ". $ver[4] ?>
                                                                </option>

                                                                <?php 
                       }
                       ?>
<<<<<<< HEAD
                       <?php 
                       $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter FROM terceros,duenio
                       where terceros.ide_ter=duenio.ide_ter AND  terceros.ide_ter LIKE'$like%'";
=======
                                                                <?php 
                       $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter FROM terceros,dueño
                       where terceros.ide_ter=dueño.ide_ter AND  terceros.ide_ter LIKE'$like%'";
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                       $result =pg_query($conexion,$query);
                       while ($ver=pg_fetch_row($result)) {
                         ?>
                                                                <option value="<?php echo $ver[0] ?>">
                                                                    <?php echo $ver[1]." ". $ver[2]." ". $ver[3]." ". $ver[4] ?>
                                                                </option>

                                                                <?php 
                       }
                       ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="#!" onclick="guardar_soc();"
                                                        class="btn btn-info">Añadir</a>
                                                </div>
                                            </div>

                                        </form>
                                        <div id="tabla_socios">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="float-md-left" style="margin-top: 5px;">
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#modal-form">Agregar</button>
                            </div>
                            <div class="float-md-right" style="margin-top: 5px;">
                                <input class="form-control" placeholder="Buscar en la tabla" id="myInput" type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="table-responsive" id="tab_cultivos">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="../js/funciones_cultivos.js"></script>
</body>

</html>