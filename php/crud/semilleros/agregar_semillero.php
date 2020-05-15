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

$sqx="SELECT cod_smr FROM public.semillero ORDER BY cod_smr DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);

$cod_smr= 1;
if (pg_num_rows($res) != 0) {
 $cod_smr=$ver[0] + 1;
}

$sql ="INSERT INTO semillero(cod_smr,cod_ins, cod_tso, det_smr)
VALUES ('$cod_smr','$cod_ins', '$cod_tso', '$user$det_smr')";

echo $result = pg_query($conexion,$sql);
?>

