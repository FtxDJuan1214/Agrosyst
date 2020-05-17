<?php 

require '../../conexion.php';
session_start();
$cod_cul =$_GET['c'];  
?>

<?php
date_default_timezone_set('America/Bogota');
$d = date("d");
$m = date("m");
$y = date("Y");
$fecha=$y."-".$m."-".$d;
$cod_cul =$_GET['c'];

$cultivos = "SELECT cultivos.cod_cul,cultivos.fin_cul,cultivos.fif_cul,cultivos.npl_cul,
cultivos.tip_cul,cultivos.dur_cul,cultivos.est_cul,nombre_cultivo.cod_ncu,nombre_cultivo.des_ncu,
lotes.cod_lot,lotes.nom_lot,cultivos.mod_cul FROM cultivos,fincas,lotes,nombre_cultivo 
WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot 
AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND cultivos.cod_cul='$cod_cul'
ORDER BY cultivos.cod_cul ASC";
$result =pg_query($conexion,$cultivos);
$info=pg_fetch_row($result);
require('../../../assets/pdf/mpdf.php');
$html='
<html lang="es">
<head>
<meta charset="utf-8">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../../../assets/css/informes.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="header">
<h5 style="font-size:16px">Agrosyst Co.<span style="color:green"></span> Informe generado el '.$fecha.'	</h5>
</div>
<div style="width:100%;background:#a892a8;"></div>
<div style="width:100%; text-align:center;"><h2>Cultivo '.explode("-",$info[8])[1].'</h2></div>
<h2 style="font-weight:bold">Cultivo en el lote: '.$info[10].' con '.$info[3].' plantas</h2>';

 	//**************************Parte del rendimiento del cultivo 


$detalles = "";


?>

<?php
$queryasda="SELECT DISTINCT gozar.fec_goz,tipo_de_produccion.des_tpr, gozar.cpt_goz,gozar.ctp_goz, gozar.pre_goz,produccion.cod_pro
FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  gozar.fec_goz ASC";
$resultasda =pg_query($conexion,$queryasda);
if (pg_num_rows($resultasda) != 0) {

	$sql1="SELECT fec_goz FROM gozar ORDER BY fec_goz ASC LIMIT 1";
	$res=pg_query($conexion,$sql1);
	$ver1=pg_fetch_row($res);
	$var=strval($ver1[0]);

	$produccion_rendimiento = "";  
	$dinero = 0;
	$kilos = 0;
	while ($ver=pg_fetch_row($resultasda)) {
		$dinero = $dinero + (floatval($ver[3]) * floatval($ver[4]));
		$kilos = $kilos + (floatval($ver[2]) * floatval($ver[3]));

	}
	$detalles =  $detalles.$dinero.",".$kilos."**";

	$queryasda="SELECT DISTINCT gozar.fec_goz,tipo_de_produccion.des_tpr, gozar.cpt_goz,gozar.ctp_goz
	FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
	public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
	WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
	AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
	AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
	AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  tipo_de_produccion.des_tpr ASC";
	$resultasda =pg_query($conexion,$queryasda);

	$sql1="SELECT DISTINCT gozar.fec_goz,tipo_de_produccion.des_tpr, gozar.cpt_goz,gozar.ctp_goz
	FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
	public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
	WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
	AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
	AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
	AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  tipo_de_produccion.des_tpr ASC LIMIT 1";
	$res=pg_query($conexion,$sql1);
	$ver1=pg_fetch_row($res);
	$var=strval($ver1[1]);

	$kilos = 0;
	while ($ver=pg_fetch_row($resultasda)) {

		if (strcmp($var, strval($ver[1])) !== 0){
			$detalles =  $detalles."".explode("-", $var)[1].",".$kilos."||";
			$var = strval($ver[1]);
			$dinero = 0;
			$kilos = 0;
		}
		$kilos = $kilos + (floatval($ver[2]) * floatval($ver[3]));

	}
	$detalles =   $detalles."".explode("-", $var)[1].",".$kilos."||";

	$sqya = "SELECT DISTINCT tarea.cod_tar, tarea.des_tar, tarea.fin_tar, tarea.ffi_tar, cultivos.cod_cul, nombre_cultivo.des_ncu, cultivos.npl_cul,lotes.nom_lot,tarea.val_tar 
	FROM fincas, lotes, cultivos, ejecutar, convenio, efectuar, tarea, nombre_cultivo, labores
	WHERE fincas.cod_fin=lotes.cod_fin AND nombre_cultivo.cod_ncu = cultivos.cod_ncu AND lotes.cod_lot=cultivos.cod_lot 
	AND cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con 
	AND convenio.cod_con=efectuar.cod_con AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_lab = labores.cod_lab and cultivos.cod_cul = '$cod_cul'
	ORDER BY tarea.fin_tar ASC";
	$resasad =pg_query($conexion,$sqya);
	$aportes = 0;
	while ($ver=pg_fetch_row($resasad)) {
		$aportes = $aportes + floatval($ver[8]);
	}
	$detalles =   $detalles."**".$aportes;
	$todo = explode("**",$detalles);
	$tipos_p = explode("||",$todo[1]);
	$html.='<h3> A la fecha de '.$fecha.' el rendimiento del cultivo está así:</h3>';
	for ($i=0; $i < count($tipos_p) - 1; $i++) { 
		$detallado = explode(",",$tipos_p[$i]);
		$html.='<p style="font-size:17px;">° Tipo de producción '.$detallado[0].':</p>
		<p style="margin-left:30px;">total de kilogramos producidos : '.$detallado[1].'Kg.</p>';
	}
	$html.='<p style="font-weight:bold;  font-size:17px; text-decoration:underline;">Total de kilos producidos: '.explode(",",$todo[0])[1].'Kg</p ><div style="width:100%;background:#a892a8;"></div>
	<h3>Rendimiento del cultivo:</h3>
	<p style="font-size:17px;">Total de inversión: $'.$todo[2].'.</p>
	<p style="font-size:17px;">Total de recaudo: $'.explode(",",$todo[0])[0].'.</p>
	<h3>Situación:</h3>';
	if (floatval($todo[2] ) > floatval(explode(",",$todo[0])[0])) {
		$html.='<p style="font-size: 17px;">La inversión es mayor al recaudo, esto significa que el cultivo está en perdidas por un valor de: $'.($todo[2] - explode(",",$todo[0])[0]).'.</p style="font-size: 17px;">';
	}else{
		$html.='<p style="font-size: 17px;">El recaudo es mayor a la inversión, esto significa el cultivo está en ganacias por un valor de: $'.(explode(",",$todo[0])[0] - $todo[2]).'.</p>';
	}
	$html.='</div>
	</body>
	</html>
	';

	$nombre='AgrosystCo - informe de rendimiento del cultivo'.explode("-",$info[8])[1].' - '.$fecha.'.pdf';

	$mpdf=new mPDF('c','A4');

	$mpdf->writeHTML($html);
	$mpdf->Output($nombre,'I');

}else{
	echo "El cultivo seleccinoado no tiene producciones.";
}

?>