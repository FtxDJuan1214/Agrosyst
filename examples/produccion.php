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
  <title>Agrosyst Co</title>
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

  <!-- PDF --->
 <!--  <script type="text/javascript" src="../assets/pdf/jspdf.min.js"></script>
  <script type="text/javascript" src="../assets/pdf/html2canvas.js"></script> -->

  <!--   <script type="text/javascript"> -->
   <!--  function exportpdf(){
      html2canvas(document.body).then(function(canvas) {
        document.body.appendChild(canvas)
        var img = canvas.toDataURL('image/png')
        var doc = new jsPDF()
        doc.addImage(img, 'PNG', 10, 10)
        doc.save('test.pdf')
      });
    } -->
    <!--   </script> -->
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
          public.municipio, public.duenio, public.tipo_unidad_medida
          WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
          AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
          AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter and fincas.cod_fin='$ide_ter'";
          $result=pg_query($conexion,$sql);
          $finca=pg_fetch_row($result);
          ?>
          <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i class="fas fa-angle-right"></i>  Producción</a>
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
      <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/produccion.jpg'); no-repeat;
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
        <div class="modal fade" id="modal-produccion" tabindex="-1" role="dialog" aria-labelledby="modal-produccion" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">

              <div class="modal-body p-0">


                <div class="card bg-secondary shadow border-0">
                  <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
                    <span aria-hidden="true" style="left: 0;">×</span>
                  </a>
                  <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                      <h2>Producción</h2>
                    </div>
                    <form role="form" id="form-add-produccion">
                      <div class="col-md-12" style="margin-bottom: 10px;">
                        <a style="font-size: 1em;" href="terceros.php" class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar clientes"><i class="fas fa-user-plus"></i></a>
                        <a style="font-size: 1em;" href="cultivos.php" class="btn btn-info btn-sm bg-gradient-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Crear un cultivo" aria-describedby="tooltip653723"><i class="fas fa-spa"></i></a>
                      </div>
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <select id="cultivo" class="form-control"data-live-search="true">
                            <option value="0" disabled selected>Selecciona Cultivo de la producción</option>
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
                        <select id="cliente" class="form-control"data-live-search="true">
                          <option value="0" disabled selected>Selecciona el comprador</option>
                          <?php 

                          require '../php/conexion.php';
                          $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter
                          FROM public.terceros INNER JOIN cliente on
                          terceros.ide_ter = cliente.ide_ter where terceros.ide_ter like '$like%'";
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

                   <div class="text-center">
                    <button type="button" class="btn btn-default my-4" id="btn_save" onclick="preloader();">Crear</button>
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

  <!-- Modal para hacer CRUD de produccion - gozar -->
  <div class="col-md-4">
    <div class="modal fade" id="modal-crud-gozar" tabindex="5" role="dialog" aria-labelledby="modal-produccion" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

          <div class="modal-body p-0">


            <div class="card bg-secondary shadow border-0">
              <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
                <span aria-hidden="true" style="left: 0;">×</span>
              </a>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                  <h2>Producción</h2>
                </div>

                <div class="row">

                  <div class="col-sm-6" style="margin-bottom: 10px;">

                   <div class="form-group" style="display: none;">
                    <div class="input-group input-group-alternative">
                     <input readonly type="text" id="cod_pro" class="form-control">
                   </div>
                 </div>

                 <div class="input-group input-group-alternative" data-toggle="tooltip" data-placement="top" title="Comprador de la producción">
                  <select id="ide_ter" class="form-control"data-live-search="true">
                    <option value="0" disabled selected>Selecciona el comprador</option>
                    <?php 

                    require '../php/conexion.php';
                    $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter
                    FROM public.terceros INNER JOIN cliente on
                    terceros.ide_ter = cliente.ide_ter where terceros.ide_ter like '$like%'";
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
             <div class="col-sm-6">
               <div class="input-group input-group-alternative">
                <select id="cod_cul" class="form-control"data-live-search="true" disabled>
                  <option value="0" disabled selected>Selecciona Cultivo de la producción</option>
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
         </div>
         <form role="form" id="form-add-producciones">
           <div class="row">
            <div class="col-sm-6">

             <div class="form-group mb-3">
              <label>Tipo de producción:</label>
              <div class="input-group input-group-alternative">
                <select id="tip_prod" class="form-control"data-live-search="true">
                  <option value="0" disabled selected>Selecciona el tipo de producción</option>
                  <?php 

                  $sql="SELECT tipo_de_produccion.cod_tpr, tipo_de_produccion.des_tpr, tipo_de_produccion.cod_unm, unidad_de_medida.des_unm
                  FROM public.tipo_de_produccion, public.unidad_de_medida
                  where unidad_de_medida.cod_unm=tipo_de_produccion.cod_unm AND tipo_de_produccion.des_tpr LIKE '$like%'"; 
                  $result =pg_query($conexion,$sql);
                  while ($see=pg_fetch_row($result)) {
                   ?>
                   <option value="<?php echo $see[0] ?>"><?php $array=explode("-", $see[1]);  $array1=explode("-", $see[3]); echo $array[1]." - ".$array1[0];?></option>

                   <?php 
                 }
                 ?>
               </select>
             </div>
           </div>

           <div>
             <input style="display: none;"class="form-control datepicker" id="date"  name="date"  placeholder="Select date" type="text" value="<?php echo $fecha_act?>">
             <div id="fecha"></div>
           </div>

           <div class="form-group"  data-toggle="tooltip" data-placement="top" title="¿Cuantos Kilos de tomate puede empacar por (bulto/canastilla)?">
            <label id="tx_capacidad"></label>
            <div class="input-group input-group-alternative" id="div_cpt_goz">
              <input style="border-color: #fb6340;" type="text" id="cpt_goz" class="form-control" placeholder="Capacidad por (bulto/canastilla)" autocomplete="off">
            </div>
          </div>

        </div>

        <!-- ------------------------------------ -->
        <div class="col-sm-6">

          <div class="form-group" data-toggle="tooltip" data-placement="top" title="¿Cuantos (bultos/canastillas) salieron?">
            <label id="tx_cantidad"></label>
            <div class="input-group input-group-alternative" id="div_ctp_goz">
              <input style="border-color: #fb6340;" type="text" id="ctp_goz" class="form-control" placeholder="Cantidad de unidades">
            </div>
          </div>

          <div class="form-group" data-toggle="tooltip" data-placement="top" title="¿A como se vendio el (bulto/canastilla)?">
            <label id="tx_pre"></label>
            <div class="input-group input-group-alternative" id="div_pre_goz" >
              <input style="border-color: #fb6340;" type="text" id="pre_goz" class="form-control" placeholder="precio de unidad">
            </div>
          </div>

          <div class="text-center">
            <button type="button" class="btn btn-default my-4" id="btn_save1" onclick="preloaderup();">Agregar a producción</button>
            <button type="button" class="btn btn-default my-4" id="btn_update" onclick="preloaderup1();">Actualizar producción</button>
          </div>
        </div>
      </div>

      <hr class="dashed" style="border: dashed;">

      <div id="tab_producciones"></div>

      <div class="text-center">
        <button type="button" style="margin-top: 30px;" class="btn btn-default my-4" onclick="editar_toda_produccion();">Terminar</button>
      </div>
    </form>
    <img src="../assets/img/icons/preloader.gif" id="preloaderup" style="margin: 10px auto;">
    <script>
      jQuery('#btn_update').hide();
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
  <div class="col">
    <div class="card shadow">
      <div class="row col-md-12">
        <div class="col-md-3">
          <div class="card-header border-0">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-produccion" >Agregar</button>
          </div>
        </div>
        <div class="col-md-6">
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
    </div>
    <!--  <a href="#" class="btn-success" onclick="exportpdf();">Imprimir</a> -->
    <div class="table-responsive"  id="tab_tipo_prod">
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

<!-- modal para filtrar por fechas -->

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
                <input class="form-control datepicker" id="fecha_ini_filtro" placeholder="Select date" type="text" value="<?php echo $fecha_act?>">
              </div>
            </div>
            <div class="form-group center col-md-10">
              <label >Fecha final:</label>
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker" id="fecha_fin_filtro" placeholder="Select date" type="text" value="<?php echo $fecha_act?>">
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

</body>
<!-- Argon Scripts -->
<!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.0.0"></script>
<!-- funciones -->
<script src="../js/funciones_produccion.js"></script>
</body>

</html>