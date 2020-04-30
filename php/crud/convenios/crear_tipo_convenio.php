<?php 
require_once '../../conexion.php'; 

$sql1="SELECT cod_con FROM convenio ORDER BY cod_con DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod_con=pg_fetch_row($result);
$tipo_con = $_POST['tipo_con'];


if($tipo_con==1){
	$hor_jor=$_POST['hor_jor'];
	$vho_hor=$_POST['vho_hor'];
	$sql="INSERT INTO public.jornales(
	hor_jor, vho_jor, cod_con)
	VALUES ('$hor_jor', '$vho_hor', '$cod_con[0]')";
	echo $result=pg_query($conexion,$sql);
}
if($tipo_con==2){
	$val_cont=$_POST['val_cont'];
	$ffi_con=$_POST['ffi_con'];
	$des_cont=$_POST['des_cont'];
	$sql="INSERT INTO public.contratos(
	 val_cot, des_cot, cod_con, ffi_con)
	VALUES ('$val_cont', '$des_cont', '$cod_con[0]', '$ffi_con')";
	echo $result=pg_query($conexion,$sql);
}
?>