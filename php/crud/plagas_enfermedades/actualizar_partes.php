<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
	
$partes_f=$_POST['partes'];
$cod_afe=$_POST['cod_afe'];


$eli = "DELETE FROM public.partes_planta_afe
WHERE cod_afe = '$cod_afe'";
echo $result = pg_query($conexion,$eli);
    
    $sepa = explode("-", $partes_f);
    $contar=count($sepa);
    for($i=1;$i<$contar;$i++){

      $adde ="INSERT INTO public.partes_planta_afe(
        cod_afe, det_par)
        VALUES ('$cod_afe', '$sepa[$i]')";

      echo $result = pg_query($conexion,$adde);
    }
    
      


?>