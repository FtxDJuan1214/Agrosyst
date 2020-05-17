<?php 

require '../../conexion.php';
session_start();
$cod_cul =$_GET['c'];  
?>

<?php
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
 	<h2 style="font-weight:bold">Cultivo en el lote: '.$info[10].' con '.$info[3].' plantas</h2>
 	<div style="width:100%;background:#a892a8;"></div>
 	<h3>Aportes de los socios: </h3>';
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
 	$html.='
 	</div>
 	</body>
 	</html>
 	';


 	$nombre='AgrosystCo - informe del cultivo'.explode("-",$info[8])[1].' - aportes por soio - '.$fecha.'.pdf';

 	$mpdf=new mPDF('c','A4');

 	$mpdf->writeHTML($html);
 	$mpdf->Output($nombre,'I');
 }else{
 	echo "El cultivo no tiene aportes";
 }
}



?>