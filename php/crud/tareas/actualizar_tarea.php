<?php 
require_once '../../conexion.php';     
$cod_tar_up = $_POST['cod_tar_up'];
$descipcion = $_POST['descipcion'];
$fin_tar = $_POST['fin_tar'];
$cod_lab = $_POST['cod_lab'];

$sql="UPDATE public.tarea
SET ffi_tar='$fin_tar', des_tar='$descipcion', cod_lab = '$cod_lab'
WHERE cod_tar='$cod_tar_up'";
echo $result=pg_query($conexion,$sql);
?>