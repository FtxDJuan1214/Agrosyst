<?php 
session_start();
require_once '../../conexion.php';     
$nomb_cultivo = $_SESSION['idusuario'].ucwords(strtolower($_POST['nomb_cultivo']));
$sql="INSERT INTO public.nombre_cultivo(des_ncu)
VALUES ('$nomb_cultivo');";
echo $result=pg_query($conexion,$sql);
?>