<?php 
require '../../conexion.php';
$cod_pro=$_POST['cod_pro'];
$ide_ter=$_POST['ide_ter'];

$sql="UPDATE public.produccion
	SET ide_ter= '$ide_ter' 
	WHERE cod_pro= '$cod_pro'";
$result=pg_query($conexion,$sql);
?>

