<?php 

require '../../conexion.php';
session_start();
$cod_cul =$_GET['c'];  
$codi_fin=$_SESSION['ide_finca'];
?>

<?php
date_default_timezone_set('America/Bogota');
$d = date("d");
$m = date("m");
$y = date("Y");
$fecha=$y."-".$m."-".$d;
$cod_cul =$_GET['c'];
$total_inversion_cul = 0;

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
<h2 style="font-weight:bold">Tareas:</h2>';

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
//**************************Parte de tareas en el cultivo 
$nombre='AgrosystCo - informe de tareas ejecutadas en el cultivo'.explode("-",$info[8])[1].' - '.$fecha.'.pdf';

$mpdf=new mPDF('c','A4');

$mpdf->writeHTML($html);
$mpdf->Output($nombre,'I');
}else{
echo "El cultivo seleccionado no tiene tareas";
}



?>