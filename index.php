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
require 'php/conexion.php';
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<html class="no-js" lang="es">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Agrosyst Co</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Argon CSS -->
  <link href="assets/fonts/fonts/material-icons.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/scrollbar.css">
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- jquery -->
  <!-- sweet_alert -->
  <script src="assets/sweetalert/sweetalert.min.js"></script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
  <!-- funciones -->
  <script src="js/funciones_fincas.js"></script>
  <script src="js/funciones_index.js"></script>
  <!-- sweet_alert -->
  <script src="assets/sweetalert/sweetalert.min.js"></script>
  <!-- toastr -->
  <script src="assets/toastr/toastr.min.js"></script>
  <link type="text/css" href="assets/toastr/toastr.css" rel="stylesheet">

  <link rel="stylesheet" href="librerias/Inicio/css/fontAwesome.css">
  <link rel="stylesheet" href="librerias/Inicio/css/templatemo-style.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <script src="librerias/Inicio/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>


</head>

<body style="background-image:url(<?php echo 'imagenes/Agro'.rand(0,10).'.jpg' ?>);">
  <div class="overlay"></div>

  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card bg-secondary shadow border-0">
            <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
              <span aria-hidden="true" style="left: 0;">×</span>
            </a>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h3>Agregar finca</h3>
              </div>
              <form role="form" id="form-add-finca" method="POST" enctype="multipart/form-data">

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <input id="cod_fin" name="cod_fin" type="text" class="form-control" placeholder="N° Escritura" autocomplete="off" maxlength="17">
                  </div>
                </div>

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative" id="div_nom_fin">
                    <input style="border-color: #fb6340;" id="nom_fin" name="nom_fin" type="text" class="form-control" placeholder="Nombre" autocomplete="off" maxlength="25">
                  </div>
                </div>

                <label for="det_fin">Detalle</label>
                <div class="input-group-alternative" id="div_det_fin" style="margin-bottom: 25px;">
                  <textarea style="border-color: #fb6340;" id="det_fin" name="det_fin" class="form-control" rows="2" maxlength="45"></textarea>
                </div>

                <div class="row">
                  <div class="col-sm-9 col-md-9 col-lg-9">
                   <div id="duenios">

                   </div>
                 </div>
                 <div class="col-sm-3 col-md-3 col-lg-3">
                  <button type="button" class="btn btn-amarillo" data-toggle="modal" data-target="#modal-duenio"><i class="fas fa-user-plus"></i></button>
                </div>
            </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="Logo_Semillero">Foto de la finca</label>
        <input id="foto_fin" name="foto_fin" type="file" class="validate" autocomplete="off"  accept="image/*">
      </div>

      <div class="text-center">
        <input name="btnLogB" type="button" id="btn_save" class="btn btn-default my-4" value="Guardar"/>
      </div>
    </form>
    <img src="assets/img/icons/preloader.gif" id="preloader" style="margin: 10px auto;">
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
<section class="cd-hero">
  <div class="cd-slider-nav">
    <nav>
      <span class="cd-marker item-1"></span>
      <ul>
        <li class="selected"><a href="index.php"><div class="image-icon"><img src="librerias/Inicio/img/home-icon.png"></div><h6>Inicio</h6></a></li>
        <li><a href="lotes.php"><div class="image-icon"><img src="librerias/Inicio/img/about-icon.png"></div><h6>Fincas</h6></a></li>
        <li><a href="lotes.php"><div class="image-icon"><img src="librerias/Inicio/img/projects-icon.png"></div><h6>Contactenos</h6></a></li>
      </ul>
    </nav> 
  </div> <!-- .cd-slider-nav -->

  <ul class="cd-hero-slider">

    <li class="selected">
      <div class="heading">
        <h1>Agrosyst Co</h1>
        <span>¡Bienvenido a tu sistema Agro!</span>
        <?php 
        date_default_timezone_set('America/Bogota');
        $d = date("d");
        $m = date("m");
        $y = date("Y");
        $fecha=$y."-".$m."-".$d;
        ?>
                    <br>
                    <h2 style="color: #fff; font-weight: bold; padding-bottom: 10px;"><?php echo $fecha ?></h2>
                </div>

            </li>

            <li>
                <div class="heading">
                    <h1>Fincas</h1>
                    <span>Yo soy agricultor, y siempre tengo las mejores vistas desde mi oficina</span>
                </div>
                <div class="cd-half-width second-slide">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="content second-content">
                                    <?php 
                $like = $_SESSION['idusuario'];
                require 'php/conexion.php';
                $sql="SELECT cod_fin,nom_fin,det_fin,nom_dep,nom_mun,des_tum,med_fin,des_unm,fot_fin from public.fincas INNER JOIN
                municipio ON fincas.cod_mun=municipio.cod_mun INNER JOIN unidad_de_medida ON 
                fincas.cod_unm=unidad_de_medida.cod_unm INNER JOIN departamento ON 
                municipio.cod_dep=departamento.cod_dep INNER JOIN tipo_unidad_medida ON
                unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum where cod_fin LIKE '$like%'";
                $result=pg_query($conexion,$sql);
                while ($ver=pg_fetch_row($result)) {
                  ?>
                                    <form action="finca_actual.php" method="POST">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-7 left-image">
                                                <img src="imagenes/<?php echo $ver[8] ?>">
                                            </div>
                                            <div class="col-md-5">
                                                <div class="right-about-text">
                                                    <h4><?php echo $ver[1]?></h4>
                                                    <p><?php echo $ver[2]?></p>
                                                    <p>Ubicación: <?php echo $ver[4]?>, <?php echo $ver[3]?></p>
                                                    <p>Medida: <?php echo $ver[6]?> <?php echo $ver[7]?></p>
                                                    <input name="prueba" type="hidden" value="<?php echo $ver[0]?>" />
                                                    <input name="btnLogA" type="submit" class="btn btn-amarillo"
                                                        value="¡A trabajar!" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                }
                ?>
                <div class="card-header border-0">

                  <button type="button" class="btn btn-amarillo" data-toggle="modal" data-target="#modal-form" id="btn_save">Crear finca</button>
                </div> 
              </div>
            </div>
          </div>                  
        </div>
      </div>
    </li>



  </ul> <!-- .cd-hero-slider -->
