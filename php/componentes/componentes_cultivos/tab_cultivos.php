<?php
require '../../conexion.php';
session_start();
$codi_fin=$_SESSION['ide_finca'];
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Fechas</th>
      <th scope="col">Estado</th>
      <th scope="col">Plantas</th>
      <th scope="col">Modalidad</th>
      <th scope="col">Tipo de cultivo</th>
      <th scope="col">Duración</th>
      <th scope="col">Etapa</th>
      <th scope="col">Lote</th>
      <th scope="col">Socios</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    // $sql="SELECT cultivos.cod_cul,cultivos.fin_cul,cultivos.fif_cul,cultivos.dia_cul,cultivos.npl_cul,
    // cultivos.tip_cul,cultivos.dur_cul,cultivos.est_cul,nombre_cultivo.cod_ncu,nombre_cultivo.des_ncu,
    // lotes.cod_lot,lotes.nom_lot FROM cultivos INNER JOIN nombre_cultivo ON nombre_cultivo.cod_ncu=cultivos.cod_ncu 
    // INNER JOIN lotes on lotes.cod_lot=cultivos.cod_lot ORDER BY cultivos.cod_cul ASC"; 
    $sql="SELECT cultivos.cod_cul,cultivos.fin_cul,cultivos.fif_cul,cultivos.dia_cul,cultivos.npl_cul,
    cultivos.tip_cul,cultivos.dur_cul,cultivos.est_cul,nombre_cultivo.cod_ncu,nombre_cultivo.des_ncu,
    lotes.cod_lot,lotes.nom_lot,cultivos.mod_cul FROM cultivos,fincas,lotes,nombre_cultivo WHERE fincas.cod_fin=lotes.cod_fin 
    AND lotes.cod_lot=cultivos.cod_lot AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND fincas.cod_fin='$codi_fin'
    ORDER BY cultivos.cod_cul ASC"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){

      $sq1="SELECT cod_cul,act_cul.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter 
      FROM act_cul INNER JOIN terceros ON terceros.ide_ter=act_cul.ide_ter
      WHERE cod_cul='$ver[0]'"; 
      $resul1=pg_query($conexion,$sq1);
      $socios=pg_num_rows($resul1);
      $datos = "";
      ?>
      <tr 
      <?php if($socios== 0){
        echo "style='background: rgba(232,170,27,.3)'";
      } ?>
      >
        <td><?php $array=explode("-", $ver[9]); echo $array[1];?></td>
        <td>
         <div class=" icon-sm icon-shape bg-gradient-verde text-white rounded-circle " data-toggle="tooltip" data-placement="bottom" title="<?php
         echo 'Fecha inicio: '.$ver[1].'. Fecha fin: '.($ver[2]).'.'?>"><i class="fas fa-calendar-alt"></i>
       </fiv>
     </td>
     <td><?php

     date_default_timezone_set('America/Bogota');
     $d = date("d");
     $m = date("m");
     $y = date("Y");
     $fecha_hoy=$y."-".$m."-".$d;

     $fecha_inicio=$ver[1];
     $fecha_fin=$fecha_hoy;

     $fecha1= date_create($fecha_inicio);
     $fecha2= date_create($fecha_fin);
     $intervalo= date_diff($fecha1,$fecha2);

     $tiempo=array();
     foreach ($intervalo as $valor) {
      $tiempo[]=$valor;
    }

    $Dias_totales = $ver[3] ;
    $Dias_actuales = $tiempo[11];
    echo "dias totales = ".$Dias_totales."<br>";
    echo "dias actuales = ".$Dias_actuales."<br>";

    $porcentaje=intval((($Dias_actuales*100)/$Dias_totales));;

    if ($porcentaje <= 25) {
      ?>
      <div class="d-flex align-items-center">
        <span class="mr-2"><?php echo $porcentaje."%" ?></span>
        <div>
          <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?php echo $porcentaje ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje."%" ?>"></div>
          </div>
        </div>
      </div>
      <?php
    }elseif ($porcentaje > 25 && $porcentaje <= 50) {
      ?>
      <div class="d-flex align-items-center">
        <span class="mr-2"><?php echo $porcentaje."%" ?></span>
        <div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo $porcentaje ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje."%" ?>"></div>
          </div>
        </div>
      </div>
      <?php
    }elseif ($porcentaje > 50 && $porcentaje <= 75) {
      ?>
      <div class="d-flex align-items-center">
        <span class="mr-2"><?php echo $porcentaje."%" ?></span>
        <div>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $porcentaje ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje."%" ?>"></div>
          </div>
        </div>
      </div>
      <?php
    }elseif ($porcentaje > 75 && $porcentaje < 100) {
      ?>
      <div class="d-flex align-items-center">
        <span class="mr-2"><?php echo $porcentaje."%" ?></span>
        <div>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $porcentaje ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje."%" ?>"></div>
          </div>
        </div>
      </div>
      <?php
    }elseif ($porcentaje >= 100) {
      ?>
      <div class="d-flex align-items-center">
        <span class="mr-2">100%</span>
        <div>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100%" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>

  </td>
  <td><?php echo $ver[4] ?></td>
  <td><?php 
  if ($ver[12] == 1) {
   echo "Una planta";
 }elseif ($ver[12] == 2) {
   echo "Dos plantas";
 }?>
 
</td>
<td><?php 
if ($ver[5] == 1) {
 echo "Transitorio";
}elseif ($ver[5] == 2) {
 echo "Perenne";
}
?>

</td>
<td><?php echo $ver[6] ?></td>
<td><?php
if($ver[7] != 7){

  if($Dias_actuales >= 0 && $Dias_actuales <= 3){

    $sqlet = "UPDATE public.cultivos SET est_cul='1' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||1||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Inicio";

  }else if($Dias_actuales > 3 && $Dias_actuales <=210){

    $sqlet = "UPDATE public.cultivos SET est_cul='2' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||2||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Crecimiento";
  }else if($Dias_actuales > 210 && $Dias_actuales <=240){

    $sqlet = "UPDATE public.cultivos SET est_cul='3' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||3||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Inicio afloración";
  }else if($Dias_actuales > 240 && $Dias_actuales <=300){

    $sqlet = "UPDATE public.cultivos SET est_cul='4' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||4||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Maxima afloración";
  }else if($Dias_actuales > 300 && $Dias_actuales <=365){

    $sqlet = "UPDATE public.cultivos SET est_cul='5' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||5||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Inicio fructificación";
  }else if ($Dias_actuales > 365 && $Dias_actuales < $Dias_totales ) {

    $sqlet = "UPDATE public.cultivos SET est_cul='6' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||6||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Cosecha";
  }else if($Dias_actuales >= $Dias_totales ){

    $sqlet = "UPDATE public.cultivos SET est_cul='7' WHERE cod_cul='$ver[0]'";
    $resultet=pg_query($conexion,$sqlet);

    $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
    $ver[6]."||7||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];

    echo "Finalización";
  }
}else{
 $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4]."||".$ver[5]."||".
 $ver[6]."||".$ver[7]."||".$ver[8]."||".$ver[9]."||".$ver[10]."||".$ver[11]."||".$ver[12];
 echo "Finalización";
}
?></td>
<td><?php echo $ver[11] ?></td>
<td>
 <?php 
 while($see=pg_fetch_row($resul1)){
  echo $see[2]." ".$see[3]." ".$see[4]." ".$see[5];
  ?>
  <br>
  <?php
}
?>
</td>
<td>
  <div class="dropdown text-right">
    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
      <a class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
      <a class="dropdown-item" href="#"  onclick="eliminar_cultivo(' <?php  echo $ver[0] ?> ')"><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
    </div>
  </div>
</td>
</tr>
<?php 
}
?>
</tbody>
</table>
<script>
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>