<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Nombre C</th>
            <th scope="col">Epoca</th>
            <th scope="col">Metodos P.</th>
            <th scope="col">Etapa en planta ataque</th>
            <th scope="col">Hora de ataque</th>
            <th scope="col">Patogeno</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
          session_start();
          $like = $_SESSION['idusuario'];
          $sql = "";

          if($like != '1-'){
          $sql="SELECT afeccion.cod_afe, afeccion.nom_afe, afeccion.noc_afe, afeccion.epo_afe, 
          afeccion.prv_afe, afeccion.eat_afe, afeccion.hat_afe, 
          enfermedades.cod_enf, enfermedades.pat_enf
          FROM public.afeccion, public.enfermedades
          WHERE afeccion.cod_afe = enfermedades.cod_afe
          AND afeccion.cod_afe LIKE '$like%' or afeccion.cod_afe LIKE '1-%'"; 
          }else{

          $sql="SELECT afeccion.cod_afe, afeccion.nom_afe, afeccion.noc_afe, afeccion.epo_afe, 
          afeccion.prv_afe, afeccion.eat_afe, afeccion.hat_afe,
          enfermedades.cod_enf, enfermedades.pat_enf
          FROM public.afeccion, public.enfermedades
          WHERE afeccion.cod_afe = enfermedades.cod_afe
          AND afeccion.cod_afe LIKE '$like%'"; 
          }
          
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
          $ver[8]."||";

        ?>
        <tr>

            <td><?php echo $ver[0] ?></td>
            <td><?php echo $ver[1] ?></td>
            <td><?php echo $ver[2] ?></td>
            <td><?php echo $ver[3] ?></td>
            <td><?php echo $ver[4] ?></td>
            <td><?php echo $ver[5] ?></td>
            <td><?php echo $ver[6] ?></td>
            <td><?php echo $ver[8] ?></td>
            <td class="text-right">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#" onclick="modalActualizar(' <?php  echo $datos ?> ')">
                            <div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div>
                        </a>
                        <a class="dropdown-item" href="#" onclick="eliminarIngrediente(' <?php  echo $datos ?> ')">
                            <div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>