
<?php 
require_once '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];	

$cod_iac= $_POST['cod_iac'];
$des_iac= $_POST['des_iac'];
$pro_iac= $_POST['pro_iac'];

$upd = "UPDATE public.ingredientes_activos
SET cod_iac='$cod_iac', des_iac='$des_iac', pro_iac='$pro_iac'
WHERE cod_iac='$cod_iac'";
echo $result=pg_query($conexion,$upd);
?>