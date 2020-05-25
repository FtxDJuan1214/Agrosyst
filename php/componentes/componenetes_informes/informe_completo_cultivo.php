<?php 
require '../../conexion.php';
date_default_timezone_set('America/Bogota');
$d = date("d");
$m = date("m");
$y = date("Y");
$fecha=$y."-".$m."-".$d;
$cod_cul =$_GET['c'];
session_start();
$codi_fin=$_SESSION['ide_finca'];

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
<div style="width:100%; text-align:center;"><h2>Informe completo del cultivo '.explode("-",$info[8])[1].'</h2></div>
<p style="font-weight:bold">Cultivo en el lote:</p>
<p style="margin-left:7px;">'.$info[10].'</p>
<p style="font-weight:bold">Fecha de inicio: </p>
<p style="margin-left:7px;">'.$info[1].'</p>
<p style="font-weight:bold">Fecha de finalización: </p>
<p style="margin-left:7px;">'.$info[2].'</p>
<p style="font-weight:bold">Duración: </p>
<p style="margin-left:7px;">'.$info[5].'</p>
<p style="font-weight:bold">Tipo de cultivo: </p>';
if ($info[4] == 1) {
	$html.='<p style="margin-left:7px;">Transitorio</p>';
}else{
	$html.='<p style="margin-left:7px;">Perenne</p>';
}
$html.='
<p style="font-weight:bold">Número de plantas: </p>
<p style="margin-left:7px;">'.$info[3].'</p>
<p style="font-weight:bold">Estado del cultivo: </p>';
if ($info[6] == 1) {
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Inicio</p>';
}else if($info[6] == 2){
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Crecimiento</p>';
}else if($info[6] == 3){
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Inicio de afloración</p>';
}else if($info[6] == 4){
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Maxima afloración</p>';
}else if($info[6] == 5){
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Inicio de fructificacipon</p>';
}else if($info[6] == 6){
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Cosecha</p>';
}else if($info[6] == 7){
	$html.='<p style="margin-left:7px;">A lafecha de '.$fecha.', el estado del cultivo es: Finalizado</p>';
}
$html.='
<p style="font-weight:bold">Socios del cultivo:</p>';
$query="SELECT act_cul.ide_ter,terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter FROM public.act_cul 
INNER JOIN terceros ON terceros.ide_ter = act_cul.ide_ter 
where cod_cul='$cod_cul'";
$result =pg_query($conexion,$query);
while ($ver=pg_fetch_row($result)) {
	
	$html.='<p style="margin-left:7px;"> 	°'.$ver[1].' '.$ver[2].' '.$ver[3].' '.$ver[4].'</p>';

}

///*****************************************aportes de los socios *********************************

