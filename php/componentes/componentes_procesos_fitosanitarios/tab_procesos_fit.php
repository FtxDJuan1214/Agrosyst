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
<table class="table align-items-center table-flush table-hover">
    <thead class="thead-light">
        <tr>
            <!--<th scope="col">Codigo Tarea</th>
      <th scope="col">Codigo Planificación</th>
      <th scope="col">Codigo Tarea</th>-->
            <th>Nombre Afeccion - Cultivo</th>
            <th>Fecha Inicio</th>
            <th>Nombre Labor</th>
            <th>Calificación de la labor</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
    session_start();
    $like = $_SESSION['idusuario'];

    $sql="SELECT DISTINCT fitosanitaria.cod_fit, planificacion.cod_pla, tarea.cod_tar, afeccion.nom_afe,
    procesos_fitosanitarios.fin_pfi, labores.nom_lab, labores.det_lab, 
    planificacion.agr_pla, procesos_fitosanitarios.cod_pfi, fitosanitaria.cal_fit, nombre_cultivo.des_ncu
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
    INNER JOIN nombre_cultivo ON nombre_cultivo.cod_ncu = cultivos.cod_ncu
    WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
    AND procesos_fitosanitarios.ffi_pfi IS null
    ORDER BY afeccion.nom_afe ASC"; 
    
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
     $ver[10]."||";

     $sep = explode("-",$ver[10]);

     ?>
        <tr>
            <td><?php echo $ver[3].' - '.$sep[1] ?></td>
            <td><?php echo $ver[4] ?></td>
            <td><?php echo $ver[5] ?></td>
            <td>
                <div class='rating-stars'>
                    <ul id='stars'>
                        <?php if($ver[9] != null){ 
                            ?>
                        <li class='star selected' title='Inservible' data-value='1'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*1' ?>')"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class='star' title='Inservible' data-value='1'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*1' ?>')"></i>
                        </li>
                        <?php
                        }
                        ?>

                        <?php if($ver[9] > '1'){ 
                            ?>
                        <li class='star selected' title='Poco Efectiva' data-value='2'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*2' ?>')"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class='star' title='Poco Efectiva' data-value='2'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*2' ?>')"></i>
                        </li>
                        <?php
                        }
                        ?>


                        <?php if($ver[9] > '2'){ 
                            ?>
                        <li class='star selected' title='Aceptable' data-value='3'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*3' ?>')"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class='star' title='Aceptable' data-value='3'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*3' ?>')"></i>
                        </li>
                        <?php
                        }
                        ?>

                        <?php if($ver[9] > '3'){ 
                            ?>
                        <li class='star selected' title='Efectiva' data-value='4'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*4' ?>')"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class='star' title='Efectiva' data-value='4'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*4' ?>')"></i>
                        </li>
                        <?php
                        }
                        ?>


                        <?php if($ver[9] > '4'){ 
                            ?>
                        <li class='star selected' title='Muy Efectiva' data-value='5'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*5' ?>')"></i>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class='star' title='Muy Efectiva' data-value='5'>
                            <i class='fa fa-star fa-fw' style="font-size:20px;"
                                onclick="calificar('<?php  echo $ver[0].'*5' ?>')"></i>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>

            </td>
<<<<<<< HEAD
            <!--<td><button type="button" class="btn btn-success center-block" data-toggle="tooltip"
                    title="Ver, editar y eliminar comentarios sobre el avance de este proceso fitosanitario"
                    style="font-family:'FontAwesome',tahoma; font-size: 10px;">Información</button></td>-->
=======
            <td><button type="button" class="btn btn-success center-block" data-toggle="tooltip"
                    title="Ver, editar y eliminar comentarios sobre el avance de este proceso fitosanitario"
                    style="font-family:'FontAwesome',tahoma; font-size: 10px;">Información</button>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
            <td>
                <div class="text-center">
                    <button type="button" class="btn btn-dark center-block" data-toggle="tooltip"
                        title="Ver, editar y eliminar comentarios sobre el avance de este proceso fitosanitario"
                        style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                        onclick="modalComentarios(' <?php  echo $ver[8] ?> ')">Comentarios</button>

                    <div id="sintomas-mostrar">
                    </div>
                </div>
            </td>
            <td>
                <div class="text-center">
                    <button type="button" class="btn btn-danger center-block" data-toggle="tooltip"
                        title="Ver, editar y eliminar comentarios sobre el avance de este proceso fitosanitario"
                        style="font-family:'FontAwesome',tahoma; font-size: 10px;"
<<<<<<< HEAD
                        onclick="terminarProceso(' <?php  echo $ver[8] ?> ','<?php  echo $ver[9] ?>')">Terminar proceso</button>
=======
                        onclick="modalComentarios(' <?php  echo $ver[8] ?> ')">Terminar proceso</button>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894

                    <div id="sintomas-mostrar">
                    </div>
                </div>
            </td>

        </tr>
        <?php   }
  ?>
    </tbody>
</table>



<script>
$(document).ready(function() {

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function() {
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function() {
        $(this).parent().children('li.star').each(function(e) {
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li').on('click', function() {
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        } else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);

    });


});


function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>