<?php
require_once '../../conexion.php';
session_start();
$user = $_SESSION['idusuario'];


//Saber código de la ultima plaga o enfermedad creada

$codi_eta = $_POST['codi_eta'];
$codi_afe  = $_POST['codi_afe'];
$img = "";
            
$nomi = $_FILES['imagen_esc']['name'];
$ruta = $_FILES['imagen_esc']['tmp_name'];

$folder = '../../../imagenes/etapas';
move_uploaded_file($ruta, $folder . '/' . $nomi);
$img = "etapas/" . $nomi;

$sql = "INSERT INTO public.eta_x_afe(
    cod_afe, cod_eta, ima_eta, cod_agr)
    VALUES ('$codi_afe', '$codi_eta', '$img', '1-1');";
echo $result = pg_query($conexion, $sql);
  
?>