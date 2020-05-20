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

		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." está en etapa de inicio, te recomendamos aplicar abonos como gallinaza y opcionalmente cal, para darle a la planta la fuerza suficiente para sobrevivir.\n\n";

	}
	if($Dias_actuales > 53 && $Dias_actuales <=55 || $Dias_actuales > 58 && $Dias_actuales <=60){

			$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." está a punto de cumplir dos meses, este periodo es importante ya que tus plantas aún están creciendo. Te recomendamos aplicar abonos que las nutran.\n\n";
	}
	if($Dias_actuales > 143 && $Dias_actuales <=145 || $Dias_actuales > 148 && $Dias_actuales <=150){
		
		$notificacion .="Tu cultivo está a punto de cumplir cinco meses, este periodo es importante. Te recomendamos aplicar abonos que nutran las plantas.\n\n";

	}
	if($Dias_actuales > 238 && $Dias_actuales <= 242){

		$notificacion .="Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." está en etapas de floración, este periodo es muy importante para tener una buena producción. Te recomendamos aplicar abonos que nutran las plantas.\n\n";
	}
	if($Dias_actuales > 350 && $Dias_actuales <=365){

		$notificacion .="¡Felicidades! Tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4]." está cerca de cumplir un año, pronto empezará su etapa de producción. Te recomendamos aplicar abonos que nutran las plantas.\n\n";
	}

	//Después de del año

	if($Dias_actuales > 455 && $Dias_actuales <= 358){

		$notificacion .="Es hora de aplicar nutrientes en tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4].", te recomendamos abonarlo\n\n";
	}

	if($Dias_actuales > 545 && $Dias_actuales <= 548){

		$notificacion .="Es hora de aplicar nutrientes en tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4].", te recomendamos abonarlo\n\n";
	}

	if($Dias_actuales > 635 && $Dias_actuales <= 638){

		$notificacion .="Es hora de aplicar nutrientes en tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4].", te recomendamos abonarlo\n\n";
	}

	if($Dias_actuales > 725 && $Dias_actuales <= 728){

		$notificacion .="Es hora de aplicar nutrientes en tu cultivo ".explode("-",$ver[9])[1]." con ".$ver[4].", te recomendamos abonarlo\n\n";
	}

	$notificacion = $notificacion."||";

}

echo $notificacion;
?>