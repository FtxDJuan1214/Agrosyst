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
<<<<<<< HEAD
                        class="fas fa-angle-right"></i> Etapas Plagas y Enfermedades</a>
=======
                        class="fas fa-angle-right"></i> Etapas Plagas & Enfermedades</a>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
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
            style="background: url('../assets/img/theme/etapas.jpg'); no-repeat; background-size: cover;">
            <span class="mask bg-gradient-fito opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row" style="width=50px;">
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
                                                Etapas
                                            </h4>
                                        </div>
                                        <form role="form" id="form-add-eta">

                                            <!------------------------Nombre de la etapa------------------------->
=======
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                        Etapas
                                    </h4>
                                        </div>
                                        <form role="form" id="form-add-eta">

                                            <!------------------------Nombre ingrediente activo---------------------->
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_des_ins">
                                                    <input style="border-color: #fb6340;" id="nom_eta" name="nom_eta"
                                                        type="text" class="form-control" placeholder="Nombre Etapa"
<<<<<<< HEAD
                                                        autocomplete="off" maxlength="45" required>
=======
                                                        autocomplete="off" maxlength="45">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                </div>
                                            </div>

                                            <!--------------------------Botón guardar-------------------------------->

                                            <div class="text-center">
<<<<<<< HEAD
                                                <button type="button" class="btn btn-default my-4" id="btn_save" text
                                                    style="font-family:'FontAwesome',tahoma; font-size: 11px;"
=======
                                                <button type="button" class="btn btn-default my-4" id="btn_save"
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                    onclick="guadarEtapa();">Guardar</button>
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
                                        </div>
                                        <form role="form" id="form-up-sem">

                                            <!------------------------Nombre de la etapa---------------------->
=======
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                        Editar datos
                                    </h4>
                                        </div>
                                        <form role="form" id="form-up-sem">

                                            <!------------------------Nombre ingrediente activo---------------------->
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_des_ins">
                                                    <input style="border-color: #fb6340;" id="nom_eta_up" name="nom_eta"
                                                        type="text" class="form-control" placeholder="Nombre Etapa"
<<<<<<< HEAD
                                                        autocomplete="off" maxlength="45" required>
=======
                                                        autocomplete="off" maxlength="45">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                </div>
                                            </div>
                                            <!---------------------------------------------------------------------------->

                                            <div class="text-center">
<<<<<<< HEAD
                                                <button type="button" class="btn btn-default my-4" id="btn_up" text
                                                    style="font-family:'FontAwesome',tahoma; font-size: 11px;"
=======
                                                <button type="button" class="btn btn-default my-4" id="btn_up"
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                    onclick="actualizarEtapa_g();">Guardar</button>
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


            <!-- modal para mostrar lista de plagas y enfermedades -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-list" tabindex="-1" role="dialog" aria-labelledby="modal-form"
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
                                                Lista de plagas y enfermedades
                                            </h4>
=======
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                        Lista de plagas y enfermedades
                                    </h4>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                        </div>
                                        <form role="form" id="form-list">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="card shadow">
                                                        <div class="card-header border-0">
                                                            <div class="float-md-right" style="margin-top: 5px;">
<<<<<<< HEAD
                                                                <input class="form-control text-center"
                                                                    placeholder="Buscar" id="myInput1" type="text"
                                                                    autocomplete="off">
=======
                                                                <input class="form-control"
                                                                    placeholder="Buscar en la tabla" id="myInput1"
                                                                    type="text" autocomplete="off">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive" id="tabla_afecciones">

                                                            <table
                                                                class="table align-items-center table-flush table-hover">
                                                                <thead class="thead-light">
                                                                    <tr>
<<<<<<< HEAD
                                                                        <th scope="col">
                                                                            <center>Nombre</center>
                                                                        </th>
=======
                                                                        <th scope="col">Nombre</th>
                                                                        <th></th>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="myTable1">
                                                                    <?php 
