<?php 
require_once '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];	

$cod_afe= $_POST['cod_afe'];
$nom_afe= $_POST['nom_afe'];
$noc_afe= $_POST['noc_afe'];
$epo_afe= $_POST['epo_afe'];
$hat_afe= $_POST['hat_afe'];
$tipo= $_POST['tipo'];

$upd = "UPDATE public.afeccion
SET nom_afe='$nom_afe', noc_afe='$noc_afe', epo_afe='$epo_afe', hat_afe='$hat_afe'
WHERE cod_afe = '$cod_afe'";
echo $result=pg_query($conexion,$upd);
?>