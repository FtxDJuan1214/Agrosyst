<?php 
require '../../conexion.php';

$codigo=$_POST['codigo'];
$comentario=$_POST['comentario'];

$sql="INSERT INTO public.comentarios_pfi(
	cod_pfi, com_pfi, fec_com)
    VALUES ('$codigo', '$comentario', current_timestamp)";
    
echo $result=pg_query($conexion,$sql);
?>
