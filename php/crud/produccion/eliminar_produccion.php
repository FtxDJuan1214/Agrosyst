<?php 
require_once '../../conexion.php';     
$cod_pro = $_POST['cod_pro'];
$cod_cuñ = $_POST['cod_cuñ'];

$sql1="DELETE FROM public.gozar
	WHERE cod_pro = '$cod_pro'";
$result=pg_query($conexion,$sql1);

$sql1="DELETE FROM public.produccion
	WHERE cod_pro = '$cod_pro' AND cod_cul='$cod_cuñ'";
echo $result=pg_query($conexion,$sql1);
?>


