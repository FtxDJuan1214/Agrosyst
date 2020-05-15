<?php 
require_once '../../conexion.php';     
$cod_con = $_POST['cod_con'];


$consulta2= "SELECT * FROM public.efectuar WHERE  cod_con='$cod_con'";
$result2=pg_query($conexion,$consulta2);
$filas2=pg_num_rows($result2);
if($filas2 > 0 ){
	echo " \n\nEste convenio no se puede eliminar
	porque ya está efectuado en tareas.";
}
?>