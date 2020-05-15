<?php 
require '../../conexion.php';

$codigo=$_POST['codigo'];

$sql="DELETE FROM public.comentarios_pfi
WHERE com_pfi = '$codigo'";
    
echo $result=pg_query($conexion,$sql);
?>
