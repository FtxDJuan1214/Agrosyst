<?php 
require_once '../../conexion.php';     
$cod_cul= $_POST['cod_cul'];

$consulta1= "SELECT DISTINCT cultivos.cod_cul,convenio.cod_con, terceros.ide_ter, nombre_cultivo.des_ncu, lotes.nom_lot,cultivos.npl_cul
FROM public.fincas, public.lotes, public.cultivos, public.nombre_cultivo, public.ejecutar, 
public.convenio, public.act_con, public.terceros, public.act_cul
WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot
AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND cultivos.cod_cul=ejecutar.cod_cul 
AND convenio.cod_con=ejecutar.cod_con and act_con.cod_con = convenio.cod_con 
AND act_con.ide_ter = terceros.ide_ter and act_cul.ide_ter = act_con.ide_ter and cultivos.cod_cul= '$cod_cul' ";

$result1=pg_query($conexion,$consulta1);
$filas1=pg_num_rows($result1);
if($filas1 > 0 ){
	echo " \n\nEste cultivo no se puede eliminar
	porque tiene convenios registrados.";
}

$consulta2= "SELECT * FROM public.produccion WHERE  cod_cul='$cod_cul'";
$result2=pg_query($conexion,$consulta2);
$filas2=pg_num_rows($result2);
if($filas2 > 0 ){
	echo " \n\nEste cultivo no se puede eliminar
	porque tiene producciones";
}

?>