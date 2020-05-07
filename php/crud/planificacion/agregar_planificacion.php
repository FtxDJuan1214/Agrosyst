<?php 
require_once '../../conexion.php';     

$num_pla = $_POST['num_pla'];
$det_pla = $_POST['det_pla'];
$epoca = $_POST['epoca'];
$fecha = $_POST['fecha'];
$info = $_POST['info'];

$planes = explode("||", $info);
$contarPlanes=count($planes) - 1;

$enfermedad = "";
$tipo = "";


for($i = 0; $i < $contarPlanes; $i++){

	$subplan = $num_pla+$i;
   	$sep =explode("/", $planes[$i]); //Uno: Codigo agroquimico - Dos:codigo enfermedad

	if($sep[2]=="Nutrición"){

		

	}else if($sep[2] == "Curación"){

		//Debo buscar si ya hay un proceso fitosanitario de la enfermedad en cuestión, 
		//si ya esta creado se agrega normal al proceso de lo contrario se crea uno nuevo

		$validar = "SELECT procesos_fitosanitarios.cod_pfi, procesos_fitosanitarios.cod_afe 
		FROM public.procesos_fitosanitarios, public.afeccion
		WHERE procesos_fitosanitarios.cod_afe = afeccion.cod_afe
		AND procesos_fitosanitarios.ffi_pfi is NULL
		AND procesos_fitosanitarios.tip_pfi = 'Curación'
		AND procesos_fitosanitarios.cod_afe ='$sep[1]'";
		$result =pg_query($conexion,$validar);
		$ver=pg_fetch_row($result);

		//Obtener el ultimo id del proceso
		$sqx="SELECT cod_pfi FROM procesos_fitosanitarios ORDER BY cod_pfi DESC LIMIT 1";
				$resp=pg_query($conexion,$sqx);
				$got=pg_fetch_row($resp);
				$cod_pfi=$got[0];


		if($ver == ""){

			//No hay proceso, se crea uno nuevo	
			$cod_pfi=$cod_pfi+1;
			$add = "INSERT INTO public.procesos_fitosanitarios(
				cod_pfi, fin_pfi, ffi_pfi, cod_afe, tip_pfi)
				VALUES ('$cod_pfi', '$fecha', null, '$sep[1]', 'Curación');";

			echo $result=pg_query($conexion,$add);

			//Despues la planeación se ingresa

			$add = "INSERT INTO public.planificacion(
				cod_pla, det_pla, fec_pla, epo_pla, cod_ppl, cod_pfi, agr_pla)
				VALUES ('$subplan', '$det_pla', '$fecha', '$epoca ', '$num_pla', '$cod_pfi', '$sep[3]')";

			echo $result=pg_query($conexion,$add);


		}else{	

			$add = "INSERT INTO public.planificacion(
				cod_pla, det_pla, fec_pla, epo_pla, cod_ppl, cod_pfi, agr_pla)
				VALUES ('$subplan', '$det_pla', '$fecha', '$epoca ', '$num_pla', '$ver[0]', '$sep[3]')";

				echo $result=pg_query($conexion,$add);
		}
		
		

	}else if($sep[2] == "Prevención"){

//Debo buscar si ya hay un proceso fitosanitario de la enfermedad en cuestión, 
		//si ya esta creado se agrega normal al proceso de lo contrario se crea uno nuevo

		$validar = "SELECT procesos_fitosanitarios.cod_pfi, procesos_fitosanitarios.cod_afe 
		FROM public.procesos_fitosanitarios, public.afeccion
		WHERE procesos_fitosanitarios.cod_afe = afeccion.cod_afe
		AND procesos_fitosanitarios.ffi_pfi is NULL
		AND procesos_fitosanitarios.tip_pfi = 'Prevención'
		AND procesos_fitosanitarios.cod_afe ='$sep[1]'";
		$result =pg_query($conexion,$validar);
		$ver=pg_fetch_row($result);

		//Obtener el ultimo id del proceso
		$sqx="SELECT cod_pfi FROM procesos_fitosanitarios ORDER BY cod_pfi DESC LIMIT 1";
				$resp=pg_query($conexion,$sqx);
				$got=pg_fetch_row($resp);
				$cod_pfi=$got[0];


		if($ver == ""){

			//No hay proceso, se crea uno nuevo	
			$cod_pfi=$cod_pfi+1;
			$add = "INSERT INTO public.procesos_fitosanitarios(
				cod_pfi, fin_pfi, ffi_pfi, cod_afe, tip_pfi)
				VALUES ('$cod_pfi', '$fecha', null, '$sep[1]', 'Prevención');";

			echo $result=pg_query($conexion,$add);
			//Despues la planeación se ingresa

			$add = "INSERT INTO public.planificacion(
				cod_pla, det_pla, fec_pla, epo_pla, cod_ppl, cod_pfi, agr_pla)
				VALUES ('$subplan', '$det_pla', '$fecha', '$epoca ', '$num_pla', '$cod_pfi', '$sep[3]')";

			echo $result=pg_query($conexion,$add);


		}else{	

			$add = "INSERT INTO public.planificacion(
				cod_pla, det_pla, fec_pla, epo_pla, cod_ppl, cod_pfi, agr_pla)
				VALUES ('$subplan', '$det_pla', '$fecha', '$epoca ', '$num_pla', '$ver[0]', '$sep[3]')";

				echo $result=pg_query($conexion,$add);
		}

	}
}
?>
