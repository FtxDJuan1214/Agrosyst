<?php 
require_once '../../conexion.php';	
$ide_ter = $_POST['ide_ter'];
$eml_ter = $_POST['eml_ter'];

$sql ="INSERT INTO public.email_tercero(
ide_ter, ema_ter)
VALUES ('$ide_ter','$eml_ter')";

echo $result = pg_query($conexion,$sql);
?>

