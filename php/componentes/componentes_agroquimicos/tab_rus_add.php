<?php
require '../../conexion.php';
$cad = $_POST['cad'];
$array = explode("||",$cad);
$lenght = count($array)-1; 
?>
<div id="tab_rus_add" name="tab_rus_add">
    <div class="card-shadow">
        <div class="card-header">
<<<<<<< HEAD
            <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;" align="center">Recomendaciones Agregadas</h4>
=======
        <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;" align="center">Recomendaciones Agregadas</h4>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
        </div>
        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <td>Recomedación</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    for($i=0;$i<$lenght; $i++){
                    $ver=explode("~",$array[$i]);                                    
                ?>
                <tr>
                    <td>
                        <?php echo $ver[1];                                
                        ?>
                    </td>
                    <td>
<<<<<<< HEAD
                        <input type="button" name="add" class="btn btn-danger sm-3" data-toggle="tooltip"
                            value="&#xf00d" data-placement="top" title="Quitar"
=======
                        <input type="button" name="add" class="btn btn-danger sm-3" data-toggle="tooltip" value="&#xf00d"
                            data-placement="top" title="Quitar"
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                            style="font-family:'FontAwesome', tahoma; font-size:10px;"
                            onclick="rem_rus('<?php echo $ver[1]?>')">
                    </td>
                    <?php 
                        }
                    ?>

                </tr>
<<<<<<< HEAD
            </tbody>
        </table>
    </div>
</div>
=======
            </tbody>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
