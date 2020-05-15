<?php 
$fin_cul=$_POST['fin_cul'];
$fif_cul=$_POST['fif_cul'];

date_default_timezone_set('America/Bogota');
$d = date("d");
$m = date("m");
$y = date("Y");
$hoy=$y."-".$m."-".$d;

function calcularTiempo($fin_cul,$fif_cul){
  $fecha1= date_create($fin_cul);
  $fecha2= date_create($fif_cul);
  $intervalo= date_diff($fecha1,$fecha2);

  $tiempo=array();
  foreach ($intervalo as $valor) {
  	$tiempo[]=$valor;
  }

  return $tiempo;
}

$datos = calcularTiempo($fin_cul,$fif_cul);
$datos2 = calcularTiempo($fin_cul,$hoy);
$ver= $datos[0]."||".$datos[1]."||".$datos[2]."||".$datos[11]."||".$datos2[11];
echo $ver;
?>