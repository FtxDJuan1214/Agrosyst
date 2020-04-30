<?php 
require '../../conexion.php';

$des_ins=$_POST['des_ins'];
$cod_unm=$_POST['cod_unm'];

$sql="INSERT INTO insumos(
des_ins, cod_unm)
VALUES ('$des_ins', '$cod_unm')";
echo $result=pg_query($conexion,$sql);
?>

