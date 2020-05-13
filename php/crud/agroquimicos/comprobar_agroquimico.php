<?php 
require_once '../../conexion.php';	
$cod_agr = $_POST['cod_agr'];
$cod_ins = $_POST['cod_ins'];



$consulta1= "SELECT*FROM public.eta_x_afe WHERE cod_agr='$cod_agr'";
$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo " \n\nEste agroquímico está siendo utilizado como combate en una etapa de una plaga o una enfermedad.";
}

$consulta1= "SELECT*FROM public.stock WHERE cod_ins = '$cod_ins'";
$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo " \n\nEste agroquímico está siendo contado en stock";
}

?>

