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
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
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
      <link href="../assets/fonts/fonts/material-icons.css" rel="stylesheet">
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
            <ul class="nav align-items-center d-md-none" id="actions-sm-scr">

            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="index.html">
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
                <div id="menu">

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
                <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i
                        class="fas fa-angle-right"></i> Tareas</a>
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
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-md-8"
            style="background: url('../assets/img/theme/actividades.jpg'); no-repeat; background-size: cover;">
            <span class="mask bg-gradient-opaco opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row" id="contadores">
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <input id="rr" type="email" class="form-control" placeholder="rr" autocomplete="off" style="display: none;">
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
                                            <h3>Crear Tarea</h3>
                                        </div>
                                        <form role="form" id="form-add-tarea">
                                            <div class="row">
                                                <div class="col-sm-6">                                                   
                                                    <!------------------------Primera columna----------------------------->
                                                        
                                                        <div class="form-group mb-3">
                                                            <label> Cultivo a laborar</label>
                                                            <div class="input-group input-group-alternative">
                                                                <select id="cod_cul" class="form-control"
                                                                    data-live-search="true">
                                                                    <option value="" disabled selected>Selecciona
                                                                        Cultivo</option>
                                                                    <?php 
                                                                          $codi_fin=$_SESSION['ide_finca'];
                                                                          require '../php/conexion.php';
                                                                          $query="SELECT cultivos.cod_cul, nombre_cultivo.des_ncu , lotes.nom_lot ,cultivos.npl_cul
                                                                          FROM public.fincas, public.lotes, public.cultivos, public.nombre_cultivo
                                                                          WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot
                                                                          AND nombre_cultivo.cod_ncu=cultivos.cod_ncu and fincas.cod_fin='$codi_fin'";
                                                                          $result =pg_query($conexion,$query);
                                                                          while ($ver=pg_fetch_row($result)) {
                                                                          ?>
                                                                    <option value="<?php echo $ver[0] ?>">
                                                                        <?php $array=explode("-", $ver[1]); echo $array[1]." - ".$ver[2]." - ".$ver[3]." Plantas"?>
                                                                    </option>

                                                                    <?php 
                                                                          }
                                                                          ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <div class="input-group input-group-alternative">
                                                                <select id="tipo_lab" onchange="actividad();"
                                                                    class="form-control" data-live-search="true">
                                                                    <option value="" disabled selected>Tipo de tarea
                                                                    </option>
                                                                    <option value="1">comun</option>
                                                                    <option value="3">Cultural</option>
                                                                    <option value="2">Fitosanitaria</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <div class="input-group input-group-alternative"
                                                                id="div_des_tar">
                                                                <input style="border-color: #fb6340;" id="des_tar"
                                                                    type="text" class="form-control"
                                                                    placeholder="Descripcion de la Tarea"
                                                                    autocomplete="off" maxlength="45">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <div class="input-group input-group-alternative">
                                                                <select id="cod_lab" class="form-control"
                                                                    data-live-search="true">
                                                                    <option value="" disabled selected>Selecciona Labor
                                                                    </option>
                                                                    <?php 
                                                                    $codi_fin=$_SESSION['ide_finca'];
                                                                    $like =  $_SESSION['idusuario'];
                                                                    require '../php/conexion.php';
                                                                    $query="SELECT * FROM public.labores  where det_lab LIKE '$like%'";
                                                                    $result =pg_query($conexion,$query);
                                                                    while ($ver=pg_fetch_row($result)) {
                                                                    ?>
                                                                    <option value="<?php echo $ver[0] ?>">
                                                                        <?php echo $ver[1]?></option>

                                                                    <?php 
                                                                  }
                                                                  ?>
                                                                </select>
                                                            </div>
                                                        </div>                                                     

                                                          <div class="form-group">
                                                                <label> Fecha de inicio:</label>
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
                                                                      $fecha= $y."-".$m."-".$d;
                                                                      ?>
                                                                  <input class="form-control datepicker" id="fin_tar"
                                                                        placeholder="Select date" type="text"
                                                                        value="<?php echo $fecha?>">
                                                              </div>                                                            
                                                          </div>
                                                            <div class="form-group">
                                                                <label> Fecha de Finalización:</label>
                                                                <div class="input-group input-group-alternative">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="ni ni-calendar-grid-58"></i></span>
                                                                    </div>
                                                                    <input class="form-control datepicker" id="fif_tar"
                                                                        placeholder="Select date" type="text"
                                                                        value="<?php echo $fecha?>">
                                                                </div>
                                                            </div>                                                      
                                                    
                                                </div>
                                                <!-- -------------------------Segunda columna------------------------------ -->
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <button id="btn-add-conv" class="btn btn-icon btn-3 btn-success"
                                                            type="button" disabled data-toggle="modal"
                                                            data-target="#modal-convenios" onclick="verconvenios();">
                                                            <span class="btn-inner--text">Agregar convenios a la
                                                                actividad</span>
                                                            <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-add"></i></span>
                                                        </button>

                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div id="tab_conve_agregar">
                                                        </div>

                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <button id="btn-add-ins" class="btn btn-icon btn-3 btn-success"
                                                            type="button" disabled data-toggle="modal"
                                                            data-target="#modal-insumos" onclick="verinsumos();">
                                                            <span class="btn-inner--text">Agregar insumos a la actividad
                                                            </span>
                                                            <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-add"></i></span>
                                                        </button>

                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div id="tab_insumos_agregar">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <button id="btn-add-gasto"
                                                            class="btn btn-icon btn-3 btn-success" type="button"
                                                            disabled data-toggle="modal" data-target="#modal-gastos"
                                                            onclick="cargar_soc();">
                                                            <span class="btn-inner--text">Otros gastos</span>
                                                            <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-add"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div id="tab_gastos_agregar">
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
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="row col-md-12">
                            <div class="col-md-2">
                                <div class="card-header border-0">
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#modal-form">Agregar</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-header border-0">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <select id="num_registros" class="form-control" data-live-search="true">
                                                <option value="" disabled selected>¿Cuantos registros desea ver?
                                                </option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="10000000">Todos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-header border-0">
                                    <button class="btn btn-icon btn-3 btn-success" type="button" data-toggle="modal"
                                        data-target="#modal-entre_fechas">
                                        <span class="btn-inner--icon"><i class="ni  ni-bullet-list-67"></i></span>
                                        <span class="btn-inner--text">Ver entre fechas</span>

                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-header border-0">
                                        <input class="form-control" placeholder="Buscar en la tabla" id="myInput"
                                            type="text" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="tab_lab">

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  para agregar los convenios-->
            <div class="modal fade" id="modal-convenios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row col-12">
                                <div class="col-md-12 text-center">
                                    <h2 class="modal-title centered">Efectuar convenios</h2><br>
                                </div>

                                <div class="col-sm-12">
                                    <a style="font-size: 18px;" href="convenios.php"
                                        class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip"
                                        data-placement="top" title="Crear convenios"><i
                                            class="fas fa-handshake"></i></a>


                                    <a style="font-size: 18px;" href="#" class="btn btn-info btn-sm bg-gradient-green"
                                        data-container="body" data-toggle="popover" data-placement="top"
                                        data-content="Solo se muestran los conevnios que no han sido efectuados, y que están entre las fechas de inicio y fin de esta tarea."><i
                                            class="far fa-question-circle"></i></a>
                                </div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div id="tab_conve">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Terminar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal  para agregar los insumos-->
            <div class="modal fade" id="modal-insumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document" id="modal_insumo_ver">
                    <div class="modal-content">
                        <div class="modal-header">

                            <div class="row col-12">
                                <div class="col-md-12 text-center">
                                    <h2 class="modal-title centered">Agregar insumos</h2><br>
                                </div>

                                <div class="col-sm-12">
                                    <a style="font-size: 18px;" href="compras.php"
                                        class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip"
                                        data-placement="top" title="Ir a compras"><i class="fa fa-shopping-basket"
                                            aria-hidden="true"></i></a>


                                    <a style="font-size: 18px;" href="#" class="btn btn-info btn-sm bg-gradient-green"
                                        data-container="body" data-toggle="popover" data-placement="top"
                                        data-content="Se muestran los insumos disponibles para el cultivo"><i
                                            class="far fa-question-circle"></i></a>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <div id="tab_fito">
                                <div class="modal-body">
                                    <div class="form-group mb-3">

                                        <div id="fitosanitario">
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative" id="div_enf_fit">
                                                    <select id="cod_afe" name="cod_afe" class="form-control"
                                                        data-live-search="true">
                                                        <option value="">
                                                            Seleccione la enfermedad
                                                        </option>
                                                        <?php 
                                                          $like =  $_SESSION['idusuario'];
                                                            require '../php/conexion.php';

                                                            $query="SELECT cod_afe,nom_afe FROM public.afeccion WHERE (cod_afe LIKE '$like%' or cod_afe LIKE '1-%')";
                                                            $result =pg_query($conexion,$query);
                                                            while ($ver=pg_fetch_row($result)) {
                                                            ?>
                                                        <option value="<?php echo $ver[0] ?>">
                                                            <?php echo $ver[1]?></option>

                                                        <?php 
                                                          }
                                                          ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div id="select_planificaciones" name="select_planificaciones">

                                        </div>

                                        <div id="mostrar_plan" name="mostrar_plan">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-----------------Tabla normal------------------->
                            <div id="tab_normal">
                                <div class="modal-body">
                                    <div id="tab_insumo">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Terminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-gastos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row col-12">
                                <div class="col-md-12 text-center">
                                    <h2 class="modal-title centered">Agregar otros gastos</h2><br>
                                </div>

                                <div class="col-sm-12">
                                    <a style="font-size: 18px;" href="otros.php"
                                        class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip"
                                        data-placement="top" title="Crear gastos"><i class="fa fa-money"
                                            aria-hidden="true"></i></a>

                                </div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form role="form" id="form-crud_soc">
                                <div class="row" style="display: none;">
                                    <div class="col sm-3">
                                        <div class="form-group">
                                            <?php   
                                              $sql1="SELECT cod_com FROM compras ORDER BY cod_com DESC LIMIT 1";
                                              $result=pg_query($conexion,$sql1);
                                              $cod=pg_fetch_row($result);                    
                                              ?>
                                            <input type="text" class="form-control" id="num_fact" name="num_fact"
                                                value="<?php echo "N° Factura: ".($cod[0]+1);?>" autocomplete="off"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col sm-3">
                                        <div class="form-group">
                                            <div class="input-group ">
                                                <?php 
                                                    date_default_timezone_set('America/Bogota');
                                                    $d = date("d");
                                                    $m = date("m");
                                                    $y = date("Y");
                                                    $fecha=$y."-".$m."-".$d;  
                                                    ?>
                                                <input class="form-control datepicker" id="date" name="date"
                                                    placeholder="Select date" type="text" value="<?php echo $fecha?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col sm-3">
                                        <div class="form-group">
                                            <?php $hoy = getdate();?>
                                            <input type="text" class="form-control" id="time" name="time"
                                                value="<?php echo $hoy['hours']." : ".$hoy['minutes']." : ".$hoy['seconds'] ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col sm-4">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative" id="char_soc">
                                                <select id="cod_ter_soc" class="form-control" data-live-search="true">
                                                    <option value="" disabled selected>Selecciona Socio</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col sm-3">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <select id="insumo" class="form-control" data-live-search="true">
                                                    <option value="0" disabled selected>Selecciona gasto</option>
                                                    <?php 
                                                        $codi_fin=$_SESSION['ide_finca'];
                                                        require '../php/conexion.php';
                                                        $query="SELECT insumos.cod_ins,des_ins,des_unm from public.insumos 
                                                        INNER JOIN otros ON insumos.cod_ins=otros.cod_ins
                                                        INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
                                                        where otros.det_otr LIKE '$like%' or otros.det_otr LIKE '1-%'";
                                                        $result =pg_query($conexion,$query);
                                                        while ($ver=pg_fetch_row($result)) {
                                                        ?>
                                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]?></option>

                                                    <?php 
                                                      }
                                                      ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="cos_uni" name="cos_uni" type="text" class="form-control"
                                                    placeholder="Valor" autocomplete="off">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                        <div class="float-md-right">
                                            <a href="#!" onclick="string_gastos();" class="btn btn-info">Añadir</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="tab_gastos">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Terminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  para agregar Editar-->
            <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Editar tarea </h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_tarea_up">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col 12">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <label id="tipo_tar"></label>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <div class="input-group">
                                                <input id="cod_tar_up" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <select id="cod_lab_up" class="form-control" data-live-search="true">
                                                    <option value="" disabled selected>Selecciona Labor</option>
                                                    <?php 
                                                    $codi_fin=$_SESSION['ide_finca'];
                                                    $like =  $_SESSION['idusuario'];
                                                    require '../php/conexion.php';
                                                    $query="SELECT * FROM public.labores  where det_lab LIKE '$like%'";
                                                    $result =pg_query($conexion,$query);
                                                    while ($ver=pg_fetch_row($result)) {
                                                    ?>
                                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]?></option>

                                                    <?php 
                                                      }
                                                      ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <div class="input-group">

                                                <input id="des_tare" maxlength="45" type="text"
                                                    placeholder="Descripción" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="des_tar">Fecha de inicio</label>
                                            <div class="input-group ">
                                                <input class="form-control" id="fin_tare" placeholder="Select date"
                                                    disabled type="text">
                                            </div>
                                        </div>

                                        <div id="fecha2"></div>
                                        <div class="text-right">
                                            <H2 class="text-success" id="valor"></H2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" onclick="preloaderup();">guardar</button>
                            </div>
                        </form>
                        <img src="../assets/img/icons/preloader.gif" id="preloaderup" style="margin: 10px auto;">
                        <script>
                        jQuery('#preloaderup').hide();
                        </script>
                    </div>

                </div>
            </div>

            <!-- Modal  para agregar los convenios-->
            <div class="modal fade" id="modal-convenios2" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row col-12">
                                <div class="col-md-12 text-center">
                                    <h2 class="modal-title centered">Efectuar convenios</h2><br>
                                </div>

                                <div class="col-sm-12">
                                    <a style="font-size: 18px;" href="convenios.php"
                                        class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip"
                                        data-placement="top" title="Crear convenios"><i
                                            class="fas fa-handshake"></i></a>


                                    <a style="font-size: 18px;" href="#" class="btn btn-info btn-sm bg-gradient-green"
                                        data-container="body" data-toggle="popover" data-placement="top"
                                        data-content="Solo se muestran los conevnios que no han sido efectuados, y que están entre las fechas de inicio y fin de esta tarea."><i
                                            class="far fa-question-circle"></i></a>
                                </div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div id="tab_conve2">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Terminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  para agregar los insumos-->
            <div class="modal fade" id="modal-insumos2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row col-12">
                                <div class="col-md-12 text-center">
                                    <h2 class="modal-title centered">Agregar insumos</h2><br>
                                </div>

                                <div class="col-sm-12">
                                    <a style="font-size: 18px;" href="compras.php"
                                        class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip"
                                        data-placement="top" title="Ir a compras"><i class="fa fa-shopping-basket"
                                            aria-hidden="true"></i></a>


                                    <a style="font-size: 18px;" href="#" class="btn btn-info btn-sm bg-gradient-green"
                                        data-container="body" data-toggle="popover" data-placement="top"
                                        data-content="Se muestran los insumos disponibles para el cultivo"><i
                                            class="far fa-question-circle"></i></a>
                                </div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div id="tab_insumo2">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                onclick="asociarPlan();">Terminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  para agregar los convenios-->
            <div class="modal fade" id="modal-gastos2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row col-12">
                                <div class="col-md-12 text-center">
                                    <h2 class="modal-title centered">Agregar otros gastos</h2><br>
                                </div>

                                <div class="col-sm-12">
                                    <a style="font-size: 18px;" href="otros.php"
                                        class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip"
                                        data-placement="top" title="Crear gastos"><i class="fa fa-money"
                                            aria-hidden="true"></i></a>

                                </div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="tab_gastos2">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Terminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  para filtrar por fechas -->
            <div class="modal fade" id="modal-entre_fechas" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-gradient-verde">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="py-3 text-center">
                                <i class="ni ni-calendar-grid-58" style="font-size: 4rem;"></i>
                                <h3 class="heading mt-3">Específica las fechas</h3>
                                <form>
                                    <div class="form-group center col-md-10">
                                        <label>Fecha inicial:</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="fecha_ini_filtro"
                                                placeholder="Select date" type="text" value="<?php echo $fecha?>">
                                        </div>
                                    </div>
                                    <div class="form-group center col-md-10">
                                        <label>Fecha final:</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="fecha_fin_filtro"
                                                placeholder="Select date" type="text" value="<?php echo $fecha?>">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-whiteml-auto" data-dismiss="modal"
                                onclick="Cargar_tab_fechas();">Filtrar</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer -->
            
 <!-- -------------------------------FUNCIONALIDADES FLOTANTES--------------------------------------->
  <div class="contenedor">
    <button class="botonF1">
      <span><i class="material-icons" style="margin-top: 7px;">settings</i></span>
    </button>
    <a href="#">
      <button class="flotante botonF3" data-toggle="modal" data-target="#modal-manual">
        <span><i class="material-icons bslink" data-toggle="tooltip" data-placement="left" title="" data-original-title="Ayuda" style="margin-top: 5px;">info_outline</i></span>
      </button>
    </a>
    <a href="#">
      <button class="flotante botonF2" data-toggle="modal" data-target="#modal-notification">
        <span><i  class="material-icons bslink" data-toggle="tooltip" data-placement="left" title="" data-original-title="Calculadora" style="margin-top: 5px;">exposure</i></span>
      </button>
    </a>
<!-- <button class="flotante botonF4">
  <span>+</span>
</button> -->
</div>
<!-- modal para la calculadora -->
<div class="col-md-4">
  <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content bg-gradient-opaco">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="py-3 text-center">
            <!-- <i class="ni ni-bell-55 ni-3x"></i>
              <h4 class="heading mt-4">You should read this!</h4> -->
              <div id="calculadora">

              </div>
              <button style="align-self: center;" type="button" class="btn btn-white ml-auto " data-dismiss="modal" id="limpiar">Cerrar</button>
            </div>
          </div>
          <!--    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>  -->

        </div>
      </div>
    </div>
  </div>

 <!-- modal para la información -->
  <!-- Modal -->
  <div class="modal fade" id="modal-manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content" style="border-radius: 4px;">
        <div class="float-md-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>
        <embed src="../manuales/interfaz_tareas.pdf" type="application/pdf" width="100%" height="600"/>
      </div>
    </div>
  </div>
<!------------------------------------------------------------------------- -->
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
    <script src="../js/funciones_tareas.js"></script>
</body>

</html>