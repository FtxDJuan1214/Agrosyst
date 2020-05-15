<?php
require_once '../../conexion.php';

$reco = $_POST['reco'];

$sql = "DELETE FROM public.recomendaciones_uso_agr
    WHERE det_rus LIKE '$reco'";

echo $result1 = pg_query($conexion, $sql);

?>