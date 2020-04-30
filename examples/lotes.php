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
  <link href="../assets/fonts/fonts/material-icons.css" rel="stylesheet">
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

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white " id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
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
              <a href="../index.html">
                <img src="../assets/img/brand/agrosyst.gif">
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
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
        </form>
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
        <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i class="fas fa-angle-right"></i> LOTES</a>
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
    <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/lotes.jpg'); no-repeat;
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
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary shadow border-0">
                <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
                  <span aria-hidden="true" style="left: 0;">×</span>
                </a>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <h3>Agregar Lote</h3>
                  </div>
                  <form role="form" id="form-add-lote">

                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <input id="nom_lot" type="text" class="form-control" placeholder="Nombre del lote" autocomplete="off" maxlength="45">
                      </div>
                    </div>

                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <select id="temp" disabled class="form-control"data-live-search="true">
                          <?php 
                          $codi_fin=$_SESSION['ide_finca'];
                          require '../php/conexion.php';
                          $query="  SELECT cod_fin,nom_fin FROM fincas where cod_fin='$codi_fin'";
                          $result =pg_query($conexion,$query);
                          while ($ver=pg_fetch_row($result)) {
                           ?>
                           <option disabled selected  value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>

                           <?php 
                         }
                         ?>
                       </select>
                     </div>
                   </div>

                   <input type="text" id="nom_fin" style="display: none;" value="<?php echo $codi_fin ?>">
                   <div id="notificacion">

                   </div>
                   <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                     <select id="TUniMedida" disabled name="TUniMedida" class="form-control"data-live-search="true">
                      <option value="" disabled selected>Selecciona un tipo de medida</option>
                      <?php 
                      $query="SELECT cod_tum,des_tum FROM tipo_unidad_medida";
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
                <div class="input-group input-group-alternative" id="select2" data-toggle="tooltip" data-placement="top" title="Unidad de medida para el tamaño del lote." >

                </div>
              </div>

              <div class="form-group mb-3">
                <div class="input-group input-group-alternative" id="div_med_lot">
                  <input style="border-color: #fb6340;"  id="med_lot" type="text" class="form-control" placeholder="Medida" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Tamaño del lote.">
                </div>
              </div>
              <div class="text-center">
                <button type="button" class="btn btn-default my-4" id="btn_save" onclick="preloader();">Guardar</button>
              </div>
            </form>
            <img src="../assets/img/icons/preloader.gif" id="preloader" style="margin: 10px auto;">
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
<!-- modal para ingresar datos -->
<div class="col-md-4">
  <div class="modal fade" id="modal-form-up" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">


          <div class="card bg-secondary shadow border-0">
            <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
              <span aria-hidden="true" style="left: 0;">×</span>
            </a>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h2>Editar datos</h2>
              </div>
              <form role="form" id="form-up-lote">
                <div class="form-group mb-3" style="display: none;">
                  <div class="input-group input-group-alternative">
                    <input id="cod_lot" type="number" step="any"  class="form-control" disabled>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <input id="nom_lotup" type="text" class="form-control" placeholder="Nombre del lote" autocomplete="off">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <select id="nom_finup"  disabled class="form-control"data-live-search="true">
                      <option value="" disabled selected>Selecciona Finca</option>
                      <?php 

                      require '../php/conexion.php';
                      $query=" SELECT cod_fin,cnt_fin,nom_fin FROM fincas";
                      $result =pg_query($conexion,$query);
                      while ($ver=pg_fetch_row($result)) {
                       ?>
                       <option value="<?php echo $ver[1]; ?>"><?php echo $ver[2]; ?></option>
                       <?php 
                     }
                     ?>
                   </select>
                 </div>
               </div>
               <div id="notificacionup">

               </div>
               <div class="form-group mb-3" data-toggle="tooltip" data-placement="top" title="Unidad de medida para el tamaño del lote." >
                <div class="input-group input-group-alternative" id="select3">

                </div>
              </div>

              <div class="form-group mb-3">
                <div class="input-group input-group-alternative" id="div_med_lotup" >
                  <input style="border-color: #fb6340;" id="med_lotup" type="text" class="form-control" placeholder="Medida" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Tamaño del lote.">
                </div>
              </div>
              <div class="text-center">
                <button type="button" class="btn btn-default my-4" id="btn_save" onclick="preloaderup();">Guardar</button>
              </div>
            </form>
            <img src="../assets/img/icons/preloader.gif" id="preloaderup">
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
<!-- <div class="row">
  <div class="col">
    <div class="card shadow alert alert-success text-white">
      <marquee class="" scrolldelay="100" scrollamount="6" direction="left" loop="infinite" style="font-size: 1.2rem">
        <?php print_r( $finca)?>
      </marquee>
    </div>
  </div>
</div> -->
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-0">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-form" onclick="cargar_select();medida();">Agregar</button>
      </div>
      <div class="table-responsive"  id="tab_lotes">
      </div>
    </div>
  </div>
</div>

</div>
<!-- Footer -->
<!-- <footer class="footer">
  
</footer> -->
</div>
</div>
<div class="contenedor">
  <button class="botonF1">
    <span><i class="material-icons" style="margin-top: 7px;">settings</i></span>
  </button>
  <a href="#">
    <button class="flotante botonF3">
      <span><i class="material-icons bslink" data-toggle="tooltip" data-placement="left" title="" data-original-title="Conversor de unidades" style="margin-top: 5px;">swap_horiz</i></span>
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
<!-- --------------MODAL DE LA CALCULADORA-----------------------------------
-->
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
  <!-- ------------------------------------------------------------------------ -->
</div>

<!-- Argon Scripts -->
<!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.0.0"></script>
<!-- funciones -->
<script src="../js/funciones_lotes.js"></script>
</body>

</html>
