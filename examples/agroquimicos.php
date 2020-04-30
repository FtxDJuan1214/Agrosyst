

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

if (isset($_POST['btnLogA'])) {
  $codigo= $_POST["prueba"];
  $_SESSION['ide_finca']=$codigo;
}else{
  require '../php/conexion.php';
  $sql1="SELECT cod_fin FROM fincas ORDER BY cnt_fin DESC LIMIT 1";
  $result=pg_query($conexion,$sql1);
  $cod=pg_fetch_row($result);
  $_SESSION['ide_finca']=$cod[0];
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
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
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
        <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i class="fas fa-angle-right"></i> agroquímicos</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Administrador</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a  id="ver1"href="#" class="dropdown-item" onclick="cerrar_menu();">
                <i class="ni ni-align-left-2"></i>
                <span>Cerrar menu</span>
              </a>
              <a id="ver2" href="" class="dropdown-item">
                <i class="ni ni-align-left-2"></i>
                <span>Ver menu</span>
              </a>
              <a href="examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>

      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-md-8" style="background: url('../assets/img/theme/agroquimicos.png'); no-repeat; background-size: cover;">
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
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">

              <div class="modal-body p-0">


                <div class="card bg-secondary shadow border-0">
                  <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                      <h3>Agregar Agroquímico</h3>
                    </div>
                    <form role="form" id="form-add-agr">
                      
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="cod_agr"  name="cod_agr" type="text" class="form-control" placeholder="Código agroquímico" autocomplete="off">
                        </div>
                      </div>

                     <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="det_agr"  name="det_agr" type="text" class="form-control" placeholder="Nombre" autocomplete="off">
                        </div>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="des_ins" name="des_ins" type="text" class="form-control" placeholder="Detalles" autocomplete="off">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="det_agr">Recomendaciones</label>
                        <textarea id="rec_agr" name="rec_agr" class="form-control" rows="2"></textarea>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <Label>Estado:</Label>

                          <ul>
                            <li>
                              <input type="radio" name="est_agr" id="est_agr" value="Sólido" >
                              <label for="est_agr">Sólido</label>
                            </li>

                            <li>
                              <input type="radio" name="est_agr" id="est_agr" value="Líquido">
                              <label for="est_agr">Líquido</label>
                            
                          </li>
                          <li>
                              <input type="radio" name="est_agr" id="est_agr" value="Plasma">
                              <label for="est_agr">Plasma</label>
                            
                          </li>
                        </ul>
                        </div>
                      </div>
                        
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="pcr_agr"  name="pcr_agr" type="text" class="form-control" placeholder="Periodo de carencia (en horas)" autocomplete="off">
                        </div>
                      </div>
                      
                       <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="pen_agr"  name="pen_agr" type="text" class="form-control" placeholder="Periodo de entrada (en horas)" autocomplete="off">
                        </div>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <Label>Prohibido por el ICA?</Label>

                          <ul>
                            <li>
                              <input type="radio" name="pro_agr" id="pro_agr" value="SI" >
                              <label for="pro_agr">Si</label>
                            </li>

                            <li>
                              <input type="radio" name="pro_agr" id="pro_agr" value="NO">
                              <label for="pro_agr">No</label>
                            
                          </li>
                        </ul>
                        </div>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <input id="for_agr"  name="for_agr" type="text" class="form-control" placeholder="Formulación" autocomplete="off">
                        </div>
                      </div>

                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                          <select id="cod_tag" name="cod_tag" class="form-control"data-live-search="true">
                          <option value="" disabled selected>Selecciona un tipo de agroquímico</option>
                          <?php 
                          $query="SELECT * FROM tipo_agroquimico";
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
                        <div class="input-group input-group-alternative">
                          <select id="cod_tox" name="cod_tox" class="form-control"data-live-search="true">
                          <option value="" disabled selected>Selecciona un nivel de Toxicidad</option>
                          <?php 
                          $query="SELECT * FROM toxicidad";
                          $result =pg_query($conexion,$query);
                          while ($ver=pg_fetch_row($result)) {
                           ?>
                           <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]." - ".$ver[2]; ?></option>

                           <?php 
                         }
                         ?>
                       </select>
                          
                        </div>
                      </div>

                      
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                         <select id="tip_uni_med" name="tip_uni_med" class="form-control"data-live-search="true">
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
                    <div class="input-group input-group-alternative" id="select2">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn btn-primary my-4" id="btn_save" onclick="preloader();">Guardar</button>
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
  <!-- modal para editar datos -->

  <div class="col-md-4">
    <div class="modal fade" id="modal-form-up" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-secondary shadow border-0">
              <a href="#"  data-dismiss="modal" aria-label="Close" style="margin: 10px 20px 0 0; text-align: right;">
                <span aria-hidden="true" style="left: 0;">×</span>
              </a>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                  <h2>Editar Datos</h2>
                </div>
                <form role="form" id="form-up-agr">


                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <input id="des_insup" type="text" class="form-control" placeholder="Nombre" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <Label>Estado:</Label>

                      <ul>
                        <li>
                          <input type="radio" name="est_agrup" id="est_agrup" value="Sólido" >
                          <label for="est_agrup">Sólido</label>
                        </li>

                        <li>
                          <input type="radio" name="est_agrup" id="est_agrup" value="Líquido">
                          <label for="est_agrup">Líquido</label>
                        </div>
                      </li>
                    </ul>
                  </div>

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <Label>Clasificación:</Label>

                      <ul>
                        <li>
                          <input type="radio" name="cla_agrup" id="cla_agrup" value="Fertilizante" >
                          <Label for="cla_agrup">Fertilizante</Label>

                        </li>

                        <li>
                          <input type="radio" name="cla_agrup" id="cla_agrup" value="Agroquímico" >
                          <Label for="cla_agrup">Agroquímico</Label>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                     <select id="tip_uni_medup" name="tip_uni_med" class="form-control"data-live-search="true">
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
                    <div class="input-group input-group-alternative">
                     <select id="uni_medup" name="uni_medup" class="form-control"data-live-search="true">
                      <option value="" disabled selected>Selecciona Uni. de medida</option>
                      <?php 
                      $query="SELECT cod_unm,des_unm FROM unidad_de_medida";
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
                <div class="input-group input-group-alternative" id="select2up">
                </div>
              </div>

              <div class="form-group">
                <label for="det_agr">Detalle</label>
                <textarea id="det_agrup" class="form-control" rows="2"></textarea>
              </div>
              <div class="text-center">
                <button type="button" class="btn btn-default my-4" id="btn_up" onclick="preloaderup();">Guardar</button>
              </div>
              <input type="text" name="" id="rrr" style="display: none;">
            </form>
            <img src="../assets/img/icons/preloader.gif" id="preloaderup" style="margin: 10px auto;">
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
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-0">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-form">Agregar</button>
      </div>
      <div class="table-responsive"  id="tab_agroquimicos">

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
<script src="../js/funciones_agroquimicos.js"></script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function(){
    jQuery('#ver2').hide();
    $('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');
    $('#menu').load('../php/componentes/menu/menu.php');

  });
</script>
<script>
  $(document).ready(function(){
    $('#tip_uni_med').change(function(){
      recargarlista();      
    });

  });
</script>

<script >
  function recargarlista(){
    cod_tum=$('#tip_uni_med').val();
    $.ajax({
      type:"post",
      url:"../php/componentes/componentes_agroquimicos/unidad_med.php",
      data:"uni_med="+cod_tum,
      success:function(r){
        $('#select2').html(r);
      }
    });
  }
</script>

<script>
  function cerrar_menu(){
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
  }
</script>