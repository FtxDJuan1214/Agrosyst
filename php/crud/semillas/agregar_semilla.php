<?php 
require_once '../../conexion.php';	
session_start();
$user =  $_SESSION['idusuario'];
$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);

$cod_ins = $cod[0];
$det_sem = ucwords(strtolower($_POST['det_sem']));

$sqx="SELECT cod_fer FROM public.fertilizantes ORDER BY cod_fer DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);    


$cod_fer= 1;
if (pg_num_rows($res) != 0) {
 $cod_fer=$ver[0] + 1;
}

$sql ="INSERT INTO fertilizantes(cod_fer,cod_ins,det_fer)
VALUES ('$cod_fer','$cod_ins', '$user$det_sem')";

echo $result = pg_query($conexion,$sql);
?>

