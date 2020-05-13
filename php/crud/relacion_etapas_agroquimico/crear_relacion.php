<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
    

$cod_eta=$_POST['cod_eta'];
$cod_agr=$_POST['cod_agr'];
$cod_afe=$_POST['cod_afe'];

//Primero se verifica que ese agroquíco ya no se esté utilizando

$ver = "SELECT* FROM eta_x_afe WHERE cod_eta = '$cod_eta' AND cod_afe = '$cod_afe' AND cod_agr = '$cod_agr'";
$result1=pg_query($conexion,$ver);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo " \n\nutilizado";
}else{
    
$imagen = "SELECT ima_eta FROM eta_x_afe WHERE cod_eta = '$cod_eta' AND cod_afe = '$cod_afe'";
$result =pg_query($conexion,$imagen);
$ima =pg_fetch_row($result);

if($ima[0] == ''){
}

    $ins = "INSERT INTO public.eta_x_afe(
	cod_afe, cod_eta, ima_eta, cod_agr)
    VALUES ('$cod_afe', '$cod_eta', '$ima[0]', '$cod_agr')";
    
    echo $result = pg_query($conexion,$ins);
    }
?>