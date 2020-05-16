<?php 
require_once '../../conexion.php';     
$cod_sem = $_POST['cod_sem'];
$cod_ins = $_POST['cod_ins'];


$sql1="DELETE FROM public.fertilizantes
WHERE cod_fer='$cod_sem'";
$result=pg_query($conexion,$sql1);


$sql="DELETE FROM public.insumos
WHERE cod_ins='$cod_ins'";
echo $result=pg_query($conexion,$sql);
?>