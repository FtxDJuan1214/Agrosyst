<?php
require '../../conexion.php';
session_start();
$codi_fin=$_SESSION['ide_finca'];
?>

<table class="table align-items-center table-flush">
  <thead class="thead-light">
    <tr>
      <th scope="col">Descripcion</th>
      <th scope="col">Tipo</th>
      <th scope="col">Fechas</th>
      <th scope="col">Convenios</th>
      <th scope="col">Insumos</th>
      <th scope="col">Gastos</th>
      <th scope="col">Valor</th>
      <th scope="col">Labor</th>
      <th scope="col">Cultivo</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    $sql="SELECT DISTINCT tarea.cod_tar, tarea.des_tar, tarea.val_tar, tarea.fin_tar, tarea.ffi_tar, fincas.cod_fin, cultivos.cod_cul, nombre_cultivo.des_ncu, cultivos.npl_cul,lotes.nom_lot, labores.nom_lab, labores.cod_lab 
    FROM fincas, lotes, cultivos, ejecutar, convenio, efectuar, tarea, nombre_cultivo, labores
    WHERE fincas.cod_fin=lotes.cod_fin AND nombre_cultivo.cod_ncu = cultivos.cod_ncu AND lotes.cod_lot=cultivos.cod_lot 
    AND cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con 
    AND convenio.cod_con=efectuar.cod_con AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_lab = labores.cod_lab and fincas.cod_fin = '$codi_fin'
    ORDER BY tarea.fin_tar ASC"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
     $datos=$ver[0]."||".
     $ver[1]."||".
     $ver[2]."||".
     $ver[3]."||".
     $ver[4]."||".
     $ver[5]."||".
     $ver[6]."||".
     $ver[11];
     ?>
     <tr> 

      <td><?php echo $ver[1] ?></td>
      <td><?php 
      $tipo = "SELECT cod_tar FROM public.comun WHERE cod_tar = '$ver[0]'";
      $res=pg_query($conexion,$tipo);
      $filas=pg_num_rows($res);
      if($filas !=0){
        echo "Común";
        $datos = $datos."||Común";
      }

      $tipo = "SELECT cod_tar FROM public.cultural WHERE cod_tar = '$ver[0]'";
      $res=pg_query($conexion,$tipo);
      $filas=pg_num_rows($res);
      if($filas !=0){
        echo "Cultural";
        $datos = $datos."||Cultural";
      }

      // $tipo = "SELECT enf_fit FROM public.fitosanitaria WHERE cod_tar = '$ver[0]'";
      // $res=pg_query($conexion,$tipo);
      // $filas=pg_num_rows($res);
      // $enf=pg_fetch_row($res);
      // if($filas !=0){
      //   echo "Fitosanitaria<br>Enfermedad: $enf[0]";
      //   $datos = $datos."||Fitosanitaria. Enfermedad: $enf[0]";
      // }

      ?></td> 
      <td>Inicio: <?php echo $ver[3] ?><br>Fin: <?php echo $ver[4] ?></td>    
      <td><?php 
      $sql1="SELECT convenio.cod_con, convenio.fec_con, contratos.ffi_con, contratos.val_cot, contratos.des_cot
      FROM efectuar, convenio, contratos where efectuar.cod_con = convenio.cod_con AND  contratos.cod_con = convenio.cod_con
      AND efectuar.cod_tar ='$ver[0]'";
      $result1=pg_query($conexion,$sql1);
      while($cont=pg_fetch_row($result1)){

        $terceros = "SELECT  act_con.cod_con, act_con.ide_ter, terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter 
        FROM act_con, terceros WHERE act_con.ide_ter = terceros.ide_ter and act_con.cod_con = '$cont[0]'";
        ?>
        <span class="badge badge-pill badge-primary text-uppercase "  data-toggle="tooltip" data-html="true" data-placement="right" title="<ul class='list-group'>
          <li class='list-group-item text-light' style='background: #000; color: #fff' >
            Inicio: <?php echo $cont[1].'.' ?><br>Fin: <?php echo $cont[2].'.' ?><br>
            Objeto: <?php echo $cont[4].'.' ?><br>
          </li>
          <li class='list-group-item text-light' style='background: #000; color: #fff' >
            <?php
            $i = 1;
            $erre=pg_query($conexion,$terceros);
            while($pers=pg_fetch_row($erre)){
              if ($i == 1){
                echo 'Trabajador: '.$pers[2].' '.$pers[3].' '.$pers[4].' '.$pers[5].'.'; 
                $i++;
                }else{
                 echo '<br>Socio: '.$pers[2].' '.$pers[3].' '.$pers[4].' '.$pers[5].'.'; 
               }
             }
             ?><br>
           </li>
           <li class='list-group-item text-light' style='background: #000; color: #fff' >
            Valor: $ <?php echo $cont[3].'.' ?>
          </li>
        </ul>" style="font-size: 0.7rem; margin: 5px;">Contrato</span><br>
        <?php
      } 

      $sql1="SELECT convenio.cod_con, convenio.fec_con, jornales.hor_jor, jornales.vho_jor FROM efectuar, jornales, convenio
      where efectuar.cod_con = convenio.cod_con AND  jornales.cod_con = convenio.cod_con AND efectuar.cod_tar = '$ver[0]'";
      $result1=pg_query($conexion,$sql1);
      while($jor=pg_fetch_row($result1)){

        $terceros = "SELECT act_con.cod_con, act_con.ide_ter, terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter 
        FROM act_con, terceros WHERE act_con.ide_ter = terceros.ide_ter and act_con.cod_con = '$jor[0]'";
        ?>
        <span class="badge badge-pill badge-primary text-uppercase "  data-toggle="tooltip" data-html="true" data-placement="right" title="<ul class='list-group'>
          <li class='list-group-item text-light' style='background: #000; color: #fff' >
            Fecha: <?php echo $jor[1].'.' ?><br>Horas : <?php echo $jor[2].'.' ?><br>
            Valor hora: <?php echo $jor[3].'.' ?><br>
          </li>
          <li class='list-group-item text-light' style='background: #000; color: #fff' >
            <?php
            $i = 1;
            $erre=pg_query($conexion,$terceros);
            while($pers=pg_fetch_row($erre)){
              if ($i == 1){
                echo 'Trabajador: '.$pers[2].' '.$pers[3].' '.$pers[4].' '.$pers[5].'.'; 
                $i++;
                }else{
                 echo '<br>Socio: '.$pers[2].' '.$pers[3].' '.$pers[4].' '.$pers[5].'.'; 
               }
             }
             ?><br>
           </li>
           <li class='list-group-item text-light' style='background: #000; color: #fff' >
            Valor: $ <?php echo (floatval($jor[2]) * floatval($jor[3]) ).'.' ?>
          </li>
        </ul>" style="font-size: 0.7rem; margin: 5px;">Jornal</span><br>
        <?php
      }
      ?></td>

      <td><?php 
      $sql1="SELECT DISTINCT insumos.des_ins, utilizar.cin_tar, unidad_de_medida.des_unm,  
      utilizar.pin_tar, terceros.pno_ter, terceros.sno_ter, 
      terceros.pap_ter, terceros.sap_ter, stock.cod_sto, stock.cod_ins,  utilizar.cod_uti
      FROM insumos, stock, registrar, compras, comprar, terceros, duenio, unidad_de_medida, utilizar
      WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
      AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
      AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter
      AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
      AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
      $result1=pg_query($conexion,$sql1);
      while($dats=pg_fetch_row($result1)){
        $excluir="SELECT cod_ins from otros where cod_ins = '$dats[9]'"; 
        $rex=pg_query($conexion,$excluir);
        $filas=pg_num_rows($rex);
        if ($filas == 0) {
          $unm=explode("-",$dats[2]);
          ?>
          <span class="badge badge-pill badge-success text-uppercase" data-toggle="tooltip" data-placement="top" title="Insumo dado por: <?php echo '&nbsp;'. $dats[4].' '.$dats[5].'&nbsp;'.$dats[6].' '.$dats[7].'.' ?>" style="font-size: 0.7rem; margin: 5px;"><?php   echo $dats[0].".  Cantidad: ".$dats[1].". ". $unm[1].".<br>Total: $".$dats[3] ?></span><br>
          <?php
        }
      }

      $sql1="SELECT DISTINCT insumos.des_ins, utilizar.cin_tar, unidad_de_medida.des_unm,  
      utilizar.pin_tar, terceros.pno_ter, terceros.sno_ter, 
      terceros.pap_ter, terceros.sap_ter, stock.cod_sto, stock.cod_ins , utilizar.cod_uti
      FROM insumos, stock, registrar, compras, comprar, terceros, socio, unidad_de_medida, utilizar
      WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
      AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
      AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
      AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
      AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
      $result1=pg_query($conexion,$sql1);
      while($dats=pg_fetch_row($result1)){
        $excluir="SELECT cod_ins from otros where cod_ins = '$dats[9]'"; 
        $rex=pg_query($conexion,$excluir);
        $filas=pg_num_rows($rex);
        if ($filas == 0) {
          $unm=explode("-",$dats[2]);
          ?>
          <span class="badge badge-pill badge-success text-uppercase" data-toggle="tooltip" data-placement="top" title="Insumo dado por: <?php echo '&nbsp;'. $dats[4].' '.$dats[5].'&nbsp;'.$dats[6].' '.$dats[7].'.' ?>" style="font-size: 0.7rem; margin: 5px;"><?php   echo $dats[0].".  Cantidad: ".$dats[1].". ". $unm[1].".<br>Total: $".$dats[3] ?></span><br>
          <?php
        }
      } 

      ?></td>
      <td><?php 
      $sql1="SELECT DISTINCT insumos.des_ins, utilizar.pin_tar,terceros.pno_ter, terceros.sno_ter, 
      terceros.pap_ter, terceros.sap_ter, stock.cod_sto
      FROM insumos, stock, registrar, compras, comprar, terceros, duenio, unidad_de_medida, utilizar, otros
      WHERE otros.cod_ins = stock.cod_ins AND insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
      AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
      AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter
      AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
      AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
      $result1=pg_query($conexion,$sql1);
      while($dats=pg_fetch_row($result1)){
        ?>
        <span class="badge badge-pill badge-info text-uppercase" data-toggle="tooltip" data-placement="top" title="Gasto hecho por: <?php echo '&nbsp;'. $dats[2].' '.$dats[3].'&nbsp;'.$dats[4].' '.$dats[5].'.' ?>"style="font-size: 0.7rem; margin: 5px;"><?php   echo $dats[0].".  Valor: ".$dats[1]."$"?></span><br>
        <?php
      } 

      $sql1="SELECT DISTINCT insumos.des_ins, utilizar.pin_tar,terceros.pno_ter, terceros.sno_ter, 
      terceros.pap_ter, terceros.sap_ter, stock.cod_sto
      FROM insumos, stock, registrar, compras, comprar, terceros, socio, unidad_de_medida, utilizar, otros
      WHERE otros.cod_ins = stock.cod_ins AND insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
      AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
      AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
      AND unidad_de_medida.cod_unm=insumos.cod_unm AND utilizar.cod_sto = stock.cod_sto
      AND utilizar.cod_tar='$ver[0]' ORDER BY  stock.cod_sto ASC";
      $result1=pg_query($conexion,$sql1);
      while($dats=pg_fetch_row($result1)){
        ?>
        <span class="badge badge-pill badge-info text-uppercase" data-toggle="tooltip" data-placement="top" title="Gasto hecho por: <?php echo '&nbsp;'. $dats[2].' '.$dats[3].'&nbsp;'.$dats[4].' '.$dats[5].'.' ?>"style="font-size: 0.7rem; margin: 5px;"><?php   echo $dats[0].".  Valor: ".$dats[1]."$"?></span><br>
        <?php
      }

      ?></td>
      <td><span style="border: dashed #2dce89; border-radius: 5px; padding: 4px; font-size: 1.1em; color: #2dce89;"><?php echo "$".$ver[2] ?></span></td>
      <td><?php echo $ver[10] ?></td>
      <td><?php echo  explode("-",$ver[7])[1]."<br>".$ver[8]." plantas<br> En lote: ".$ver[9]?></td>
      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a data-toggle="modal" data-target="#modal-convenios2" class="dropdown-item" href="#" onclick="edaddconvenios(' <?php  echo $datos ?> ')"><div><i class="fa fa-address-book" style="margin-right: 14px;"></i>Agregar convenios </div></a>
            <a data-toggle="modal" data-target="#modal-insumos2" class="dropdown-item" href="#" onclick="edaddinsumos(' <?php  echo $datos ?> ')"><div><i class="fa fa-glass" style="margin-right: 14px;"></i>Agregar insumos </div></a>
            <a data-toggle="modal" data-target="#modal-gastos2" class="dropdown-item" href="#" onclick="edaddgastos(' <?php  echo $datos ?> ')"><div><i class="fa fa-money" style="margin-right: 14px;"></i>Agregar gastos </div></a>
            <a class="divider" href="#" ></a>
            <a data-toggle="modal" data-target="#modal-editar" class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')"><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }

  ?>
</tbody>

<script>
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>
