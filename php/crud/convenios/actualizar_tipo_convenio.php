<?php 
require_once '../../conexion.php';
$cod_con = $_POST['cod_con'];
$tipo_con = $_POST['tipo_con'];

if ($tipo_con==1) {
	$hor_jorup = $_POST['hor_jorup'];
	$vho_horup = $_POST['vho_horup'];

	$sql="UPDATE public.jornales
	SET hor_jor='$hor_jorup', vho_jor='$vho_horup'
	WHERE cod_con='$cod_con'";
}

if ($tipo_con==2) {
	$des_contup=$_POST['des_contup'];
	$val_contup = $_POST['val_contup'];
	$ffi_conup = $_POST['ffi_conup'];

	$sql="UPDATE public.contratos
	SET val_cot='$val_contup', des_cot='$des_contup',ffi_con='$ffi_conup'
	WHERE cod_con='$cod_con'";
}
echo $result=pg_query($conexion,$sql);
?>