
<?php 
require_once '../../conexion.php';	

$cod_otr= $_POST['cod_otr'];
$cod_ins= $_POST['cod_ins'];
$des_ins= $_POST['des_insup'];
$cod_unm= $_POST['uni_medup'];
$det_otr= $_POST['det_otrup'];

$sql1="UPDATE public.insumos
SET des_ins='$des_ins', cod_unm='$cod_unm' WHERE cod_ins='$cod_ins'";
$result=pg_query($conexion,$sql1);

session_start();
$user =  $_SESSION['idusuario'];


$sql="UPDATE public.otros
SET det_otr='$user$det_otr' WHERE cod_otr='$cod_otr'";
echo $$result=pg_query($conexion,$sql);
?>