<?php 
require_once '../../conexion.php'; 
$num_fact=$_POST['num_fact'];
$fec_con=$_POST['fec_con'];
$cos_tot=trim($_POST['cos_tot'],'$');

$sql1="INSERT INTO public.compras(
	cod_com, fec_com, tot_com)
	VALUES ('$num_fact', '$fec_con', '$cos_tot')";
echo $result=pg_query($conexion,$sql1);

?>