$queryasda="SELECT act_cul.ide_ter,terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter FROM public.act_cul 
INNER JOIN terceros ON terceros.ide_ter = act_cul.ide_ter 
where cod_cul='$cod_cul'";
$resultasda =pg_query($conexion,$queryasda);
if (pg_num_rows($resultasda) > 0) {
	$aporte_total_cultivo = 0;
	$convenios_aporte = "";

	while ($ver=pg_fetch_row($resultasda)) {
		$detalles_conv = 0;
		$detalles_insu = 0;
		$detalles_gast = 0;
    //Sacar cada socio
		$total_aporte = 0;
    //Buscar aportes por convenios ****************************************************************************************
		$sql1="SELECT DISTINCT convenio.cod_con, act_con.ide_ter, ejecutar.cod_cul FROM convenio , act_con, ejecutar ,efectuar
		where convenio.cod_con = act_con.cod_con and act_con.cod_con = efectuar.cod_con
		and efectuar.cod_con = ejecutar.cod_con and ejecutar.cod_cul = '$cod_cul' and ide_ter = '$ver[0]'"; 
		$r=pg_query($conexion,$sql1);
		while($se=pg_fetch_row($r)){
      // echo "---Convenio: ".$se[0];

			$sql2=" SELECT hor_jor,vho_jor FROM jornales WHERE cod_con='$se[0]'"; 
			$result1=pg_query($conexion,$sql2);
			$see=pg_fetch_row($result1);
			if($see!=0){
        // echo "      $".($see[0]*$see[1])."<br>";
				$total_aporte = $total_aporte + ($see[0]*$see[1]);
			}

			$sql2="SELECT val_cot,convenio.fec_con FROM contratos INNER JOIN convenio on contratos.cod_con=convenio.cod_con 
			and contratos.cod_con='$se[0]'"; 
			$result1=pg_query($conexion,$sql2);
			$see=pg_fetch_row($result1);
			if($see!=0){
        // echo "      $".$see[0]."<br>";
				$total_aporte = ($total_aporte + $see[0]);
			}

		}
		$detalles_conv =  ($detalles_conv + $total_aporte);
    //echo "CC: ".$ver[0]."  ".$ver[1]." ".$ver[3].":  ".$total_aporte." Convenios <br>";


    //buscar aportes por insumos / gastos ********************************************************************************
		$total_insumos = 0;
		$sql5="SELECT DISTINCT cultivos.cod_cul, tarea.cod_tar, insumos.des_ins, utilizar.cin_tar, utilizar.pin_tar, 
		terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, insumos.cod_ins
		FROM duenio, terceros, act_cul, cultivos, ejecutar, convenio, efectuar, tarea, utilizar, stock, insumos, compras, registrar, comprar 
		WHERE cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con AND convenio.cod_con=efectuar.cod_con
		AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_tar=utilizar.cod_tar AND utilizar.cod_sto=stock.cod_sto
		AND stock.cod_ins=insumos.cod_ins AND stock.cod_sto = registrar.cod_sto  AND registrar.cod_com = compras.cod_com
		AND compras.cod_com = comprar.cod_com AND comprar.ide_ter = terceros.ide_ter AND terceros.ide_ter = duenio.ide_ter
		and ejecutar.cod_cul = '$cod_cul' and terceros.ide_ter = '$ver[0]'";
		$res=pg_query($conexion,$sql5);
		while($seee=pg_fetch_row($res)){
      //echo $seee[5]." ".$seee[6]." : ".$seee[4]."<br>";
			$total_insumos = $total_insumos + $seee[4];

			$excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$seee[9]'"; 
			$rex=pg_query($conexion,$excluir);
			$filas=pg_num_rows($rex);
			if($filas==0){

				$detalles_insu = ($detalles_insu + $seee[4]);
			}else{
				$detalles_gast = ($detalles_gast + $seee[4]);
			}
		}

		$sql5="SELECT DISTINCT cultivos.cod_cul, tarea.cod_tar, insumos.des_ins, utilizar.cin_tar, utilizar.pin_tar, 
		terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, insumos.cod_ins
		FROM socio, terceros, act_cul, cultivos, ejecutar, convenio, efectuar, tarea, utilizar, stock, insumos, compras, registrar, comprar 
		WHERE cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con AND convenio.cod_con=efectuar.cod_con
		AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_tar=utilizar.cod_tar AND utilizar.cod_sto=stock.cod_sto
		AND stock.cod_ins=insumos.cod_ins AND stock.cod_sto = registrar.cod_sto  AND registrar.cod_com = compras.cod_com
		AND compras.cod_com = comprar.cod_com AND comprar.ide_ter = terceros.ide_ter AND terceros.ide_ter = socio.ide_ter
		and ejecutar.cod_cul = '$cod_cul' and terceros.ide_ter = '$ver[0]'";
		$res=pg_query($conexion,$sql5);
		while($seee=pg_fetch_row($res)){
      //echo $seee[5]." ".$seee[6]." : ".$seee[4]."<br>";
			$total_insumos = $total_insumos + $seee[4];

			$excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$seee[9]'"; 
			$rex=pg_query($conexion,$excluir);
			$filas=pg_num_rows($rex);
			if($filas==0){

				$detalles_insu = ($detalles_insu + $seee[4]);
			}else{
				$detalles_gast = ($detalles_gast + $seee[4]);
			}

		}

     //echo "CC: ".$ver[0]."  ".$ver[1]." ".$ver[3].":  ".$total_insumos." Insumos <br>";

     $convenios_aporte = $convenios_aporte."$ver[1] $ver[2] $ver[3] $ver[4]-".($total_aporte + $total_insumos)."-".$detalles_conv."-".$detalles_insu."-".$detalles_gast."||"; // Se crea la key Farton

     $aporte_total_cultivo  =  $aporte_total_cultivo + $total_aporte + $total_insumos;
 }
 if ($aporte_total_cultivo != 0 ) {

 	$cultivos = "SELECT cultivos.cod_cul,cultivos.fin_cul,cultivos.fif_cul,cultivos.npl_cul,
 	cultivos.tip_cul,cultivos.dur_cul,cultivos.est_cul,nombre_cultivo.cod_ncu,nombre_cultivo.des_ncu,
 	lotes.cod_lot,lotes.nom_lot,cultivos.mod_cul FROM cultivos,fincas,lotes,nombre_cultivo 
 	WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot 
 	AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND cultivos.cod_cul='$cod_cul'
 	ORDER BY cultivos.cod_cul ASC";
 	$result =pg_query($conexion,$cultivos);
 	$info=pg_fetch_row($result);
 	$html.='
 	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 	<br>
 	<div style="width:100%;background:#a892a8;"></div>
 	<div style="width:100%; text-align:center;"><h2>Aportes de los socios</h2></div>';
 	$aportes_det = explode("||", $convenios_aporte);
 	for ($i=0; $i < count($aportes_det) -1; $i++) { 
 		$especifico = explode("-",$aportes_det[$i]);
 		$html.='<p style="font-weight:bold">'.$especifico[0].'</p>
 		<p style="margin-left:7px;"> Aportes por :</p>
 		<p style="margin-left:10px;"> °Convenios: $'.$especifico[2].'.</p>
 		<p style="margin-left:10px;"> °Insumos: $'.$especifico[3].'.</p>
 		<p style="margin-left:10px;"> °Gatos: $'.$especifico[4].'.</p>';

 	}
 	$html.='
 	<div style="width:100%;background:#a892a8;"></div>
 	<h3>Inversión total:  $'.$aporte_total_cultivo.'</h3>
 	<div style="width:100%;background:#a892a8;"></div>
 	<h3> A la fecha de :'.$fecha.', los aportes están así:</h3>';
 	for ($i=0; $i < count($aportes_det) -1; $i++) { 
 		$especifico = explode("-",$aportes_det[$i]);

 		$total_socio = ($especifico[2] + $especifico[3] + $especifico[4]);
 		$porcentaje = ($total_socio * 100 ) / $aporte_total_cultivo;

 		$html.='<p>'.$especifico[0].' aportó $'.$total_socio.' equivalentes al '.round($porcentaje).'% de la inversión total en el cultivo.</p>';

 	}
 	// $html.='
 	// </div>
 	// </body>
 	// </html>
 	// ';

 }
}


