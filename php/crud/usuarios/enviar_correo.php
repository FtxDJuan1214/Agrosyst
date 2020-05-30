<?php 

require_once '../../conexion.php';

$destino = $_POST["ema_usu"];
$nombre = $_POST["nic_usu"];

$titulo = $_POST["title"];

$mensaje = $_POST["mensaje"];
	
$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";


$aer = mail($destino,$titulo, $mensaje, $cabeceras);
echo $aer;
?>