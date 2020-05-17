<?php 
require_once '../../conexion.php';     

session_start();
$like = $_SESSION['idusuario'];


$epoca = $_POST['epoca'];
$fecha = $_POST['fecha'];
$info = $_POST['info'];
$num_pla = $_POST['num_plan'];

$planes = explode("||", $info);
$contarPlanes=count($planes) - 1;

$enfermedad = "";
$tipo = "";
$boton = false;

for($i = 0; $i < $contarPlanes; $i++){

	    $subplan = $num_pla+$i;
       $sep =explode("/", $planes[$i]); //Uno: Codigo agroquimico - Dos:codigo enfermedad - Tres:Tipo de tarea - Cuatro:Agroquimicos utilizados divididos por ´,´  	

        //Obtener el nombre de la enfermedad
        $sqx = "SELECT nom_afe from afeccion where cod_afe = '$sep[1]'";
        $resp=pg_query($conexion,$sqx);
        $got=pg_fetch_row($resp);
        $enfermedad = $got[0];


        //Obtener la fecha desde cuando se inicio el proceso fitosanitario
        $sqx1 = "SELECT afeccion.nom_afe, procesos_fitosanitarios.fin_pfi
        from public.afeccion, public.procesos_fitosanitarios
        where afeccion.cod_afe = procesos_fitosanitarios.cod_afe
        AND procesos_fitosanitarios.ffi_pfi is null
        AND procesos_fitosanitarios.cod_afe = '$sep[1]'";
        $res=pg_query($conexion,$sqx1);
        $got1=pg_fetch_row($res);
        $fechaInicio = $got1[1];


  if($sep[2] == "Curación"){    
?>

<div class="row">
    <div class="col 6">
        <div class="card ">
            <div class="card-body">
                <div class="row d-block">
                    <div class="col">
                    <?php if($boton == false){?>
                        <div style="display: flex; justify-content: center;">
                            <a style="align-self: center; font-family:'FontAwesome',tahoma; font-size: 11px; color:white;"
                                class="btn btn-success my-4" href="planificaciones.php" data-toggle="tooltip"
                                title="Ir al listado de planificaciones">Planificaciones</a>
                        </div>
                        <?php
                        $boton=true;
                        }
                        ?>

                        <ul class='list-group'>
                            <li class='list-group-item text-light'
                                style="background: #16284C;font-family:'FontAwesome',tahoma; font-size: 17px;">
                                <center><b>Planificación N°:</b> <?php echo $subplan ?></center><br>
                                <b>Fecha de realización:</b> <?php echo $fecha ?><br>
                                <b>Descripción:</b> Esta planificación es realizada especialmente para lucha contra: -
                                <?php echo $enfermedad ?> - con registro de presencia desde el día
                                <?php echo $fechaInicio ?>
                                <br>
                            </li>
                            <!--------------------Agroquimicos------------------------>

                            <li class='list-group-item text-light'
                                style="background: #16284C;font-family:'FontAwesome',tahoma; font-size: 15px;">
                                <?php 

                                  $cod_agroquimicos =explode(",", $sep[3]);
                                  $contarAgro=count($cod_agroquimicos);

                                  for($d=1;$d<$contarAgro;$d++){

                                    $agro = "SELECT * FROM agroquimicos WHERE cod_agr= '$cod_agroquimicos[$d]'";
                                    $ragro=pg_query($conexion,$agro);
                                    $info=pg_fetch_row($ragro);

                                    $rec = "SELECT det_rus FROM recomendaciones_uso_agr WHERE cod_agr = '$cod_agroquimicos[$d]'";
                                    $recr=pg_query($conexion,$rec);
                                    
                                    ?>
                                <br><b>Nombre:</b> <?php echo $info[2] ?> <br>
                                <b>Recomendación de aplicación:</b> <?php echo $info[3] ?> <br>
                                <b>Periodo de carencia:</b> <?php echo $info[4] ?> horas <br>
                                <b>Perido de entrada:</b> <?php echo $info[5] ?> horas <br>
                                <b>Dosis recomendada:</b> <?php echo $info[9] ?><br><br>

                                <a style="color:red; font-family:'FontAwesome',tahoma;"
                                    class="fas fa-exclamation-triangle"> RECOMENDACIONES DE USO:</a><br>

                                <?php                                
                                    
                                      while($ver=pg_fetch_row($recr)){
                                    ?>
                                <?php echo '• '.$ver[0] ?><br>

                                <?php
                                    }
                                  }
                                    ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php
}else if($sep[2] == "Prevención"){
?>
<div class="row">
    <div class="col 6">
        <div class="card ">
            <div class="card-body">
                <div class="row d-block">
                    <div class="col">

                    <?php if($boton == false){?>
                        <div style="display: flex; justify-content: center;">
                            <a style="align-self: center; font-family:'FontAwesome',tahoma; font-size: 11px; color:white;"
                                class="btn btn-success my-4" href="planificaciones.php" data-toggle="tooltip"
                                title="Ir al listado de planificaciones">Planificaciones</a>
                        </div>
                        <?php
                        $boton=true;
                        }
                        ?>


                        <ul class='list-group'>
                            <li class='list-group-item' style="font-family:'FontAwesome',tahoma; font-size: 17px;">
                                <b><center>Planificación N°:</b> <?php echo $subplan ?></center><br>
                                <b>Fecha de realización:</b> <?php echo $fecha ?><br>
                                <b>Descripción:</b> Esta planificación es realizada para la prevención de: -
                                <?php echo $enfermedad ?> -
                                <br>
                            </li>
                                <!--------------------Agroquimicos------------------------>

                            <li class='list-group-item text-light'
                                style="background: #16284C;font-family:'FontAwesome',tahoma; font-size: 15px;">
                                <?php 

                                  $cod_agroquimicos =explode(",", $sep[3]);
                                  $contarAgro=count($cod_agroquimicos);

                                  for($d=1;$d<$contarAgro;$d++){

                                    $agro = "SELECT * FROM agroquimicos WHERE cod_agr= '$cod_agroquimicos[$d]'";
                                    $ragro=pg_query($conexion,$agro);
                                    $info=pg_fetch_row($ragro);

                                    $rec = "SELECT det_rus FROM recomendaciones_uso_agr WHERE cod_agr = '$cod_agroquimicos[$d]'";
                                    $recr=pg_query($conexion,$rec);
                                    
                                    ?>
                                <br><b>Nombre:</b> <?php echo $info[2] ?> <br>
                                <b>Recomendación de aplicación:</b> <?php echo $info[3] ?> <br>
                                <b>Periodo de carencia:</b> <?php echo $info[4] ?> horas <br>
                                <b>Perido de entrada:</b> <?php echo $info[5] ?> horas <br>
                                <b>Dosis recomendada:</b> <?php echo $info[9] ?><br><br>

                                <a style="color:red; font-family:'FontAwesome',tahoma;"
                                    class="fas fa-exclamation-triangle"> RECOMENDACIONES DE USO:</a><br>

                                <?php                                
                                    
                                      while($ver=pg_fetch_row($recr)){
                                    ?>
                                <?php echo '• '.$ver[0] ?><br>

                                <?php
                                    }
                                  }
                                    ?>
                            </li>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
}
?>
<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>