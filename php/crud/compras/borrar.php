<?php 
session_start();
require_once '../../conexion.php'; 
$arreglo=$_POST['arreglo'];
$num_fact=$_POST['num_fact'];
$fec_con=$_POST['fec_con']."/".$_POST['hor_com'];

// $arreglo="1,20,10,12000,120000$+1,23,12,1000,12000$+4,24,3,3000,9000$+";
// $num_fact="1";
// $fec_con="2019-06-22/15 : 23 : 34";

$array=explode("+",$arreglo);

foreach ($array as $imp ) {
	echo "((".$imp;

	$arr=explode(",",$imp);
	$tamaño=count($arr);

			// echo "[".$arr[2]."][".$arr[1]."][".$arr[3]."]))";
				$cantiad=intval($arr[2]);
				$insumo=intval($arr[1]);
				$precio=intval($arr[3]);
				$finca=$_SESSION['ide_finca'];

				echo "[".$cantiad."][".$insumo."][".$precio."]))";
				echo $finca;
				// //insertar el stock
				$sql1="INSERT INTO public.stock(can_sto, cod_ins, cod_fin) VALUES ('$cantiad','$insumo', '$finca')"; 
				echo "Stock ".$result=pg_query($conexion,$sql1);

				// // insertar precio del stock
				$sql1="SELECT cod_sto FROM stock ORDER BY cod_sto DESC LIMIT 1";
				$res=pg_query($conexion,$sql1);
				$ver=pg_fetch_row($res);
				$cod=$ver[0];
				echo "codigo del stock = (".$cod.")";
				// if ($cod==0) {
				//  echo "El codigo es 0";
				// }else{
				$sqx="INSERT INTO public.pre_sto(fec_cin, cod_sto, pre_sto) VALUES ('$fec_con', '$cod', '$precio')";	
				echo "Stock ".$result=pg_query($conexion,$sqx);
				// }

			 //    //Registrara el producto del stock en la compra
				$sql3="INSERT INTO public.registar(cod_com, cod_sto) VALUES ('$num_fact', '$cod')"; 
				echo "Registro ".$result=pg_query($conexion,$sql3);
		
}
?>
