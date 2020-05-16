<?php 
require_once '../../conexion.php';     
$cod_iac = $_POST['cod_iac'];

<<<<<<< HEAD
$inf = "SELECT agroquimicos.nom_agr FROM public.agroquimicos, public.ingredientes_activos
WHERE agroquimicos.cod_iac = ingredientes_activos.cod_iac
AND ingredientes_activos.cod_iac = '$cod_iac'";

$result1=pg_query($conexion,$inf);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo "utilizado";
}else{
=======
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894

$rev="DELETE FROM public.ingredientes_activos
WHERE cod_iac='$cod_iac'";
echo $result=pg_query($conexion,$rev);
<<<<<<< HEAD
}
=======

>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
?>