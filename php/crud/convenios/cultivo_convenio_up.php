<?php 
	require_once '../../conexion.php';     
	 $cod_cul = $_POST['cod_cul_up'];
	 $cod_con = $_POST['cod_con'];	 

	 $sql="UPDATE public.ejecutar
	SET  cod_cul='$cod_cul'
	WHERE cod_con='$cod_con'";
	  echo $result=pg_query($conexion,$sql);
?>