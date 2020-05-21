<?php 
require '../../conexion.php';
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
$html.='</div>
</body>
</html>
';


$nombre='AgrosystCo - informe general del cultivo '.explode("-",$info[8])[1].' - '.$fecha.'.pdf';

$mpdf=new mPDF('c','A4');

$mpdf->writeHTML($html);
$mpdf->Output($nombre,'I');
?>
