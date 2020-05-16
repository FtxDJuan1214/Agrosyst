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
    <title>Agrosyst</title>
    <!-- Favicon -->
    <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/scrollbar.css">
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
<<<<<<< HEAD
          public.municipio, public.duenio, public.tipo_unidad_medida
          WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
          AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
          AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter and fincas.cod_fin='$ide_ter'";
=======
          public.municipio, public.dueño, public.tipo_unidad_medida
          WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
          AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
          AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter and fincas.cod_fin='$ide_ter'";
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
          $result=pg_query($conexion,$sql);
          $finca=pg_fetch_row($result);
          ?>
                <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i
                        class="fas fa-angle-right"></i> Ingredientes Activos</a>
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
            style="background: url('../assets/img/theme/ingredientes.jpg'); no-repeat; background-size: cover;">
            <span class="mask bg-gradient-fito opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row" style="width=50px;">
                    <br>
                    <br>
                    <br>
                    <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">

            <!-- modal para ingresar datos -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-secondary shadow border-0">
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
<<<<<<< HEAD
                                            <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;"
                                                align="center">
                                                Agregar Ingrediente Activo
                                            </h4>
=======
                                            <h3>Agregar Ingrediente Activo</h3>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                        </div>
                                        <form role="form" id="form-add-iac">

                                            <!------------------------Nombre ingrediente activo---------------------->
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_des_ins">
                                                    <input style="border-color: #fb6340;" id="nom_iac" name ="nom_iac" type="text"
                                                        class="form-control" placeholder="Nombre Ingrediente" autocomplete="off"
<<<<<<< HEAD
                                                        maxlength="45" required>                                                        
=======
                                                        maxlength="45">                                                        
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                </div>                                                
                                            </div>  

                                            <div class="form-group mb-3">
                                            <label><input type="checkbox" name ="agr_nom" id="agr_nom" onchange="muestra_oculta('nomd_iac')"> 
                                            Mezcla de ingredientes activos</label><br> 
                                            </div> 

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">

                                                <input style="border-color: #fb6340;" id="nomd_iac" name ="nomd_iac" type="text"
                                                        class="form-control" placeholder="Segundo Ingrediente" autocomplete="off"
                                                        maxlength="45">  
                                                                                                          
                                                </div>                                                
                                            </div> 

                                            <!-------------------------Prohibición----------------------------------->

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <p>¿Está aprobado por el ICA?:</p>
                                                    <ul>  
                                                        <label><input type="checkbox" value="SI" name ="ica1" class="ica" id="ica1">Si</label><br>
                                                        <label><input type="checkbox" value="NO" name ="ica2" class="ica" id="ica2">No</label><br>
                                                    </u>
                                                </div>
                                            </div> 

                                            <!--------------------------Botón guardar-------------------------------->
                                            
                                            <div class="text-center">
<<<<<<< HEAD
                                                <button type="button" class="btn btn-default my-4" id="btn_save" text style="font-family:'FontAwesome',tahoma; font-size: 11px;"
                                                    onclick="guadarIngrediente();" text style="font-family:'FontAwesome',tahoma; font-size: 11px;">Guardar</button>
=======
                                                <button type="button" class="btn btn-default my-4" id="btn_save"
                                                    onclick="guadarIngrediente();">Guardar</button>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
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

            <!-- modal para editar datos -->

            <div class="col-md-4">
                <div class="modal fade" id="modal-form-up" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-secondary shadow border-0">
                                    <a href="#" data-dismiss="modal" aria-label="Close"
                                        style="margin: 10px 20px 0 0; text-align: right;">
                                        <span aria-hidden="true" style="left: 0;">×</span>
                                    </a>
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
<<<<<<< HEAD
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;"
                                                align="center">
                                                Editar datos
                                            </h4>
=======
                                            <h2>Editar Datos</h2>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                        </div>
                                        <form role="form" id="form-up-sem">

                                            <!------------------------Nombre ingrediente activo---------------------->
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_des_ins">
                                                    <input style="border-color: #fb6340;" id="nom_iac_up" name ="nom_iac" type="text"
                                                        class="form-control" placeholder="Nombre Ingrediente" autocomplete="off"
<<<<<<< HEAD
                                                        maxlength="45" required data-toggle="tooltip" data-placement="top"
                                                    title="Nombre del ingrediente activo">                                                        
=======
                                                        maxlength="45">                                                        
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                </div>                                                
                                            </div> 

                                            <!-------------------------Prohibición----------------------------------->
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <p>¿Está aprobado por el ICA?:</p>
                                                    <ul>  
                                                        <label><input type="checkbox" value="SI" name ="ica1" class="ica" id="ica1up">Si</label><br>
                                                        <label><input type="checkbox" value="NO" name ="ica2" class="ica" id="ica2up">No</label><br>
                                                    </u>
                                                </div>
                                            </div> 
                                            <!----------------------------------------------------------------------------> 

                                            

                                            <div class="text-center">
<<<<<<< HEAD
                                                <button type="button" class="btn btn-default my-4" id="btn_up" 
                                                text style="font-family:'FontAwesome',tahoma; font-size: 11px;"
=======
                                                <button type="button" class="btn btn-default my-4" id="btn_up"
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                    onclick="actualizarIngrediente_g();">Guardar</button>
                                            </div>
                                            <input type="text" name="" id="rrr" style="display: none;">
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

            <!-- Table -->
            <div class="row">
<<<<<<< HEAD
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
=======
                <div class="col">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="float-md-left" style="margin-top: 5px;">
                                <button type="button" class="btn btn-default" data-toggle="modal"
<<<<<<< HEAD
                                    data-target="#modal-form" text style="font-family:'FontAwesome',tahoma; font-size: 11px;">Agregar</button>
=======
                                    data-target="#modal-form">Agregar</button>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                            </div>
                            <div class="float-md-right" style="margin-top: 5px;">
                                <input class="form-control" placeholder="Buscar en la tabla" id="myInput" type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="table-responsive" id="tab_ingredientes_activos">

                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="col-md-1">
                </div>
=======
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
            </div>
            <!-- Footer -->

        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>
    <!-- funciones -->
    <script src="../js/funciones_ingredientes_activos.js"></script>
    
</body>

</html>