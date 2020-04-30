  <?php 
  session_start();
  require '../../conexion.php';
  $cod_cul =$_POST['cod_cul'];
  $codi_fin=$_SESSION['ide_finca'];
  $like = $_SESSION['idusuario'];
  ?>
  <div class="row">
    <div class="card bg-default shadow" style="width: 100%; ">
      <div class="table-responsive">
        <table class="table align-items-center table-dark table-flush">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Código</th>
              <th scope="col">Insumo</th>
              <th scope="col">Disponible</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Precio</th>
              <th scope="col">Agregar</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
            unidad_de_medida.des_unm,terceros.ide_ter, 
            terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
            FROM insumos, stock, registrar, compras, comprar, terceros, dueño, unidad_de_medida,  cultivos, act_cul
            WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
            AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
            AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=dueño.ide_ter
            AND unidad_de_medida.cod_unm=insumos.cod_unm AND terceros.ide_ter=act_cul.ide_ter  AND stock.can_sto != '0'
            AND act_cul.cod_cul=cultivos.cod_cul AND cultivos.cod_cul = '$cod_cul'
            AND  terceros.ide_ter LIKE '$like%'";
            $result=pg_query($conexion,$sql);
            while($ver=pg_fetch_row($result)){
              $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
              $rex=pg_query($conexion,$excluir);
              $filas=pg_num_rows($rex);
              if ($filas == 0) {
                ?>
                <tr>

                  <td><?php echo $ver[0] ?></td>
                  <td><?php echo $ver[3] ?></td>
                  <td><?php 
                  $unm=explode("-",$ver[4]);
                  echo $ver[1]." ".$unm[0]?>
                </td>
                <td>
                  <div class="form-group mb-3" style="max-width: 100px;">
                    <div class="input-group input-group-alternative" id="div_cant_usar<?php echo $ver[0] ?>">
                      <input style="border-color: #fb6340;" id="cant_usar<?php echo $ver[0] ?>" type="number" class="form-control" placeholder="Cantidad a usar" autocomplete="off">
                    </div>
                  </div>
                </td>
                <td>
                  <?php
                  $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
                  $r=pg_query($conexion,$sqf);
                  $cont=0;
                  $pre=0;
                  while($see=pg_fetch_row($r)){
                    ++$cont;
                    $pre=$pre+$see[0];
                  }
                  $precio = intval(($pre)/$cont);
                  echo "$ ".$precio;
                  ?>
                </td>
                <td> <button class="btn btn-sm btn-secondary btn-icon-only rounded-circle" type="button" 
                  onclick="stringinsumos('<?php  echo $ver[0].','.$ver[1].','.$unm[0].','?>'+$('#cant_usar<?php echo $ver[0] ?>').val()+'<?php echo ','.$precio.','.$ver[3].'' ?>');">
                  <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                </button></td>
              </tr>
              <?php 
            }
          }

          $sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
          unidad_de_medida.des_unm,terceros.ide_ter, 
          terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
          FROM insumos, stock, registrar, compras, comprar, terceros, socio, unidad_de_medida,  cultivos, act_cul
          WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
          AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
          AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
          AND unidad_de_medida.cod_unm=insumos.cod_unm AND terceros.ide_ter=act_cul.ide_ter  AND stock.can_sto != '0'
          AND act_cul.cod_cul=cultivos.cod_cul AND cultivos.cod_cul = '$cod_cul'
          AND  terceros.ide_ter LIKE '$like%'";
          $result=pg_query($conexion,$sql);
          while($ver=pg_fetch_row($result)){
            $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
            $rex=pg_query($conexion,$excluir);
            $filas=pg_num_rows($rex);
            if ($filas == 0) {
              ?>
              <tr>

                <td><?php echo $ver[0] ?></td>
                <td><?php echo $ver[3] ?></td>
                <td><?php 
                $unm=explode("-",$ver[4]);
                echo $ver[1]." ".$unm[0]?>
              </td>
              <td>
                <div class="form-group mb-3" style="max-width: 100px;">
                  <div class="input-group input-group-alternative" id="div_cant_usar<?php echo $ver[0] ?>">
                    <input style="border-color: #fb6340;" id="cant_usar<?php echo $ver[0] ?>" type="number" class="form-control" placeholder="Cantidad a usar" autocomplete="off">
                  </div>
                </div>
              </td>
              <td>
                <?php
                $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
                $r=pg_query($conexion,$sqf);
                $cont=0;
                $pre=0;
                while($see=pg_fetch_row($r)){
                  ++$cont;
                  $pre=$pre+$see[0];
                }
                $precio = intval(($pre)/$cont);
                echo "$ ".$precio;
                ?>
              </td>
              <td> <button class="btn btn-sm btn-secondary btn-icon-only rounded-circle" type="button" 
                onclick="stringinsumos('<?php  echo $ver[0].','.$ver[1].','.$unm[0].','?>'+$('#cant_usar<?php echo $ver[0] ?>').val()+'<?php echo ','.$precio.','.$ver[3].'' ?>');">
                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
              </button></td>
            </tr>
            <?php 
          }
        }

        ?>
      </tbody>
    </table>
  </div>
</div>
</div>