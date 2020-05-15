<?php 
session_start();
require_once '../../conexion.php';     
$nomb_cultivo = $_SESSION['idusuario'].ucwords(strtolower($_POST['nomb_cultivo']));

$sqx="SELECT cod_ncu FROM nombre_cultivo ORDER BY cod_ncu DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);

$cod_ncu= 1;
if (pg_num_rows($res) != 0) {
	$cod_ncu=$ver[0] + 1;
}

$sql="INSERT INTO public.nombre_cultivo(cod_ncu,des_ncu)
VALUES ('$cod_ncu','$nomb_cultivo');";
echo $result=pg_query($conexion,$sql);
?>