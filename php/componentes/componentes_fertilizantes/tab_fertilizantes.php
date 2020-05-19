<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Unidad de medida</th>      
      <th scope="col">Detalle</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    session_start();
    $like = $_SESSION['idusuario'];

    $sql="SELECT cod_fer, fertilizantes.cod_ins,des_ins,unidad_de_medida.cod_unm,des_unm,det_fer 
    from public.insumos 
    INNER JOIN fertilizantes ON insumos.cod_ins=fertilizantes.cod_ins
    INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
    where det_fer LIKE '$like%' OR det_fer LIKE '1-%' "; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
      $partes=explode("-", $ver[5]);
      $datos=$ver[0]."||".
      $ver[1]."||".
      $ver[2]."||".
      $ver[3]."||".
      $partes[1];
      ?>
      <tr>

        <td><?php echo $ver[2] ?></td>
        <td><?php echo $ver[4] ?></td>
        <td><?php echo $partes[1]?></td>
        <td class="text-right">
          <div class="dropdown">
            <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <?php  
              if ($partes[0] != '1') {
                ?>
                <a class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>

                <a class="dropdown-item" href="#" onclick="eliminar_semilla(' <?php  echo $datos ?> ')" ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
                <?php
              }else{
                ?>
                <div class="text-center">
                  <i class="fa fa-ban text-danger" aria-hidden="true" style="font-size: 1.1rem;"></i>
                </div>
                
                <?php
              }
              ?>
            </div>
          </div>
        </td>
      </tr>
      <?php 
    }
    ?>
  </tbody>
</table>

