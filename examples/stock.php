

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
</head>
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
              <a href="index.html">
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
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
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
          public.municipio, public.dueño, public.tipo_unidad_medida
          WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
          AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
          AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter and fincas.cod_fin='$ide_ter'";
          $result=pg_query($conexion,$sql);
          $finca=pg_fetch_row($result);
          ?>
          <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i class="fas fa-angle-right"></i> Stock</a>
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
      <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/bodega.jpg'); no-repeat; background-size: cover;">
        <span class="mask bg-gradient-opaco opacity-8"></span>
        <div class="container-fluid">
          <div class="header-body">
          </div>
        </div>
      </div>
      <!-- Page content -->
      <input id="rr" type="email" class="form-control" placeholder="rr" autocomplete="off" style="display: none;">
      <div class="container-fluid mt--7">
        <!-- modal para ingresar datos -->
        <!-- Table -->
        <div class="row">
          <div class="col">
            <div class="card shadow">
             <div class="row col-md-12">
              <div class="col-md-12 card-header border-0 text-center">
                <h2>Stock disponible en la finca <?php echo " ".$finca[1]?></h2>
              </div>

              <div class="col-md-6">
                <div class="card-header border-0">
                  <select id="ver_x_cultivo" class="form-control"data-live-search="true" onchange="ver_por_cultivo();">
                    <option value="" disabled selected>Stock por cultivo</option>
                    <option value="finca">Stock para la finca  <?php echo " ".$finca[1]?></option>
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

             <div class="col-md-6">

              <div class="col-md-6 float-md-right">
               <div class="card-header border-0">
                 <input class="form-control" placeholder="Buscar en la tabla" id="myInput" type="text" autocomplete="off">
               </div>
             </div>
           </div>
         </div>
         <div class="table-responsive" id="tabla_stock">
          <?php
          require '../php/conexion.php';
          ?>

          <table class="table align-items-center table-flush table-hover" >
            <thead class="thead-light">
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Insumo</th>
                <th scope="col">cantidad</th>      
                <th scope="col">Precio Unitario</th>
                <th scope="col">Propietario</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php
              $like = $_SESSION['idusuario'];
              $sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
              unidad_de_medida.des_unm,terceros.ide_ter, 
              terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, 
              fincas.cod_fin
              FROM insumos, stock, registrar, compras, comprar, terceros, socio, 
              unidad_de_medida, act_cul, lotes ,cultivos, fincas
              WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
              AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
              AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
              AND terceros.ide_ter = act_cul.ide_ter AND act_cul.cod_cul = cultivos.cod_cul
              AND cultivos.cod_lot =  lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin
              AND unidad_de_medida.cod_unm=insumos.cod_unm  AND  terceros.ide_ter LIKE '$like%'"; 

              $result=pg_query($conexion,$sql);
              while($ver=pg_fetch_row($result)){
                $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
                $rex=pg_query($conexion,$excluir);
                $filas=pg_num_rows($rex);
                if ($filas == 0) {
                  ?>
                  <tr 
                  <?php 
                  if($ver[1] == "0"){
                    echo "style='background: rgba(232,170,27,.3)'";
                  } 
                  ?>
                  >                    <td><?php echo $ver[0] ?></td>
                  <td><?php echo $ver[3] ?></td>
                  <td><?php 
                  $unm=explode("-",$ver[4]);
                  echo $ver[1].$unm[1]?>

                </td>
                <td>
                  <?php
                  $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
                  $r=pg_query($conexion,$sqf);
                  $cont=0;
                  $pre=0;
                  while($see=pg_fetch_row($r)){
                    ++$cont;
                    $pre=$pre+$see[0];
                  }
                  echo "$ ".intval(($pre)/$cont);
                  ?>
                </td>
                <td><?php 
                echo $ver[6]." ".$ver[7]." ".$ver[8]." ".$ver[9]; 
                ?></td>
              </tr>
              <?php 
            }
          }
          $sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
          unidad_de_medida.des_unm,terceros.ide_ter, 
          terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter,
          fincas.cod_fin
          FROM insumos, stock, registrar, compras, comprar, terceros, dueño, 
          unidad_de_medida, act_cul, lotes ,cultivos, fincas
          WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
          AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
          AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter
          AND terceros.ide_ter = act_cul.ide_ter AND act_cul.cod_cul = cultivos.cod_cul
          AND cultivos.cod_lot =  lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin
          AND unidad_de_medida.cod_unm=insumos.cod_unm  AND  terceros.ide_ter LIKE '$like%'"; 

          $result=pg_query($conexion,$sql);
          while($ver=pg_fetch_row($result)){
            $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
            $rex=pg_query($conexion,$excluir);
            $filas=pg_num_rows($rex);
            if ($filas == 0) {
              ?>
              <tr 
              <?php 
              if($ver[1] == "0"){
                echo "style='background: rgba(232,170,27,.3)'";
              } 
              ?>
              >
              <td><?php echo $ver[0] ?></td>
              <td><?php echo $ver[3] ?></td>
              <td><?php 
              $unm=explode("-",$ver[4]);
              echo $ver[1].$unm[1]?>

            </td>
            <td>
              <?php
              $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
              $r=pg_query($conexion,$sqf);
              $cont=0;
              $pre=0;
              while($see=pg_fetch_row($r)){
                ++$cont;
                $pre=$pre+$see[0];
              }
              echo "$ ".intval(($pre)/$cont);
              ?>
            </td>
            <td><?php 
            echo $ver[6]." ".$ver[7]." ".$ver[8]." ".$ver[9]; 
            ?></td>
          </tr>
          <?php 
        }
      }?>
    </tbody>
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
<script src="../js/funciones_stock.js"></script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function(){
    jQuery('#ver2').hide();
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#menu').load('../php/componentes/menu/menu.php');

    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    
  });

  function cerrar_menu(){
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
  }
</script>

