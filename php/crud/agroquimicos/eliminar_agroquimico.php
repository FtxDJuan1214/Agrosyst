<?php 
require_once '../../conexion.php';     
/*$cod_agr = $_POST['cod_agr'];*/
$cod_ins = $_POST['cod_ins'];


$sql="DELETE FROM public.agroquimicos
WHERE cod_ins='$cod_ins'";
$result=pg_query($conexion,$sql);

if($result==true){

	$sql1="DELETE FROM public.insumos 
	WHERE cod_ins=$cod_ins";
	$result1=pg_query($conexion,$sql1);
}

?>