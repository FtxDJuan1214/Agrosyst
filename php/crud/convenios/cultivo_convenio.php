<?php 
	require_once '../../conexion.php';     
	 $cod_cul = $_POST['cod_cul'];
	 $sql1="SELECT cod_con FROM convenio ORDER BY cod_con DESC LIMIT 1";
	 $result1=pg_query($conexion,$sql1);
 	 $ver=pg_fetch_row($result1);
 	 $cod_con=$ver[0];

	 $sql="INSERT INTO public.ejecutar(
	cod_con, cod_cul)
	VALUES ('$cod_con', '$cod_cul');";
	  echo $result=pg_query($conexion,$sql);
?>