</section> <!-- .cd-hero -->
<!-- modal para ingresar datos -->
<div class="col-md-4">
  <div class="modal fade" id="modal-duenio" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-body p-0">


          <div class="card bg-secondary shadow border-0">
            <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
              <span aria-hidden="true" style="left: 0;">×</span>
            </a>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h3>Agregar tercero</h3>
              </div>
              <form role="form" id="form-add-ter" >

                <div class="row">

                            <button type="button" class="btn btn-amarillo" data-toggle="modal" data-target="#modal-form"
                                id="btn_save">Crear finca</button>
                        </div>
                    </div>


                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <select id="tipo_per" disabled class="form-control"data-live-search="true">
                          <option value="1" disabled selected >Duenio</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                </div>
                </div>
            </li>



        </ul> <!-- .cd-hero-slider -->
    </section> <!-- .cd-hero -->
    <!-- modal para ingresar datos -->
    <div class="col-md-4">
        <div class="modal fade" id="modal-dueño" tabindex="-1" role="dialog" aria-labelledby="modal-form"
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
                                    <h3>Agregar terero</h3>
                                </div>
                                <form role="form" id="form-add-ter">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group mb-3" style="display: none;">
                                                <div class="input-group input-group-alternative">
                                                    <input id="ide_usuario" type="email" class="form-control"
                                                        placeholder="Correo"
                                                        value="<?php echo  $_SESSION['idusuario'] ?>">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_ide_ter">
                                                    <input style="border-color: #fb6340;" id="ide_ter" type="text"
                                                        class="form-control" placeholder="Cédula" autocomplete="off"
                                                        maxlength="10">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_pno_ter">
                                                    <input style="border-color: #fb6340;" id="pno_ter" type="text"
                                                        class="form-control" placeholder="Primer nombre"
                                                        autocomplete="off" maxlength="20">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_sno_ter">
                                                    <input style="border-color: #fb6340;" id="sno_ter" type="text"
                                                        class="form-control" placeholder="Segundo nombre"
                                                        autocomplete="off" maxlength="20">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_pap_ter">
                                                    <input style="border-color: #fb6340;" id="pap_ter" type="text"
                                                        class="form-control" placeholder="Primer apellido"
                                                        autocomplete="off" maxlength="20">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_sap_ter">
                                                    <input style="border-color: #fb6340;" id="sap_ter" type="text"
                                                        class="form-control" placeholder="Segundo apellido"
                                                        autocomplete="off" maxlength="20">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_tel_ter">
                                                    <input style="border-color: #fb6340;" id="tel_ter" type="text"
                                                        class="form-control" placeholder="Telefono" autocomplete="off"
                                                        maxlength="10">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative" id="div_eml_ter">
                                                    <input style="border-color: #fb6340;" id="eml_ter" type="email"
                                                        class="form-control" placeholder="Correo" autocomplete="off"
                                                        maxlength="50">
                                                </div>
                                            </div>


                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <select id="tipo_per" disabled class="form-control"
                                                        data-live-search="true">
                                                        <option value="1" disabled selected>Dueño</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn btn-default my-4"
                                            onclick="preloader_d();">Guardar</button>
                                    </div>
                                </form>
                                <img src="assets/img/icons/preloader.gif" id="preloaderd">
                                <script>
                                jQuery('#preloaderd').hide();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<input id="rr" type="email" class="form-control" placeholder="rr" autocomplete="off" style="display: none;">
<!-- ----------------------------------------------------------------------------------- -->

<script src="librerias/Inicio/js/vendor/bootstrap.min.js"></script>
<script src="librerias/Inicio/js/plugins.js"></script>
<script src="librerias/Inicio/js/main.js"></script>
<footer style="position:fied;">
  <p>Agrosyst Co &copy; 2020
  </footer>

  <div class="contenedor" style="position: absolute; z-index: 300;">
   <a href="php/logout.php">
    <button class="botonF1">
      <span><i class="material-icons" data-toggle="tooltip" data-placement="left" title="Cerrar sesion" data-original-title="Cerrar sesion"  style="margin-top: 7px;">exit_to_app</i></span>
    </button>
  </a>
</div>
</body>

</html>