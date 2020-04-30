<?php 
require_once '../../conexion.php';     
$cod_tpr = $_POST['cod_tpr'];

$sql1="DELETE FROM public.tipo_de_produccion
	WHERE cod_tpr = '$cod_tpr'";
echo $result=pg_query($conexion,$sql1);

?>