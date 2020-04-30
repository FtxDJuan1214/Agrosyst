<?php 
require_once '../../conexion.php';     
$convenios = $_POST['cadena_de_insumos_insertar'];

$sqx="SELECT cod_tar FROM tarea ORDER BY cod_tar DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);
$cod_tar=$ver[0];

$array=explode("||", $convenios);
$lenght=count($array) - 1;

for($i =0; $i<$lenght ; $i++){
	$partes=explode("-", $array[$i]);
	$cod_sto = $partes[0];
	$cin_tar = intval($partes[2]);
	$disponible = intval($partes[1]) - intval($partes[2]);

	$sql="INSERT INTO public.utilizar(
	cod_sto, cod_tar, cin_tar)
	VALUES ('$cod_sto', '$cod_tar', '$cin_tar')";
	
	echo $result=pg_query($conexion,$sql);

	$sqy="UPDATE public.stock
	SET can_sto='$disponible'
	WHERE cod_sto='$cod_sto';";
	echo $resultt=pg_query($conexion,$sqy);
}

?>