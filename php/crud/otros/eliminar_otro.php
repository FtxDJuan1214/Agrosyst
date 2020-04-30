<?php 
require_once '../../conexion.php';     
$cod_otr = $_POST['cod_otr'];
$cod_ins = $_POST['cod_ins'];


$sql1="DELETE FROM public.otros
WHERE cod_otr='$cod_otr'";
$result=pg_query($conexion,$sql1);


$sql="DELETE FROM public.insumos
WHERE cod_ins='$cod_ins'";
echo $$result=pg_query($conexion,$sql);
?>