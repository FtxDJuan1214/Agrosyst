<?php 
	require_once '../../conexion.php';     
	 $des_tar = $_POST['des_tar'];
	 $fin_tar = $_POST['fin_tar'];
	 $fif_tar = $_POST['fif_tar'];
	 $val_tar = $_POST['val_tar'];
	 $sql="INSERT INTO public.tarea(
	fin_tar, ffi_tar, des_tar , val_tar)
	VALUES ('$fin_tar', '$fif_tar', '$des_tar' , '$val_tar');";
	  echo $result=pg_query($conexion,$sql);
?>