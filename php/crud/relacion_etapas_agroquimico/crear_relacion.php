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
<<<<<<< HEAD

=======
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
    
$imagen = "SELECT ima_eta FROM eta_x_afe WHERE cod_eta = '$cod_eta' AND cod_afe = '$cod_afe'";
$result =pg_query($conexion,$imagen);
$ima =pg_fetch_row($result);

<<<<<<< HEAD
$reem = "SELECT ima_eta FROM eta_x_afe WHERE cod_eta = '$cod_eta' AND cod_afe = '$cod_afe' and cod_agr='1-1'";
$res=pg_query($conexion,$reem);
$fil=pg_num_rows($res);
if($fil == '1'){

    $ins ="UPDATE public.eta_x_afe
    SET cod_agr='$cod_agr'
    WHERE cod_afe = '$cod_afe'
    AND cod_eta = '$cod_eta'
    AND cod_agr ='1-1'";    
    echo $result = pg_query($conexion,$ins);

}else{

    $ins = "INSERT INTO public.eta_x_afe(
        cod_afe, cod_eta, ima_eta, cod_agr)
        VALUES ('$cod_afe', '$cod_eta', '$ima[0]', '$cod_agr')";
        echo $result = pg_query($conexion,$ins);
}
}

    
=======
if($ima[0] == ''){
}

    $ins = "INSERT INTO public.eta_x_afe(
	cod_afe, cod_eta, ima_eta, cod_agr)
    VALUES ('$cod_afe', '$cod_eta', '$ima[0]', '$cod_agr')";
    
    echo $result = pg_query($conexion,$ins);
    }
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
?>