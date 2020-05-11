<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
	
$codigo_sintoma=$_POST['codigo_sintoma'];
$codigos = explode("~", $codigo_sintoma);
$contar=count($codigos);

$getc="SELECT cod_afe FROM afeccion
    WHERE cod_afe LIKE '$user%'
    ORDER BY cod_afe 
    DESC LIMIT 1";

    $result =pg_query($conexion,$getc);
    $cod =pg_fetch_row($result);
    $sep = explode("-", $cod[0]);

    $cod_afe="";

    if($sep[1]){
        $cod_afe = $sep[1];
    }else{
        $cod_afe = "1";
    }

    for($i=1;$i<$contar;$i++){

        $add ="INSERT INTO sin_x_afe(
            cod_afe, cod_sin)
            VALUES ('$user$cod_afe', '$codigos[$i]')";
        
          echo $result = pg_query($conexion,$add);

    }
    
    

?>