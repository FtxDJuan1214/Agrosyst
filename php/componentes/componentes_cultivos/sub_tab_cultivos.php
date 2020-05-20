<div class="row">
  <div class="card bg-default shadow" style="width: 100%; ">
    <div class="card-header bg-transparent border-0">
      <h3 class="text-white mb-0">Cultivos</h3>
    </div>
    <div class="table-responsive">
      <table class="table align-items-center table-dark table-flush">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Cultivo</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          require '../../conexion.php';
          session_start();
          $like = $_SESSION['idusuario'];
          $sql="SELECT * FROM nombre_cultivo WHERE des_ncu LIKE'$like%' or des_ncu LIKE'1-%' ORDER BY cod_ncu ASC"; 
          $result=pg_query($conexion,$sql);
          while($ver=pg_fetch_row($result)){
           $datos=$ver[0]."||".
           $ver[1];
           ?>
           <tr>
             <td><?php echo $ver[0] ?></td>
             <td><?php
             $array=explode("-", $ver[1]);
             echo $array[1] ?></td>
             <td class="text-right">
              <div class="dropdown" style="margin-right: 25px;">
                <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                  <?php  
                  if ($array[0] != '1' || $like == "1-") {
                    ?>
                    <a class="dropdown-item" href="#" onclick="editar_nom_cul(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
                    <a class="dropdown-item" href="#"  onclick="eliminar_nom_cul(' <?php  echo $ver[0] ?> ')"><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
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
  </div>
</div>
</div>