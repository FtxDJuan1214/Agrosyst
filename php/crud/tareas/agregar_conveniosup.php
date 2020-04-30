<?php 
require_once '../../conexion.php';     
$cod_con = $_POST['cod_con'];
$cod_tar = $_POST['cod_tar'];
$nuevotot = $_POST['nuevotot'];

$sql="INSERT INTO public.efectuar(
cod_con, cod_tar)
VALUES ('$cod_con', '$cod_tar');";
$result0=pg_query($conexion,$sql);

$sql1="UPDATE public.tarea
SET val_tar='$nuevotot'
WHERE cod_tar='$cod_tar'";
echo $result=pg_query($conexion,$sql1);

?>