
<?php 
require_once '../../conexion.php';	
session_start();
$like =  $_SESSION['idusuario'];
$cod_pfi= $_POST['cod_pfi'];
$cod_cul= $_POST['cod_cul'];


$sql="SELECT*FROM comentarios_pfi WHERE cod_pfi = '$cod_pfi'";
$result1=pg_query($conexion,$sql);
$filas1=pg_num_rows($result1);
if($filas1 == 0 ){
	echo "no";
}else{

    //echo $filas1;
date_default_timezone_set('America/Bogota');
$d = date("d");
$m = date("m");
$y = date("Y");
$fecha = $y . "-" . $m . "-" . $d;

//Primero pongo 0 a las tareas para indicar que son procesos cerrados

$ver = "SELECT fitosanitaria.cod_fit, labores.nom_lab, labores.det_lab, 
fitosanitaria.cal_fit, tarea.fin_tar, tarea.cod_tar, fitosanitaria.aoi_fit
FROM fitosanitaria 
INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
INNER JOIN labores ON tarea.cod_lab = labores.cod_lab
INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
INNER JOIN convenio ON efectuar.cod_con = convenio.cod_con
INNER JOIN ejecutar ON ejecutar.cod_con = convenio.cod_con
INNER JOIN cultivos ON cultivos.cod_cul = ejecutar.cod_cul
WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
AND procesos_fitosanitarios.ffi_pfi IS null
AND cultivos.cod_cul = '$cod_cul'
AND procesos_fitosanitarios.cod_pfi = '$cod_pfi'";

    $result=pg_query($conexion,$ver);
    while($bor=pg_fetch_row($result)){

        $up="UPDATE public.fitosanitaria
        SET aoi_fit = '$fecha'
        WHERE cod_tar = '$bor[5]'";
        echo $resultup=pg_query($conexion,$up);

    }

//Luego verifico si no hay más cultivos añadidos a este proceso al mismo tiempo


$ver2 = "SELECT fitosanitaria.cod_fit, labores.nom_lab, labores.det_lab, 
fitosanitaria.cal_fit, tarea.fin_tar, tarea.cod_tar, fitosanitaria.aoi_fit
FROM fitosanitaria 
INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
INNER JOIN labores ON tarea.cod_lab = labores.cod_lab
INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
INNER JOIN convenio ON efectuar.cod_con = convenio.cod_con
INNER JOIN ejecutar ON ejecutar.cod_con = convenio.cod_con
INNER JOIN cultivos ON cultivos.cod_cul = ejecutar.cod_cul
WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
AND procesos_fitosanitarios.ffi_pfi IS null
AND cultivos.cod_cul != '$cod_cul'
AND procesos_fitosanitarios.cod_pfi = '$cod_pfi'";

$resultC=pg_query($conexion,$ver2);
$filasC=pg_num_rows($resultC);

echo $filasC;

if($filasC == 0){


$sql1="UPDATE public.procesos_fitosanitarios
SET ffi_pfi='$fecha'
WHERE cod_pfi = '$cod_pfi'";
echo $result=pg_query($conexion,$sql1);

}

}
?>