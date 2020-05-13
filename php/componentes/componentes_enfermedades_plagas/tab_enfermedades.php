<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Nombre C</th>
            <th scope="col">Epoca</th>
            <th scope="col">Etapa en planta ataque</th>
            <th scope="col">Partes atacadas</th>
            <th scope="col">Hora de ataque</th>
            <th scope="col">Sintomas</th>            
            <th scope="col">Metodos P.</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
          session_start();
          $like = $_SESSION['idusuario'];
          $sql = "";

          
          $sql="SELECT afeccion.cod_afe, afeccion.nom_afe, afeccion.noc_afe, afeccion.epo_afe, 
          afeccion.prv_afe, afeccion.eat_afe, afeccion.hat_afe, 
           enfermedades.cod_enf, enfermedades.pat_enf
           FROM public.afeccion, public.enfermedades
           WHERE afeccion.cod_afe = enfermedades.cod_afe
           AND (afeccion.cod_afe LIKE '1-%' or afeccion.cod_afe LIKE '$like%')";
          
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

            <td><?php echo $ver[1] ?></td>
            <td><?php echo $ver[2] ?></td>
            <td><?php echo $ver[3] ?></td>
            <td>
                <?php $sep = explode('-',$ver[5]);
            $contar=count($sep);
            for($i=1;$i<$contar;$i++){ 
                if($sep[$i] != ''){               
                    echo $sep[$i];?><br><?php  
                      }
                    }
             ?></td>
            <td><?php $sql1="SELECT partes_planta_afe.det_par FROM  public.afeccion, public.partes_planta_afe
		  where partes_planta_afe.cod_afe = afeccion.cod_afe
		  AND partes_planta_afe.cod_afe = '$ver[0]'";
                $result1=pg_query($conexion,$sql1);
                while($ver1=pg_fetch_row($result1)){
                  echo $ver1[0]; ?><br><?php  
                }
                ?></td>            
            <td><?php echo $ver[6] ?></td>
            <td>
                <?php $sep = explode('~',$ver[7]);
                $contar=count($sep);
                for($i=1;$i<$contar;$i++){ 
                    if($sep[$i] != ''){               
                        echo $sep[$i];?><br><?php  
                            }
                        }
                    ?></td>
                    <td>
                <?php $sep = explode('~',$ver[4]);
            $contar=count($sep);
            for($i=1;$i<$contar;$i++){ 
                if($sep[$i] != ''){               
                    echo $sep[$i];?><br><?php  
                      }
                    }
             ?></td>
            <td class="text-right">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#"  onclick="modalActualizar('<?php  echo $datos ?>','E')">
                            <div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div>
                        </a>
                        <a class="dropdown-item" href="#" onclick="eliminar_plaga_enf(' <?php  echo $datos ?> ','E')">
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