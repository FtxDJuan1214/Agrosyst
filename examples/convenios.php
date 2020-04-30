<?php
session_start();
if (isset($_SESSION['usuario'])) {  
  $like = $_SESSION['idusuario'];   
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
        <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i class="fas fa-angle-right"></i>  Convenios</a>
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
    <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/convenio.jpg'); no-repeat;
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
        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
          <div class="modal-content">

            <div class="modal-body p-0">


              <div class="card bg-secondary shadow border-0">
                <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
                  <span aria-hidden="true" style="left: 0;">×</span>
                </a>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <h3>Agregar Convenio</h3>
                  </div>
                  <form role="form" id="form-add-convenio">

                    <div class="form-group">
                      <label > fecha del convenio:</label>
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <?php 
                        date_default_timezone_set('America/Bogota');
                        $d = date("d");
                        $m = date("m");
                        $y = date("Y");
                        $fecha=$y."-".$m."-".$d;  
                        ?>
                        <input class="form-control datepicker" id="fec_con" placeholder="Select date" type="text" value="<?php echo $fecha?>">
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <select id="cod_cul" class="form-control"data-live-search="true">
                          <option value="0" disabled selected>Selecciona Cultivo</option>
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
                           <option value="<?php echo $ver[0] ?>"><?php $array=explode("-", $ver[1]); echo $array[1]." - ".$ver[2]." - ".$ver[3]." Plantas"?></option>

                           <?php 
                         }
                         ?>
                       </select>
                     </div>
                   </div>
                   <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <select id="trabajador" class="form-control"data-live-search="true">
                        <option value="0" disabled selected>Selecciona el trabajador</option>
                        <?php 

                        require '../php/conexion.php';
                        $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter
                        FROM public.terceros INNER JOIN trabajador on
                        terceros.ide_ter = trabajador.ide_ter where terceros.ide_ter like '$like%'";
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
                  <div class="input-group input-group-alternative" id="soc_opc">
                    <select class="form-control"data-live-search="true">
                      <option value="0" disabled selected>Selecciona Socio que pagará</option>
                    </select>
                  </div>
                </div>


                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <select id="tipo_con" class="form-control"data-live-search="true">
                      <option value="0" disabled selected>Tipo de convenio</option>
                      <option value="1">Jornal</option>
                      <option value="2">Contrato</option>                    
                    </select>
                  </div>
                </div>

                <div id="contrato" style="display: none;">
                  <div class="form-group mb-3">
                  </div>
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <input id="des_cont" type="text" class="form-control" placeholder="Objetivo del contrato" autocomplete="off" maxlength="45">
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative" id="div_val_cont">
                      <input style="border-color: #fb6340;" id="val_cont" type="number" class="form-control" placeholder="Valor total del contrato" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label > fecha finalizacion del contrato:</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                      </div>
                      <?php 
                      date_default_timezone_set('America/Bogota');
                      $d = date("d");
                      $m = date("m");
                      $y = date("Y");
                      $fecha=$y."-".$m."-".$d;
                      ?>                
                      <input class="form-control datepicker" id="ffi_con" placeholder="Select date" type="text" value="<?php echo $fecha?>">
                    </div>
                  </div>
                </div>
                <div id="jornal" style="display: none;">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative" id="div_hor_jor">
                      <input style="border-color: #fb6340;" id="hor_jor" type="number" class="form-control" placeholder="Horas a trabajar" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative" id="div_vho_hor">
                      <input style="border-color: #fb6340;" id="vho_hor" type="number" class="form-control" placeholder="Valor por hora de contrato" autocomplete="off">
                    </div>
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
<!-- Table -->
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="row col-md-12">
        <div class="col-md-2">
          <div class="card-header border-0">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-form" >Agregar</button>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-header border-0">
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <select id="num_registros" class="form-control"data-live-search="true">
                  <option value="0" disabled selected>¿Cuantos registros desea ver?</option>
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
          <button class="btn btn-icon btn-3 btn-success" type="button" data-toggle="modal" data-target="#modal-entre_fechas">
            <span class="btn-inner--icon"><i class="ni  ni-bullet-list-67"></i></span>
            <span class="btn-inner--text">Ver entre fechas</span>

          </button>
        </div>
      </div>
      <div class="col-md-3">
        <div class="">
         <div class="card-header border-0">
           <input class="form-control" placeholder="Buscar en la tabla" id="myInput" type="text" autocomplete="off">
         </div>
       </div>
     </div>
   </div>
   <div class="table-responsive"  id="tab_convenios">

   </table>
 </div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-entre_fechas" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
          <form >
            <div class="form-group center col-md-10">
              <label >Fecha inicial:</label>
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker" id="fecha_ini_filtro" placeholder="Select date" type="text" value="<?php echo $fecha?>">
              </div>
            </div>
            <div class="form-group center col-md-10">
              <label >Fecha final:</label>
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker" id="fecha_fin_filtro" placeholder="Select date" type="text" value="<?php echo $fecha?>">
              </div>
            </div>
          </form>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-whiteml-auto" data-dismiss="modal" onclick="Cargar_tab_fechas();">Filtrar</button>
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
<script src="../js/funciones_convenios.js"></script>
</body>
</html>