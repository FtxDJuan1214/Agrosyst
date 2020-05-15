<?php
require '../../conexion.php';
error_reporting(0);
session_start();
$num_reg = $_POST['num_reg'];
?>

<table class="table align-items-center table-flush">
  <thead class="thead-light">
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Descripción</th>
      <th scope="col">Fecha</th>
      <th scope="col">Capacidad</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Total</th>
      <th scope="col">Recaudo</th>
      <th scope="col">Cultivo</th>
      <th scope="col">Comprador</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
 
    $cod_fin=$_SESSION['ide_finca'];
    $sql="SELECT DISTINCT produccion.cod_pro, tipo_de_produccion.cod_tpr, tipo_de_produccion.des_tpr, 
    gozar.fec_goz, gozar.cpt_goz,gozar.ctp_goz, gozar.pre_goz, cultivos.cod_cul, nombre_cultivo.des_ncu,
    unidad_de_medida.des_unm, produccion.ide_ter, terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, cultivos.npl_cul,lotes.nom_lot
    FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
    public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
    WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
    AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
    AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
    AND produccion.ide_ter = terceros.ide_ter AND fincas.cod_fin = '$cod_fin' ORDER BY  produccion.cod_pro ASC"; 
    $result=pg_query($conexion,$sql);
    $result1=pg_query($conexion,$sql);
    $result2=pg_query($conexion,$sql);
    $cont = 0;
    $veces = 0;
    $anterior = 0;
    $indice = 0;
    while($fila=pg_fetch_row($result1)){
     $Lista[] = [$fila[0],(floatval($fila[5]) * floatval($fila[6]))];

     if($fila[0] == $anterior){
      $veces++;
      $anterior = $fila[0];
    }else{
      if($cont == 0){
        $veces++;
        $anterior = $fila[0];
      }else{
        $array[] = [$indice,$veces];
        $veces = 1;
        $anterior = $fila[0];
      }
    }

    $indice = $fila[0];
    $cont++;
  }
  $array[] = [$indice,$veces];

  $nant = $Lista[0][0];
  $total = 0;

  
  for ($i=0; $i < count($array) ; $i++) { 
    //echo "Codigo: ".$array[$i][0]." Repite: ".$array[$i][1];
    $total = 0;
    for ($j=0; $j < count($Lista); $j++) { 
      if ($array[$i][0] == $Lista[$j][0]) {
        $total = ($total + $Lista[$j][01]);
      }
    }
    $totales[] = [$array[$i][0],$array[$i][1],$total];
    //echo " Total : " . $total."<br>";
  }

  $index = 0;
  $i=0;
  $money = 0;
  $background = "#FCF4CD";


  $contador = 0;
  while($ver=pg_fetch_row($result)){   

   $datos=$ver[0]."||".
   $ver[1]."||".
   $ver[2]."||".
   $ver[3]."||".
   $ver[4]."||".
   $ver[5]."||".
   $ver[6]."||".
   $ver[7]."||".
   $ver[8]."||".
   $ver[9]."||".
   $ver[10];

   if($ver[0] == $index){
    $index = $ver[0];
    ?>
    <tr style="background:<?php echo $background ?>;" >
      <td><?php
      $array=explode("-", $ver[2]);
      $arra1=explode("-", $ver[9]);
      echo $array[1]."<br> [".$arra1[1],"]"?></td>
      <td><?php echo $ver[3] ?></td>
      <td><?php echo $ver[4].' Kg' ?></td>
      <td><?php echo $ver[5] ?></td>
      <td><?php echo '$'.(floatval($ver[5]) * floatval($ver[6])) ?></td>
    </tr>

    <?php

  }else{
    if($contador == $num_reg){
      break;
    }else{
      $contador++;
    }
    if ($background == "#FCF4CD") {
     $background = "#C0F7BB";
   }else{
    $background = "#FCF4CD";
  }
  ?>

  <tr  style="background:<?php echo $background ?>;">

    <td rowspan="<?php echo $totales[$i][1] ?> "><?php echo $ver[0] ?></td>
    <td><?php
    $array=explode("-", $ver[2]);
    $arra1=explode("-", $ver[9]);
    echo $array[1]."<br> [".$arra1[1],"]"?></td>
    <td><?php echo $ver[3] ?></td>
    <td><?php echo $ver[4].' Kg' ?></td>
    <td><?php echo $ver[5] ?></td>
    <td><?php echo '$'.(floatval($ver[5]) * floatval($ver[6])) ?></td>
    <td rowspan="<?php echo $totales[$i][1] ?> "><?php echo "$".$totales[$i][2]?></td>
    <td rowspan="<?php echo $totales[$i][1] ?> "><?php $array=explode("-", $ver[8]); echo $array[1]."<br>".$ver[15]." Plantas<br>En lote: ".$ver[16] ?></td>
    <td rowspan="<?php echo $totales[$i][1] ?> "><?php echo $ver[11]." ".$ver[12]."<br>".$ver[13]." ".$ver[14]?></td>
    <td rowspan="<?php echo $totales[$i][1]?>" class="text-right">
      <div class="dropdown">
        <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
          <a data-toggle="modal" data-target="#modal-form" class="dropdown-item" href="#"  onclick="editar(' <?php  echo $ver[0] ?>','<?php  echo $ver[7] ?>',' <?php  echo $ver[10] ?>')" ><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
          <a class="dropdown-item" href="#" onclick="eliminar_todo(' <?php  echo $ver[0] ?>','<?php  echo $ver[7] ?>')"  ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
        </div>
      </div>
    </td>
  </tr>

  <?php
  $index = $ver[0];
  $i++;
}
?>

<?php 
}
?>
</tbody>


