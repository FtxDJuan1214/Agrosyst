<?php 
require_once '../../conexion.php';     
$cod_lab = $_POST['cod_lab'];

$sql="DELETE FROM public.labores
WHERE cod_lab='$cod_lab'";
echo $result=pg_query($conexion,$sql);
?>