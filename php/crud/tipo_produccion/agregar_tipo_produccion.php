<?php 
require '../../conexion.php';
session_start();

$sqx="SELECT cod_tpr FROM tipo_de_produccion ORDER BY cod_tpr DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);

$cod= 1;
if (pg_num_rows($res) != 0) {
	$cod = $ver[0] + 1;
}

$des_tpr=$_POST['des_tpr'];
$cod_unm=$_POST['cod_unm'];
$user =  $_SESSION['idusuario'];
$sql="INSERT INTO public.tipo_de_produccion(cod_tpr,des_tpr, cod_unm) VALUES ('$cod','$user$des_tpr', '$cod_unm')";
echo $result=pg_query($conexion,$sql);
?>

