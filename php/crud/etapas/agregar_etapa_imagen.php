<?php
require_once '../../conexion.php';
session_start();
$user = $_SESSION['idusuario'];


//Saber código de la ultima plaga o enfermedad creada
<<<<<<< HEAD
$codi_eta = $_POST['codi_eta'];
$codi_afe  = $_POST['codi_afe'];
$img = "";

$consulta1= "SELECT cod_agr FROM eta_x_afe WHERE cod_afe = '$codi_afe' AND cod_eta = '$codi_eta'";
$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo "utilizado";
}else{
    
=======

$codi_eta = $_POST['codi_eta'];
$codi_afe  = $_POST['codi_afe'];
$img = "";
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
            
$nomi = $_FILES['imagen_esc']['name'];
$ruta = $_FILES['imagen_esc']['tmp_name'];

$folder = '../../../imagenes/etapas';
move_uploaded_file($ruta, $folder . '/' . $nomi);
$img = "etapas/" . $nomi;

$sql = "INSERT INTO public.eta_x_afe(
    cod_afe, cod_eta, ima_eta, cod_agr)
    VALUES ('$codi_afe', '$codi_eta', '$img', '1-1');";
echo $result = pg_query($conexion, $sql);
<<<<<<< HEAD
}
=======
  
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
?>