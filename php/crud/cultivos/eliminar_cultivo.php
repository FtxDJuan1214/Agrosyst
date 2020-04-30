<?php 
require_once '../../conexion.php';

$cod_cul = $_POST['cod_cul'];    

$sql1="DELETE FROM public.act_cul
WHERE cod_cul='$cod_cul'";
$r=pg_query($conexion,$sql1);

$sql="DELETE FROM public.cultivos
WHERE cod_cul='$cod_cul'";
echo $result=pg_query($conexion,$sql);
?>