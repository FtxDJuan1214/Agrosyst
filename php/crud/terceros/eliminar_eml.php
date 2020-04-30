<?php 
	require_once '../../conexion.php';	
     $eml_ter = $_POST['eml_ter'];

  $sql ="DELETE FROM public.email_tercero
		WHERE ema_ter='$eml_ter'";

  echo $result = pg_query($conexion,$sql);
?>

