<?php 
require_once '../../conexion.php';

session_start();
$user =  $_SESSION['idusuario'];

$sql1="SELECT cod_eta FROM etapas_crecimiento
WHERE cod_eta LIKE '$user%'
ORDER BY cod_eta 
DESC LIMIT 1";

$result =pg_query($conexion,$sql1);
$cod =pg_fetch_row($result);
$sep = explode("-", $cod[0]);

     $cod_eta = $sep[1]+1;
     $det_eta = $_POST['nom_eta'];

  $add ="INSERT INTO public.etapas_crecimiento(
	cod_eta, det_eta)
	VALUES ('$user$cod_eta', '$det_eta');";

  echo $result = pg_query($conexion,$add);
?>

