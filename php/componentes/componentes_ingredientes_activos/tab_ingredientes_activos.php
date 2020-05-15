<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col"><center>Nombre</center></th>
      <th scope="col"><center>¿Prohibido ICA?</center></th>
      <th><center>Agroquímicos</center></th>
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

      <td><center><?php echo $ver[1] ?></center></td>
      <td><center><?php echo $ver[2] ?></center></td>
      <td>
      <?php $sql1="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr FROM public.agroquimicos
      WHERE (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
	    AND cod_agr NOT LIKE '1-1' 
      AND agroquimicos.cod_iac = '$ver[0]'";
            $result1=pg_query($conexion,$sql1);
            while($ver1=pg_fetch_row($result1)){


//-----------------Infon del agroquímico------------------------//

    $info ="SELECT agroquimicos.nom_agr,tipo_agroquimico.det_tag, agroquimicos.fun_agr, 
    formulacion.nom_for, formulacion.sig_for, toxicidad.det_tox, agroquimicos.cod_agr
    FROM agroquimicos
    INNER JOIN tipo_agroquimico on agroquimicos.cod_tag=tipo_agroquimico.cod_tag
    INNER JOIN ingredientes_activos on agroquimicos.cod_iac=ingredientes_activos.cod_iac
    INNER JOIN formulacion on agroquimicos.cod_for=formulacion.cod_for
    INNER JOIN insumos on agroquimicos.cod_ins=insumos.cod_ins
    INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
    INNER JOIN toxicidad ON agroquimicos.cod_tox=toxicidad.cod_tox
    WHERE (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
	  AND cod_agr NOT LIKE '1-1'
    AND cod_agr = '$ver1[0]'";
    $resul=pg_query($conexion,$info);
    $res=pg_fetch_row($resul);

    $dos ="SELECT DISTINCT afeccion.nom_afe FROM public.afeccion, public.eta_x_afe, public.agroquimicos
    WHERE afeccion.cod_afe = eta_x_afe.cod_afe AND agroquimicos.cod_agr = eta_x_afe.cod_agr
    AND eta_x_afe.cod_agr = '$res[6]'";
    $resuld=pg_query($conexion,$dos);

      ?>   
       <center>

              
          <span class="badge badge-pill badge-warning text-uppercase"  data-toggle="tooltip" data-html="true" 
           data-placement="right" title="<ul class='list-group'>
          <li class='list-group-item-info text-light' style='background: #000; color: #fff'>
          <center><b>Nombre:</b> <?php echo $res[0].'.' ?><center>
          <b>Tipo:</b> <?php echo $res[1].'.' ?><br>
          <b>Función:</b> <?php echo $res[2].'.' ?><br>
          <b>Formulación:</b> <?php echo $res[3].'.' ?><br>
          <b>Toxicidad:</b> <?php echo $res[5].'.' ?><br>
          </li>
          <li class='list-group-item text-light' style='background: #000; color: #fff' >
            <br><b>Enfermedad/Plaga:</b><br>
            <?php while($imp=pg_fetch_row($resuld)){?>
            • <?php echo $imp[0].'.'; }?><br>
           </li>           
        </ul>" style="font-size: 0.7rem; margin: 5px;"><?php echo $ver1[1] ?></span><br>
      </center>
      <?php
            }
            ?>
      </td>
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
<script>
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>