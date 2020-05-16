<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_eta=$_POST['cod_eta']; 
$sep = explode('/',$cod_eta);//Uno codigo de la etapa -//Dos codigo de la enfermedad
<<<<<<< HEAD
$stock = "";
=======

>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894

?>



<div id="tab_agro" name="tab_agro">
    <div class="card shadow">
        <div class="card-header">
            <strong>Agroquímicos Recomendados</strong>
        </div>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th style="width:20px">Codigo</th>
                    <th style="width:20px">Nombre</th>
                    <th style="width:20px">Dosis</th>
                    <th style="width:10px">Stock</th>
                    <th style="width:5px">Info</th>
                    <th style="width:5px">Agregar</th>
                </tr>
            </thead>
            <tbody>

                <?php 

<<<<<<< HEAD
                    if($sep[0] != "Prevención"){

                        $query="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, ingredientes_activos.des_iac,
                        agroquimicos.dos_agr, agroquimicos.rap_agr
                        FROM public.agroquimicos, public.insumos, public.afeccion, public.etapas_crecimiento, 
                        public.eta_x_afe, public.ingredientes_activos
                        WHERE insumos.cod_ins = agroquimicos.cod_ins 
                        AND agroquimicos.cod_iac = ingredientes_activos.cod_iac
                        AND eta_x_afe.cod_afe = afeccion.cod_afe 
                        AND eta_x_afe.cod_eta = etapas_crecimiento.cod_eta
                        AND eta_x_afe.cod_agr = agroquimicos.cod_agr
                        AND eta_x_afe.cod_eta ='$sep[0]' AND afeccion.cod_afe = '$sep[1]'
                        AND (eta_x_afe.cod_afe LIKE '1-%' or eta_x_afe.cod_afe LIKE '$like%') 
                        AND (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
                        AND agroquimicos.cod_agr NOT LIKE '1-1'";
                        
                        $result =pg_query($conexion,$query);
                        while ($ver=pg_fetch_row($result)) {
                            ?>
                <tr>
                    <td><?php echo $ver[0] ?></td>
                    <td><?php echo $ver[1] ?></td>
                    <td><?php echo $ver[3] ?></td>

                    <!--Aquí debo hacer otra consulta para el stock-->
                    <td><?php                     
                    $consulta1="SELECT stock.can_sto
                    FROM public.agroquimicos, public.stock, public.insumos
                    WHERE stock.cod_ins = insumos.cod_ins
                    AND insumos.cod_ins = agroquimicos.cod_ins 
                    AND agroquimicos.cod_agr = '$ver[0]'";
                    $result1=pg_query($conexion,$consulta1);
                    $filas1=pg_num_rows($result1);
                    $res=pg_fetch_row($result1);
                    if($filas1 > 0 ){
                        echo $res[0];
                        $stock= $res[0];
                    }else{
                        echo '0';
                        $stock='0';
                    }    
                    ?></td>

=======
                                if($sep[0] != "Prevención"){

                                $query="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, ingredientes_activos.des_iac,
                                agroquimicos.dos_agr, agroquimicos.rap_agr, stock.can_sto
                                FROM public.agroquimicos, public.stock, public.insumos, public.afeccion, public.etapas_crecimiento, 
                                public.eta_x_afe, public.ingredientes_activos
                                WHERE stock.cod_ins = insumos.cod_ins
                                AND insumos.cod_ins = agroquimicos.cod_ins 
                                AND agroquimicos.cod_iac = ingredientes_activos.cod_iac
                                AND eta_x_afe.cod_afe = afeccion.cod_afe 
                                AND eta_x_afe.cod_eta = etapas_crecimiento.cod_eta
                                AND eta_x_afe.cod_agr = agroquimicos.cod_agr
                                AND eta_x_afe.cod_eta ='$sep[0]' AND afeccion.cod_afe = '$sep[1]'
                                AND (eta_x_afe.cod_afe LIKE '1-%' or eta_x_afe.cod_afe LIKE '$like%') 
								AND (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')";
                                $result =pg_query($conexion,$query);
                                while ($ver=pg_fetch_row($result)) {
                            ?>
                <tr><td><?php echo $ver[0] ?></td>
                    <td><?php echo $ver[1] ?></td>
                    <td><?php echo $ver[3] ?></td>
                    <td><?php echo $ver[5] ?></td>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                    <td><input type="button" name="info" class="btn btn-info sm-3" data-toggle="tooltip"
                            data-placement="top" title="<?php echo $ver[4] ?>" value="&#xf05a    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"></td>
                    <td><input type="button" name="add" class="btn btn-primary sm-3" data-toggle="tooltip"
                            data-placement="top" title="Agregar" value="&#xf0a5    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
<<<<<<< HEAD
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$stock?>')">
=======
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$ver[5]?>')">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                    </td>

                    <?php 
                                }
                            }else{

                                $query="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, ingredientes_activos.des_iac,
<<<<<<< HEAD
                                agroquimicos.dos_agr, agroquimicos.rap_agr
                                FROM public.agroquimicos, public.insumos, public.afeccion, public.etapas_crecimiento, 
                                public.eta_x_afe, public.ingredientes_activos
                                WHERE insumos.cod_ins = agroquimicos.cod_ins 
=======
                                agroquimicos.dos_agr, agroquimicos.rap_agr, stock.can_sto
                                FROM public.agroquimicos, public.stock, public.insumos, public.afeccion, public.etapas_crecimiento, 
                                public.eta_x_afe, public.ingredientes_activos
                                WHERE stock.cod_ins = insumos.cod_ins
                                AND insumos.cod_ins = agroquimicos.cod_ins 
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                AND agroquimicos.cod_iac = ingredientes_activos.cod_iac
                                AND eta_x_afe.cod_afe = afeccion.cod_afe 
                                AND eta_x_afe.cod_eta = etapas_crecimiento.cod_eta
                                AND eta_x_afe.cod_agr = agroquimicos.cod_agr
<<<<<<< HEAD
                                AND eta_x_afe.cod_eta ='1-1'
=======
                                AND eta_x_afe.cod_eta ='1-0'
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                AND agroquimicos.fun_agr = 'Prevención'
                                AND eta_x_afe.cod_afe = '$sep[1]'
								AND (eta_x_afe.cod_afe LIKE '1-%' or eta_x_afe.cod_afe LIKE '$like%') 
								AND (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
<<<<<<< HEAD
                                AND (etapas_crecimiento.cod_eta LIKE '1-%' or etapas_crecimiento.cod_eta LIKE '$like%')
                                AND agroquimicos.cod_agr NOT LIKE '1-1'";
=======
								AND (etapas_crecimiento.cod_eta LIKE '1-%' or etapas_crecimiento.cod_eta LIKE '$like%')";
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                $result =pg_query($conexion,$query);
                                while ($ver=pg_fetch_row($result)) {
                                    ?>
                <tr>
                    <td><?php echo $ver[0] ?></td>
                    <td><?php echo $ver[1] ?></td>
                    <td><?php echo $ver[3] ?></td>
<<<<<<< HEAD
                    <td><?php                     
                    $consulta1="SELECT stock.can_sto
                    FROM public.agroquimicos, public.stock, public.insumos
                    WHERE stock.cod_ins = insumos.cod_ins
                    AND insumos.cod_ins = agroquimicos.cod_ins 
                    AND agroquimicos.cod_agr = '$ver[0]'";
                    $result1=pg_query($conexion,$consulta1);
                    $filas1=pg_num_rows($result1);
                    $res=pg_fetch_row($result1);
                    if($filas1 > 0 ){
                        echo $res[0];
                        $stock= $res[0];
                    }else{
                        echo '0';
                        $stock='0';
                    }    
                    ?></td>
=======
                    <td><?php echo $ver[5] ?></td>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                    <td><input type="button" name="info" class="btn btn-info sm-3" data-toggle="tooltip"
                            data-placement="top" title="<?php echo $ver[4] ?>" value="&#xf05a    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"></td>
                    <td><input type="button" name="add" class="btn btn-primary sm-3" data-toggle="tooltip"
                            data-placement="top" title="Agregar" value="&#xf0a5    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
<<<<<<< HEAD
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$stock?>')">
=======
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$ver[5]?>')">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                    </td>

                    <?php 

                            }
                        }
                            ?>
                </tr>
            </tbody>
        </table>

        <div style="display: flex; justify-content: center;">
            <!--<a style="align-self: center;" href="#" class="btn btn-success my-4"
                        onclick="comprar();">Agregar</a>
                    <a style="align-self: center;" href="compras.php" class="btn btn-warning my-4">Cancelar</a>-->

        </div>
    </div>
</div>

<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>