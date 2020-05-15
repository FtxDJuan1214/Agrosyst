<?php 
require_once '../../conexion.php';     
$des_tar = $_POST['des_tar'];
$fin_tar = $_POST['fin_tar'];
$fif_tar = $_POST['fif_tar'];
$val_tar = $_POST['val_tar'];
$cod_lab = $_POST['cod_lab'];

$sqx="SELECT cod_tar FROM public.tarea ORDER BY cod_tar DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);

$cod_tar= 1;
if (pg_num_rows($res) != 0) {
	$cod_tar=$ver[0] + 1;
}

$sql="INSERT INTO public.tarea(cod_tar, fin_tar, ffi_tar, des_tar , val_tar, cod_lab)
VALUES ('$cod_tar','$fin_tar', '$fif_tar', '$des_tar' , '$val_tar', '$cod_lab');";
echo $result=pg_query($conexion,$sql);
?>