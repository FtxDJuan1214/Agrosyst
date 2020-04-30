<?php 
	require_once '../../conexion.php';     
	 $trabajador = $_POST['trabajador'];
	 $socio = $_POST['socio'];

	 $sql1="SELECT cod_con FROM convenio ORDER BY cod_con DESC LIMIT 1";
	 $result1=pg_query($conexion,$sql1);
 	 $ver=pg_fetch_row($result1);
 	 $cod_con=$ver[0];

	$sql="INSERT INTO public.act_con(
	cod_con, ide_ter)
	VALUES ('$cod_con', '$trabajador')";
	  echo $result=pg_query($conexion,$sql);

	$sql="INSERT INTO public.act_con(
	cod_con, ide_ter)
	VALUES ('$cod_con', '$socio')";
	  echo $result=pg_query($conexion,$sql);
?>