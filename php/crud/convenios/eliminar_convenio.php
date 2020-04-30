<?php 
require_once '../../conexion.php';     
$cod_con = $_POST['cod_con'];


$sql="DELETE FROM public.ejecutar
	WHERE cod_con='$cod_con'";
echo $result=pg_query($conexion,$sql);
?>