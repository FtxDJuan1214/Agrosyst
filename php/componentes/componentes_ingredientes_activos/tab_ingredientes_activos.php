<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">¿Prohibido por el ICA?</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    session_start();
    $like = $_SESSION['idusuario'];

    $sql="SELECT cod_iac, des_iac, pro_iac
    FROM public.ingredientes_activos where cod_iac LIKE '$like%' or cod_iac LIKE '1-%'"; 
    
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){  
        
    $datos=$ver[0]."||".
     $ver[1]."||".
     $ver[2]."||";

     ?>
     <tr>

      <td><?php echo $ver[1] ?></td>
      <td><?php echo $ver[2] ?></td>
      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#" onclick="modalActualizar(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminarIngrediente(' <?php  echo $datos ?> ')" ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>
</table>