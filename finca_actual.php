<?php
session_start();
if (isset($_SESSION['usuario'])) { 
}else{
  header('location:login.php');
}
if (isset($_POST['btnLogA'])) {
  $codigo= $_POST["prueba"];
  $_SESSION['ide_finca']=$codigo;
  require 'php/conexion.php';
  $sql1="SELECT cnt_fin FROM fincas where cod_fin='$codigo'";
  $result=pg_query($conexion,$sql1);
  $cod=pg_fetch_row($result);
  $_SESSION['cod_finca']=$cod[0];

}else{
  require 'php/conexion.php';
  $sql1="SELECT cod_fin,cnt_fin FROM fincas ORDER BY cnt_fin DESC LIMIT 1";
  $result=pg_query($conexion,$sql1);
  $cod=pg_fetch_row($result);
  $_SESSION['ide_finca']=$cod[0];

   $_SESSION['cod_finca']=$cod[1];
} 
header('location:home.php');
?>
