<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
    

$cod_eta=$_POST['cod_eta'];
$cod_agr=$_POST['cod_agr'];
$cod_afe=$_POST['cod_afe'];

//Primero verificar si ya no hay uno con 1-1

$reem = "SELECT ima_eta FROM eta_x_afe WHERE cod_eta = '$cod_eta' AND cod_afe = '$cod_afe' and cod_agr='1-1'";
$res=pg_query($conexion,$reem);
$fil=pg_num_rows($res);
echo $fil;
if($fil > 0 ){

    $ins = "DELETE FROM public.eta_x_afe
    WHERE cod_eta = '$cod_eta'
    AND cod_afe = '$cod_afe'
    AND cod_agr = '$cod_agr'";
    echo $result = pg_query($conexion,$ins);

}else{

    $ins ="UPDATE public.eta_x_afe
    SET cod_agr='1-1'
    WHERE cod_afe = '$cod_afe'
    AND cod_eta = '$cod_eta'
    AND cod_agr = '$cod_agr'"; 
    echo $result = pg_query($conexion,$ins);

}



?>