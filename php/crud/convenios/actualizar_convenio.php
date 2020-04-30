<?php 
require_once '../../conexion.php';
$cod_con = $_POST['cod_con'];
$fec_con = $_POST['fec_con'];
$ide_ter = $_POST['ide_ter_up'];

$sql="UPDATE public.convenio
	SET  fec_con='$fec_con', ide_ter='$ide_ter'
	WHERE cod_con='$cod_con'";
echo $result=pg_query($conexion,$sql);
?>