<?php 
require_once '../../conexion.php';	

$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);
//echo $cod[0];


$cod_ins = $cod[0];
$cod_tso = $_POST['cod_tso'];
$det_smr = ucwords(strtolower($_POST['det_smr']));

session_start();
$user =  $_SESSION['idusuario'];

$sql ="INSERT INTO semillero(
cod_ins, cod_tso, det_smr)
VALUES ('$cod_ins', '$cod_tso', '$user$det_smr')";

echo $result = pg_query($conexion,$sql);
?>

