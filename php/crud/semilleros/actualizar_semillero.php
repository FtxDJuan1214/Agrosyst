
<?php 
require_once '../../conexion.php';	

$cod_smr= $_POST['cod_smr'];
$cod_ins= $_POST['cod_ins'];
$des_insup= $_POST['des_insup'];
$cod_tsoup= $_POST['cod_tsoup'];
$det_smrup= $_POST['det_smrup'];

$sql1="UPDATE public.insumos
SET des_ins='$des_insup'WHERE cod_ins='$cod_ins'";
$result=pg_query($conexion,$sql1);

session_start();
$user =  $_SESSION['idusuario'];

$sql="UPDATE public.semillero
SET cod_tso='$cod_tsoup', det_smr='$user$det_smrup'WHERE cod_smr='$cod_smr'";
echo $result=pg_query($conexion,$sql);
?>