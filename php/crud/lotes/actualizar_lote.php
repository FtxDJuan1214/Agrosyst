<?php 
	require_once '../../conexion.php'; 

     $cod_lot=$_POST['cod_lot'];
	 $nom_lot = ucwords(strtolower($_POST['nom_lotup']));
	 $cod_fin = $_POST['nom_finup'];

	 $sql1=" SELECT cod_fin FROM fincas where cnt_fin=$cod_fin";
	 $r =pg_query($conexion,$sql1);
	 $ver=pg_fetch_row($r);
	 $cod_fin=$ver[0];
	 $cod_unm = $_POST['uni_med_up'];
	 $med_lot = $_POST['med_lotup'];
	 $sql="UPDATE public.lotes
	SET nom_lot='$nom_lot',cod_fin='$cod_fin', cod_unm='$cod_unm', med_lot='$med_lot'
	WHERE  cod_lot='$cod_lot'";
	  echo $result=pg_query($conexion,$sql);
?>