
<?php 
require_once '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
	
$des_ins=$_POST['des_ins'];
$cod_unm=$_POST['cod_unm'];

$cod_agr = $_POST['cod_agr'];
$nom_agr = $_POST['nom_agr'];
$rap_agr = $_POST['rap_agr'];
$pcr_agr = $_POST['pcr_agr'];
$pen_agr = $_POST['pen_agr'];
$pro_agr = $_POST['pro_agr'];
$cod_for = $_POST['cod_for'];
$cod_tag = $_POST['cod_tag'];
$cod_tox = $_POST['cod_tox'];
$cod_iac = $_POST['cod_iac'];
$fun_agr = $_POST['fun_agr'];
$add_rus_agr = $_POST['add_rus_agr'];

$arreglo = explode("||",$add_rus_agr);
$length=count($arreglo)-1;

$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result1=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result1);
$cod_ins = $cod[0] + 1;


$sql="INSERT INTO insumos(cod_ins, des_ins, cod_unm) VALUES ('$cod_ins','$des_ins', '$cod_unm')";
echo $result=pg_query($conexion,$sql);


$sql2 ="INSERT INTO public.agroquimicos(
	cod_agr, cod_ins, nom_agr, rap_agr, pcr_agr, pen_agr, pro_agr, cod_for, cod_tag, cod_tox, cod_iac, fun_agr)
	VALUES ('$like$cod_agr', $cod_ins, '$nom_agr', '$rap_agr', '$pcr_agr', '$pen_agr', '$pro_agr', '$cod_for', '$cod_tag', '$cod_tox','$cod_iac','$fun_agr')";

echo $result2 = pg_query($conexion,$sql2);

	for($i=0;$i<$length;$i++){
		$arreglo1 = explode("~",$arreglo[$i]);
		$sql3="INSERT INTO public.recomendaciones_uso_agr(
			cod_agr, det_rus)
			VALUES ('$like$cod_agr','$arreglo1[1]')";

		echo $result3=pg_query($conexion,$sql3);
	}



?>