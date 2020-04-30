<?php 
require_once '../../conexion.php';     
$act = $_POST['actividad'];
$fitosanitario = $_POST['fitosanitario'];

$sqx="SELECT cod_tar FROM tarea ORDER BY cod_tar DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
				$ver=pg_fetch_row($res);
				$cod_tar=$ver[0];

if ($act==1) {

	$sql="INSERT INTO public.comun(
	cod_tar)
	VALUES ('$cod_tar')";
	echo $result=pg_query($conexion,$sql);

}else if($act==2){

	$sql="INSERT INTO public.fitosanitaria(
	enf_fit, cod_tar)
	VALUES ('$fitosanitario', '$cod_tar')";
	echo $result=pg_query($conexion,$sql);

}else if($act==3){

	$sql="INSERT INTO public.cultural(
	cod_tar)
	VALUES ('$cod_tar')";
	
	echo $result=pg_query($conexion,$sql);
}
?>