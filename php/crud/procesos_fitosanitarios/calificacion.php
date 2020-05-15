
<?php 
require '../../conexion.php';

$cod_lfi=$_POST['cod_lfi'];
$calif=$_POST['calif'];


$sql="UPDATE public.fitosanitaria
SET cal_fit='$calif'
WHERE cod_fit= '$cod_lfi'";

echo $result=pg_query($conexion,$sql);
?>
