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
                        class="fas fa-angle-right"></i> Relación entre etapas de la plaga o enfermedad y los
                    agroquímicos</a>
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
            style="background: url('../assets/img/theme/relacion.jpg'); no-repeat; background-size: cover;">
            <span class="mask bg-gradient-fito opacity-8"></span>
            <div class="container-fluid">
                <br>
                <br>
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <div class="float-md-right" style="margin-top: 5px;">
                                        <input class="form-control" placeholder="Buscar en la tabla" id="myInput"
                                            type="text" autocomplete="off">
                                    </div>
                                </div>
                                <!-----------------------------Mostrar tabla de agroquimicos asociados------------------------->
                                <div class="table-responsive" id="principal">
                                    <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                        Enfermedades y sus respectivas etapas
                                    </h4>
                                    <table class="table align-items-center table-flush table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Imagen de la etapa</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <?php 
                                                $like = $_SESSION['idusuario'];
                                                $sql = "";

                                                $sql="SELECT afeccion.cod_afe, afeccion.nom_afe
                                                FROM public.afeccion
                                                WHERE (afeccion.cod_afe LIKE '1-%' or afeccion.cod_afe LIKE '$like%')";
                                                
                                                $result=pg_query($conexion,$sql);
                                                while($ver=pg_fetch_row($result)){  
                                                    
                                                $datos=$ver[0]."||".
                                                $ver[1]."||";

                                                ?>
                                            <tr>
                                                <td><?php echo $ver[1] ?></td>

                                                <td>
<<<<<<< HEAD
=======


>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                    <?php $sql1="SELECT DISTINCT etapas_crecimiento.cod_eta, etapas_crecimiento.det_eta, eta_x_afe.ima_eta
                                                            FROM public.etapas_crecimiento, public.eta_x_afe, public.afeccion
                                                            WHERE afeccion.cod_afe = eta_x_afe.cod_afe
                                                            AND etapas_crecimiento.cod_eta = eta_x_afe.cod_eta
                                                            AND eta_x_afe.cod_afe = '$ver[0]'";
<<<<<<< HEAD
                                                            
                                                            $result1=pg_query($conexion,$sql1);

                                                            $filas1=pg_num_rows($result1);
                                                            //echo $filas1;
                                                            if($filas1 == 1 ){                                                            

=======
                                                            $result1=pg_query($conexion,$sql1);
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                            while($ver1=pg_fetch_row($result1)){
                                                                ?>
                                                    <br>
                                                    <center>
                                                        <a style="font-family:'FontAwesome',tahoma; font-size: 16px;"
                                                            title="<?php echo $ver1[1] ?>" href="#"
                                                            onclick="tablaAgro('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')"><?php echo $ver1[1] ?></a>
                                                    </center>
                                                    <input type="button" name="eliminar_etapa"
                                                        class="btn btn-danger sm-4" data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Eliminar etapa: <?php echo $ver1[1] ?>"
                                                        value="&#xf00d    "
                                                        style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                                                        onclick="eliminarEtapa('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')">

                                                    <?php if($ver1[2] != null){?>
                                                    <center>
                                                        <a title="<?php echo $ver1[1] ?>" href="#"
                                                            onclick="tablaAgro('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')">
                                                            <img width="100" height="100"
                                                                src="../imagenes/<?php echo $ver1[2]?>"
                                                                alt="<?php echo $ver1[1] ?>" /></a>
                                                    </center>
                                                    <a
                                                        style="color:#7A7894">_______________________________________________________</a>
                                                    <?php 
                                                                                                }else{
                                                                                                    ?>
                                                    <center>
                                                        <a title="<?php echo $ver1[1] ?>" href="#"
                                                            onclick="tablaAgro('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')">
                                                            <img width="100" height="100"
                                                                src="../imagenes/etapas/sinimagen.jpg"
                                                                alt="<?php echo $ver1[1] ?>" /></a>
                                                    </center>
                                                    <a
                                                        style="color:#7A7894">_______________________________________________________</a>

                                                    <?php
                                                            }
                                                        }
<<<<<<< HEAD
                                                    }else{


                                                        $sql2="SELECT DISTINCT etapas_crecimiento.cod_eta, etapas_crecimiento.det_eta, eta_x_afe.ima_eta
                                                        FROM public.etapas_crecimiento, public.eta_x_afe, public.afeccion
                                                        WHERE afeccion.cod_afe = eta_x_afe.cod_afe
                                                        AND etapas_crecimiento.cod_eta = eta_x_afe.cod_eta
                                                        AND eta_x_afe.cod_afe = '$ver[0]'";
                                                        
                                                        $result2=pg_query($conexion,$sql2);
                                                        while($ver1=pg_fetch_row($result2)){
                                                            ?>
                                                <br>
                                                <center>
                                                    <a style="font-family:'FontAwesome',tahoma; font-size: 16px;"
                                                        title="<?php echo $ver1[1] ?>" href="#"
                                                        onclick="tablaAgro('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')"><?php echo $ver1[1] ?></a>
                                                </center>
                                                <input type="button" name="eliminar_etapa"
                                                    class="btn btn-danger sm-4" data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Eliminar etapa: <?php echo $ver1[1] ?>"
                                                    value="&#xf00d    "
                                                    style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                                                    onclick="eliminarEtapa('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')">

                                                <?php if($ver1[2] != null){?>
                                                <center>
                                                    <a title="<?php echo $ver1[1] ?>" href="#"
                                                        onclick="tablaAgro('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')">
                                                        <img width="100" height="100"
                                                            src="../imagenes/<?php echo $ver1[2]?>"
                                                            alt="<?php echo $ver1[1] ?>" /></a>
                                                </center>
                                                <a
                                                    style="color:#7A7894">_______________________________________________________</a>
                                                <?php 
                                                                                            }else{
                                                                                                ?>
                                                <center>
                                                    <a title="<?php echo $ver1[1] ?>" href="#"
                                                        onclick="tablaAgro('<?php echo $ver1[0] ?>','<?php echo $ver[0] ?>')">
                                                        <img width="100" height="100"
                                                            src="../imagenes/etapas/sinimagen.jpg"
                                                            alt="<?php echo $ver1[1] ?>" /></a>
                                                </center>
                                                <a
                                                    style="color:#7A7894">_______________________________________________________</a>

                                                <?php
                                                        }
                                                    }


                                                    }
=======
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                        ?>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <div class="float-md-right" style="margin-top: 5px;">
                                        <input class="form-control" placeholder="Buscar en la tabla" id="myInput1"
                                            type="text" autocomplete="off">
                                    </div>
                                </div>
                                <!-----------------------------Mostrar tabla de agroquimicos asociados------------------------->
                                <div class="table-responsive" id="tablaAgro" name="tablaAgro">
                                    <div class="form-group">
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                            Agroquímicos asociados por etapa</h4>
                                        <table class="table align-items-center table-flush table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Nombre Agroquímico</th>
                                                    <th scope="col">Tipo de agroquímico</th>
                                                    <th scope="col">Eliminar</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <br>
                                        <center>
                                            <input type="button" name="Asociar" class="btn btn-success sm-4"
                                                data-toggle="tooltip" data-placement="top" title="Asociar"
                                                value="Asociar"
                                                style="font-family:'FontAwesome',tahoma; font-size: 12px;">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7" id="tab_pla">
            <!-------------------------------------------Modal para asociar agroquimicos con etapas--------------------------------->
            <div class="col-md-4">
                <div class="modal fade" id="modal-mostrar" tabindex="-1" role="dialog" aria-labelledby="modal-form"
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
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
                                            Listado de Agroquímicos</h4>
                                        </div>
                                        <form role="form" id="form-mostrar">

                                            <div class="row">

                                                <div class="card shadow">
                                                    <div class="card-header border-0">

                                                        <div class="float-md-right" style="margin-top: 5px;">
                                                            <input class="form-control" placeholder="Buscar en la tabla"
<<<<<<< HEAD
                                                                id="myInput2" type="text" autocomplete="off">
=======
                                                                id="myInput" type="text" autocomplete="off">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                                        </div>
                                                        <div class="table-responsive" id="tabla_agroquimicos">

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
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        
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
    <script src="../js/funciones_relacion_etapas_agro.js"></script>
</body>

</html>