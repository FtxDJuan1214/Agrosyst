<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];


$cod_afe =$_POST['cod_afe'];
$cod_cul =$_POST['cod_cul'];
$cod_sto =$_POST['cod_sto'];

//echo 'stock cod '.$cod_sto."\n";
//Todas las tareas realizadas de la afeccion ordenadas por fecha DEL CULTIVO ESCOGIDO
$query="SELECT DISTINCT tarea.cod_tar, tarea.des_tar, tarea.fin_tar, tarea.ffi_tar, afeccion.nom_afe from tarea
INNER JOIN fitosanitaria ON fitosanitaria.cod_tar = tarea.cod_tar
INNER JOIN utilizar ON utilizar.cod_tar = tarea.cod_tar
INNER JOIN stock ON stock.cod_sto = utilizar.cod_sto
INNER JOIN insumos on insumos.cod_ins = stock.cod_ins
INNER JOIN agroquimicos ON agroquimicos.cod_ins = insumos.cod_ins
INNER JOIN planificacion on planificacion.cod_pla = fitosanitaria.cod_pla
INNER JOIN procesos_fitosanitarios on procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
INNER JOIN labores ON tarea.cod_lab = labores.cod_lab
INNER JOIN efectuar ON efectuar.cod_tar=tarea.cod_tar
INNER JOIN convenio ON convenio.cod_con=efectuar.cod_con
INNER JOIN ejecutar ON ejecutar.cod_con=convenio.cod_con
INNER JOIN cultivos ON cultivos.cod_cul=ejecutar.cod_cul
AND afeccion.cod_afe = '$cod_afe'
AND cultivos.cod_cul = '$cod_cul'
ORDER BY tarea.fin_tar DESC";

$result=pg_query($conexion,$query);
$contar = array();
while ($ver=pg_fetch_row($result)) {

    //echo ' -tarea '.$ver[0]."\n";

   //contar incidencia de uso
   $con ="SELECT tarea.cod_tar,utilizar.cod_sto, stock.cod_ins, insumos.des_ins, agroquimicos.nom_agr
   FROM fitosanitaria 
   INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
   INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
   INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
   INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
   INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
   INNER JOIN utilizar ON utilizar.cod_tar = tarea.cod_tar
   INNER JOIN stock ON utilizar.cod_sto = stock.cod_sto
   INNER JOIN insumos ON insumos.cod_ins = stock.cod_ins
   INNER JOIN agroquimicos ON insumos.cod_ins = agroquimicos.cod_ins
   WHERE utilizar.cod_sto='$cod_sto'
   AND tarea.cod_tar = '$ver[0]'";
   $res=pg_query($conexion,$con);
   $filas=pg_num_rows($res);
   //echo 'Numero de filas '.$filas;
   if($filas>0){
    array_push($contar, "SI");
   }else{
    array_push($contar, "NO");
   }
 }

 //Ahora verifico si hay usos seguidos
 $sum =0;
 //echo "\ncontar array ".count($contar);
 for($i=0;$i<count($contar);$i++){

    if($contar[$i] == 'SI'){
        $sum++;
    }else{
    break;
    }

 }
 echo $sum;
            
?>