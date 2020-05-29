<?php 
require_once '../../conexion.php';


$usuario= $_POST['usu_usu'];
$contraseña= $_POST['con_usu'];

$consulta= "SELECT * FROM public.usuario WHERE  usu_usu='$usuario' and pas_usu='$contraseña'";
$result=pg_query($conexion,$consulta);
$filas=pg_num_rows($result);

if($filas>0){
	echo "1";
}else{
	echo "0";
}
?>