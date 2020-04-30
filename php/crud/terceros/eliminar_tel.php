<?php 
	require_once '../../conexion.php';	
     $tel_ter = $_POST['tel_ter'];

  $sql ="DELETE FROM public.tel_tercero
		WHERE tel_ter='$tel_ter'";

  echo $result = pg_query($conexion,$sql);
?>

