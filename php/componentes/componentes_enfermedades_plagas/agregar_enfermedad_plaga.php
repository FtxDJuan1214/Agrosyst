<?php
require '../../conexion.php';
?>



<div class="header-body">
    <!-- Card stats -->
    <div class="row">
        <div class="col 12 ">
            <div class="card ">
                <div class="card-body">
                    <div class="row d-block">
                        <div class="col">
                            <form role="form" id="form-solo" method="POST" enctype="multipart/form-data">
                                <div class="row">

                                    <!--------------------Primera Columna -------------------------->
                                    <div class="col-md-4">
                                        <!-----------------------------Horario de ataque------------------------->
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <select id="pla_o_enf" name="pla_o_enf" class="form-control"
                                                        data-live-search="true" onchange="cargar_select_tip()" required>
                                                        <option value="" disabled selected>Plaga/Enfermedad
                                                        </option>
                                                        <option value="Plaga">Plaga</option>
                                                        <option value="Enfermedad">Enfermedad</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!------------------------Seleccionar patogeno o tipo de plaga---------------------->
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative" id="sel_pat_tip" required>
                                            </div>
                                        </div>
                                        <!------------------------Nombre común Enfermedad o plaga---------------------->
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative" id="div_des_ins">
                                                <input style="border-color: #fb6340;" id="nom_afe" name="nom_afe"
                                                    type="text" class="form-control" placeholder="Nombre común"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Nombre de la enfermedad o plaga."
                                                    autocomplete="off" pattern="[A-Za-z]{6,30}" required>
                                            </div>
                                        </div>

                                        <!------------------------Nombre científico Enfermedad o plaga---------------------->
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative" id="div_des_ins">
                                                <input style="border-color: #fb6340;" id="nomc_afe" name="nomc_afe"
                                                    type="text" class="form-control" placeholder="Nombre científico"
                                                    autocomplete="off" pattern="[A-Za-z]{6,50}">
                                            </div>
                                        </div>
                                        <!-----------------------------Horario de ataque------------------------->
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <select id="horario" name="horario" class="form-control"
                                                        data-live-search="true" required>
                                                        <option value="" disabled selected>Horario
                                                            ataque
                                                        </option>
                                                        <option value="Madrugada">Madrugada</option>
                                                        <option value="Medio día">Medio día</option>
                                                        <option value="Atardecer">Atardecer</option>
                                                        <option value="Noche">Noche</option>
                                                        <option value="No Registra">No Registra</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-----------------------------Epoca de mayor ataque------------------------->
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <select id="epoca_a" name="epoca_a" class="form-control"
                                                        data-live-search="true" required>
                                                        <option value="" disabled selected>Epoca de
                                                            mayor ataque
                                                        </option>
                                                        <option value="Invierno">Invierno</option>
                                                        <option value="Verano">Verano</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--------------------Segunda Columna -------------------------->
                                    <div class="col-md-4">

                                        <!-----------------------------Partes afectadas de la planta------------------------->
                                        <div class="form-group mb-6">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success center-block"
                                                    data-toggle="modal" data-target="#modal-partes-afe" style="font-family:'FontAwesome',tahoma; font-size: 11px;" 
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Partes de la planta que son afectadas por la plaga o enfermedad.">Partes
                                                    Afectadas</button>

                                                <div id="partes-mostrar" class="card-header" data-toggle="tooltip" data-placement="top"
                                                    title="Partes de la planta que son afectadas por la plaga o enfermedad." required>
                                                </div>                                                
                                            </div>

                                            <!-----------------------------Etapa de la planta afectada------------------------->
                                            <br>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#modal-etapas-afe" style="font-family:'FontAwesome',tahoma; font-size: 11px;"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Etapas de la planta en la que son atacadas por la plaga o enfermedad.">Etapas
                                                    Afectadas</button>

                                                <div id="etapas-afe-mostrar" class="card-header" data-toggle="tooltip" data-placement="top"
                                                    title="Etapas de la planta en la que son atacadas por la plaga o enfermedad." required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success center-block"
                                                    data-toggle="modal" data-target="#modal-sintomas" style="font-family:'FontAwesome',tahoma; font-size: 11px;"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Sintomas que presenta la planta a cauda de la plaga o enfermedad.">Sintomas</button>

                                                <div id="sintomas-mostrar" class="card-header" data-toggle="tooltip" data-placement="top"
                                                    title="Sintomas que presenta la planta a cauda de la plaga o enfermedad." required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--------------------Tercera Columna -------------------------->
                                    <div class="col-md-4">
                                        <!--div tabla agre--->
                                        <div class="form-group" id="tab_rus">
                                        <div class="form-group" id="tab_met_pre" name="tab_met_pre" data-toggle="tooltip" data-placement="top"
                                            title="Recomendaciones que nos ayudan a recordarte como evitar la aparición de esta plaga o enfermedad. No es obligatorio.">
                                            <div class="card-shadow form-group">
                                                <div class="card-header">
                                                <p style="font-family:'FontAwesome',tahoma; font-size: 16px;"  align="center">Métodos de Prevención</P>
                                                </div>
                                                <table class="table align-items-center table-flush table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <td>Método</td>
                                                            <td>Agregar</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" hidden id="cod_agr_rus"
                                                                    name="cod_agr_rus">
                                                                <div>
                                                                    <input type="text" name="rus_agr" id="rus_agr"
                                                                        class="form-control">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="button" name="add"
                                                                    class="btn btn-success sm-3" data-toggle="tooltip"
                                                                    value="&#xf0a5" data-placement="top" title="Agregar"
                                                                    style="font-family:'FontAwesome', tahoma; font-size:10px;"
                                                                    onclick="cargarTablaAdd($('#cod_agr_rus').val()+'_'+$('#rus_agr').val())">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    

                                    <!--------------------------------Tabla Métodos de Prevención Agregados-------------------->
                                    <div class="col-md-12">
                                    <div class="form-group" id="tab_met_agre">
                                    </div>
                                    </div>
                                    <br>

                                    <!------------------------Columna Etapas plagas y enfermedades-----------------------
                                    <div class="col-md-5" hidden>
                                        <div class="form-group">
                                            <h3 align='center'>Etapas</h3>
                                            <p>Escoja todas las etapas de crecimiento que tiene la
                                                enfermedad o plaga:</p>
                                            <div class="input-group input-group-alternative">
                                                <select id="eta_sel" name="eta_sel" class="form-control"
                                                    data-live-search="true" onchange="mostrarTabEtapas()">
                                                    <option value="" disabled selected>Etapas
                                                    </option>
                                                    <?php 
                                                        $like = $_SESSION['idusuario'];
                                                        $sql="SELECT cod_eta, det_eta
                                                        FROM public.etapas_crecimiento where cod_eta LIKE '$like%' or cod_eta LIKE '1-%'";
                                                        $result=pg_query($conexion,$sql);
                                                        while($ver=pg_fetch_row($result)){ 
                                                        $datos=$ver[0]."||".
                                                        $ver[1]."||";
                                                        ?>
                                                    ?>
                                                    <option value="<?php echo $datos?>">
                                                        <?php echo $ver[1] ?></option>
                                                    <?php 
                                                                            }
                                                                            ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->

                                    <!------------------------Columna tabla etapas agregadas y pedir imagen----------------------->
                                    <div class="col-md-7">
                                        <div class="table-responsive" id="tab_eta_ima">

                                        </div>
                                    </div>
                                </div>
                                <!-------------------------------Botón Guardar------------------------->
                                <div class="row">    
                                    <div class="col-md-6">
                                        <br>
                                        <center>
                                            <input type="button" name="cargar" class="btn btn-danger sm-4"
                                                value="Cancelar"style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                                onclick="cancelar()">
                                        </center>  
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <center>
                                            <input type="button" name="cargarx" class="btn btn-primary sm-4"
                                                data-toggle="tooltip" data-placement="top" title="Etapas" value="Seguir"
                                                style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                                onclick="guardarEnfer_Plaga()">
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

<script>
$(document).ready(function(){
   $('#cod_agr').keyup(function(){
    var value = $(this).val();
    $('#cod_agr_rus').val(value);

   });
});
</script>