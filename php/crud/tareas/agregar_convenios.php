<?php 
require_once '../../conexion.php';     
$convenios = $_POST['cadena_de_convenios_insertar'];

$sqx="SELECT cod_tar FROM tarea ORDER BY cod_tar DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
				$ver=pg_fetch_row($res);
				$cod_tar=$ver[0];

$array=explode("||", $convenios);
$lenght=count($array) - 1;

for($i =0; $i<$lenght ; $i++){

	$sql="INSERT INTO public.efectuar(
	cod_con, cod_tar)
		VALUES ('$array[$i]', '$cod_tar');";
	echo $result=pg_query($conexion,$sql);
}

?>