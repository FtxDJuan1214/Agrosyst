
<?php 
require_once '../../conexion.php';     
$fin_cul = $_POST['fin_cul'];
$fif_cul = $_POST['fif_cul'];
$npl_cul = $_POST['npl_cul'];
$tip_cul = $_POST['tip_cul'];
$dur_cul = $_POST['dur_cul'];
$est_cul = $_POST['est_cul'];
$nom_cul = $_POST['nom_cul'];
$cod_lot = $_POST['cod_lot'];
$dia_cul = $_POST['dia_cul'];
$mod_cul = $_POST['mod_cul'];

$sqx="SELECT cod_cul FROM public.cultivos ORDER BY cod_cul DESC LIMIT 1";
$res=pg_query($conexion,$sqx);
$ver=pg_fetch_row($res);


$cod_cul= 1;
if (pg_num_rows($res) != 0) {
	$cod_cul=$ver[0] + 1;
}

$sql="INSERT INTO public.cultivos(cod_cul,fin_cul, fif_cul, npl_cul, tip_cul, dur_cul, est_cul, cod_ncu, cod_lot, dia_cul,mod_cul)
VALUES ('$cod_cul','$fin_cul', '$fif_cul', '$npl_cul', '$tip_cul', '$dur_cul','$est_cul', '$nom_cul', '$cod_lot', '$dia_cul','$mod_cul')";
echo $result=pg_query($conexion,$sql);
?>