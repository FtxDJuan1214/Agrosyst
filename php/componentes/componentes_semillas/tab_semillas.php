<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo de semilla</th>
      <th scope="col">Unidad de medida</th>      
      <th scope="col">Detalle</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    session_start();
    $like = $_SESSION['idusuario'];

    $sql="SELECT cod_sem, semillas.cod_ins,des_ins,tipo_semilla.cod_tsa,det_tsa,unidad_de_medida.cod_unm,des_unm,det_sem 
    from public.insumos 
    INNER JOIN semillas ON insumos.cod_ins=semillas.cod_ins
    INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
    INNER JOIN tipo_semilla ON semillas.cod_tsa=tipo_semilla.cod_tsa
    where det_sem LIKE '$like%'"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
      $partes=explode("-", $ver[7]);
     $datos=$ver[0]."||".
     $ver[1]."||".
     $ver[2]."||".
     $ver[3]."||".
     $ver[4]."||".
     $ver[5]."||".
     $ver[6]."||".
     $partes[1];
     ?>
     <tr>

      <td><?php echo $ver[2] ?></td>
      <td><?php echo $ver[4] ?></td>
      <td><?php echo $ver[6] ?></td>
      <td><?php echo $partes[1]?></td>
      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminar_semilla(' <?php  echo $datos ?> ')" ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>
</table>