
<?php 
require_once '../../conexion.php';     

session_start();
$like = $_SESSION['idusuario'];


$cod_pla = $_POST['cod_pla'];

//-----//
$info = "SELECT*FROM planificacion,procesos_fitosanitarios WHERE
planificacion.cod_pfi = procesos_fitosanitarios.cod_pfi
AND planificacion.cod_pla = '$cod_pla'
AND procesos_fitosanitarios.ffi_pfi is NULL";

$respt=pg_query($conexion,$info);
$total=pg_fetch_row($respt);

$planes = explode("||", $info);
$contarPlanes=count($planes) - 1;

$enfermedad = "";
$tipo = "";
        //Obtener el nombre de la enfermedad
        $sqx = "SELECT nom_afe from afeccion where cod_afe = '$total[10]'";
        $resp=pg_query($conexion,$sqx);
        $got=pg_fetch_row($resp);
        $enfermedad = $got[0];

        //Obtener la fecha desde cuando se inicio el proceso fitosanitario
        $fechaInicio = $total[8];   ?>

    <div class="row">
        <div class="col 6">
            <div class="card ">
                <div class="card-body">
                    <div class="row d-block">
                        <div class="col">


                            <ul class='list-group'>
                                <li class='list-group-item text-light text-center' style="background: #16284C;font-family:'FontAwesome',tahoma; font-size: 14px;">
                                <b>Planificación N°: <?php 
                                    $sepr = explode("-", $total[0]);
                                    echo $sepr[1] ?><br></b>
                                    Fecha de realización: <?php echo $total[2]?><br>
                                    Esta planificación es realizada especialmente para:
                                        <b><?php echo $enfermedad ?></b><br>
                                    Registro de presencia desde el día:</br>
                                    <?php echo $fechaInicio ?>
                                    <br>
                                </li>
                                <!--------------------Agroquimicos------------------------>

                                <li class='list-group-item text-light' style="background: #16284C;font-family:'FontAwesome',tahoma; font-size: 12px;">
                                    <?php 

                                  $cod_agroquimicos =explode(",", $total[6]);
                                  $contarAgro=count($cod_agroquimicos);

                                  for($d=1;$d<$contarAgro;$d++){

                                    $agro = "SELECT * FROM agroquimicos WHERE cod_agr= '$cod_agroquimicos[$d]'";
                                    $ragro=pg_query($conexion,$agro);
                                    $info=pg_fetch_row($ragro);

                                    $rec = "SELECT det_rus FROM recomendaciones_uso_agr WHERE cod_agr = '$cod_agroquimicos[$d]'";
                                    $recr=pg_query($conexion,$rec);
                                    $cont=pg_num_rows($recr);
                                    
                                    ?>
                                    <br><b>Nombre:</b> <?php echo $info[2] ?> <br>
                                    <b>Periodo de carencia:</b> <?php echo $info[4] ?> Días <br>
                                    <b>Perido de entrada:</b> <?php echo $info[5] ?> Días <br>
                                    <b>Dosis recomendada:</b> <?php echo $info[9] ?><br>                                   
                                    
                                    <?php
                                    //----------------Aconsejar sobre tiempo de empleo-------------->
                                    $hora = "SELECT hat_afe FROM afeccion WHERE afeccion.cod_afe = '$total[10]'";
                                    $rhora=pg_query($conexion,$hora);
                                    $horat=pg_fetch_row($rhora);

                                    if($horat[0] == 'Madrugada'){
                                        ?><b>Tiempo optimo de aplicación:</b> Madrugada <?php
                                    }else if($horat[0] == 'Medio día'){
                                        ?><b>Tiempo optimo de aplicación: Medio día<?php
                                    }else if($horat[0] == 'Atardecer'){
                                        ?><b>Tiempo optimo de aplicación: Atardecer<?php
                                    }else if($horat[0] == 'noche'){
                                        ?><b>Tiempo optimo de aplicación: En horas de la tarde, pues su aparician es en la noche<?php
                                    }

                                    if($cont != 0){?>

                                    <br><br><p style="color:red;" class="fas fa-exclamation-triangle"> RECOMENDACIONES DE USO:</p><br>

                                    <?php                                
                                    
                                      while($ver=pg_fetch_row($recr)){
                                    ?>                                   
                                      <?php echo '• '.$ver[0] ?><br>

                                    <?php
                                        }
                                    }else{
                                        ?><br><br><?php
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

?>