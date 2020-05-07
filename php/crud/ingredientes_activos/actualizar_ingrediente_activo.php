
<?php 
require_once '../../conexion.php';	

$cod_iac= $_POST['cod_iac'];
$des_iac= $_POST['des_iac'];
$pro_iac= $_POST['pro_iac'];

$upd = "UPDATE public.ingredientes_activos
SET cod_iac='$cod_iac', des_iac='$des_iac', pro_iac='$pro_iac'
WHERE cod_iac='$cod_iac'";
echo $result=pg_query($conexion,$upd);
/*session_start();
$user =  $_SESSION['idusuario'];
$sql="UPDATE public.semillas
SET cod_tsa='$cod_tsaup', det_sem='$user$det_semup'WHERE cod_sem='$cod_sem'";
echo $$result=pg_query($conexion,$sql);*/
?>