<?php 
require '../../conexion.php';
$med=$_POST['med'];
/*Obtener la equivalencia en metros de la medida*/
$query="SELECT equ_med FROM unidad_de_medida WHERE cod_unm='$med'";
$result =pg_query($conexion,$query);
$ver=pg_fetch_row($result);
$conversion=$ver[0];
echo $conversion;
?>
