<?php 
session_start();
require_once '../../conexion.php'; 
$num_fact=$_POST['num_fact'];
$fec_con=$_POST['fec_con'];
$cos_tot=$_POST['cos_tot'];
$comprador=$_POST['comprador'];

//Crear compras *******************************************************************************************

$sqy="SELECT cod_com FROM public.compras ORDER BY cod_com DESC LIMIT 1";
$resy=pg_query($conexion,$sqy);
$very=pg_fetch_row($resy);


$cod_com= 1;
if (pg_num_rows($resy) != 0) {
	$cod_com=$very[0] + 1;
}

$sqlo="INSERT INTO public.compras( cod_com, fec_com, tot_com)
	VALUES ('$cod_com', '$fec_con', '$cos_tot')";
echo "Crear compras: ".$result=pg_query($conexion,$sqlo)."Cod com: ". $cod_com ."\n";


//Crear comprar *******************************************************************************************
$sql1="INSERT INTO public.comprar(
	cod_com, ide_ter)
	VALUES ('$cod_com', '$comprador');";
echo "Crear comprar: ".$result=pg_query($conexion,$sql1)." \n";


//Llenar Stock ********************************************************************************************

$insumo=$_POST['insumo'];
$cantiad=$_POST['cantiad'];
$fec_con=$_POST['fec_con']."/".$_POST['hor_com'];
$precio=$_POST['precio'];
$socio=$_POST['socio'];


$sqlk="SELECT cod_sto FROM stock ORDER BY cod_sto DESC LIMIT 1";
$resk=pg_query($conexion,$sqlk);
$verk=pg_fetch_row($resk);


$cod_sto= 1;
if (pg_num_rows($resk) != 0) {
	$cod_sto=$verk[0] + 1;
}

$sql1="INSERT INTO public.stock(cod_sto, can_sto, cod_ins) VALUES ('$cod_sto','1','$insumo')"; 

echo "Crear stock: ".$result=pg_query($conexion,$sql1)." \n";

// insertar precio del stock *****************************************************************************

$sqll="SELECT cod_pre FROM pre_sto ORDER BY cod_pre DESC LIMIT 1";
$resl=pg_query($conexion,$sqll);
$verl=pg_fetch_row($resl);

$cod_pre= 1;
if (pg_num_rows($resl) != 0) {
	$cod_pre=$verl[0] + 2;
}


$sqx="INSERT INTO public.pre_sto(fec_cin, cod_sto, pre_sto, cod_pre) VALUES ('$fec_con', '$cod_sto', '$precio', '$cod_pre')";	
echo "Precio del stock (".$cod_pre."): ".$result=pg_query($conexion,$sqx)."\n";

//Registrara el producto del stock en la compra **********************************************************
$sql3="INSERT INTO public.registrar(cod_com, cod_sto) VALUES ('$cod_com', '$cod_sto')"; 
echo "Registrar la compra: ".$result=pg_query($conexion,$sql3)."\n";


//  insertar precio del stock ****************************************************************************
$cod_tar=$_POST['tarea'];
$nuevotot = $_POST['ntotal'];

$sqll="SELECT cod_uti FROM utilizar ORDER BY cod_uti DESC LIMIT 1";
$resl=pg_query($conexion,$sqll);
$verl=pg_fetch_row($resl);
$cod_uti=$verl[0] + 2;

$cod_uti= 1;
if (pg_num_rows($resl) != 0) {
	$cod_uti=$verl[0] + 2;
}

$sql="INSERT INTO public.utilizar(
cod_sto, cod_tar, cin_tar, pin_tar, cod_uti)
VALUES ('$cod_sto', '$cod_tar', '1','$precio', '$cod_uti')";

echo  "Registrar el uso en la tarea: ".$result=pg_query($conexion,$sql)."\n";

$sqy="UPDATE public.stock
SET can_sto='0'
WHERE cod_sto='$cod_sto';";
echo "Actualizar el stock: ".$resultt=pg_query($conexion,$sqy)."\n";

$sql1="UPDATE public.tarea
SET val_tar='$nuevotot'
WHERE cod_tar='$cod_tar'";
$result=pg_query($conexion,$sql1);

?>


