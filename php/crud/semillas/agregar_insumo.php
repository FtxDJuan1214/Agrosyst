<?php 
require '../../conexion.php';

$des_ins=$_POST['des_ins'];
$cod_unm=$_POST['cod_unm'];

$sqx="SELECT cod_ins FROM public.insumos ORDER BY cod_ins DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);

$cod_ins= 1;
if (pg_num_rows($res) != 0) {
	$cod_ins=$ver[0] + 1;
}

$sql="INSERT INTO insumos(cod_ins,des_ins, cod_unm)
VALUES ('$cod_ins','$des_ins', '$cod_unm')";
echo $result=pg_query($conexion,$sql);
?>

