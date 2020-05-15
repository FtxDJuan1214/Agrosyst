<?php 
require_once '../../conexion.php';		
$ide_ter = $_POST['ide_ter'];
$tipo_per = $_POST['tipo_per'];

if($tipo_per==1){

 $sqx="SELECT cod_due FROM public.duenio ORDER BY cod_due DESC LIMIT 1";
 $res=pg_query($conexion,$sqx);
 $ver=pg_fetch_row($res);
 $cod_due= 1;
 if (pg_num_rows($res) != 0) {
   $cod_due=$ver[0] + 1;

 }


 $sql ="INSERT INTO public.duenio(cod_due,ide_ter)
 VALUES ('$cod_due','$ide_ter')";
 $result = pg_query($conexion,$sql);

 echo $sql;

}else if ($tipo_per==2){

  $sqx="SELECT cod_soc FROM public.socio ORDER BY cod_soc DESC LIMIT 1";
  $res=pg_query($conexion,$sqx);
  $ver=pg_fetch_row($res);


  $cod_soc= 1;
  if (pg_num_rows($res) != 0) {
    $cod_soc=$ver[0] + 1;
  }

  $sql="INSERT INTO public.socio(cod_soc,ide_ter)
  VALUES ('$cod_soc','$ide_ter')";
  echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==3){

 $sqx="SELECT cod_tra FROM public.trabajador ORDER BY cod_tra DESC LIMIT 1";
 $res=pg_query($conexion,$sqx);
 $ver=pg_fetch_row($res);


 $cod_tra= 1;
 if (pg_num_rows($res) != 0) {
  $cod_tra=$ver[0] + 1;
}

$sql="INSERT INTO public.trabajador(cod_tra,ide_ter)
VALUES ('$cod_tra','$ide_ter')";
echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==4){

  $sqx="SELECT cod_pro FROM public.proveedor ORDER BY cod_pro DESC LIMIT 1";
  $res=pg_query($conexion,$sqx);
  $ver=pg_fetch_row($res);
  
  $cod_pro= 1;
  if (pg_num_rows($res) != 0) {
   $cod_pro=$ver[0] + 1;
 }

 $sql="INSERT INTO public.proveedor(cod_pro,ide_ter)
 VALUES ('$cod_pro','$ide_ter');";
 echo $result = pg_query($conexion,$sql);

}else if ($tipo_per==5){

  $sqx="SELECT cod_cli FROM public.cliente ORDER BY cod_cli DESC LIMIT 1";
  $res=pg_query($conexion,$sqx);
  $ver=pg_fetch_row($res);


  $cod_cli= 1;
  if (pg_num_rows($res) != 0) {
   $cod_cli=$ver[0] + 1;
 }
 
 $sql="INSERT INTO public.cliente(cod_cli,ide_ter)
 VALUES ('$cod_cli','$ide_ter');";
 echo $result = pg_query($conexion,$sql);

}