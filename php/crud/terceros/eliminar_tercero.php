<?php 
require_once '../../conexion.php';	
$ide_ter = $_POST['ide_ter'];

$sql ="DELETE FROM public.tel_tercero
WHERE ide_ter='$ide_ter'";

echo $result = pg_query($conexion,$sql);

$sql ="DELETE FROM public.email_tercero
WHERE ide_ter='$ide_ter'";

echo $result = pg_query($conexion,$sql);

$sql="DELETE FROM public.terceros
WHERE ide_ter='$ide_ter'";
echo $result = pg_query($conexion,$sql);
?>

