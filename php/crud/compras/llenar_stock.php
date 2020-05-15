<?php 
session_start();
require_once '../../conexion.php'; 

$insumo=$_POST['insumo'];
$cantiad=$_POST['cantiad'];


$fec_con=$_POST['fec_con']."/".$_POST['hor_com'];
$precio=$_POST['precio'];
$num_fact=$_POST['num_fact'];
$socio=$_POST['socio'];

$sqj="SELECT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
unidad_de_medida.des_unm,terceros.ide_ter, 
terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
FROM insumos, stock, registrar, compras, comprar, terceros, unidad_de_medida, cultivos, act_cul
WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
AND comprar.ide_ter=terceros.ide_ter AND unidad_de_medida.cod_unm=insumos.cod_unm 
AND terceros.ide_ter=act_cul.ide_ter AND act_cul.cod_cul=cultivos.cod_cul 
AND  terceros.ide_ter = '$socio' AND insumos.cod_ins = '$insumo'";
$r=pg_query($conexion,$sqj);
$see=pg_fetch_row($r);
$suma=intval(($see[1])+($cantiad));

if ($see[2] == $insumo && $see[5]==$socio) {
echo "Existente";
	$sql1="UPDATE public.stock SET can_sto='$suma', cod_ins='$see[2]' WHERE cod_sto='$see[0]'"; 
    echo $result=pg_query($conexion,$sql1);	
	
				$cod=$see[0];
				echo "codigo del stock = (".$cod.")";
				
				$sql2="SELECT cod_pre FROM pre_sto ORDER BY cod_pre DESC LIMIT 1";
				$res2=pg_query($conexion,$sql2);
				$ver2=pg_fetch_row($res2);

				$cod_pre= 1;
				if (pg_num_rows($res2) != 0) {
					$cod_pre=$ver2[0] + 2;
				}
				
				
				$sqx="INSERT INTO public.pre_sto(fec_cin, cod_sto, pre_sto, cod_pre) VALUES ('$fec_con', '$cod', '$precio', '$cod_pre')";	
				echo "Stock $".$result=pg_query($conexion,$sqx);

			 //    //Registrara el producto del stock en la compra
				$sql3="INSERT INTO public.registrar(cod_com, cod_sto) VALUES ('$num_fact', '$cod')"; 
				echo "Registro ".$result=pg_query($conexion,$sql3);

}else{
echo "Nuevo\n";

$sqlx="SELECT cod_sto FROM stock ORDER BY cod_sto DESC LIMIT 1";
				$resx=pg_query($conexion,$sqlx);
				$verx=pg_fetch_row($resx);
				
				$cod=1;
				if (pg_num_rows($resx) != 0) {
					$cod=$verx[0] + 1;
				}
				
$sql1="INSERT INTO public.stock(cod_sto, can_sto, cod_ins) VALUES ('$cod','$cantiad','$insumo')"; 
echo "ins sto".$result=pg_query($conexion,$sql1);


// // insertar precio del stock
				echo "codigo del stock = (".$cod.")";
				
				$sql2="SELECT cod_pre FROM pre_sto ORDER BY cod_pre DESC LIMIT 1";
				$res2=pg_query($conexion,$sql2);
				$ver2=pg_fetch_row($res2);
				$cod_pre= 1;
				if (pg_num_rows($res2) != 0) {
					$cod_pre=$ver2[0] + 2;
				}

				$sqx="INSERT INTO public.pre_sto(fec_cin, cod_sto, pre_sto, cod_pre) VALUES ('$fec_con', '$cod', '$precio', '$cod_pre')";	
				echo " precio Stock $".$result=pg_query($conexion,$sqx);

			 //    //Registrara el producto del stock en la compra
				$sql3="INSERT INTO public.registrar(cod_com, cod_sto) VALUES ('$num_fact', '$cod')"; 
				echo " Registro ".$result=pg_query($conexion,$sql3);

}
?>