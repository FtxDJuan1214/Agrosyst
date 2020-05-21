<?php
require '../../conexion.php';
?>
<style>
/*-------------------------------------------------------------------*/

/* Rating Star Widgets Style */
.rating-stars ul {
    list-style-type: none;
    padding: 0;

    -moz-user-select: none;
    -webkit-user-select: none;
}

.rating-stars ul>li.star {
    display: inline-block;

}

/* Idle State of the stars */
.rating-stars ul>li.star>i.fa {
    font-size: 2.5em;
    /* Change the size of the stars */
    color: #ccc;
    /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul>li.star.hover>i.fa {
    color: #FFCC36;
}

/* Selected state of the stars */
.rating-stars ul>li.star.selected>i.fa {
    color: #FF912C;


}
</style>
<table class="table align-items-center table-dark table-flush table-hover">
    <thead class="thead-dark">
        <tr>
            <!--<th scope="col">Codigo Tarea</th>
      <th scope="col">Codigo Planificación</th>
      <th scope="col">Codigo Tarea</th>-->
            <th>
                <center>Nombre Afeccion - Cultivo</center>
            </th>
            <th>
                <center>Nombre Labor</center>
            </th>
            <th>
                <center>Calificación de la labor</center>
            </th>
            <th>
                <center>Fecha</center>
            </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
    session_start();
    $like = $_SESSION['idusuario'];

    $sql="SELECT DISTINCT afeccion.nom_afe,
    procesos_fitosanitarios.fin_pfi, procesos_fitosanitarios.cod_pfi, nombre_cultivo.des_ncu, cultivos.cod_cul
    FROM fitosanitaria 
    INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
    INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
    INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
    INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
    INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
    INNER JOIN convenio ON efectuar.cod_con = convenio.cod_con
    INNER JOIN ejecutar ON ejecutar.cod_con = convenio.cod_con
    INNER JOIN cultivos ON cultivos.cod_cul = ejecutar.cod_cul
    INNER JOIN nombre_cultivo ON nombre_cultivo.cod_ncu = cultivos.cod_ncu
    WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
    AND procesos_fitosanitarios.ffi_pfi IS null
    ORDER BY afeccion.nom_afe ASC"; 
     $result=pg_query($conexion,$sql);   
    
    while($ver=pg_fetch_row($result)){          

     $sep = explode("-",$ver[3]);

     $datos=$ver[4]."||".
           $ver[2]."||".
           $sep[1]."||";


//-------------------Centrales----------------------------//
    $tar = "SELECT fitosanitaria.cod_fit, labores.nom_lab, labores.det_lab, 
    fitosanitaria.cal_fit, tarea.fin_tar, tarea.cod_tar
    FROM fitosanitaria 
    INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
    INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
    INNER JOIN labores ON tarea.cod_lab = labores.cod_lab
    INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
    INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
    INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
    INNER JOIN convenio ON efectuar.cod_con = convenio.cod_con
    INNER JOIN ejecutar ON ejecutar.cod_con = convenio.cod_con
    INNER JOIN cultivos ON cultivos.cod_cul = ejecutar.cod_cul
    WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
    AND procesos_fitosanitarios.ffi_pfi IS null
    AND cultivos.cod_cul = '$ver[4]'
    AND fitosanitaria.aoi_fit IS NOT NULL
    AND procesos_fitosanitarios.cod_pfi = '$ver[2]'";

    $tar1=pg_query($conexion,$tar);
    $tar2=pg_query($conexion,$tar);
    $tar3=pg_query($conexion,$tar);
    $tar4=pg_query($conexion,$tar);
    $tar5=pg_query($conexion,$tar);
    $resC=pg_num_rows($tar5);
//-----------------------------------------------------------------//

     ?>
        <tr>
        <?php if($resC!=0){?>
            <td data-toggle="tooltip" data-html="true" data-placement="left"
                title="Presente desde: <?php  echo $ver[1].' Hasta: '. $ver[4] ?>"><?php echo $ver[0].' - '.$sep[1] ?>
            </td>
            <td><br><?php 
  
            while($tareas=pg_fetch_row($tar1)){             
                echo $tareas[1] ?> <br><br><br>
                <?php
            }
            ?>
            </td>
            <td><br>
                <?php 
  
            while($tareas=pg_fetch_row($tar2)){ 
                ?>
                <div class='rating-stars'>
                    <ul id='stars'>
                        <?php if($tareas[3] != null){ 
                            ?>
                        <li data-toggle="tooltip" data-html="true" class='star selected' data-placement="left" title='Inservible'
                            data-value='1'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li data-toggle="tooltip" data-html="true" class='star' title='Inservible' data-value='1'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }
                        ?>

                        <?php if($tareas[3] > '1'){ 
                            ?>
                        <li data-toggle="tooltip" data-html="true" class='star selected' data-placement="left" title='Poco Efectiva'
                            data-value='2'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li data-toggle="tooltip" data-html="true" class='star' title='Poco Efectiva' data-value='2'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }
                        ?>


                        <?php if($tareas[3] > '2'){ 
                            ?>
                        <li data-toggle="tooltip" data-html="true" class='star selected' data-placement="left" title='Aceptable'
                            data-value='3'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li data-toggle="tooltip" data-html="true" class='star' title='Aceptable' data-value='3'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }
                        ?>

                        <?php if($tareas[3] > '3'){ 
                            ?>
                        <li data-toggle="tooltip" data-html="true" class='star selected' data-placement="left" title='Efectiva'
                            data-value='4'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li data-toggle="tooltip" data-html="true" class='star' title='Efectiva' data-value='4'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }
                        ?>


                        <?php if($tareas[3] > '4'){ 
                            ?>
                        <li data-toggle="tooltip" data-html="true" class='star selected' data-placement="left" title='Muy Efectiva'
                            data-value='5'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li data-toggle="tooltip" data-html="true" class='star' title='Muy Efectiva' data-value='5'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"></i>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <br>
                <?php
            }
            ?>
            </td>
            <td><br>
                <?php   
            while($tareas=pg_fetch_row($tar3)){                 
            echo $tareas[4]?> <br><br><br>
                <?php
            }
            ?>
            </td>
            <td>
                <?php 
            while($tareas=pg_fetch_row($tar4)){ 
                
                $agro = "SELECT tarea.cod_tar,utilizar.cod_sto, stock.cod_ins, insumos.des_ins, agroquimicos.nom_agr
                FROM fitosanitaria 
                INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
                INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
                INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
                INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
                INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
                INNER JOIN utilizar ON utilizar.cod_tar = tarea.cod_tar
                INNER JOIN stock ON utilizar.cod_sto = stock.cod_sto
                INNER JOIN insumos ON insumos.cod_ins = stock.cod_ins
                INNER JOIN agroquimicos ON insumos.cod_ins = agroquimicos.cod_ins
                WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
                AND tarea.cod_tar = '$tareas[5]'";
                $quimicos=pg_query($conexion,$agro);
                $listado=""; 
                while($ragro=pg_fetch_row($quimicos)){ 

                $listado = $listado.'• '.$ragro[4];
                //echo $ragro[3]?>
                <?php
                    }
                    ?>
                <center>
                    <span class="badge badge-pill badge-secondary text-uppercase" data-toggle="tooltip" data-html="true" data-placement="left"
                        title="<ul class='list-group'>
                <li class='list-group-item text-dark' style='background: #fff; color: #fff'>
                <?php echo $listado ?>
                </li>           
                </ul>" style="font-size: 0.7rem; margin: 5px;">Agroquímicos</span><br>
                </center>
                <br>
                <?php            
                    }
                    ?>
            </td>
            <td>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary center-block" data-toggle="tooltip"
                        data-placement="left"
                        title="Ver comentarios sobre el avance de este proceso fitosanitario"
                        style="font-family:'FontAwesome',tahoma; font-size: 9px;"
                        onclick="modalComentariosVer(' <?php  echo $ver[2] ?> ')">Comentarios</button>
                    <div id="sintomas-mostrar">
                    </div>
                </div>
            </td>
            <td class="text-right">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        
                       <a class="dropdown-item" href="#" onclick="informe(' <?php  echo $datos ?> ')">
                            <div><i class="fas fa-envelope-open-text" style="margin-right: 14px;"></i>Descargar informe</div>
                        </a>
                        
                    </div>
                </div>
            </td>
        </tr>
        <?php   
        }
    }
  ?>
    </tbody>
</table>



<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>