<?php 
require_once '../../conexion.php';     
$cod_pro = $_POST['cod_pro'];
$cod_tpr = $_POST['cod_tpr'];

$sql1="DELETE FROM public.gozar
	WHERE cod_tpr = '$cod_tpr' AND cod_pro = '$cod_pro'";
echo $result=pg_query($conexion,$sql1);

?>