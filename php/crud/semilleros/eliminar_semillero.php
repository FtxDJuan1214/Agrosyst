<?php 
require_once '../../conexion.php';     
$cod_smr = $_POST['cod_smr'];
$cod_ins = $_POST['cod_ins'];


$sql1="DELETE FROM public.semillero
WHERE cod_smr='$cod_smr'";
$result=pg_query($conexion,$sql1);


$sql="DELETE FROM public.insumos
WHERE cod_ins='$cod_ins'";
echo $$result=pg_query($conexion,$sql);
?>