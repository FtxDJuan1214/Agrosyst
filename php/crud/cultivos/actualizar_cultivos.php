<?php 
require_once '../../conexion.php';
$cod_cul = $_POST['cod_cul'];    
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
$sql="UPDATE public.cultivos
SET  fin_cul='$fin_cul', fif_cul='$fif_cul', npl_cul='$npl_cul', tip_cul='$tip_cul', dur_cul='$dur_cul', est_cul='$est_cul', cod_ncu='$nom_cul', cod_lot='$cod_lot', dia_cul='$dia_cul',mod_cul='$mod_cul'
WHERE cod_cul='$cod_cul'";
echo $result=pg_query($conexion,$sql);
?>