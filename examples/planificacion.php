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

if ((isset($_POST['proveedor'])) && (isset($_POST['tip_ins'])) && (isset($_POST['cod_ins'])) && (isset($_POST['cod_ter_soc']))) {
  if ($_SESSION['saber'] == true) {
    error_reporting(0);
    $num_fact = $_POST['num_fact'];
    $proveedor = $_POST['proveedor'];
    $can_sto = $_POST['can_sto'];
    $fec = $_POST['date'];
    $tip_ins = $_POST['tip_ins'];
    $cos_uni = $_POST['cos_uni'];
    $time = $_POST['time'];
    $cod_ins = $_POST['cod_ins'];
    $cos_mul = $_POST['cos_mul'];
    $cod_ter_soc = $_POST['cod_ter_soc'];
    $cod_cul = $_POST['cod_cul'];

    $string="$tip_ins,$cod_ins,$can_sto,$cos_uni,$cos_mul";
    require '../php/conexion.php';
    $sql="SELECT insumos.des_ins,unidad_de_medida.des_unm FROM insumos,unidad_de_medida
    WHERE insumos.cod_unm=unidad_de_medida.cod_unm AND insumos.cod_ins='$cod_ins'";
    $result=pg_query($conexion,$sql);
    $detalle=pg_fetch_row($result);

    $unidad = explode("-",$detalle[1]);

    $ins="$detalle[0],$can_sto $unidad[1],$cos_uni $,$cos_mul";

    $_SESSION['costo_total']=($_SESSION['costo_total']+$cos_mul)."$";
    $_SESSION['productos']=$_SESSION['productos'].$string."+";
    $_SESSION['insumo']=$_SESSION['insumo'].$ins."+";

  }else{
    $_SESSION['productos']= null;
    $_SESSION['insumo']= null;
    $_SESSION['costo_total']="";
  }
}else{
  ?>


<?php
  $_SESSION['productos']= null;
  $_SESSION['insumo']= null;
  $_SESSION['costo_total']="";
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
        public.municipio, public.dueño, public.tipo_unidad_medida
        WHERE municipio.cod_dep=departamento.cod_dep AND fincas.cod_mun=municipio.cod_mun 
        AND fincas.cod_unm=unidad_de_medida.cod_unm AND unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum 
        AND fincas.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter and fincas.cod_fin='$ide_ter'";
        $result=pg_query($conexion,$sql);
        $finca=pg_fetch_row($result);
        ?>
                <a class="h2 mb-0 text-white text-uppercase  d-lg-inline-block"><?php echo $finca[1]." "?><i
                        class="fas fa-angle-right"></i> Planificación</a>
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
            style="background: url('../assets/img/theme/compras.jpg'); no-repeat; background-size: cover;">
            <span class="mask bg-gradient-opaco opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col 12 ">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row d-block">
                                        <div class="col">

                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
                                                method="post">
                                                <div class="row">

                                                    <!--------------------Primera Columna -------------------------->
                                                    <div class="col-md-4">
                                                        <!------------------Codigo planificación----------------------->
                                                        <div class="form-group">
                                                            <?php   
                                                              $sql1="SELECT cod_pla FROM planificacion ORDER BY cod_pla DESC LIMIT 1";
                                                              $result=pg_query($conexion,$sql1);
                                                              $cod=pg_fetch_row($result);                    
                                                            ?>
                                                            <input type="text" class="form-control" id="num_fact"
                                                                name="num_fact"
                                                                value="<?php echo "Planificación N°: ".($cod[0]+1);?>"
                                                                autocomplete="off" readonly>
                                                        </div>
                                                        <!-----------------------fecha------------------------------------>
                                                        <div class="form-group">
                                                            <div class="input-group ">
                                                                <?php
                                                                date_default_timezone_set('America/Bogota');
                                                                $d = date("d");
                                                                $m = date("m");
                                                                $y = date("Y");
                                                                $fecha = $y . "-" . $m . "-" . $d;
                                                                ?>
                                                                <?php if (isset($fec)) {
                                                                ?>
                                                                <input readonly class="form-control datepicker"
                                                                    id="date" name="date" placeholder="Select date"
                                                                    type="text" value="<?php echo $fec ?>">
                                                                <?php
                                                                  } else {
                                                                  ?>
                                                                <input class="form-control datepicker" id="date"
                                                                    name="date" placeholder="Select date" type="text"
                                                                    value="<?php echo $fecha ?>">
                                                                <?php
                                                                    }
                                                                    ?>

                                                            </div>
                                                        </div>                                                        
                                                        <!----------------------Epoca---------------------->
                                                        <div class="form-group">
                                                            <div class="input-group input-group-alternative">
                                                                <select id="epoca" class="form-control" data-live-search="true">
                                                                    <option value="" disabled selected>Epoca</option>
                                                                    <option value="1">Invierno</option>
                                                                    <option value="2">Verano</option>
                                                                </select>
                                                            </div>
                                                        </div>                                                                                                                                                                                                                             
                                                    </div>
                                                    <!--------------------Segunda Columna -------------------------->
                                                    <div class="col-md-4">
                                                    <!-----------------------------Detalle------------------------->
                                                        <div class="form-group">                                                            
                                                            <div class="form-group">
                                                                <textarea id="det_pla" class="form-control" placeholder="Detalle"
                                                                    rows="1"></textarea>
                                                            </div>
                                                        </div> 
                                                        <!----------------------Tipo de tarea---------------------->
                                                        <div class="form-group">
                                                            <div class="form-group mb-3">
                                                                <div class="input-group input-group-alternative">
                                                                    <select id="tip_tar" name="tip_tar" class="form-control" data-live-search="true">
                                                                    <option value="" disabled selected>Tipo de tarea</option>
                                                                    <option value="1">Nutrición</option>
                                                                    <option value="2">Prevención</option>
                                                                    <option value="3">Combate</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                                                  
                                                    </div>

                                                    <!--------------------Tercera Columna -------------------------->
                                                    <div class="col-md-4">
                                                      
                                                      <!----------------------Select escoger plaga o enfermedad------------------>
                                                        <div class="form-group">
                                                          <div class="input-group">
                                                            <div class="input-group input-group-alternative" id="sel_enf_pla" name="sel_enf_pla">
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <!-------------------------Escoger plaga o enfermedad------------------>                
                                                        <div class="form-group">
                                                          <div class="input-group">
                                                            <div class="input-group input-group-alternative" id="enfe_plag" name="enfe_plag">
                                                            </div>
                                                          </div>
                                                        </div>
                                                      

                                                    </div>

                                                    <!-----------------------------Imagenes de etapas------------------------->
                                                    <div class="form-group">
                                                        <div class="input-group input-group-alternative" id="etapasN" name="etapasN">
                                                       </div>              
                                                    </div>
                                                    
                                                    <!----------------------------Tabla de agroquimicos-------------------------->
                                                    <div class="table-responsive" id="tab_agr" style="width:600px">                                                        
                                                    </div>  
                                                    
                                                    <!----------------------Botón Nueva Planificación------------------------->
                                                    
                                                    <div class="col-md-12">
                                                        <div class="float-md-right">
                                                            <input type="submit" name="cargar"
                                                                    class="btn btn-default my-4" data-toggle="tooltip"
                                                                    data-placement="top" title="Planificar otra tarea"
                                                                    value="&#xf067    "
                                                                    style="font-family:'FontAwesome',tahoma; font-size: 15px;">
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
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <!-- modal para ingresar datos -->
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <strong>Lista de planificaciones</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Insumo</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Costo Unit</th>
                                        <th scope="col">Costo total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $array=explode("+", $_SESSION['insumo']);
                                        $lenght=count($array);
                                        for ($j=0; $j< ($lenght-1); ++$j) {
                                            ?>
                                                                <tr>
                                                                    <?php 
                                            $arr2=explode(",",$array[$j]);
                                            $tam=count($arr2);
                                            for ($i=0; $i< ($tam); ++$i) {
                                            ?>

                                        <td><?php echo $arr2[$i] ?></td>
                                        <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="display: flex; justify-content: center;">
                            <a style="align-self: center;" href="#" class="btn btn-success my-4"
                                onclick="comprar();">Comprar</a>
                            <a style="align-self: center;" href="compras.php" class="btn btn-warning my-4">Cancelar</a>

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
    <script src="../js/funciones_planificacion.js"></script>
</body>

</html>