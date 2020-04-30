<?php 
require_once '../../conexion.php'; 
$num_fact=$_POST['num_fact'];
$proveedor=$_POST['proveedor'];
$comprador=$_POST['comprador'];

$sql1="INSERT INTO public.comprar(
	cod_com, ide_ter)
	VALUES ('$num_fact', '$proveedor');";
	
echo $result=pg_query($conexion,$sql1);

$sql1="INSERT INTO public.comprar(
	cod_com, ide_ter)
	VALUES ('$num_fact', '$comprador');";

echo $result=pg_query($conexion,$sql1);

?>