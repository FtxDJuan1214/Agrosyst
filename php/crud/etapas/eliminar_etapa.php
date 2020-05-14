<?php 
require_once '../../conexion.php';     
$cod_eta = $_POST['cod_eta'];


$rev="DELETE FROM public.etapas_crecimiento
WHERE cod_eta='$cod_eta'";
echo $result=pg_query($conexion,$rev);

?>