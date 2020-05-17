<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
	
$etapas=$_POST['etapas'];
$cod_afe=$_POST['cod_afe'];


$eli = "UPDATE public.afeccion
SET eat_afe='$etapas'
WHERE cod_afe = '$cod_afe'";
echo $result = pg_query($conexion,$eli);



?>