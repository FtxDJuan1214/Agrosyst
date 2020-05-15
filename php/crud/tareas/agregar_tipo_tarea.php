<?php 
require_once '../../conexion.php';     
$act = $_POST['actividad'];
$fitosanitario = $_POST['fitosanitario'];
$codi_plan = $_POST['cod_plan'];

$cod_fit="";

$sqx="SELECT cod_tar FROM tarea ORDER BY cod_tar DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
				$ver=pg_fetch_row($res);
				$cod_tar=$ver[0];

$sqf="SELECT cod_fit FROM fitosanitaria ORDER BY cod_fit DESC LIMIT 1";
$resf=pg_query($conexion,$sqf);
$verf=pg_fetch_row($resf);
$cont=pg_num_rows($resf);
if($cont != 0){
	$cod_fit =$verf[0]+1;
}else{
	$cod_fit='1';	
}	

if ($act==1) {

	$sql="INSERT INTO public.comun(
	cod_tar)
	VALUES ('$cod_tar')";
	echo $result=pg_query($conexion,$sql);

}else if($act==2){

	$sql="INSERT INTO public.fitosanitaria(
	cod_fit, cod_tar, cal_fit, cod_pla)
	VALUES ('$cod_fit', '$cod_tar',null,'$codi_plan')";
	echo $result=pg_query($conexion,$sql);

}else if($act==3){

	$sql="INSERT INTO public.cultural(
	cod_tar)
	VALUES ('$cod_tar')";
	
	echo $result=pg_query($conexion,$sql);
}
?>