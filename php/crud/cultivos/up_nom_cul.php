<?php 
	require_once '../../conexion.php';
	session_start();     
	$nomb_cultivo = $_SESSION['idusuario'].ucwords(strtolower($_POST['nomb_cultivo']));
	$cod_cul=$_POST['cod_cul'];
	$sql="	UPDATE public.nombre_cultivo
		SET des_ncu='$nomb_cultivo'
		WHERE cod_ncu='$cod_cul'";
	  echo $result=pg_query($conexion,$sql);
?>