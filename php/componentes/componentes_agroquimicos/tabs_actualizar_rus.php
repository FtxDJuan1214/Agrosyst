<?php
require '../../conexion.php';
$cod_agr= $_POST['cod_agr'];
?>

<div class="col-md-12" id="dif">
    <div class="card-shadow">
        <div class="card-header">
            <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;" align="center">Recomendaciones Agregadas</h4>
        </div>
        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <td>Recomedación</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
            <?php $sql1="SELECT det_rus from recomendaciones_uso_agr where cod_agr='$cod_agr'";
                $result1=pg_query($conexion,$sql1);
                while($ver1=pg_fetch_row($result1)){
                    ?>
                <tr>                    
                    <td>
                    <textarea id="reco" name="reco"class="form-control" rows="2" onchange="actualizarRec('<?php echo $ver1[0] ?>')"><?php echo $ver1[0] ?></textarea>                    
                <br>
                    <td>
                        <input type="button" name="add" class="btn btn-danger sm-3" data-toggle="tooltip"
                            value="&#xf00d" data-placement="top" title="Quitar"
                            style="font-family:'FontAwesome', tahoma; font-size:10px;"
                            onclick="quitarRec('<?php echo $ver1[0] ?>')">
                    </td>
                    <?php 
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<div class="col-md-12">
    <div class="card-shadow form-group">
        <div class="card-header">
            <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;" align="center">Agregar Recomendaciones de Uso</h4>
        </div>
        <table class="table align-items-center table-flush table-hover" data-toggle="tooltip" data-placement="top"
            title="Recomendaciones que nos ayudan a recordarte a proteger tu salud. No es obligatorio.">
            <thead class="thead-light">
                <tr>
                    <td>Recomedación</td>
                    <td>Agregar</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" hidden id="cod_agr_rus" name="cod_agr_rus">
                        <div>
                            <textarea id="rus_agr" name="rus_agr" class="form-control" placeholder="...."
                                rows="4"></textarea>
                        </div>

                    </td>
                    <td>
                        <input type="button" name="add" class="btn btn-info sm-3" data-toggle="tooltip" value="&#xf0a5"
                            data-placement="top" title="Agregar"
                            style="font-family:'FontAwesome', tahoma; font-size:10px;"
                            onclick="agregarRec()">
                    </td>

                </tr>
            </tbody>

        </table>
    </div>
</div>