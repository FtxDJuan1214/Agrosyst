<?php 
require_once '../../conexion.php';     
$fec_con = $_POST['fec_con'];

$sql1="SELECT cod_con FROM public.convenio ORDER BY cod_con DESC LIMIT 1";
$result1=pg_query($conexion,$sql1);
$ver=pg_fetch_row($result1);

$cod_con= 1;
if (pg_num_rows($result1) != 0) {
	$cod_con=$ver[0] + 1;

}

$sql="INSERT INTO public.convenio(cod_con,fec_con)
VALUES ('$cod_con','$fec_con')";
echo $result=pg_query($conexion,$sql);
?>