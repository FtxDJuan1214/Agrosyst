<?php
require '../../conexion.php';

session_start();
$like = $_SESSION['idusuario'];
$cod_etapa =$_POST['cod_etapa']; 
$cod_afe =$_POST['cod_afe'];
?>      
                                         
<div class="form-group" id="tab_mostrar" name="tab_mostrar">
    <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;"
        align="center">Agroquímicos asociados por etapa</h4>
    <table
        class="table align-items-center table-flush table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col"><center>Nombre Agroquímico</center></th>
                <th scope="col"><center>Tipo de agroquímico</center></th>
                <th scope="col"><center>Eliminar</center></th>
            </tr>
        </thead>
        <tbody id="myTable1">
            <?php 
        $like = $_SESSION['idusuario'];
        $sql = "";
        

        $sql="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, tipo_agroquimico.det_tag
        FROM public.agroquimicos, public.eta_x_afe, public.tipo_agroquimico
        WHERE agroquimicos.cod_agr = eta_x_afe.cod_agr
        AND agroquimicos.cod_tag = tipo_agroquimico.cod_tag
        AND eta_x_afe.cod_eta = '$cod_etapa'
        AND eta_x_afe.cod_afe = '$cod_afe'
        AND agroquimicos.cod_agr NOT LIKE '1-1'";
        
        $result=pg_query($conexion,$sql);
        while($ver=pg_fetch_row($result)){  
            
        $datos=$ver[0]."||".
        $ver[1]."||";
        ?>
            <tr>
                <td><center><?php echo $ver[1] ?></center></td>
                <td><center><?php echo $ver[2] ?></center></td>
                <td><center>
                        <input type="button" name="cargar" class="btn btn-danger sm-3" data-toggle="tooltip"
                            data-placement="top" title="Quitar" value="&#xf00d    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                            onclick="eliminarAsociacion('<?php echo $ver[0] ?>')"></center></td>
                </tr>
            </tr>
            <?php 
        }
        ?>
        </tbody>
    </table>
    <br>
    <center>
    <input type="button" name="cargar" class="btn btn-success sm-4" id="<?php echo $cod_etapa ?>"
            data-toggle="tooltip" data-placement="top"
            title="Planificar otra tarea" value="Asociar"
            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
            onclick="asociar('<?php echo $cod_etapa ?>')">
</center>
</div>

<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>