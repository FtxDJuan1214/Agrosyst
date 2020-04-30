<?php 
	require_once '../../conexion.php';     
	$cod_ncu = $_POST['cod_ncu'];
	$sql="DELETE FROM public.nombre_cultivo
	WHERE cod_ncu ='$cod_ncu';";
	  echo $result=pg_query($conexion,$sql);
?>