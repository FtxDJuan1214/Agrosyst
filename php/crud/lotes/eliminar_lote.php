<?php 
require_once '../../conexion.php'; 

$cod_lot=$_POST['cod_lot'];
$sql="DELETE FROM public.lotes
WHERE cod_lot='$cod_lot'";
echo $result=pg_query($conexion,$sql);
?>