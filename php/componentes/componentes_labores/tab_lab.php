<?php
require '../../conexion.php';
session_start();
$like =  $_SESSION['idusuario'];
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Detalle</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    $sql="SELECT cod_lab,nom_lab,det_lab FROM labores where det_lab LIKE '$like%'"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
     $partes=explode("-", $ver[2]);
     $datos=$ver[0]."||".
     $ver[1]."||".
     $partes[1];
     ?>
     <tr>
      <td><?php echo $ver[1] ?></td>
      <td><?php echo $partes[1] ?></td>

      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminar_labor(' <?php  echo $ver[0] ?> ')" ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>