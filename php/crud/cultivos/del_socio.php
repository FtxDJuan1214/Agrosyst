<?php 
	require_once '../../conexion.php';     
	$ide_ter= $_POST['ide_ter'];
	$cod_cul= $_POST['cod_cul'];
	$sql="DELETE FROM public.act_cul
	WHERE ide_ter='$ide_ter' and cod_cul='$cod_cul'";
	echo $result=pg_query($conexion,$sql);
?>