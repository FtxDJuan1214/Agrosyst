<?php 
require '../../conexion.php';

$cod_tpr=$_POST['cod_tpr'];
$cod_pro=$_POST['cod_pro'];
$fec_goz=$_POST['fec_goz'];
$ctp_goz=$_POST['ctp_goz'];
$pre_goz=$_POST['pre_goz'];
$cpt_goz=$_POST['cpt_goz'];

$sql="UPDATE public.gozar
	SET  fec_goz='$fec_goz', ctp_goz='$ctp_goz', pre_goz='$pre_goz', cpt_goz='$cpt_goz'
	WHERE cod_tpr='$cod_tpr' AND cod_pro='$cod_pro'";

echo $result=pg_query($conexion,$sql);


?>

