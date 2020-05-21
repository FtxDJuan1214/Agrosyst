<?php
require '../../conexion.php';

session_start();
$like = $_SESSION['idusuario'];

$sql1="SELECT cod_agr FROM agroquimicos WHERE (cod_agr LIKE '$like%' or cod_agr LIKE '1-%')
order by regexp_split_to_array(cod_agr, E'\\-')::integer[]
DESC LIMIT 1";

$result=pg_query($conexion,$sql1);
$cod=pg_fetch_row($result);
$cod_agro="";
if($cod[0]){    
    $sep = explode("-", $cod[0]); 
    $cod_agro=$sep[1] + 1;
}else{
    $cod_agro='1';
}            
?>


<div class="containter-fluid" id="crear_agroquimicos">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
            <div class="col 12 ">
                <div class="card ">
                    <div class="card-body">
                        <div class="row d-block">
                            <div class="col">
                                <form role="form" id="form-add-agr">
                                    <div class="row">
                                        <!-----------------Primera columna---------------------->

                                        <div class="col-md-3">

                                            <!--Div Código-->
                                            <input type="text" class="form-control" id="cod_agr" readonly name="cod_agr"
                                            value="<?php echo  $cod_agro ?>" hidden>


                                            <!--Div Nombre Agroquímico-->
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="nom_agr" name="nom_agr" pattern="[A-Za-z0-9]{1,50}"
                                                placeholder="Nombre" required>

                                            </div>
                                            <!--Div Prentación-->
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="pre_agr" name="pre_agr" pattern="[A-Za-z0-9]{1,5}"
                                                data-toggle="tooltip" data-placement="left"
                                                title="Presentación de producto. Ejemplo: 1L"
                                                placeholder="Presentación" required>
                                            </div>

                                            <!--Div Ingredientes activos-->
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <select id="cod_iac" name="cod_iac" class="form-control"
                                                    data-live-search="true" data-toggle="tooltip"
                                                    data-placement="left" title="Composición del producto" required>
                                                    <option value="" disabled selected>Ingrediente
                                                    Activo</option>
                                                    <?php 
                                                    $query="SELECT cod_iac, des_iac FROM ingredientes_activos 
                                                    WHERE (cod_iac LIKE '$like%' or cod_iac LIKE '1-%')";
                                                    $result =pg_query($conexion,$query);
                                                    while ($ver=pg_fetch_row($result)) {
                                                        ?>
                                                        <option value="<?php echo $ver[0]; ?>">
                                                            <?php echo $ver[1];?></option>

                                                            <?php 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!--Div Tipo de agroquímico-->
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <select id="cod_tag" name="cod_tag" class="form-control"
                                                    data-live-search="true" required>
                                                    <option value="" disabled selected>Tipo de
                                                    agroquímico</option>
                                                    <?php 
                                                    $query="SELECT * FROM tipo_agroquimico";
                                                    $result =pg_query($conexion,$query);
                                                    while ($ver=pg_fetch_row($result)) {
                                                        ?>
                                                        <option value="<?php echo $ver[0]; ?>">
                                                            <?php echo $ver[1]; ?></option>

                                                            <?php 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!--Div Función-->
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <select id="fun_agr" name="fun_agr" class="form-control"
                                                    data-live-search="true" required>
                                                    <option value="" disabled selected>Función</option>
                                                    <option value="Curación">Curación</option>
                                                    <option value="Prevención">Prevención</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!--Div Tipo de Formulación-->
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <select id="cod_for" name="cod_for" class="form-control"
                                                data-live-search="true" required>
                                                <option value="" disabled selected>Formulación
                                                </option>
                                                <?php 
                                                $query="SELECT cod_for, nom_for, sig_for FROM formulacion";
                                                $result =pg_query($conexion,$query);
                                                while ($ver=pg_fetch_row($result)) {
                                                    ?>
                                                    <option value="<?php echo $ver[0]; ?>">
                                                        <?php echo $ver[1]." - ".$ver[2] ; ?></option>

                                                        <?php 
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-----------------Segunda columna---------------------->
                                    <div class="col-md-3">

                                        <!--Div Dosis-->
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="dos_agr" name="dos_agr" pattern="[A-Za-z0-9]{1,10}"
                                            data-toggle="tooltip" data-placement="left"
                                            title="Dosis recomendada a usar." placeholder="Ej: 00cc/Ha" required>
                                        </div>

                                        <!--Div Prohibido-->
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <select id="pro_agr" name="pro_agr" class="form-control"
                                                data-live-search="true" required>
                                                <option value="" disabled selected>¿Prohibido por
                                                ICA?</option>
                                                <option value="SI">Si</option>
                                                <option value="NO">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--Div Toxicidad-->
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <select id="cod_tox" name="cod_tox" class="form-control"
                                            data-live-search="true" required>
                                            <option value="" disabled selected>Nivel de
                                            Toxicidad</option>
                                            <?php 
                                            $query="SELECT * FROM toxicidad";
                                            $result =pg_query($conexion,$query);
                                            while ($ver=pg_fetch_row($result)) {
                                                ?>
                                                <option value="<?php echo $ver[0]; ?>">
                                                    <?php echo $ver[1]." - ".$ver[2]; ?></option>

                                                    <?php 
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!--Div Tipo Unidad de Medida-->
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <select id="tip_uni_med" name="tip_uni_med" class="form-control"
                                            data-live-search="true" required>
                                            <option value="" disabled selected>Tipo de medida
                                            </option>
                                            <?php 
                                            $query="SELECT cod_tum, des_tum FROM tipo_unidad_medida WHERE 
                                            cod_tum = '3'
                                            OR cod_tum = '4'";
                                            $result =pg_query($conexion,$query);
                                            while ($ver=pg_fetch_row($result)) {
                                                ?>
                                                <option value="<?php echo $ver[0]; ?>">
                                                    <?php echo $ver[1]; ?></option>

                                                    <?php 
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!--Div Unidad de Medida-->
                                    <div class="form-group" id="select2">
                                    </div>

                                    <!--Div Nombre Entrada-->
                                    <div class="form-group">

                                        <input type="number" class="form-control" id="pen_agr" name="pen_agr"
                                        data-toggle="tooltip" data-placement="left"
                                        title="Tiempo que debe transcurrir entre la última aplicación y el re ingreso de personas al cultivo."
                                        placeholder="Días de Entrada">

                                    </div>

                                    <!--Div Nombre Carencia-->
                                    <div class="form-group">

                                        <input type="number" class="form-control" id="pcr_agr" name="pcr_agr"
                                        data-toggle="tooltip" data-placement="left"
                                        title="Tiempo que debe transcurrir entre la última aplicación del producto y la cosecha."
                                        placeholder="Días de carencia">

                                    </div>

                                </div>
                                <!-----------------Tercera columna---------------------->
                                <div class="col-md-6">
                                    <!-----------------Div Detalle Insumo---------------------->
                                    <div class="form-group">
                                        <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                        align="center">Sugerencias de aplicacion</h4><br>
                                        <textarea data-toggle="tooltip" data-placement="left"
                                        title="Generalmente en la etiqueta viene esta sugerencia de aplicación, sí no, puede dejar el campo vacío."
                                        name="rap_agr" id="rap_agr" cols="18" rows="3"
                                        class="form-control"></textarea>
                                    </div>

                                    <!--div tabla agre--->
                                    <div class="form-group" id="tab_rus">
                                    </div>                                            
                                </div>

                                <div class="col-md-12">
                                    <!--div tabla agergar rus--->
                                    <div class="form-group" id="tab_rus_agre">
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <center>
                                        <button class="btn btn-danger" text style="font-family:'FontAwesome',tahoma; font-size: 11px;"
                                        data-toggle="tooltip" data-placement="left"
                                        title="Cancelar operacion" 
                                        onclick="cancelar();">Cancelar
                                    </button>
                                </center>
                            </div>
                            <div class="col-md-6">
                                <center>
                                    <button id="guardar_agrob" name="guardar_agrob" class="btn btn-success" 
                                    text style="font-family:'FontAwesome',tahoma; font-size: 11px;" 
                                    data-toggle="tooltip" data-placement="left" type="button"
                                    title="Guardar"
                                    onclick="guardar_agro();">Guardar
                                </button>
                            </center>
                        </div>                                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<script src="../js/funciones_agroquimicos.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

       $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
       
       $('#tip_uni_med').change(function() {
        recargarlista();
    });

       function recargarlista() {
        cod_tum = $('#tip_uni_med').val();
        $.ajax({
            type: "post",
            url: "../php/componentes/componentes_agroquimicos/unidad_med.php",
            data: "uni_med=" + cod_tum,
            success: function(r) {
                $('#select2').html(r);
            }
        });
    }
});
</script>