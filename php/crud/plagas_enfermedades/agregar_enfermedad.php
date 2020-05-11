<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
    

$cont=strlen($user);

$indiv=$_POST['indiv'];

$getc="SELECT cod_afe FROM afeccion
    WHERE cod_afe LIKE '$user%'
    ORDER BY (SUBSTRING (cod_afe FROM ($cont+2) FOR 8))
    DESC LIMIT 1";

$getd="SELECT cod_enf FROM enfermedades
    WHERE cod_enf LIKE '$user%'
    ORDER BY (SUBSTRING (cod_enf FROM ($cont+2) FOR 8))
    DESC LIMIT 1";

    $result =pg_query($conexion,$getc);
    $cod =pg_fetch_row($result);
    $sep = explode("-", $cod[0]);

    $result1 =pg_query($conexion,$getd);
    $cod1 =pg_fetch_row($result1);
    $sep1 = explode("-", $cod1[0]);

    $cod_afe="";
    $cod_enf="";

    if($sep[1]){
        $cod_afe = $sep[1];
    }else{
        $cod_afe = "1";
    }

    if($sep1[1]){
        $cod_enf = $sep1[1]+1;
    }else{
        $cod_enf = "1";
    }
    
    $add ="INSERT INTO public.enfermedades(
        cod_afe, cod_enf, pat_enf)
        VALUES ('$user$cod_afe', '$user$cod_enf', '$indiv');";
    
      echo $result = pg_query($conexion,$add);

?>