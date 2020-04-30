<?php 
require_once '../../conexion.php';	
session_start();
$user =  $_SESSION['idusuario'];

$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);

$cod_ins = $cod[0];
$det_otr = $_POST['det_otr'];

$sql ="INSERT INTO otros(cod_ins, det_otr)
VALUES ('$cod_ins', '$user$det_otr')";

echo $result = pg_query($conexion,$sql);
?>

