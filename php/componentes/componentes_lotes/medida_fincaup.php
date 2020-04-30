<?php 
//Este php obtiene los datos de la finca con el codigo del contador 
require '../../conexion.php';
$cod_fin=$_POST['cod_fin'];
$cod_lot=$_POST['cod_lot'];

/*Obtener el area del lote actual */

$query="SELECT lotes.med_lot,unidad_de_medida.equ_med FROM lotes INNER JOIN unidad_de_medida 
ON unidad_de_medida.cod_unm=lotes.cod_unm  INNER JOIN fincas ON fincas.cod_fin=lotes.cod_fin 
WHERE fincas.cnt_fin='$cod_fin' and lotes.cod_lot='$cod_lot' ";
$result =pg_query($conexion,$query);
$ver=pg_fetch_row($result);
$area_lote=(($ver[0]*$ver[1]));
/*Obtener el area de la finca*/
$query="SELECT med_fin,unidad_de_medida.equ_med FROM fincas INNER JOIN  unidad_de_medida 
ON fincas.cod_unm=unidad_de_medida.cod_unm WHERE fincas.cnt_fin='$cod_fin'";
$result =pg_query($conexion,$query);
$ver=pg_fetch_row($result);
$area_fin=(($ver[0]*$ver[1])+$area_lote);

/*Obtener el area de los lotes */

$query="SELECT lotes.med_lot,unidad_de_medida.equ_med FROM lotes INNER JOIN unidad_de_medida 
ON unidad_de_medida.cod_unm=lotes.cod_unm  INNER JOIN fincas ON fincas.cod_fin=lotes.cod_fin WHERE fincas.cnt_fin='$cod_fin'";
$result =pg_query($conexion,$query);
$area_lot=0;
while($ver=pg_fetch_row($result)){
$area_lot=($area_lot+($ver[0]*$ver[1]));
}
$area_free=($area_fin-$area_lot);
echo $area_free;
?>
