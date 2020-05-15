
<?php
require_once '../../conexion.php';

$cod_agr = $_POST['cod_agr'];
$nuevo = $_POST['nuevo'];

$sql = "INSERT INTO public.recomendaciones_uso_agr(
	cod_agr, det_rus)
	VALUES ('$cod_agr', '$nuevo')";
echo $result1 = pg_query($conexion, $sql);


?>