<?php 
	require_once '../../conexion.php';     
	$cod_cul = $_POST['cod_cul'];
	$cod_ter_soc = $_POST['cod_ter_soc'];
	$sql="INSERT INTO public.act_cul(
	cod_cul, ide_ter)
	VALUES ('$cod_cul', '$cod_ter_soc')";
	  echo $result=pg_query($conexion,$sql);
?>