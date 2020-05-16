<?php 
require_once '../../conexion.php';

session_start();
$user =  $_SESSION['idusuario'];

<<<<<<< HEAD
$sql1="SELECT cod_iac FROM ingredientes_activos WHERE (cod_iac LIKE '$user%' or cod_iac LIKE '1-%')
order by regexp_split_to_array(cod_iac, E'\\-')::integer[]
DESC LIMIT 1";


=======
$sql1="SELECT cod_iac FROM ingredientes_activos
WHERE cod_iac LIKE '$user%'
ORDER BY cod_iac 
DESC LIMIT 1";

>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
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

