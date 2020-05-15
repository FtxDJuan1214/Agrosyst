<?php
require_once '../../conexion.php';

$reco = $_POST['reco'];
$nuevo = $_POST['nuevo'];

$sql = "UPDATE public.recomendaciones_uso_agr
	SET det_rus='$nuevo'
	WHERE det_rus LIKE '$reco'";
echo $result1 = pg_query($conexion, $sql);

?>