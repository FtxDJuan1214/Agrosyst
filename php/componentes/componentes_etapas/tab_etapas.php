<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nombre de la etapa</th>
      <th scope="col">Plaga o enfermedad y respectiva imagen</th>
      <th scope="col">Asocir plaga o enfermedad</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    session_start();
    $like = $_SESSION['idusuario'];

    $tab="SELECT cod_eta, det_eta
    FROM public.etapas_crecimiento where cod_eta LIKE '$like%' or cod_eta LIKE '1-%'"; 
    
    $result=pg_query($conexion,$tab);
    while($ver=pg_fetch_row($result)){  
        
    $datos=$ver[0]."||".
     $ver[1]."||";

     ?>
     <tr>

      <td><?php echo $ver[1] ?></td>
      <td>
      <?php $sql1="SELECT DISTINCT afeccion.nom_afe, etapas_crecimiento.det_eta, eta_x_afe.ima_eta
          FROM public.afeccion, public.eta_x_afe, public.etapas_crecimiento
          WHERE afeccion.cod_afe = eta_x_afe.cod_afe
          AND etapas_crecimiento.cod_eta = eta_x_afe.cod_eta
          AND eta_x_afe.cod_eta = '$ver[0]'";
            $result1=pg_query($conexion,$sql1);
            while($ver1=pg_fetch_row($result1)){
      ?>
       <br>
       <center>
           <?php echo $ver1[0] ?><br>

       <?php if($ver1[2] != null){?>
           <a title="<?php echo $ver1[1] ?>" href="#">
               <img width="100" height="100"
                   src="../imagenes/<?php echo $ver1[2]?>"
                   alt="<?php echo $ver1[1] ?>" /></a><br>
       
       <a style="color:#7A7894">_______________________________________________________</a><br>
           </center>
       <?php 
      }else{
          ?>
       <center>
           <a title="<?php echo $ver1[1] ?>" href="#">
               <img width="100" height="100"
                   src="../imagenes/etapas/sinimagen.jpg"
                   alt="<?php echo $ver1[1] ?>" /></a>
       </center>
       <a style="color:#7A7894">_______________________________________________________</a><br>

       <?php
          }
        }    
    ?>
      </td>
      <td><input type="button" name="aso_eta"
                 class="btn btn-success sm-4"
                 data-placement="top"
                 title="Asociar una enfermedad o plaga a esta etapa"
                 value="Asociar a esta estapa"
                 style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                 data-toggle="modal" data-target="#modal-list"
                 onclick="asociar('<?php echo $ver[0] ?>')"></td>
      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#" onclick="modalActualizar(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminarEtapa(' <?php  echo $datos ?> ')" ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>
</table>