<<<<<<< HEAD
                                                                        $like = $_SESSION['idusuario'];

                                                                        $sql="SELECT nom_afe, cod_afe FROM afeccion WHERE (cod_afe LIKE '$like%' or cod_afe LIKE '1-%')"; 
                                                                        
                                                                        $result=pg_query($conexion,$sql);
                                                                        while($ver=pg_fetch_row($result)){  
                                                                        ?>
                                                                    <tr>
                                                                        <td
                                                                            onclick="seleccion_afe('<?php echo $ver[1] ?>')">
                                                                            <center>
                                                                                <?php echo $ver[0] ?>
                                                                            </center>
                                                                        </td>
=======
                                                            $like = $_SESSION['idusuario'];

                                                            $sql="SELECT nom_afe, cod_afe FROM afeccion WHERE (cod_afe LIKE '$like%' or cod_afe LIKE '1-%')"; 
                                                            
                                                            $result=pg_query($conexion,$sql);
                                                            while($ver=pg_fetch_row($result)){  
                                                            ?>
                                                                    <tr>
                                                                        <td
                                                                            onclick="seleccion_afe('<?php echo $ver[1] ?>')">
                                                                            <?php echo $ver[0] ?></td>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                                    </tr>
                                                                    <?php 
                                                        }
                                                        ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Segundo modal -->
            <div class="col-md-4">
                <div class="modal fade" id="modal-list-dos" tabindex="-1" role="dialog" aria-labelledby="modal-form"
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
<<<<<<< HEAD
                                            <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;"
                                                align="center">
                                                Imagen de la etapa
                                            </h4>
                                        </div>
                                        <form role="form" id="form-list-dos">
                                            <div class="card shadow">
                                                <input style="font-family:'FontAwesome',tahoma; font-size: 14px;"
                                                    id="imagen_esc" name="imagen_esc" type="file" class="validate"
                                                    autocomplete="off" accept="image/*" onchange="validateFileType()">
                                                <input id="codi_eta" name="codi_eta" hidden></input>
                                                <input id="codi_afe" name="codi_afe" hidden></input>
                                            </div>
                                            <br>
                                            <center>
                                                <input type="button" name="cargar" class="btn btn-success sm-4"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Planificar otra tarea" value="Guardar sin imagen"
                                                    style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                                    onclick="guardarSinImagen()">
                                            </center>
=======
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                        Imagen de la etapa
                                    </h4>
                                        </div>
                                        <form role="form" id="form-list-dos">
                                        <div class="card shadow">
                                            <input style="font-family:'FontAwesome',tahoma; font-size: 14px;"
                                            id="imagen_esc" name="imagen_esc" type="file" class="validate"
                                                autocomplete="off" accept="image/*" onchange="validateFileType()">
                                                <input id="codi_eta" name="codi_eta"></input>
                                                <input id="codi_afe" name="codi_afe"></input>
                                        </div>
                                        <br>
                                        <center>
                                        <input type="button" name="cargar" class="btn btn-success sm-4"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Planificar otra tarea" value="Guardar sin imagen"
                                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                            onclick="guardarSinImagen()">
                                        </center>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                </div>
            </div>
            <!-- Table -->
            <div class="row">
            <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="float-md-left" style="margin-top: 5px;">
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#modal-form" text
                                    style="font-family:'FontAwesome',tahoma; font-size: 11px;">Agregar</button>
                            </div>
                            <div class="float-md-right" style="margin-top: 5px;">
                                <input class="form-control" placeholder="Buscar en la tabla" id="myInput" type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="table-responsive" id="tab_etapas">

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
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
    <script src="../js/funciones_etapas.js"></script>
=======
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
                                        <input class="form-control" placeholder="Buscar en la tabla" id="myInput"
                                            type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="table-responsive" id="tab_etapas">

                                    </table>
                                </div>
                            </div>
                        </div>
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
            <script src="../js/funciones_etapas.js"></script>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894

</body>

</html>