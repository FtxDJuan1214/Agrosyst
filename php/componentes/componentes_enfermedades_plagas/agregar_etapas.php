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
                            <form role="form" id="form-add-eta" method="POST" enctype="multipart/form-data">
                                <div class="row"> 
                                    <!------------------------Columna Etapas plagas y enfermedades----------------------->
                                    <div class="col-md-5">
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
                                    </div>

                                    <!------------------------Columna tabla etapas agregadas y pedir imagen----------------------->
                                    <div class="col-md-7">
                                        <div class="table-responsive" id="tab_eta_ima">

                                        </div>
                                    </div>
                                </div>
                                <!-------------------------------Botón Guardar------------------------->
                                <div class="col-md-6">
                                    <br>                                    
                                    <div class="float-md-right">

                                    <div class="float-md-right">
                                    <div id="etapas-des-mostrar" class="card-header">
                                    </div>

                                    </div>
                                    <br>
                                    <br>
                                        <input type="button" name="cargar" class="btn btn-primary sm-4"
                                            data-toggle="tooltip" data-placement="top" title="Terminar" value="Terminar"
                                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                            onclick="finalizarall()">

                                        <input type="text" name="listado_etapas" id="listado_etapas" hidden>
                                        <input type="text" name="listado_fotos" id="listado_fotos" hidden>

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
