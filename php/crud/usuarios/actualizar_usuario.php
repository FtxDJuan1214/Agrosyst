<?php 
require_once '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$id = explode("-", $like)[0];
$new_con= $_POST['new_con'];


$consulta= "UPDATE public.usuario
	SET pas_usu='$new_con'
	WHERE id_usu='$id'";
echo $result=pg_query($conexion,$consulta);

?>