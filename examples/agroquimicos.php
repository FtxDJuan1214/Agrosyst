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
                      public.municipio, public.duenio, public.tipo_unidad_medida
                      WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
                      AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
                      AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter and fincas.cod_fin='$ide_ter'";
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
            style="background: url('../assets/img/theme/agroquimicos2.jpg'); no-repeat; background-size: cover;">
            <span class="mask bg-gradient-fito opacity-8"></span>
            <!--END HEADER-->
            <!----------------------------------Ingresar agroquimicos------------------------------>
            <div class="containter-fluid" id="crear_agroq" name="crear_agroq">
                <br>

            </div>
        </div>

        <!-- Page content -->

        <div class="container-fluid mt--7">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <center>
                            <strong text style="font-family:'FontAwesome',tahoma; font-size: 15px;">Lista de agroquímicos</strong>
                            </center>
                            <div class="float-md-left" style="margin-top: 5px;" id="div-btn-add" name="div-btn-add">
                                <button id="bt-add-agr" name="bt-add-agr" class="btn btn-success" type="button"
                                    onclick="cargarAgro()" style="font-family:'FontAwesome',tahoma; font-size: 11px;">Agregar</button>
                            </div>
                            <div class="float-md-right" style="margin-top: 5px;">
                                <input class="form-control" placeholder="Buscar en la tabla" id="myInput" type="text"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="table-responsive" id="tab_agroquimicos">
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <!----------------------- modal para Editar datos --------------------------->
            <div class="col-md-4">
                <div class="modal fade" id="modal-agr-up" tabindex="-1" role="dialog" aria-labelledby="modal-form"
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
                                            <h4 text style="font-family:'FontAwesome',tahoma; font-size: 15px;">Editar Agroquímico</h4>
                                        </div>
                                        <form role="form" id="form-up-agroq">

                                            <div class="row">
                                                <!-----------------Primera columna---------------------->
                                                <div class="col-md-6">
                                                    <!--Div Nombre Agroquímico-->
                                                    <div class="form-group">

                                                        <input type="text" class="form-control" id="nom_agr_up" pattern="[A-Za-z0-9]{1,50}"
                                                            name="nom_agr_up" placeholder="Nombre" required data-toggle="tooltip" data-placement="top"
                                                    title="Nombre">

                                                    </div>
                                                    <!--Div Prentación-->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="pre_agr_up" pattern="[A-Za-z0-9]{1,5}"
                                                            name="pre_agr_up" placeholder="Presentación" required data-toggle="tooltip" data-placement="top"
                                                    title="Presentación de producto. Ejemplo: 1L">
                                                    </div>

                                                    <!--Div Ingredientes activos-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="cod_iac_up" name="cod_iac_up"
                                                                class="form-control" data-live-search="true" data-toggle="tooltip" data-placement="top"
                                                                    title="Ingrediente activo">
                                                                <option value="" disabled selected>Ingrediente
                                                                    Activo</option>
                                                                <?php 
                                                                       $query="SELECT cod_iac, des_iac FROM ingredientes_activos 
                                                                       WHERE (cod_iac LIKE '$like%' or cod_iac LIKE '1-%')";
                                                                       $result =pg_query($conexion,$query);
                                                                       while ($ver=pg_fetch_row($result)) {
                                                                   ?>
                                                                <option value="<?php echo $ver[0]; ?>">
                                                                    <?php echo $ver[1];?></option>

                                                                <?php 
                                                                      }
                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--Div Tipo de agroquímico-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="cod_tag_up" name="cod_tag_up"
                                                                class="form-control" data-live-search="true" data-toggle="tooltip" data-placement="top"
                                                                    title="Tipo de agroquímico">
                                                                <option value="" disabled selected>Tipo de
                                                                    agroquímico</option>
                                                                <?php 
                                                            $query="SELECT * FROM tipo_agroquimico";
                                                            $result =pg_query($conexion,$query);
                                                             while ($ver=pg_fetch_row($result)) {
                                                            ?>
                                                                <option value="<?php echo $ver[0]; ?>">
                                                                    <?php echo $ver[1]; ?></option>

                                                                <?php 
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--Div Función-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="fun_agr_up" name="fun_agr_up"
                                                                class="form-control" data-live-search="true" data-toggle="tooltip" data-placement="top"
                                                                    title="Función del agroquímico">
                                                                <option value="" disabled selected>Función</option>
                                                                <option value="Curación">Curación</option>
                                                                <option value="Prevención">Prevención</option>
                                                                <option value="Nutrición">Nutrición</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--Div Tipo de Formulación-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="cod_for_up" name="cod_for_up"
                                                                class="form-control" data-live-search="true" data-toggle="tooltip" data-placement="top"
                                                                        title="Tipo de formulación">
                                                                <option value="" disabled selected>Formulación
                                                                </option>
                                                                <?php 
                                                            $query="SELECT cod_for, nom_for, sig_for FROM formulacion";
                                                            $result =pg_query($conexion,$query);
                                                            while ($ver=pg_fetch_row($result)) {
                                                            ?>
                                                                <option value="<?php echo $ver[0]; ?>">
                                                                    <?php echo $ver[1]." - ".$ver[2] ; ?></option>

                                                                <?php 
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--Div Nombre Carencia-->
                                                    <div class="form-group">

                                                        <input type="number" class="form-control" id="pcr_agr_up"
                                                            name="pcr_agr_up" placeholder="Horas de carencia" data-toggle="tooltip" data-placement="top"
                                                    title="P.Carencia: Tiempo que debe transcurrir entre la última aplicación del producto y la cosecha.">

                                                    </div>

                                                    <!--Div Nombre Entrada-->
                                                    <div class="form-group">

                                                        <input type="number" class="form-control" id="pen_agr_up"
                                                            name="pen_agr_up" placeholder="Días de Entrada" data-toggle="tooltip" data-placement="top"
                                                    title="P. Entrada: Tiempo que debe transcurrir entre la última aplicación y el re ingreso de personas al cultivo.">
                                                    </div>

                                                </div>
                                                <!-----------------Segunda columna---------------------->
                                                <div class="col-md-6">

                                                    <!--Div Dosis-->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="dos_agr_up" pattern="[A-Za-z0-9]{1,10}"
                                                            name="dos_agr_up" placeholder="Dosis" data-toggle="tooltip" data-placement="top"
                                                    title="Dosis recomendada a usar.">
                                                    </div>

                                                    <!--Div Prohibido-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="pro_agr_up" name="pro_agr_up"
                                                                class="form-control" data-live-search="true" data-toggle="tooltip" data-placement="top"
                                                                title="¿Está prohibido por el ICA?">
                                                                <option value="" disabled selected>¿Prohibido por
                                                                    ICA?</option>
                                                                <option value="SI">Si</option>
                                                                <option value="NO">No</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--Div Toxicidad-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="cod_tox_up" name="cod_tox_up"
                                                                class="form-control" data-live-search="true" data-toggle="tooltip" data-placement="top"
                                                                title="Nivel de toxicidad">
                                                                <option value="" disabled selected>Nivel de
                                                                    Toxicidad</option>
                                                                <?php 
                                                                    $query="SELECT * FROM toxicidad";
                                                                    $result =pg_query($conexion,$query);
                                                                    while ($ver=pg_fetch_row($result)) {
                                                                    ?>
                                                                <option value="<?php echo $ver[0]; ?>">
                                                                    <?php echo $ver[1]." - ".$ver[2]; ?></option>

                                                                <?php 
                                                        }
                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>                                                    

                                                    <!--Div Tipo Unidad de Medida-->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative">
                                                            <select required id="tip_uni_med_up" name="tip_uni_med_up"
                                                                class="form-control" data-live-search="true">
                                                                <option value="" disabled selected>Tipo de medida
                                                                </option>
                                                                <?php 
                                                                    $query="SELECT cod_tum, des_tum FROM tipo_unidad_medida WHERE 
                                                                    cod_tum = '3'
                                                                    OR cod_tum = '4'";
                                                                    $result =pg_query($conexion,$query);
                                                                    while ($ver=pg_fetch_row($result)) {
                                                                    ?>
                                                                <option value="<?php echo $ver[0]; ?>">
                                                                    <?php echo $ver[1]; ?></option>

                                                                <?php 
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--Div Unidad de Medida-->
                                                    <div class="form-group" id="select2">
                                                    </div>  

                                                    <!-----------------Div Detalle Insumo---------------------->
                                                    <div class="form-group">
                                                        <label for="">Sugerencias de aplicacion</label><br>
                                                        <textarea name="rap_agr_up" id="rap_agr_up" cols="18" rows="5"
                                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                                    title="Generalmente en la etiqueta viene esta sugerencia de aplicación, sí no, puede dejar el campo vacío."></textarea>
                                                    </div>
                                                            <!----Boton recomendaciones de uso---->
                                                    <div class="form-group">
                                                    <center>
                                                    <input type="button" name="cargar" class="btn btn-success sm-4"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Editar recomendaciones" value="Editar recomendaciones de uso"
                                                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                                            onclick="editarRecomendaciones()">
                                                    </center>
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
            <!------------------------------ Recomendaciones de uso  --------------------------->
            <div class="col-md-4">
                <div class="modal fade" id="modal-suge-dos" tabindex="-1" role="dialog" aria-labelledby="modal-form"
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
                                        Editar recomendaciones de uso
                                    </h4>
                                        </div>
                                        <form role="form" id="form-suge-dos">
                                        <div class="card shadow" id = mostrar-tablas-rec>
                                            
                                        </div>
                                        <br>
                                        <center>
                                        <input type="button" name="cargar" class="btn btn-success sm-4"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Guardar" value="Guardar"
                                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                            onclick="actualizarRecomendaciones()">
                                        </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
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