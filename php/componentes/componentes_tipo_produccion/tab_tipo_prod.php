<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Descripción</th>
      <th scope="col">Unidad de medida</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    session_start();
    $like = $_SESSION['idusuario'];
    $sql="SELECT tipo_de_produccion.cod_tpr, tipo_de_produccion.des_tpr, tipo_de_produccion.cod_unm, unidad_de_medida.des_unm
    FROM public.tipo_de_produccion, public.unidad_de_medida
    where unidad_de_medida.cod_unm=tipo_de_produccion.cod_unm AND tipo_de_produccion.des_tpr LIKE '$like%'"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){

     $partes=explode("-", $ver[1]);
     

     $datos=$ver[0]."||".
     $partes[1]."||".
     $ver[2];
     ?>
     <tr>

      <td><?php echo $ver[0] ?></td>
      <td><?php echo $partes[1] ?></td>
      <td><?php  $partes1=explode("-", $ver[3]);
      echo $partes1[0] ?></td>

      

      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a data-toggle="modal" data-target="#modal-form" class="dropdown-item" href="#"  onclick="llenarform(' <?php  echo $datos ?> ')" ><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminar_tipo_pro(' <?php  echo $ver[0] ?> ')"  ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>