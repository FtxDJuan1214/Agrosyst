<?php
require '../../conexion.php';
session_start();
$codi_fin=$_SESSION['ide_finca'];
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Finca</th>
      <th scope="col">Unidad de medida</th>
      <th scope="col">Medida</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql="SELECT cod_lot,nom_lot,fincas.cod_fin,nom_fin,cnt_fin,unidad_de_medida.cod_unm,des_unm,tipo_unidad_medida.cod_tum,med_lot from public.lotes 
    INNER JOIN fincas ON lotes.cod_fin=fincas.cod_fin 
    INNER JOIN unidad_de_medida ON lotes.cod_unm=unidad_de_medida.cod_unm
    INNER JOIN tipo_unidad_medida ON unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum WHERE fincas.cod_fin='$codi_fin' ORDER BY cnt_fin ASC "; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
     $datos=$ver[0]."||".
     $ver[1]."||".
     $ver[2]."||".
     $ver[3]."||".
     $ver[4]."||".
     $ver[5]."||".
     $ver[6]."||".
     $ver[7]."||".
     $ver[8];

     $medida = explode("-", $ver[6]); 
     ?>
     <tr>

      <td><?php echo $ver[1] ?></td>
      <td><?php echo $ver[3] ?></td>
      <td><?php echo $medida[0] ?></td>
      <td><?php echo $ver[8]." ".$medida[1] ?></td>
      <td class="text-right">
        <div class="dropdown" style="margin-right: 25px;">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#"  onclick="eliminar_lote(' <?php  echo $ver[0] ?> ')"><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>