///************************************************************************************************


///*************************************Informe de rendimiento del cultivo************************

$html.='
<div style="width:100%;background:#a892a8;"></div>	
<div style="width:100%; text-align:center;"><h2>Rendimiento del cultivo</h2></div>';

 	//**************************Parte del rendimiento del cultivo 


$detalles = "";

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

}

//**************************************************************************************************



//***************************************Informe de la producción************************************
$int = 1;

$html.='<div style="width:100%;background:#a892a8;"></div>
<h2 style="font-weight:bold;" align="center">Producción del cultivo</h2>';

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

}


$html.='<div style="width:100%;background:#a892a8;"></div>
<h2 style="font-weight:bold" align="center">Tareas ejecutadas en el cultivo</h2>';

//**************************Parte de tareas en el cultivo 

$html.='<style>
table {
	border-collapse: collapse;
	font-size: 14px;
}

th, td {
	text-align: left;
	font-size: 0.7rem;
	padding: 5px;
}

tr:nth-child(even) {background-color: #808B96;}
</style>
</head>
<table class="table align-items-center table-flush">
<thead class="thead-light">
<tr>
<th style="width:;">Descripcion</th>
<th style="width:;">Tipo</th>
<th style="width:;">Fechas</th>
<th style="width:;">Convenios</th>
<th style="width:;">Insumos</th>
<th style="width:;">Gastos</th>
<th style="width:;">Valor</th>
<th style="width:;">Labor</th>
<th></th>
</tr>
</thead>
<tbody>';

$sql="SELECT DISTINCT tarea.cod_tar, tarea.des_tar, tarea.val_tar, tarea.fin_tar, tarea.ffi_tar, fincas.cod_fin, cultivos.cod_cul, nombre_cultivo.des_ncu, cultivos.npl_cul,lotes.nom_lot, labores.nom_lab, labores.cod_lab 
FROM fincas, lotes, cultivos, ejecutar, convenio, efectuar, tarea, nombre_cultivo, labores
WHERE fincas.cod_fin=lotes.cod_fin AND nombre_cultivo.cod_ncu = cultivos.cod_ncu AND lotes.cod_lot=cultivos.cod_lot 
AND cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con 
AND convenio.cod_con=efectuar.cod_con AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_lab = labores.cod_lab and fincas.cod_fin = '$codi_fin' AND cultivos.cod_cul = '$cod_cul' ORDER BY tarea.fin_tar ASC"; 
$result=pg_query($conexion,$sql);
$filas = pg_num_rows($result);
if ($filas != 0) {
	while($ver=pg_fetch_row($result)){

	$html.='<tr> 

	<td>'.$ver[1].'</td>
	<td>';
	$tipo = "SELECT cod_tar FROM public.comun WHERE cod_tar = '$ver[0]'";
	$res=pg_query($conexion,$tipo);
	$filas=pg_num_rows($res);
	if($filas !=0){
		$html.='Común';
	}

	$tipo = "SELECT cod_tar FROM public.cultural WHERE cod_tar = '$ver[0]'";
	$res=pg_query($conexion,$tipo);
	$filas=pg_num_rows($res);
	if($filas !=0){
		$html.='Cultural';
	}

	$tipo = "SELECT cod_tar FROM public.fitosanitaria WHERE cod_tar = '$ver[0]'";
	$res=pg_query($conexion,$tipo);
	$filas=pg_num_rows($res);
	if($filas !=0){
		$html.='Fitosanitaria';
	}

	$html.='</td> 
	<td>Inicio: '.$ver[3].'<br>Fin: '.$ver[4].'</td>    
	<td>';
	$sql1="SELECT convenio.cod_con, convenio.fec_con, contratos.ffi_con, contratos.val_cot, contratos.des_cot
	FROM efectuar, convenio, contratos where efectuar.cod_con = convenio.cod_con AND  contratos.cod_con = convenio.cod_con
	AND efectuar.cod_tar ='$ver[0]'";
	$result1=pg_query($conexion,$sql1);
	while($cont=pg_fetch_row($result1)){

		$terceros = "SELECT  act_con.cod_con, act_con.ide_ter, terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter 
		FROM act_con, terceros WHERE act_con.ide_ter = terceros.ide_ter and act_con.cod_con = '$cont[0]'";
		$html.='<br>
		<span>Contrato Pagado por:<br>';
		$i = 1;
		$erre=pg_query($conexion,$terceros);
		while($pers=pg_fetch_row($erre)){
			if ($i == 1){
				$i++;
			}else{
				$html.=''.$pers[2].' '.$pers[4].''; 
			}
		}
		$html.='<br>
		Valor: $'.$cont[3].'.</span>
		<br>_____________________________<br>';
	} 

	$sql1="SELECT convenio.cod_con, convenio.fec_con, jornales.hor_jor, jornales.vho_jor FROM efectuar, jornales, convenio
	where efectuar.cod_con = convenio.cod_con AND  jornales.cod_con = convenio.cod_con AND efectuar.cod_tar = '$ver[0]'";
	$result1=pg_query($conexion,$sql1);
	while($jor=pg_fetch_row($result1)){

		$terceros = "SELECT act_con.cod_con, act_con.ide_ter, terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter 
		FROM act_con, terceros WHERE act_con.ide_ter = terceros.ide_ter and act_con.cod_con = '$jor[0]'";
		
		$html.='<br>
		<span>Jornal pagado por:<br>';
		$i = 1;
		$erre=pg_query($conexion,$terceros);
		while($pers=pg_fetch_row($erre)){
			if ($i == 1){
				$i++;
			}else{
				$html.=''.$pers[2].' '.$pers[4].''; 
			}
		}

		$html.='<br>
		Valor: '.(floatval($jor[2]) * floatval($jor[3]) ).'</span>
		<br>_____________________________<br>';
	}

	$html.='</td>
	<td>';
	$sql1="SELECT DISTINCT insumos.des_ins, utilizar.cin_tar, unidad_de_medida.des_unm,  
	utilizar.pin_tar, terceros.pno_ter, terceros.sno_ter, 
	terceros.pap_ter, terceros.sap_ter, stock.cod_sto, stock.cod_ins,  utilizar.cod_uti
	FROM insumos, stock, registrar, compras, comprar, terceros, duenio, unidad_de_medida, utilizar
	WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
	AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
	AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter
	AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
	AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
	$result1=pg_query($conexion,$sql1);
	while($dats=pg_fetch_row($result1)){
		$excluir="SELECT cod_ins from otros where cod_ins = '$dats[9]'"; 
		$rex=pg_query($conexion,$excluir);
		$filas=pg_num_rows($rex);
		if ($filas == 0) {
			$unm=explode("-",$dats[2]);

			$html.='<span>'.$dats[4].' '.$dats[6].'<br>'.$dats[0].'.<br>Cantidad: '.$dats[1].' '. $unm[1].'.<br>Valor: $'.$dats[3].'</span>
			<br>_____________________________<br>';
		}
	}

	$sql1="SELECT DISTINCT insumos.des_ins, utilizar.cin_tar, unidad_de_medida.des_unm,  
	utilizar.pin_tar, terceros.pno_ter, terceros.sno_ter, 
	terceros.pap_ter, terceros.sap_ter, stock.cod_sto, stock.cod_ins , utilizar.cod_uti
	FROM insumos, stock, registrar, compras, comprar, terceros, socio, unidad_de_medida, utilizar
	WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
	AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
	AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
	AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
	AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
	$result1=pg_query($conexion,$sql1);
	while($dats=pg_fetch_row($result1)){
		$excluir="SELECT cod_ins from otros where cod_ins = '$dats[9]'"; 
		$rex=pg_query($conexion,$excluir);
		$filas=pg_num_rows($rex);
		if ($filas == 0) {
			$unm=explode("-",$dats[2]);
			$html.='<span>'.$dats[4].' '.$dats[6].'<br>'.$dats[0].'.<br>Cantidad: '.$dats[1].' '. $unm[1].'.<br>Valor: $'.$dats[3].'</span>
			<br>_____________________________<br>';
		}
	} 

	$html.='</td>
	<td>';
	$sql1="SELECT DISTINCT insumos.des_ins, utilizar.pin_tar,terceros.pno_ter, terceros.sno_ter, 
	terceros.pap_ter, terceros.sap_ter, stock.cod_sto
	FROM insumos, stock, registrar, compras, comprar, terceros, duenio, unidad_de_medida, utilizar, otros
	WHERE otros.cod_ins = stock.cod_ins AND insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
	AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
	AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter
	AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
	AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
	$result1=pg_query($conexion,$sql1);
	while($dats=pg_fetch_row($result1)){

		$html.='<span>'.$dats[2].' '.$dats[4].'<br>'.$dats[0].'.<br>Valor: $'.$dats[1].'</span>
		<br>_____________________________<br>';
	} 

	$sql1="SELECT DISTINCT insumos.des_ins, utilizar.pin_tar,terceros.pno_ter, terceros.sno_ter, 
	terceros.pap_ter, terceros.sap_ter, stock.cod_sto
	FROM insumos, stock, registrar, compras, comprar, terceros, socio, unidad_de_medida, utilizar, otros
	WHERE otros.cod_ins = stock.cod_ins AND insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
	AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
	AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
	AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
	AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
	$result1=pg_query($conexion,$sql1);
	while($dats=pg_fetch_row($result1)){

		$html.='<span>'.$dats[2].' '.$dats[4].'<br>'.$dats[0].'.<br>Valor: $'.$dats[1].'</span>
		<br>_____________________________<br>';
	}

	$html.='</td>
	<td><span style="border:1px dashed ; border-radius: 5px; padding: 4px; font-size: 1.1em;">$'.$ver[2].'</span></td>
	<td>'.$ver[10].'</td></tr>';
	$total_inversion_cul = $total_inversion_cul + $ver[2];
}
$html.='</tbody></table>';
$html.='<p style="font-weight:bold;font-size:18px; text-decoration:underline;">Inversión total en el cultivo: $'.$total_inversion_cul.'.</p>';

}


//****************************************************************************************************

$html.='</div>
</body>
</html>
';


$nombre='AgrosystCo - informe completo del cultivo '.explode("-",$info[8])[1].' - '.$fecha.'.pdf';

$mpdf=new mPDF('c','A4');

$mpdf->writeHTML($html);
$mpdf->Output($nombre,'I');
?>
