<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario']; 


//Saber código de la ultima plaga o enfermedad creada


$sql1="SELECT cod_afe FROM afeccion WHERE cod_afe LIKE '$user%'
order by regexp_split_to_array(cod_afe, E'\\-')::integer[]
DESC LIMIT 1";

$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);
$cod_afe="";
if($cod[0]){    
$sep = explode("-", $cod[0]); 
$cod_afe=$sep[1];
} 

$info =$_POST['info'];

//-----------------------------------------------------------//

    $sql="INSERT INTO public.eta_x_afe(
        cod_afe, cod_eta, ima_eta, cod_agr)
        VALUES ('$user$cod_afe', '$info', null, '1-1');";		 
        echo $result=pg_query($conexion,$sql);
    

?>
