<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
	
$indiv=$_POST['indiv'];

$getc="SELECT cod_afe FROM afeccion
    WHERE cod_afe LIKE '$user%'
    ORDER BY cod_afe 
    DESC LIMIT 1";

$getd="SELECT cod_plg FROM plagas
    WHERE cod_plg LIKE '$user%'
    ORDER BY cod_plg 
    DESC LIMIT 1";

    $result =pg_query($conexion,$getc);
    $cod =pg_fetch_row($result);
    $sep = explode("-", $cod[0]);

    $result1 =pg_query($conexion,$getd);
    $cod1 =pg_fetch_row($result1);
    $sep1 = explode("-", $cod1[0]);

    $cod_afe="";
    $cod_plg="";

    if($sep[1]){
        $cod_afe = $sep[1];
    }

    if($sep1[1]){
        $cod_plg = $sep1[1]+1;
    }else{
        $cod_plg = "1";
    }
    
    $add ="INSERT INTO public.plagas(
        cod_afe, cod_plg, tip_plg)
        VALUES ('$user$cod_afe', '$user$cod_plg', '$indiv');";
    
      echo $result = pg_query($conexion,$add);

?>