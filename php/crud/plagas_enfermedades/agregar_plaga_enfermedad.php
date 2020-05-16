<?php 
require_once '../../conexion.php';
session_start();
$user =  $_SESSION['idusuario'];
	
$pla_o_enf=$_POST['pla_o_enf'];
$nom_afe=$_POST['nom_afe'];
$nomc_afe = $_POST['nomc_afe'];
$horario = $_POST['horario'];
$epoca_a = $_POST['epoca_a'];
$etapas_f = $_POST['etapas_f'];
$partes_f = $_POST['partes_f'];
$sintomas_f = $_POST['sintomas_f'];
$metodos_f = $_POST['metodos_f'];


    $getc="SELECT cod_afe FROM afeccion WHERE (cod_afe LIKE '$user%')
    order by regexp_split_to_array(cod_afe, E'\\-')::integer[]
    DESC LIMIT 1";

    $result =pg_query($conexion,$getc);
    $cod =pg_fetch_row($result);
    $sep = explode("-", $cod[0]);
    
<<<<<<< HEAD
    $cod_afe = $sep[1]+1;
=======
         $cod_afe = $sep[1]+1;
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
    
        $add ="INSERT INTO public.afeccion(
        cod_afe, nom_afe, noc_afe, epo_afe, prv_afe, eat_afe, hat_afe)
        VALUES ('$user$cod_afe', '$nom_afe', '$nomc_afe', '$epoca_a', '$metodos_f', '$etapas_f', '$horario');";

        echo $result = pg_query($conexion,$add);
  
    
    $sepa = explode("-", $partes_f);
    $contar=count($sepa);
    for($i=1;$i<$contar;$i++){

      $adde ="INSERT INTO public.partes_planta_afe(
        cod_afe, det_par)
        VALUES ('$user$cod_afe', '$sepa[$i]')";

      echo $result = pg_query($conexion,$adde);
    }
    
      


?>