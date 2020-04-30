<?php 
require '../../conexion.php';
$cod_tum=$_POST['uni_med'];
 $query="SELECT equ_med FROM unidad_de_medida where cod_unm='$cod_tum'";
  $result =pg_query($conexion,$query);
  $ver=pg_fetch_row($result);
echo $ver[0];
?>