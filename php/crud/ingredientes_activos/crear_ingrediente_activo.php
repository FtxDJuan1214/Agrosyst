<?php 
require_once '../../conexion.php';	
session_start();
$user =  $_SESSION['idusuario'];

$sql1="SELECT cod_iac::numeric FROM ingredientes_activos ORDER BY cod_iac::numeric DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);

     $cod_iac = $cod[0]+1;
     $des_iac = $_POST['nombre'];
     $pro_iac = $_POST['ica'];

  $add ="INSERT INTO public.ingredientes_activos(
    cod_iac, des_iac, pro_iac)
    VALUES ('$cod_iac', '$des_iac', '$pro_iac');";

  echo $result = pg_query($conexion,$add);
?>

