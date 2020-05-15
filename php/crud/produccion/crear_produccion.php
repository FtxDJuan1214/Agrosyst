<?php 
require '../../conexion.php';
$cod_cul=$_POST['cod_cul'];
$ide_ter=$_POST['ide_ter'];

$sqx="SELECT cod_pro FROM produccion ORDER BY cod_pro DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);


$cod_pro= 1;
if (pg_num_rows($res) != 0) {
	$cod_pro= $ver[0] + 1;
}


$sql="INSERT INTO public.produccion(cod_pro,cod_cul,ide_ter)
VALUES ('$cod_pro','$cod_cul','$ide_ter');";
$result=pg_query($conexion,$sql);

$str1 = strval($result) ;
$str2 = "Resource id #5";
$str3 = "Resource id #6";
$str4 = "Resource id #7";
$str5 = "Resource id #8";
if (strcmp($str1, $str2) === 0 || strcmp($str1, $str3) === 0 || strcmp($str1, $str4) === 0 || strcmp($str1, $str5) === 0){
	echo $cod_pro;
}else{
	echo "0";
}

?>

