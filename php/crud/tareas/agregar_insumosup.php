<?php 
require_once '../../conexion.php';     
$cod_tar = $_POST['cod_tar'];
$cod_sto = $_POST['cod_sto'];
$cin_tar = $_POST['cin_tar'];

$can_sto = $_POST['can_sto'];
$precio_in = $_POST['precio_in'];
$tot_tar = $_POST['tot_tar'];

$disponible = floatval($can_sto) - floatval($cin_tar);
$precio = floatval($cin_tar) *  floatval($precio_in);
$nuevotot = floatval($tot_tar) +  floatval($precio);

$sqx="SELECT cod_uti FROM public.utilizar ORDER BY cod_uti DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);

$cod_uti= 1;
if (pg_num_rows($res) != 0) {
	$cod_uti=$ver[0] + 1;
}

$sql="INSERT INTO public.utilizar(
cod_sto, cod_tar, cin_tar, pin_tar,cod_uti)
VALUES ('$cod_sto', '$cod_tar', '$cin_tar', '$precio', '$cod_uti')";

$result=pg_query($conexion,$sql);

$sqy="UPDATE public.stock
SET can_sto='$disponible'
WHERE cod_sto='$cod_sto';";
$resultt=pg_query($conexion,$sqy);

$sql1="UPDATE public.tarea
SET val_tar='$nuevotot'
WHERE cod_tar='$cod_tar'";
$result=pg_query($conexion,$sql1);

echo $nuevotot;
?>