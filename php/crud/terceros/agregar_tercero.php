<?php 
require '../../conexion.php';

$ide_ter=$_POST['ide_ter'];
$pno_ter=ucwords(strtolower($_POST['pno_ter']));
$sno_ter=ucwords(strtolower($_POST['sno_ter']));
$pap_ter=ucwords(strtolower($_POST['pap_ter']));
$sap_ter=ucwords(strtolower($_POST['sap_ter']));

$sql="INSERT INTO public.terceros(
ide_ter, pno_ter, sno_ter, pap_ter, sap_ter)
VALUES ('$ide_ter', '$pno_ter', '$sno_ter', '$pap_ter', '$sap_ter')";
echo $result=pg_query($conexion,$sql);
?>

