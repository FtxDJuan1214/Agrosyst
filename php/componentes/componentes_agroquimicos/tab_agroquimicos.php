<?php
require '../../conexion.php';

session_start();
$user =  $_SESSION['idusuario'];

?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th style="width:10px">Nombre</th>
      <th style="width:20px">Tipo</th>
      <th style="width:20px">Función</th>
      <th style="width:20px">Ingrediete activo</th>
      <th style="width:20px">Formulación</th>
      <th style="width:20px">Per. Carencia</th>
      <th style="width:20px">Per. Entrada</th>
      <th style="width:20px">Prohibido por ICA</th> 
      <th style="width:20px">Unidad de medida</th>     
      <th style="width:20px">Toxicidad</th>

      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql="SELECT agroquimicos.cod_agr, agroquimicos.cod_ins, agroquimicos.nom_agr, 
    tipo_agroquimico.det_tag, agroquimicos.fun_agr, ingredientes_activos.des_iac, 
    formulacion.nom_for, formulacion.sig_for, agroquimicos.pcr_agr, agroquimicos.pen_agr, 
    agroquimicos.pro_agr, unidad_de_medida.des_unm, toxicidad.det_tox, 
    ingredientes_activos.cod_iac, tipo_agroquimico.cod_tag, formulacion.cod_for,
    agroquimicos.dos_agr, toxicidad.cod_tox,unidad_de_medida.cod_tum,
    insumos.cod_ins, insumos.des_ins, agroquimicos.rap_agr

    FROM agroquimicos
    INNER JOIN tipo_agroquimico on agroquimicos.cod_tag=tipo_agroquimico.cod_tag
    INNER JOIN ingredientes_activos on agroquimicos.cod_iac=ingredientes_activos.cod_iac
    INNER JOIN formulacion on agroquimicos.cod_for=formulacion.cod_for
    INNER JOIN insumos on agroquimicos.cod_ins=insumos.cod_ins
    INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
    INNER JOIN toxicidad ON agroquimicos.cod_tox=toxicidad.cod_tox
    WHERE (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$user%')
    ORDER BY agroquimicos.cod_agr"; 
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
     $ver[9]."||".
     $ver[10]."||".
     $ver[11]."||".
     $ver[12]."||".
     $ver[13]."||".
     $ver[14]."||".
     $ver[15]."||".
     $ver[16]."||".
     $ver[17]."||".
     $ver[18]."||".
     $ver[19]."||".
     $ver[20]."||".
     $ver[21]."||";
     ?>
     <tr>

      <td><?php echo $ver[2] ?></td>
      <td><?php echo $ver[3] ?></td>
      <td><?php echo $ver[4] ?></td>
      <td><?php echo $ver[5] ?></td>
      <td><?php echo $ver[6]." - ".$ver[7]?></td>
      <td><?php echo $ver[8]." hrs" ?></td>
      <td><?php echo $ver[9]." hrs" ?></td>
      <td><?php echo $ver[10] ?></td>
      <td><?php echo $ver[11] ?></td>
      <td><?php echo $ver[12] ?></td>
      <!--<td><?php $sql1="SELECT det_rus from recomendaciones_uso_agr where cod_agr='$ver[0]'";
                $result1=pg_query($conexion,$sql1);
                while($ver1=pg_fetch_row($result1)){
                  echo $ver1[0]; ?><br><?php
                  

                }
       ?></td>-->
      
      
       
      <td class="text-right">
        <div class="dropdown">
          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="#"  onclick="llenarform(' <?php  echo $datos ?> ')" ><div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div></a>
            <a class="dropdown-item" href="#" onclick="eliminar_agroquimico(' <?php  echo $datos ?> ')"  ><div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div></a>
          </div>
        </div>
      </td>
    </tr>
    <?php 
  }
  ?>
</tbody>