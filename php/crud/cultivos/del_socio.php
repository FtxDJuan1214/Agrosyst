<?php 
require_once '../../conexion.php';     
$ide_ter= $_POST['ide_ter'];
$cod_cul= $_POST['cod_cul'];

	//confirmar que el socio se puede eliminar

$squerya = "SELECT cultivos.cod_cul,convenio.cod_con, terceros.ide_ter, nombre_cultivo.des_ncu, lotes.nom_lot,cultivos.npl_cul
FROM public.fincas, public.lotes, public.cultivos, public.nombre_cultivo, public.ejecutar, 
public.convenio, public.act_con, public.terceros
WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot
AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND cultivos.cod_cul=ejecutar.cod_cul 
AND convenio.cod_con=ejecutar.cod_con AND act_con.cod_con = convenio.cod_con 
AND act_con.ide_ter = terceros.ide_ter AND cultivos.cod_cul= '$cod_cul' AND terceros.ide_ter='$ide_ter'";

$result2=pg_query($conexion,$squerya);
$filas=pg_num_rows($result2);
if($filas > 0 ){
	echo " \nEste socio no se puede eliminar
	porque está registrado en convenios.";

}else{

	$sql="DELETE FROM public.act_cul
	WHERE ide_ter='$ide_ter' AND cod_cul='$cod_cul'";
	echo $result=pg_query($conexion,$sql);
}
?>