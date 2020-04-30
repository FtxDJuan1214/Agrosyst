<?php 
require '../../conexion.php';
$cod_cul=$_POST['cod_cul'];
$ide_ter=$_POST['ide_ter'];

$sql="INSERT INTO public.produccion(
cod_cul,ide_ter)
VALUES ('$cod_cul','$ide_ter');";
$result=pg_query($conexion,$sql);

$str1 = strval($result) ;
$str2 = "Resource id #6";
if (strcmp($str1, $str2) === 0){
    $sqx="SELECT cod_pro FROM produccion ORDER BY cod_pro DESC LIMIT 1";
	$res=pg_query($conexion,$sqx);
	$ver=pg_fetch_row($res);
	echo $ver[0];
}else{
	echo "0";
}

?>

