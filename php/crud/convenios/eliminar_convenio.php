<?php 
require_once '../../conexion.php';     
$cod_con = $_POST['cod_con'];


$sql1="DELETE FROM public.ejecutar
	WHERE cod_con='$cod_con'";
$result1=pg_query($conexion,$sql1);

//Borrar el tipo de convenio

$sql2="DELETE FROM public.jornales
	WHERE cod_con='$cod_con'";
$result2=pg_query($conexion,$sql2);

$sql3="DELETE FROM public.contratos
	WHERE cod_con='$cod_con'";
$result3=pg_query($conexion,$sql3);

//Borrar los terceros
$sql4="DELETE FROM public.act_con
	WHERE cod_con='$cod_con'";
$result4=pg_query($conexion,$sql4);

//Borrar el convenio
$sql5="DELETE FROM public.convenio
	WHERE cod_con='$cod_con'";
echo  $result5=pg_query($conexion,$sql5);
?>