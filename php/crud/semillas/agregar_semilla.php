<?php 
require_once '../../conexion.php';	
session_start();
$user =  $_SESSION['idusuario'];
$sql1="SELECT cod_ins FROM insumos ORDER BY cod_ins DESC LIMIT 1";
$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);

     $cod_ins = $cod[0];
     $cod_tsa = $_POST['cod_tsa'];
     $det_sem = ucwords(strtolower($_POST['det_sem']));

  $sql ="INSERT INTO semillas(
	cod_ins, cod_tsa, det_sem)
	VALUES ('$cod_ins', '$cod_tsa', '$user$det_sem')";

  echo $result = pg_query($conexion,$sql);
?>

