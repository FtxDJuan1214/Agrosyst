
<?php 
require_once '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];	

$cod_agr=$_POST['cod_agr'];
$cod_ins=$_POST['cod_ins'];
$nom_agr=$_POST['nom_agr'];
$pre_agr=$_POST['pre_agr'];
$dos_agr=$_POST['dos_agr'];
$des_ins=$_POST['des_ins'];
$rap_agr=$_POST['rap_agr'];
$pcr_agr=$_POST['pcr_agr'];
$pen_agr=$_POST['pen_agr'];
$pro_agr=$_POST['pro_agr'];
$cod_for=$_POST['cod_for'];
$cod_tag=$_POST['cod_tag'];
$cod_tox=$_POST['cod_tox'];
$est_agr=$_POST['est_agr'];
$cod_unm=$_POST['cod_unm'];
$cod_iac=$_POST['cod_iac'];
$fun_agr=$_POST['fun_agr'];

$upd = "UPDATE public.agroquimicos
SET nom_agr='$nom_agr', rap_agr='$rap_agr', pcr_agr='$pcr_agr', pen_agr='$pen_agr', pro_agr='$pro_agr', 
cod_tag='$cod_tag', cod_tox='$cod_tox', est_agr='$est_agr', dos_agr='$dos_agr', cod_for='$cod_for', cod_iac='$cod_iac', fun_agr='$fun_agr'
WHERE cod_agr = '$cod_agr'";
echo $result=pg_query($conexion,$upd);
?>