<?php 
require '../../conexion.php';
$tip_ins=$_POST['tip_ins'];
session_start();
$like = $_SESSION['idusuario'];

if($tip_ins == "1"){

	$query="SELECT insumos.cod_ins,des_ins,des_unm,det_fer from public.insumos 
	INNER JOIN fertilizantes ON insumos.cod_ins=fertilizantes.cod_ins
	INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm WHERE det_fer LIKE '$like%' or det_fer LIKE '1-%'";
	$result =pg_query($conexion,$query);

	$cadena="<select id='cod_ins' name='cod_ins' class='form-control' data-live-search='true'>
	<option value='' disabled selected>Seleccion de Semilla</option>";
	while ($ver=pg_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).' / '.($ver[2]).'</option>';
	}

	echo $cadena.'</select>';
}


else if($tip_ins == "2"){

	$query="SELECT insumos.cod_ins,des_ins,des_unm,det_smr  from public.insumos 
	INNER JOIN semillero ON insumos.cod_ins=semillero.cod_ins
	INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm WHERE det_smr LIKE '$like%' or det_smr LIKE '1-%'";
	$result =pg_query($conexion,$query);

	$cadena="<select id='cod_ins' name='cod_ins' class='form-control' data-live-search='true'>
	<option value='' disabled selected>Seleccion de Semillero</option>";
	while ($ver=pg_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).' / '.($ver[2]).'</option>';
	}

	echo $cadena.'</select>';
}

else if($tip_ins == "3"){

	$query="SELECT insumos.cod_ins,des_ins,des_unm  from public.insumos 
	INNER JOIN agroquimicos ON insumos.cod_ins=agroquimicos.cod_ins
	INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm";
	$result =pg_query($conexion,$query);

	$cadena="<select id='cod_ins' name='cod_ins' class='form-control' data-live-search='true'>
	<option value='' disabled selected>Seleccion de Agroquímico/Fertilizante</option>";
	while ($ver=pg_fetch_row($result)) {
		if($ver[0] != "7"){
			$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).' / '.($ver[2]).'</option>';
		}
	}

	echo $cadena.'</select>';
}

else if($tip_ins == "4"){

	$query="SELECT insumos.cod_ins,des_ins,des_unm,des_otr from public.insumos 
	INNER JOIN otros ON insumos.cod_ins=otros.cod_ins
	INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm WHERE des_otr LIKE '$like%' or des_otr LIKE '1-%'";
	$result =pg_query($conexion,$query);

	$cadena="<select id='cod_ins' name='cod_ins' class='form-control' data-live-search='true'>
	<option value='' disabled selected>Seleccion de Otro insumo</option>";
	while ($ver=pg_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).' / '.($ver[2]).'</option>';
	}

	echo $cadena.'</select>';
}


?>
