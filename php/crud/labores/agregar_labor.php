<?php 
require '../../conexion.php';
session_start();

$nom_lab=$_POST['nom_lab'];
$det_lab=$_POST['det_lab'];
$user =  $_SESSION['idusuario'];

$sql="INSERT INTO labores(
nom_lab, det_lab)
VALUES ('$nom_lab', '$user$det_lab')";
echo $result=pg_query($conexion,$sql);
?>

