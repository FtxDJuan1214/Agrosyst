<?php 
require_once '../../conexion.php';

$correo= $_POST['correo'];
$afi = false;
$contra="";

$correos = "SELECT ema_usu FROM public.usuario";
$result =pg_query($conexion,$correos);
while($ver=pg_fetch_row($result)){ 

if($correo == $ver[0]){
$afi=true;
break;

}

 }

 if($afi == true){

    //Cambiar contraseña del usuario
    function generar_token_seguro($longitud){

    if ($longitud < 4) {
        $longitud = 4;
    } 
    return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
}

    $contra= generar_token_seguro(12);
    //echo $contra;

    $up="UPDATE public.usuario
	SET pas_usu='$contra'
    WHERE ema_usu='$correo'";
    
    //echo $resultU = pg_query($conexion,$up);


    //Enviar correo con nueva contraseña
    $mensaje = '<html>'.
	'<head><title></title></head>'.
	'<body><h2>Recuperación de contraseña</h2>'.
	'Hola, has pedido recuperar tu contraseña. Tu nueva contraseña es:'.
    '<br><b style="font-size: 1.2rem;">'.
    $contra.
	'</b><br>'.
	'<p style="color:#C1C4C1;">Agrosyst Co © 2020</p>'.
	'</body>'.
	'</html>';
	
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $cabeceras .= 'From: Agrosyst Co';


    $aer = mail($destino,$titulo, $mensaje, $cabeceras);
    echo $aer;




 }else{

    echo "No";
 }


?>