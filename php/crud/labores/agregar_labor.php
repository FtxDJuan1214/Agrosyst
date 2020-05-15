<?php 
require '../../conexion.php';
session_start();

$nom_lab=$_POST['nom_lab'];
$det_lab=$_POST['det_lab'];
$user =  $_SESSION['idusuario'];

$sqx="SELECT cod_lab FROM public.labores ORDER BY cod_lab DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);


$cod_lab= 1;
if (pg_num_rows($res) != 0) {
	$cod_lab=$ver[0] + 1;
}


$sql="INSERT INTO labores(cod_lab,nom_lab, det_lab)
VALUES ('$cod_lab','$nom_lab', '$user$det_lab')";
echo $result=pg_query($conexion,$sql);
?>

