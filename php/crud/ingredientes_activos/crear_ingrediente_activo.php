<?php 
require_once '../../conexion.php';

session_start();
$user =  $_SESSION['idusuario'];

$sql1="SELECT cod_iac FROM ingredientes_activos
WHERE cod_iac LIKE '$user%'
ORDER BY cod_iac 
DESC LIMIT 1";
$result =pg_query($conexion,$sql1);
$cod =pg_fetch_row($result);
$sep = explode("-", $cod[0]);

     $cod_iac = $sep[1]+1;
     $des_iac = $_POST['nombre'];
     $pro_iac = $_POST['ica'];

  $add ="INSERT INTO public.ingredientes_activos(
    cod_iac, des_iac, pro_iac)
    VALUES ('$user$cod_iac', '$des_iac', '$pro_iac');";

  echo $result = pg_query($conexion,$add);
?>

