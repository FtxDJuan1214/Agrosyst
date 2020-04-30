<?php 
require_once '../../conexion.php';     
$cod_fin = $_POST['fin_cod_up'];	 
$nom_fin = $_POST['nom_finup'];
$det_fin = $_POST['det_finup'];
$cod_dep = $_POST['dep_finup'];
$cod_mun = $_POST['mun_fin_up'];
$ide_ter = $_POST['ide_ter_up'];
$cod_unm = $_POST['uni_medup'];
$med_fin = $_POST['med_finup']; 
$nomi=$_FILES['foto_fin_up']['name'];
$ruta=$_FILES['foto_fin_up']['tmp_name'];

if ($nomi =="") {
		$img =$_POST['nom_fot'];
	}else{
		$img = "fincas/".$nomi;
	}

$folder='../../../imagenes/fincas';
move_uploaded_file($ruta, $folder.'/'.$nomi);



$sql="UPDATE public.fincas
    SET nom_fin='$nom_fin', det_fin='$det_fin', cod_dep='$cod_dep', cod_mun='$cod_mun', 
    ide_ter='$ide_ter', cod_unm='$cod_unm', med_fin='$med_fin', fot_fin='$img'
	WHERE cod_fin='$cod_fin' ";	
echo $result=pg_query($conexion,$sql); 
?>



