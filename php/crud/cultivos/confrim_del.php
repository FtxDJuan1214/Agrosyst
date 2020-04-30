<?php 
require_once '../../conexion.php';     
$cod_cul= $_POST['cod_cul'];

// $consulta1= "SELECT * FROM public.act_cul WHERE cod_cul='$cod_cul'";
// $result1=pg_query($conexion,$consulta1);
// $filas1=pg_num_rows($result1);
// if($filas1 > 0 ){
// 	echo " \n\nEste cultivo no se puede eliminar
// 	porque tiene convenios (jornales o contratos).'$cod_cul'";
// }

$consulta2= "SELECT * FROM public.produccion WHERE  cod_cul='$cod_cul'";
$result2=pg_query($conexion,$consulta2);
$filas2=pg_num_rows($result2);
if($filas2 > 0 ){
	echo " \n\nEste cultivo no se puede eliminar
	porque tiene producciones";
}

?>