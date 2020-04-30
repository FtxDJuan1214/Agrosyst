<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Detalles</th>
      <th scope="col">Recomendacioes</th>
      <th scope="col">Estado</th>
      <th scope="col">Periodo de Carencia</th>
      <th scope="col">Periodo de Entrada</th>
      <th scope="col">Prohibido por ICA</th>
      <th scope="col">Formulación</th> 
      <th scope="col">Unidad de medida</th>     
      <th scope="col">Toxicidad</th>
      <th scope="col">Tipo</th>

      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql="SELECT cod_agr,agroquimicos.cod_ins,det_agr,rec_agr,est_agr,pcr_agr,pen_agr,pro_agr,for_agr,unidad_de_medida.cod_unm,des_unm,tipo_unidad_medida.cod_tum, toxicidad.det_tox, tipo_agroquimico.det_tag, insumos.des_ins  from public.insumos 
    INNER JOIN agroquimicos ON insumos.cod_ins=agroquimicos.cod_ins
    INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
    INNER JOIN tipo_unidad_medida ON unidad_de_medida.cod_tum=tipo_unidad_medida.cod_tum
    INNER JOIN toxicidad ON agroquimicos.cod_tox=toxicidad.cod_tox
    INNER JOIN tipo_agroquimico ON agroquimicos.cod_tag=tipo_agroquimico.cod_tag ORDER BY agroquimicos.cod_agr"; 
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
     $ver[8]."||".
     $ver[9]."||".
     $ver[10]."||".
     $ver[11]."||".
     $ver[12]."||".
     $ver[13]."||".
     $ver[14];
     ?>
     <tr>

      <td><?php echo $ver[2] ?></td>
      <td><?php echo $ver[14] ?></td>
      <td><?php echo $ver[3] ?></td>
      <td><?php echo $ver[4] ?></td>
      <td><?php echo $ver[5] ?></td>
      <td><?php echo $ver[6] ?></td>
      <td><?php echo $ver[7] ?></td>
      <td><?php echo $ver[8] ?></td>
      <td><?php echo $ver[10] ?></td>
      <td><?php echo $ver[12] ?></td>
      <td><?php echo $ver[13] ?></td>
      
       
      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#"  onclick="llenarform(' <?php  echo $datos ?> ')" ><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminar_agroquimico(' <?php  echo $datos ?> ')"  ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>