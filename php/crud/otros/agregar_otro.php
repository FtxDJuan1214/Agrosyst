<?php 
require_once '../../conexion.php';	
session_start();
$user =  $_SESSION['idusuario'];

$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);

$cod_ins = $cod[0];
$det_otr = $_POST['det_otr'];

$sqx="SELECT cod_otr FROM public.otros ORDER BY cod_otr DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);


$cod_otr= 1;
if (pg_num_rows($res) != 0) {
	$cod_otr=$ver[0] + 1;
}

$sql ="INSERT INTO otros(cod_otr,cod_ins, det_otr)
VALUES ('$cod_otr','$cod_ins', '$user$det_otr')";

echo $result = pg_query($conexion,$sql);
?>

