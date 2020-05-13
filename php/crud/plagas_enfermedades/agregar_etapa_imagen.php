<?php
require_once '../../conexion.php';
session_start();
$user = $_SESSION['idusuario'];


//Saber código de la ultima plaga o enfermedad creada


$sql1 = "SELECT cod_afe FROM afeccion WHERE cod_afe LIKE '$user%'
order by regexp_split_to_array(cod_afe, E'\\-')::integer[]
DESC LIMIT 1";

$result  = pg_query($conexion, $sql1);
$cod     = pg_fetch_row($result);
$cod_afe = "";
if ($cod[0]) {
    $sep     = explode("-", $cod[0]);
    $cod_afe = $sep[1];
}

//-----------------------------------------------------------//

$listado_etapas = $_POST['listado_etapas'];
$listado_fotos  = $_POST['listado_fotos'];

$sep_eta = explode("||", $listado_etapas);
$sep_fot = explode("||", $listado_fotos);

$len_sep_eta = count($sep_eta) - 1;
$len_sep_fot = count($sep_fot) - 1;


$img = "";


for ($i = 0; $i < $len_sep_eta; $i++) {    
    $sep_etapas = explode("~", $sep_eta[$i]);
    
    for ($d = 0; $d < $len_sep_fot; $d++) {        
        $sep_fotos = explode("~", $sep_fot[$d]);        
        
        if ($sep_etapas[$i] == $sep_fotos[$d]) {
            
            $nomi = $_FILES[$sep_fotos[$d]]['name'];
            $ruta = $_FILES[$sep_fotos[$d]]['tmp_name'];
            
            $folder = '../../../imagenes/etapas';
            move_uploaded_file($ruta, $folder . '/' . $nomi);            
            $img = "etapas/" . $nomi;
            
            $sql = "INSERT INTO public.eta_x_afe(
                cod_afe, cod_eta, ima_eta, cod_agr)
                VALUES ('$user$cod_afe', '$sep_fotos[$d]', '$img', '1-1');";
            echo $result = pg_query($conexion, $sql);
            
            break;
        }
    }    
}
?>