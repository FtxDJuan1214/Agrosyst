<?php 
require_once '../../conexion.php';		
$ide_ter = $_POST['ide_ter'];
$tipo_per = $_POST['global'];

if($tipo_per==1){
     $sql ="DELETE FROM public.dueño
    WHERE ide_ter='$ide_ter'";
    echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==2){
     $sql="DELETE FROM public.socio
    WHERE ide_ter='$ide_ter'";
    echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==3){
     $sql="DELETE FROM public.trabajador
    WHERE ide_ter='$ide_ter'";
    echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==4){
     $sql="DELETE FROM public.proveedor
    WHERE ide_ter='$ide_ter'";
    echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==5){
     $sql="DELETE FROM public.cliente
    WHERE ide_ter='$ide_ter'";
    echo $result = pg_query($conexion,$sql);

}
echo 'ide='.$ide_ter.'tipo='.$tipo_per;
?>

