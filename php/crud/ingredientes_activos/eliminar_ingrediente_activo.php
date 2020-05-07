<?php 
require_once '../../conexion.php';     
$cod_iac = $_POST['cod_iac'];


$rev="DELETE FROM public.ingredientes_activos
WHERE cod_iac='$cod_iac'";
echo $result=pg_query($conexion,$rev);

?>