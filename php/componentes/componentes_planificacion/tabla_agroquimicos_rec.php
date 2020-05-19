<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_eta=$_POST['cod_eta']; 
$sep = explode('/',$cod_eta);//Uno codigo de la etapa -//Dos codigo de la enfermedad
$stock = "";

?>



<div id="tab_agro" name="tab_agro">
    <div class="card shadow">
        <div class="card-header">
            <strong><center>Agroquímicos Recomendados</center></strong>
        </div>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th style="width:20px"><center>Nombre</center></th>
                    <th style="width:20px"><center>Dosis</center></th>
                    <th style="width:10px"><center>Stock</center></th>
                    <th style="width:5px"><center>Info</center></th>
                    <th style="width:5px"><center>Agregar</center></th>
                </tr>
            </thead>
            <tbody>

                <?php 

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
                    <td><center><center><?php echo $ver[1] ?></center></td>
                    <td><center><center><?php echo $ver[3] ?></center></td>

                    <!--Aquí debo hacer otra consulta para el stock-->
                    <td><center><?php                     
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
                    ?></center></td>

                    <td><center><input type="button" name="info" class="btn btn-warning sm-3" data-toggle="tooltip"
                            data-placement="left" title="<?php echo 'Recomendación de aplicación: '.$ver[4] ?>" value="&#xf05a    "
                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"></center></td>
                    <td><center><input type="button" name="add" class="btn btn-dark sm-3" data-toggle="tooltip"
                            data-placement="left" value="&#xf0a5    "
                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$stock?>')">
                    </center></td>

                    <?php 
                                }
                            }else{

                                $query="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, ingredientes_activos.des_iac,
                                agroquimicos.dos_agr, agroquimicos.rap_agr
                                FROM public.agroquimicos, public.insumos, public.afeccion, public.etapas_crecimiento, 
                                public.eta_x_afe, public.ingredientes_activos
                                WHERE insumos.cod_ins = agroquimicos.cod_ins 
                                AND agroquimicos.cod_iac = ingredientes_activos.cod_iac
                                AND eta_x_afe.cod_afe = afeccion.cod_afe 
                                AND eta_x_afe.cod_eta = etapas_crecimiento.cod_eta
                                AND eta_x_afe.cod_agr = agroquimicos.cod_agr
                                AND eta_x_afe.cod_eta ='1-1'
                                AND agroquimicos.fun_agr = 'Prevención'
                                AND eta_x_afe.cod_afe = '$sep[1]'
								AND (eta_x_afe.cod_afe LIKE '1-%' or eta_x_afe.cod_afe LIKE '$like%') 
								AND (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
                                AND (etapas_crecimiento.cod_eta LIKE '1-%' or etapas_crecimiento.cod_eta LIKE '$like%')
                                AND agroquimicos.cod_agr NOT LIKE '1-1'";
                                $result =pg_query($conexion,$query);
                                while ($ver=pg_fetch_row($result)) {
                                    ?>
                <tr>
                    <td><center><?php echo $ver[0] ?></center></td>
                    <td><center><?php echo $ver[1] ?></center></td>
                    <td><center><?php echo $ver[3] ?></center></td>
                    <td><center><?php                     
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
                    ?></center></td>
                    <td><center><input type="button" name="info" class="btn btn-warning sm-3" data-toggle="tooltip"
                            data-placement="left" title="<?php echo 'Recomendación de aplicación: '.$ver[4] ?>" value="&#xf05a    "
                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"></center></td>
                    <td><center><input type="button" name="add" class="btn btn-dark sm-3" data-toggle="tooltip"
                            data-placement="left" value="&#xf0a5    "
                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$stock?>')">
                    </center></td>

                    <?php 

                            }
                        }
                            ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>