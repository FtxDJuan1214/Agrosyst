<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];    

$cod_eta=$_POST['cod_eta'];
$cod_afe=$_POST['cod_afe'];

    $ins = "DELETE FROM public.eta_x_afe
	WHERE cod_eta = '$cod_eta'
	AND cod_afe ='$cod_afe'";
    
    echo $result = pg_query($conexion,$ins);

?>