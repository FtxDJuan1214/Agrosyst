<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
	
$sintomas=$_POST['sintomas'];
$cod_afe=$_POST['cod_afe'];


$eli = "DELETE FROM public.sin_x_afe
WHERE cod_afe = '$cod_afe'";
echo $result = pg_query($conexion,$eli);
    

$codigos = explode("~", $sintomas);
$contar=count($codigos);

    
    for($i=1;$i<$contar;$i++){

      $adde ="INSERT INTO public.sin_x_afe(
        cod_afe, cod_sin)
        VALUES ('$cod_afe', '$codigos[$i]')";

      echo $result = pg_query($conexion,$adde);
    }
    
      


?>