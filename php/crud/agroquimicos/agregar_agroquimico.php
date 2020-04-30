<?php 
require_once '../../conexion.php';
	
$des_ins=$_POST['des_ins'];
$cod_unm=$_POST['cod_unm'];

$cod_agr = $_POST['cod_agr'];
$det_agr = $_POST['det_agr'];
$rec_agr = $_POST['rec_agr'];
$pcr_agr = $_POST['pcr_agr'];
$pen_agr = $_POST['pen_agr'];
$pro_agr = $_POST['pro_agr'];
$for_agr = $_POST['for_agr'];
$cod_tag = $_POST['cod_tag'];
$cod_tox = $_POST['cod_tox'];
$est_agr = $_POST['est_agr'];

$sql="INSERT INTO insumos(
des_ins, cod_unm)
VALUES ('$des_ins', '$cod_unm')";
echo $result=pg_query($conexion,$sql);

if($result==true){


$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result1=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result1);


$cod_ins = $cod[0];


$sql2 ="INSERT INTO public.agroquimicos(
	cod_agr, cod_ins, det_agr, rec_agr, pcr_agr, pen_agr, pro_agr, for_agr, cod_tag, cod_tox, est_agr)
	VALUES ('$cod_agr', $cod_ins, '$det_agr', '$rec_agr', '$pcr_agr', '$pen_agr', '$pro_agr', '$for_agr', '$cod_tag', '$cod_tox', '$est_agr');";

echo $result2 = pg_query($conexion,$sql2);
}

return true;
?>

