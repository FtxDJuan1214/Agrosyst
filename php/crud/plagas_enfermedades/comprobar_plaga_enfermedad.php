<?php 
require_once '../../conexion.php';	
$cod_afe = $_POST['cod_afe'];



$consulta1= "SELECT*FROM public.eta_x_afe WHERE cod_afe='$cod_afe' AND cod_agr NOT LIKE '1-1'";
$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo " \n\nEsta plaga o enfermedad está siendo utilizada como parte de una etapa ya relacionada con agroquimícos.";
}

?>

