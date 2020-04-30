
<?php 
require_once '../../conexion.php';	

$cod_sem= $_POST['cod_sem'];
$cod_ins= $_POST['cod_ins'];
$des_insup= $_POST['des_insup'];
$cod_tsaup= $_POST['cod_tsaup'];
$cod_unmup= $_POST['cod_unmup'];
$det_semup= $_POST['det_semup'];

$sql1="UPDATE public.insumos
SET des_ins='$des_insup', cod_unm='$cod_unmup'WHERE cod_ins='$cod_ins'";
$result=pg_query($conexion,$sql1);

session_start();
$user =  $_SESSION['idusuario'];
$sql="UPDATE public.semillas
SET cod_tsa='$cod_tsaup', det_sem='$user$det_semup'WHERE cod_sem='$cod_sem'";
echo $$result=pg_query($conexion,$sql);
?>