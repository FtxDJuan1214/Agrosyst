<?php
require '../../conexion.php';
$cod_pro=$_POST['cod_pro'];
?>
<div class="row">
  <div class="card bg-default shadow" style="width: 100%; ">
    <div class="table-responsive">
      <table class="table align-items-center table-dark table-flush table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Capacidad</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Total</th>
            <th scope="col">Cultivo</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql=" SELECT DISTINCT produccion.cod_pro, tipo_de_produccion.cod_tpr, tipo_de_produccion.des_tpr, 
          gozar.fec_goz, gozar.cpt_goz,gozar.ctp_goz, gozar.pre_goz, cultivos.cod_cul, nombre_cultivo.des_ncu,
          unidad_de_medida.des_unm
          FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
          public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida
          WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
          AND produccion.cod_cul=cultivos.cod_cul 
          AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
          AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin 
          AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm AND produccion.cod_pro = $cod_pro"; 
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
           $ver[9];
           ?>
           <tr>
            <td><?php
            $array=explode("-", $ver[2]);
            $arra1=explode("-", $ver[9]);
            echo $array[1]." / ".$arra1[1]?></td>
            <td><?php echo $ver[3] ?></td>
            <td><?php echo $ver[4].' Kg' ?></td>
            <td><?php echo $ver[5] ?></td>
            <td><?php echo '$'.$ver[6] ?></td>
            <td><?php echo '$'.(floatval($ver[5]) * floatval($ver[6])) ?></td>
            <td><?php
            $array=explode("-", $ver[8]);
            echo $array[1] ?></td>

            <td class="text-right">
              <div class="dropdown">
                <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a data-toggle="modal" data-target="#modal-form" class="dropdown-item" href="#"  onclick="llenarform(' <?php  echo $datos ?> ')" ><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
                  <a class="dropdown-item" href="#" onclick="eliminar_produccion(' <?php  echo $ver[0] ?>','<?php  echo $ver[1] ?>')"  ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
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