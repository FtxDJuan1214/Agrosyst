<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_eta=$_POST['cod_eta'];    

?>



<div id="tab_agro" name="tab_agro">
    <div class="card shadow">
        <div class="card-header">
            <strong>Agroquímicos Recomendados</strong>
        </div>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th style="width:20px">Nombre</th>
                    <th style="width:20px">Dosis</th>
                    <th style="width:10px">Stock</th>
                    <th style="width:5px">Info</th>
                    <th style="width:5px">Agregar</th>
                </tr>
            </thead>
            <tbody>

                            <?php 
                                $query="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, ingredientes_activos.des_iac,
                                agroquimicos.dos_agr, agroquimicos.rap_agr, stock.can_sto, agr_x_iac.cod_eta, etapas_crecimiento.det_eta
                                FROM public.agroquimicos, public.stock, public.insumos, public.afeccion, public.etapas_crecimiento, 
                                public.agr_x_iac, public.eta_x_afe, public.ingredientes_activos
                                WHERE stock.cod_ins = insumos.cod_ins
                                AND insumos.cod_ins = agroquimicos.cod_ins 
                                AND agroquimicos.cod_agr = agr_x_iac.cod_agr
                                AND agr_x_iac.cod_afe = afeccion.cod_afe 
                                AND agr_x_iac.cod_eta = etapas_crecimiento.cod_eta
                                AND ingredientes_activos.cod_iac = agr_x_iac.cod_iac
                                AND afeccion.cod_afe = eta_x_afe.cod_afe
                                AND eta_x_afe.cod_eta = etapas_crecimiento.cod_eta
                                AND agr_x_iac.cod_eta ='$cod_eta'";
                                $result =pg_query($conexion,$query);
                                while ($ver=pg_fetch_row($result)) {
                            ?>
                <tr>
                    <td><?php echo $ver[1] ?></td>
                    <td><?php echo $ver[3] ?></td>
                    <td><?php echo $ver[5] ?></td>
                    <td><input type="button" name="info" class="btn btn-info sm-3" data-toggle="tooltip"
                            data-placement="top" title="<?php echo $ver[4] ?>" value="&#xf05a    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"></td>
                    <td><input type="button" name="add" class="btn btn-primary sm-3" data-toggle="tooltip"
                            data-placement="top" title="Agregar" value="&#xf0a5    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                            onclick="cargarTablaAdd('<?php echo $ver[0].'_'.$ver[1].'_'.$ver[2].'_'.$ver[3].'_'.$ver[4].'_'.$ver[5].'_'.$ver[6].'_'.$ver[7]?>')">
                    </td>

                    <?php 
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