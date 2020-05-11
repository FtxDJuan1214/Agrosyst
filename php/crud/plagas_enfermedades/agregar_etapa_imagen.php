<?php 
session_start();
require_once '../../conexion.php'; 	 
$listado_etapas = $_POST['listado_etapas'];
$listado_fotos = $_POST['listado_fotos'];

$sep_eta = explode("||",$listado_etapas);
$sep_fot = explode("||",$listado_fotos);

$len_sep_eta = count($sep_eta) - 1;
$len_sep_fot = count($sep_fot) - 1;


for($i=0;$i<$len_sep_eta;$i++){

    $sep_etapas = explode("~",$sep_eta[$i]);

    for($d=0;$d<$len_sep_fot;$d++){

        $sep_fotos = explode("~",$sep_fot[$d]);
if($sep_etapas[$i] == $sep_fotos[$d]){
    
    //echo '<script type="text/javascript">alert("' .'Encontrado!!! en '.$sep_fotos[$d].' de: '.$sep_etapas[$i].' es: '.$sep_etapas[$i]. '")</script>';

    $nomi=$_FILES[$sep_fotos[$d]]['name'];
    echo 'niomi'.$nomi;
    $ruta=$_FILES[$sep_fotos[$d]]['tmp_name'];
    echo 'ruta'.$ruta;

    $folder='../../../imagenes/etapas';
    move_uploaded_file($ruta, $folder.'/'.$nomi);
    
break;
}
    }

}



/*
$nomi=$_FILES['foto_fin']['name'];
$ruta=$_FILES['foto_fin']['tmp_name'];

$folder='../../../imagenes/fincas';
move_uploaded_file($ruta, $folder.'/'.$nomi);

$img = "fincas/".$nomi;

$sql="INSERT INTO public.fincas(
cod_fin, nom_fin, det_fin, cod_dep, cod_mun, ide_ter, cod_unm, med_fin,fot_fin)
VALUES ('$cod_fin','$nom_fin', '$det_fin', '$cod_dep','$cod_mun','$ide_ter','$cod_unm', '$med_fin','$img')";		 
echo $result=pg_query($conexion,$sql); */
?>
