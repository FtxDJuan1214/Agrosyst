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
$int = 1;

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
<h2 style="font-weight:bold">Cultivo en el lote: '.$info[10].' con '.$info[3].' plantas</h2>
<h2 style="font-weight:bold">Producciones:</h2>';

 	//**************************Parte de producción del cultivo 


$html.='<table>
<thead style="width:100%;">
<tr style="width:100px;" >
<th style="width:100px;" >Código</th>
<th style="width:100px;" >Descripción</th>
<th style="width:100px;" >Fecha</th>
<th style="width:100px;" >Capacidad</th>
<th style="width:100px;" >Cantidad</th>
<th style="width:100px;" >Total</th>
<th style="width:100px;" >Recaudo</th>
<th style="width:100px;" >Comprador</th>
</tr>
</thead>
<tbody>';
$sql=" SELECT DISTINCT produccion.cod_pro, tipo_de_produccion.cod_tpr, tipo_de_produccion.des_tpr, 
gozar.fec_goz, gozar.cpt_goz,gozar.ctp_goz, gozar.pre_goz, cultivos.cod_cul, nombre_cultivo.des_ncu,
unidad_de_medida.des_unm, produccion.ide_ter, terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, cultivos.npl_cul,lotes.nom_lot
FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  produccion.cod_pro ASC"; 
$result=pg_query($conexion,$sql);
$result1=pg_query($conexion,$sql);

$filas= pg_num_rows($result);
if ($filas != 0) {
	
	$cont = 0;
	$veces = 0;
	$anterior = 0;
	$indice = 0;
	while($fila=pg_fetch_row($result1)){
		$Lista[] = [$fila[0],(floatval($fila[5]) * floatval($fila[6]))];

		if($fila[0] == $anterior){
			$veces++;
			$anterior = $fila[0];
		}else{
			if($cont == 0){
				$veces++;
				$anterior = $fila[0];
			}else{
				$array[] = [$indice,$veces];
				$veces = 1;
				$anterior = $fila[0];
			}
		}

		$indice = $fila[0];
		$cont++;
	}
	$array[] = [$indice,$veces];

	$nant = $Lista[0][0];
	$total = 0;


	for ($i=0; $i < count($array) ; $i++) { 
    //echo "Codigo: ".$array[$i][0]." Repite: ".$array[$i][1];
		$total = 0;
		for ($j=0; $j < count($Lista); $j++) { 
			if ($array[$i][0] == $Lista[$j][0]) {
				$total = ($total + $Lista[$j][01]);
			}
		}
		$totales[] = [$array[$i][0],$array[$i][1],$total];
    //echo " Total : " . $total."<br>";
	}

	$index = 0;
	$i=0;
	$money = 0;
	$background = "#808B96";

	$recaudo_total=0;
	while($ver=pg_fetch_row($result)){   

		if($ver[0] == $index){
			$index = $ver[0];

			$html.='<tr style="background:'.$background.';" >
			<td align="center">';
			$array=explode("-", $ver[2]);
			$arra1=explode("-", $ver[9]);
			$html.=''.$array[1].'<br> ['.$arra1[1].']</td>
			<td align="center">'.$ver[3].'</td>
			<td align="center">'.$ver[4].'Kg</td>
			<td align="center">'.$ver[5].'</td>
			<td align="center">$'.(floatval($ver[5]) * floatval($ver[6])).'</td>
			</tr>';
		}else{

			if ($background == "#808B96") {
				$background = "#CCD1D1";
			}else{
				$background = "#808B96";
			}


			$html.='<tr style="background:'.$background.';">

			<td align="center" rowspan="'.$totales[$i][1].'">Producción: '.$int.'</td>
			<td align="center">';
			$array=explode("-", $ver[2]);
			$arra1=explode("-", $ver[9]);
			$html.=''.$array[1].'<br> ['.$arra1[1].']</td>
			<td align="center">'.$ver[3].'</td>
			<td align="center">'.$ver[4].'Kg</td>
			<td align="center">'.$ver[5].'</td>
			<td align="center">$'.(floatval($ver[5]) * floatval($ver[6])).'</td>
			<td align="center" rowspan="'.$totales[$i][1].'">$'.$totales[$i][2].'</td>
			<td align="center" rowspan="'.$totales[$i][1].'">'.$ver[11].' '.$ver[12].'<br>'.$ver[13].' '.$ver[14].'</td>
			</tr>';
			$recaudo_total = $recaudo_total + $totales[$i][2];
			$index = $ver[0];
			$i++;
			$int++;
		}

	}
	$html.='
	</tbody>
	</table>
	<p style="font-weight:bold;font-size:18px; text-decoration:underline;">Recaudo total de las produccinoes: $'.$recaudo_total.'.</p>
	';

//**************************Parte de producción del cultivo 
	$nombre='AgrosystCo - informe de producción del cultivo'.explode("-",$info[8])[1].' - '.$fecha.'.pdf';

	$mpdf=new mPDF('c','A4');

	$mpdf->writeHTML($html);
	$mpdf->Output($nombre,'I');

}else{
	echo "Este cultivo no tiene produccinoes.";
}

?>