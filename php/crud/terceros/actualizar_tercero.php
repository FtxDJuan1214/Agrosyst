<?php 
require '../../conexion.php';

$ide_ter=$_POST['ide_ter'];
$pno_ter=ucwords(strtolower($_POST['pno_ter']));
$sno_ter=ucwords(strtolower($_POST['sno_ter']));
$pap_ter=ucwords(strtolower($_POST['pap_ter']));
$sap_ter=ucwords(strtolower($_POST['sap_ter']));

$sql="UPDATE public.terceros
	SET pno_ter='$pno_ter', sno_ter='$sno_ter', pap_ter='$pap_ter', sap_ter='$sap_ter'
	WHERE ide_ter='$ide_ter'";
echo $result=pg_query($conexion,$sql);
?>

