<?php 
require_once '../../conexion.php';

$correo= $_POST['correo'];
$afi = false;
$new = "";
$contra="";

$correos = "SELECT ema_usu FROM public.usuario";
$result =pg_query($conexion,$correos);
while($ver=pg_fetch_row($result)){ 
if(trim($correo) == trim($ver[0])){
$afi=true;
$new = $ver[0];
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
    

    $up="UPDATE public.usuario
	SET pas_usu='$contra'
    WHERE ema_usu='$new'";
    
    $resultU = pg_query($conexion,$up);
    
    echo $contra;

 }else{

    echo "NoEsta";
 }


?>