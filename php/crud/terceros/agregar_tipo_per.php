<?php 
require_once '../../conexion.php';		
     $ide_ter = $_POST['ide_ter'];
     $tipo_per = $_POST['tipo_per'];

     if($tipo_per==1){
     	$sql ="INSERT INTO public.dueño(
				ide_ter)
		VALUES ('$ide_ter')";
  		echo $result = pg_query($conexion,$sql);

     }else if ($tipo_per==2){
     	$sql="INSERT INTO public.socio(ide_ter)
		VALUES ('$ide_ter')";
		echo $result = pg_query($conexion,$sql);

     }else if ($tipo_per==3){
     	$sql="INSERT INTO public.trabajador(ide_ter)
		VALUES ('$ide_ter')";
		echo $result = pg_query($conexion,$sql);
		
     }else if ($tipo_per==4){
     	$sql="INSERT INTO public.proveedor(
	 		ide_ter)
		VALUES ('$ide_ter');";
		echo $result = pg_query($conexion,$sql);
		
     }else if ($tipo_per==5){
          $sql="INSERT INTO public.cliente(
               ide_ter)
          VALUES ('$ide_ter');";
          echo $result = pg_query($conexion,$sql);
          
     }
