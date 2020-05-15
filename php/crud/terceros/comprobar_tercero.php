<?php 
require_once '../../conexion.php';	
$ide_ter = $_POST['ide_ter'];

$consulta1= "SELECT * FROM public.act_con WHERE  ide_ter='$ide_ter'";
$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo " \n\nEsta persona no se puede eliminar
		  porque está en convenios.";
}

$consulta2= "SELECT * FROM public.act_cul WHERE  ide_ter='$ide_ter'";
$result2=pg_query($conexion,$consulta2);
$filas2=pg_num_rows($result2);
if($filas2 > 0 ){
	echo " \n\nEsta persona no se puede eliminar
		  porque es socio de un cultivo.";
}

$consulta3= "SELECT * FROM public.comprar WHERE  ide_ter='$ide_ter'";
$result3=pg_query($conexion,$consulta3);
$filas3=pg_num_rows($result3);
if($filas3 > 0 ){
	echo " \n\nEsta persona no se puede eliminar
		  porque ha realizado compras.";
}


$consulta4= "SELECT * FROM public.fincas WHERE  ide_ter='$ide_ter'";
$result4=pg_query($conexion,$consulta4);
$filas4=pg_num_rows($result4);
if($filas4 > 0 ){
	echo " \n\nEsta persona no se puede eliminar porque 
	está registrado como duenio de una finca.";
}


$consulta5= "SELECT * FROM public.produccion WHERE  ide_ter='$ide_ter'";
$result5=pg_query($conexion,$consulta5);
$filas5=pg_num_rows($result5);
if($filas5 > 0 ){
	echo " \n\nEsta persona no se puede eliminar porque 
	aparece como comprador en producciones.";
}

?>

