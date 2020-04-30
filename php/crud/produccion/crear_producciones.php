<?php 
require '../../conexion.php';

$cod_tpr=$_POST['cod_tpr'];
$cod_pro=$_POST['cod_pro'];
$fec_goz=$_POST['fec_goz'];
$ctp_goz=$_POST['ctp_goz'];
$pre_goz=$_POST['pre_goz'];
$cpt_goz=$_POST['cpt_goz'];

$sql="INSERT INTO public.gozar(
	cod_tpr, cod_pro, fec_goz, ctp_goz, pre_goz, cpt_goz)
	VALUES ('$cod_tpr', '$cod_pro', '$fec_goz', '$ctp_goz', '$pre_goz', '$cpt_goz')";

echo $result=pg_query($conexion,$sql);


?>

