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
	
	$sqx="SELECT cod_uti FROM utilizar ORDER BY cod_uti DESC LIMIT 1";
	$res=pg_query($conexion,$sqx);
	$ver=pg_fetch_row($res);

	$cod_uti= 1;
	if (pg_num_rows($res) != 0) {
		$cod_uti=$ver[0] + 1;
	}

	$sql="INSERT INTO public.utilizar(cod_sto, cod_tar, cin_tar, pin_tar, cod_uti)
	VALUES ('$cod_sto', '$cod_tar', '$cin_tar', '$partes[3]', '$cod_uti')";
	
	echo $result=pg_query($conexion,$sql);

	$sqy="UPDATE public.stock
	SET can_sto='$disponible'
	WHERE cod_sto='$cod_sto';";
	echo $resultt=pg_query($conexion,$sqy);
}

?>