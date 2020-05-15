<?php 
require_once '../../conexion.php'; 

$sql1="SELECT cod_con FROM convenio ORDER BY cod_con DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod_con=pg_fetch_row($result);
$tipo_con = $_POST['tipo_con'];


if($tipo_con==1){
	$hor_jor=$_POST['hor_jor'];
	$vho_hor=$_POST['vho_hor'];
	
	$sqx="SELECT cod_jor FROM public.jornales ORDER BY cod_jor DESC LIMIT 1";
	$res=pg_query($conexion,$sqx);
	$ver=pg_fetch_row($res);


	$cod_jor= 1;
	if (pg_num_rows($res) != 0) {
		$cod_jor=$ver[0] + 1;
	}

	$sql="INSERT INTO public.jornales(cod_jor,hor_jor, vho_jor, cod_con)
	VALUES ('$cod_jor','$hor_jor', '$vho_hor', '$cod_con[0]')";
	echo $result=pg_query($conexion,$sql);
}
if($tipo_con==2){
	$val_cont=$_POST['val_cont'];
	$ffi_con=$_POST['ffi_con'];
	$des_cont=$_POST['des_cont'];
	
	$sqx="SELECT cod_cot FROM public.contratos ORDER BY cod_cot DESC LIMIT 1";
	$res=pg_query($conexion,$sqx);
	$ver=pg_fetch_row($res);
	
	$cod_cot= 1;
	if (pg_num_rows($res) != 0) {
		$cod_cot=$ver[0] + 1;
	}

	$sql="INSERT INTO public.contratos(cod_cot,val_cot, des_cot, cod_con, ffi_con)
	VALUES ('$cod_cot','$val_cont', '$des_cont', '$cod_con[0]', '$ffi_con')";
	echo $result=pg_query($conexion,$sql);
}
?>