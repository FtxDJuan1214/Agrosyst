<?php 
require_once '../../conexion.php';

$destino = $_POST["correo"];
$contra = $_POST["contra"];

$mensaje = 'Hola, has pedido recuperar tu contraseña. Tu nueva contraseña es: '."<br>".$contra."<br>"."<br>".'Recuerda cambiarla apenas ingreses.'."<br>"."<br>".'Agrosyst Co';

$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";


$aer = mail($destino,'Recuperación de contraseña', $mensaje, $cabeceras);
echo $aer;

?>