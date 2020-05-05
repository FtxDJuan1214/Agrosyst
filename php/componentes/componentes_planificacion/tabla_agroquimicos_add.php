<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$info=$_POST['info'];    
$array = explode("||",$info);
$lenght=count($array) - 1;
?>



<div id="tab_agro" name="tab_agro">
    <div class="card shadow">
        <div class="card-header">
            <strong>Agroquímicos Agregados</strong>
        </div>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th style="width:30px">Nombre</th>
                    <th style="width:30px">Info</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for($i =0; $i<$lenght ; $i++){
                    $ver=explode(",", $array[$i]);
                    ?>
                <tr>
                    <td><?php echo $ver[1] ?></td>
                    <td><input type="button" name="cargar" class="btn btn-info sm-3" data-toggle="tooltip"
                            data-placement="top" title="<?php echo $ver[2] ?>" value="&#xf05a    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"></td>
                    <td>
                        <input type="button" name="cargar" class="btn btn-danger sm-3" data-toggle="tooltip"
                            data-placement="top" title="Quitar" value="&#xf00d    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                            onclick="rem_agr('<?php echo $ver[0] ?>')"></td>
                </tr>
                <?php
                }
                ?>
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