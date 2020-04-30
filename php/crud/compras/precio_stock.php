<?php 
session_start();
require_once '../../conexion.php'; 
$fec_con=$_POST['fec_con']."/".$_POST['hor_com'];
$precio=$_POST['precio'];
$num_fact=$_POST['num_fact'];

				// // insertar precio del stock
				$sql1="SELECT cod_sto FROM stock ORDER BY cod_sto DESC LIMIT 1";
				$res=pg_query($conexion,$sql1);
				$ver=pg_fetch_row($res);
				$cod=$ver[0];
				echo "codigo del stock = (".$cod.")";

				$sqx="INSERT INTO public.pre_sto(fec_cin, cod_sto, pre_sto) VALUES ('$fec_con', '$cod', '$precio')";	
				echo "Stock $".$result=pg_query($conexion,$sqx);

			 //    //Registrara el producto del stock en la compra
				$sql3="INSERT INTO public.registrar(cod_com, cod_sto) VALUES ('$num_fact', '$cod')"; 
				echo "Registro ".$result=pg_query($conexion,$sql3);
?>