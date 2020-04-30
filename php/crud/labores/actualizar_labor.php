<?php 
require '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];

$cod_lab=$_POST['cod_lab'];
$nom_labup=$_POST['nom_labup'];
$det_labup=$_POST['det_labup'];

$sql="UPDATE public.labores
SET nom_lab='$nom_labup', det_lab='$user$det_labup'WHERE cod_lab='$cod_lab'";
echo $result=pg_query($conexion,$sql);
?>

