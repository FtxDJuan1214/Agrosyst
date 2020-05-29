<?php 
require_once '../../conexion.php';

$nic_usu = $_POST['nic_usu'];
$ema_usu = $_POST['ema_usu'];
$usu_usu = $_POST['usu_usu'];
$pas_usu = $_POST['pas_usu'];

$sqx="SELECT id_usu FROM public.usuario ORDER BY id_usu DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);
$id_usu= 1;

if (pg_num_rows($res) != 0) {
	$id_usu=$ver[0] + 1;
}

$sql="INSERT INTO public.usuario(
	id_usu, usu_usu, pas_usu, nic_usu, ema_usu)
	VALUES ($id_usu, '$usu_usu', '$pas_usu', '$nic_usu', '$ema_usu')";
echo $result=pg_query($conexion,$sql);
?>