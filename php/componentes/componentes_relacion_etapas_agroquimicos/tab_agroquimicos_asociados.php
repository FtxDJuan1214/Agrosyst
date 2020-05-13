<?php
require '../../conexion.php';

session_start();
$like = $_SESSION['idusuario'];
$cod_etapa =$_POST['cod_etapa']; 
?>      
                                         
<div class="form-group" id="tab_mostrar" name="tab_mostrar">
    <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;"
        align="center">Agroquímicos asociados por etapa</h4>
    <table
        class="table align-items-center table-flush table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Nombre Agroquímico</th>
                <th scope="col">Tipo de agroquímico</th>
                <th scope="col">Eliminar</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php 
        $like = $_SESSION['idusuario'];
        $sql = "";
        

        $sql="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, tipo_agroquimico.det_tag
        FROM public.agroquimicos, public.eta_x_afe, public.tipo_agroquimico
        WHERE agroquimicos.cod_agr = eta_x_afe.cod_agr
        AND agroquimicos.cod_tag = tipo_agroquimico.cod_tag
        AND eta_x_afe.cod_eta = '$cod_etapa'
        AND agroquimicos.cod_agr not like '1-1'";
        
        $result=pg_query($conexion,$sql);
        while($ver=pg_fetch_row($result)){  
            
        $datos=$ver[0]."||".
        $ver[1]."||";
        ?>
            <tr>
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2] ?></td>
                <td>
                        <input type="button" name="cargar" class="btn btn-danger sm-3" data-toggle="tooltip"
                            data-placement="top" title="Quitar" value="&#xf00d    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                            onclick="eliminarAsociacion('<?php echo $ver[0] ?>')"></td>
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