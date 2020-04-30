<?php 
session_start();
require_once '../../conexion.php'; 
$num_fact=$_POST['num_fact'];
$fec_con=$_POST['fec_con'];
$cos_tot=$_POST['cos_tot'];
$comprador=$_POST['comprador'];

//Crear compras *******************************************************************************************
$sql1="INSERT INTO public.compras(
cod_com, fec_com, tot_com)
VALUES ('$num_fact', '$fec_con', '$cos_tot')";
echo "Crear compras: ".$result=pg_query($conexion,$sql1)." \n";


//Crear comprar *******************************************************************************************
$sql1="INSERT INTO public.comprar(
cod_com, ide_ter)
VALUES ('$num_fact', '$comprador');";
echo "Crear comprar: ".$result=pg_query($conexion,$sql1)." \n";


//Llenar Stock ********************************************************************************************

$insumo=$_POST['insumo'];
$cantiad=$_POST['cantiad'];
$fec_con=$_POST['fec_con']."/".$_POST['hor_com'];
$precio=$_POST['precio'];
$socio=$_POST['socio'];

$sql1="INSERT INTO public.stock(can_sto, cod_ins) VALUES ('1','$insumo')"; 

echo "Crear stock: ".$result=pg_query($conexion,$sql1)." \n";

// insertar precio del stock *****************************************************************************

$sql1="SELECT cod_sto FROM stock ORDER BY cod_sto DESC LIMIT 1";
$res=pg_query($conexion,$sql1);
$ver=pg_fetch_row($res);
$cod=$ver[0];


$sqx="INSERT INTO public.pre_sto(fec_cin, cod_sto, pre_sto) VALUES ('$fec_con', '$cod', '$precio')";	
echo "Precio del stock (".$cod."): ".$result=pg_query($conexion,$sqx)."\n";

//Registrara el producto del stock en la compra **********************************************************
$sql3="INSERT INTO public.registrar(cod_com, cod_sto) VALUES ('$num_fact', '$cod')"; 
echo "Registrar la compra: ".$result=pg_query($conexion,$sql3)."\n";


//  insertar precio del stock ****************************************************************************
$cod_tar=$_POST['tarea'];
$nuevotot = $_POST['ntotal'];
$cod_sto=$cod;

$sql="INSERT INTO public.utilizar(
cod_sto, cod_tar, cin_tar, pin_tar)
VALUES ('$cod_sto', '$cod_tar', '1','$precio')";

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