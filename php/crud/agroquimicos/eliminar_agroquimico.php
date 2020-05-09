<?php 
require_once '../../conexion.php';     

$cod_ins = $_POST['cod_ins'];
$cod_agr = intval($_POST['cod_agr']);

$sql2="DELETE FROM public.recomendaciones_uso_agr
		WHERE cod_agr='$cod_agr';";
$result2=pg_query($conexion,$sql2);
if($result2==true){
	$sql="DELETE FROM public.agroquimicos
	WHERE cod_ins='$cod_ins';";
	$result=pg_query($conexion,$sql);

	if($result==true){

		$sql1="DELETE FROM public.insumos 
		WHERE cod_ins=$cod_ins";
		$result1=pg_query($conexion,$sql1);

		
	
	}


}



?>