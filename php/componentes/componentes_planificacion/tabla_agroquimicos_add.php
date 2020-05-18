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
            <strong><center>Agroquímicos Agregados</center></strong>
        </div>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th style="width:30px"><center>Nombre</center></th>
                    <th><center>Quitar</center></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for($i =0; $i<$lenght ; $i++){
                    $ver=explode(",", $array[$i]);
                    ?>
                <tr>
                    <td><center><?php echo $ver[1] ?></center></td>                    
                    <td><center>
                        <input type="button" name="cargar" class="btn btn-danger sm-3" data-toggle="tooltip"
                        data-placement="left" title="Quitar" value="&#xf00d    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                            onclick="rem_agr('<?php echo $ver[0] ?>')"></center></td>
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