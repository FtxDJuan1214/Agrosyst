<?php 
require '../../conexion.php';
session_start();
$codi_fin=$_SESSION['ide_finca'];
$notificacion = "";
$sql="SELECT cultivos.cod_cul,cultivos.fin_cul,cultivos.fif_cul,cultivos.dia_cul,cultivos.npl_cul,
cultivos.tip_cul,cultivos.dur_cul,cultivos.est_cul,nombre_cultivo.cod_ncu,nombre_cultivo.des_ncu,
lotes.cod_lot,lotes.nom_lot,cultivos.mod_cul FROM cultivos,fincas,lotes,nombre_cultivo WHERE fincas.cod_fin=lotes.cod_fin 
AND lotes.cod_lot=cultivos.cod_lot AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND fincas.cod_fin='$codi_fin'
ORDER BY cultivos.cod_cul ASC"; 
$result=pg_query($conexion,$sql);
while($ver=pg_fetch_row($result)){

	date_default_timezone_set('America/Bogota');
	$d = date("d");
	$m = date("m");
	$y = date("Y");
	$fecha_hoy=$y."-".$m."-".$d;

	$fecha_inicio=$ver[1];
	$fecha_fin=$fecha_hoy;

	$fecha1= date_create($fecha_inicio);
	$fecha2= date_create($fecha_fin);
	$intervalo= date_diff($fecha1,$fecha2);

	$tiempo=array();
	foreach ($intervalo as $valor) {
		$tiempo[]=$valor;
	}

	$Dias_totales = $ver[3];
	$Dias_actuales = $tiempo[11];
	if($Dias_actuales >= 0 && $Dias_actuales <= 3){

		$sql2="select nom_afe, eat_afe from afeccion where to_tsvector(eat_afe)@@ to_tsquery('Inicio');"; 
		$result1=pg_query($conexion,$sql2);
		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." plantas está en etapa Inicial.\n\nEstas son algunas de las plagas o enfermedades que podrían aparecer:\n\n";
		while($see=pg_fetch_row($result1)){
			$notificacion.="".$see[0].",\n";
		}

	}
	if($Dias_actuales > 26 && $Dias_actuales <=34){
		$sql2="select nom_afe, eat_afe from afeccion where to_tsvector(eat_afe)@@ to_tsquery('Crecimiento');"; 
		$result1=pg_query($conexion,$sql2);
		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." plantas está cerca a la etapa de crecimiento.\n\nEstas son algunas de las plagas o enfermedades que podrían aparecer:\n\n";
		while($see=pg_fetch_row($result1)){
			$notificacion.="".$see[0].",\n";
		}

	}
	if($Dias_actuales > 206 && $Dias_actuales <=214){
		$sql2="select nom_afe, eat_afe from afeccion where to_tsvector(eat_afe)@@ to_tsquery('Inicio floracion');"; 
		$result1=pg_query($conexion,$sql2);
		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." plantas está cerca a la etapa de inicio de floración.\n\nEstas son algunas de las plagas o enfermedades que podrían aparecer:\n\n";
		while($see=pg_fetch_row($result1)){
			$notificacion.="".$see[0].",\n";
		}

	}
	if($Dias_actuales > 236 && $Dias_actuales <=244){

		$sql2="select nom_afe, eat_afe from afeccion where to_tsvector(eat_afe)@@ to_tsquery('Maxima floracion');"; 
		$result1=pg_query($conexion,$sql2);
		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." plantas está cerca a la etapa de maxima floración.\n\nEstas son algunas de las plagas o enfermedades que podrían aparecer:\n\n";
		while($see=pg_fetch_row($result1)){
			$notificacion.="".$see[0].",\n";
		}

	}
	if($Dias_actuales > 296 && $Dias_actuales <=304){

		$sql2="select nom_afe, eat_afe from afeccion where to_tsvector(eat_afe)@@ to_tsquery('Fructificacion');"; 
		$result1=pg_query($conexion,$sql2);
		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." plantas está cerca a la etapa de inicio de fructificación.\n\n Estas son algunas de las plagas o enfermedades que podrían aparecer:\n\n";
		while($see=pg_fetch_row($result1)){

			$notificacion.="".$see[0].",\n";
		}
	}
	if($Dias_actuales > 361 && $Dias_actuales <=369){


		$sql2="select nom_afe, eat_afe from afeccion where to_tsvector(eat_afe)@@ to_tsquery('Cosecha');"; 
		$result1=pg_query($conexion,$sql2);
		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." plantas está iniciando producción.\n\nEstas son algunas de las plagas o enfermedades que podrían aparecer:\n\n";
		while($see=pg_fetch_row($result1)){

			$notificacion = $notificacion."".$see[0].",\n";
		}
		
	}
	$notificacion = $notificacion."||";

}

echo $notificacion;
?>