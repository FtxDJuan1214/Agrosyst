<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario']; 


$cod_eta =$_POST['cod_eta'];
$cod_afe =$_POST['cod_afe'];

$consulta1= "SELECT cod_agr FROM eta_x_afe WHERE cod_afe = '$cod_afe' AND cod_eta = '$cod_eta'";
$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo "utilizado";
}else{
    echo $filas1;
//-----------------------------------------------------------//

    $sql="INSERT INTO public.eta_x_afe(
        cod_afe, cod_eta, ima_eta, cod_agr)
        VALUES ('$cod_afe', '$cod_eta', 'etapas/sinimagen.jpg', '1-1');";		 
        echo $result=pg_query($conexion,$sql);
    
    }
?>