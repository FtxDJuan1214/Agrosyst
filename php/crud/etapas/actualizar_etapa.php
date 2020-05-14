
<?php 
require_once '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];	

$cod_eta= $_POST['cod_eta'];
$det_eta= $_POST['nom_eta'];

$upd = "UPDATE public.etapas_crecimiento
SET cod_eta='$cod_eta', det_eta='$det_eta'
WHERE cod_eta='$cod_eta'";

echo $result=pg_query($conexion,$upd);
?>