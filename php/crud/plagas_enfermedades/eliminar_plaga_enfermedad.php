<?php
require_once '../../conexion.php';

$cod_afe = $_POST['cod_afe'];
$tipoa = $_POST['tipoa'];

    $sql ="DELETE FROM public.partes_planta_afe
    WHERE cod_afe ='$cod_afe'";
    echo $result = pg_query($conexion, $sql);	
	
	$sql3 ="DELETE FROM public.sin_x_afe
    WHERE cod_afe ='$cod_afe'";    
    echo $result3 = pg_query($conexion, $sql3);
    
    if($tipoa == 'P'){
        $sql1 ="DELETE FROM public.plagas
        WHERE cod_afe ='$cod_afe'";
        echo $result1 = pg_query($conexion, $sql1);
    }else if($tipoa == 'E'){
        $sql2 ="DELETE FROM public.enfermedades
        WHERE cod_afe ='$cod_afe'";
        echo $result2 = pg_query($conexion, $sql2);
        
    }

	$sql4="DELETE FROM public.afeccion
    WHERE cod_afe ='$cod_afe'";
    echo $result5 = pg_query($conexion, $sql4);
    
    

?>