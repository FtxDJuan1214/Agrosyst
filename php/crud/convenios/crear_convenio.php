<?php 
	require_once '../../conexion.php';     
	 $fec_con = $_POST['fec_con'];
	 $sql="INSERT INTO public.convenio(
	fec_con)
	VALUES ('$fec_con')";
	  echo $result=pg_query($conexion,$sql);
?>