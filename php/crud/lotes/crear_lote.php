<?php 
	require_once '../../conexion.php';     
	 $nom_lot = ucwords(strtolower($_POST['nomb_lote']));
	 $cod_fin = $_POST['NFinca'];
	 $cod_unm = $_POST['UniMedida'];
	 $med_lot = $_POST['medi_lote'];
	 $sql="INSERT INTO public.lotes(
		nom_lot, cod_fin, cod_unm, med_lot)
		VALUES ('$nom_lot', '$cod_fin', '$cod_unm', '$med_lot')";
	  echo $result=pg_query($conexion,$sql);
?>