<?php 
require '../../conexion.php';
$cod_fin=$_POST['cod_fin'];
/*Obtener el area de la finca*/
$query="SELECT med_fin,unidad_de_medida.equ_med FROM fincas INNER JOIN  unidad_de_medida 
ON fincas.cod_unm=unidad_de_medida.cod_unm WHERE cnt_fin='$cod_fin'";
$result =pg_query($conexion,$query);
$ver=pg_fetch_row($result);
$area_fin=($ver[0]*$ver[1]);
$medida=$_POST['medida'];
$fan=$medida/6400;

$porcentaje=(($medida*100)/$area_fin);

if ($porcentaje >= 60) {
	$cadena="<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <span class='alert-text'><strong><i class='fas fa-info-circle white-text'></i>"." "."La finca dispone de ".$medida."M² / ".$fan." Fanegadas</strong></span>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
        </button>
        </div>";
}elseif ($porcentaje >= 30 and $porcentaje < 60) {
	$cadena="<div class='alert alert-amarillo alert-dismissible fade show' role='alert'>
        <span class='alert-text'><strong><i class='fas fa-info-circle white-text'></i>"." "."La finca dispone de ".$medida."M² / ".$fan." Fanegadas</strong></span>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
        </button>
        </div>";
}elseif ($porcentaje < 30) {
	$cadena="<div class='alert alert-danger  alert-dismissible fade show' role='alert'>
        <span class='alert-text'><strong><i class='fas fa-info-circle white-text'></i>"." "."La finca dispone de ".$medida."M² / ".$fan." Fanegadas </strong></span>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
        </button>
        </div>";
}

echo $cadena;
?>
