<?php
require_once '../../conexion.php';

$cod_ins = $_POST['cod_ins'];
$cod_agr = $_POST['cod_agr'];

$sql2 = "DELETE FROM public.recomendaciones_uso_agr
        WHERE cod_agr='$cod_agr'";

echo $result2 = pg_query($conexion, $sql2);

$sql = "DELETE FROM public.agroquimicos
    WHERE cod_ins='$cod_ins'";

echo $result = pg_query($conexion, $sql);

$sql1 = "DELETE FROM public.insumos 
        WHERE cod_ins=$cod_ins";
echo $result1 = pg_query($conexion, $sql1);

?>