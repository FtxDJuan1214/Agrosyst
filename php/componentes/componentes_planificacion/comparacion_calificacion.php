<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];


$cod_afe =$_POST['cod_afe'];
$cod_agr =$_POST['cod_agr'];


//
$query="SELECT AVG(fitosanitaria.cal_fit::INTEGER) from tarea
INNER JOIN fitosanitaria ON fitosanitaria.cod_tar = tarea.cod_tar
INNER JOIN utilizar ON utilizar.cod_tar = tarea.cod_tar
INNER JOIN stock ON stock.cod_sto = utilizar.cod_sto
INNER JOIN insumos on insumos.cod_ins = stock.cod_ins
INNER JOIN agroquimicos ON agroquimicos.cod_ins = insumos.cod_ins
INNER JOIN planificacion on planificacion.cod_pla = fitosanitaria.cod_pla
INNER JOIN procesos_fitosanitarios on procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
AND afeccion.cod_afe = '$cod_afe'
AND agroquimicos.cod_agr = '$cod_agr'";

$result=pg_query($conexion,$query);
$contar = array();
$ver=pg_fetch_row($result);

echo $ver[0];
            
?>