<?php 
	require_once '../../conexion.php';	
     $ide_ter = $_POST['ide_ter'];
     $tel_ter = $_POST['tel_ter'];

  $sql ="INSERT INTO public.tel_tercero(
	ide_ter, tel_ter)
	VALUES ('$ide_ter', '$tel_ter')";

  echo $result = pg_query($conexion,$sql);
?>

