
<?php 
require_once '../../conexion.php';	

$cod_pfi= $_POST['cod_pfi'];


$sql="SELECT*FROM comentarios_pfi WHERE cod_pfi = '$cod_pfi'";
$result1=pg_query($conexion,$sql);
$filas1=pg_num_rows($result1);
if($filas1 == 0 ){
	echo "no";
}else{

    echo $filas1;
date_default_timezone_set('America/Bogota');
$d = date("d");
$m = date("m");
$y = date("Y");
$fecha = $y . "-" . $m . "-" . $d;

$sql1="UPDATE public.procesos_fitosanitarios
SET ffi_pfi='$fecha'
WHERE cod_pfi = '$cod_pfi'";
echo $result=pg_query($conexion,$sql1);
}
?>