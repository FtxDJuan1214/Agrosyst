<?php 
require_once '../../conexion.php'; 
$var = $_POST['fecha'];
$sql1="SELECT cod_cul FROM cultivos ORDER BY cod_cul DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod_con=pg_fetch_row($result);

echo $cod_con[0];