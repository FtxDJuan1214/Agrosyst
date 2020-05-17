<?php 
require_once '../../conexion.php';     
$cod_afe = $_POST['cod_afe'];
$cod_eta = $_POST['cod_eta'];

$rev="SELECT* from  eta_x_afe where cod_afe = '$cod_afe' and cod_eta = '$cod_eta'  and cod_agr NOT LIKE '1-1'";
$result=pg_query($conexion,$rev);
$filas=pg_num_rows($result);

if($filas>0){
echo 'utilizado';
}else{
    $rem="DELETE FROM public.eta_x_afe
    WHERE cod_afe='$cod_afe'";
    echo $result=pg_query($conexion,$rem);
}
?>