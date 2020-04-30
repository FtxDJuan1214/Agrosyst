
<?php 
require_once '../../conexion.php';	
session_start();
$cod_tpr=$_POST['cod_tpr'];
$des_tpr=$_POST['des_tpr'];
$cod_unm=$_POST['cod_unm'];
$user =  $_SESSION['idusuario'];

$sql1="UPDATE public.tipo_de_produccion
SET  des_tpr='$user$des_tpr', cod_unm='$cod_unm'
WHERE cod_tpr='$cod_tpr'";
echo $result=pg_query($conexion,$sql1);

?>