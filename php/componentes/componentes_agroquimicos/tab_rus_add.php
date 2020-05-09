<?php
require '../../conexion.php';
$cad = $_POST['cad'];
$array = explode("||",$cad);
$lenght = count($array)-1; 
?>
<div id="tab_rus_add" name="tab_rus_add">
    <div class="card-shadow">
        <div class="card-header">
            Recomendaciones agregadas
        </div>
        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <td>Recomedación</td>
                    <td>Quitar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                                    for($i=0;$i<$lenght; $i++){
                                        $ver=explode(",",$array[$i]);
                                    
                               ?>
                <tr>
                    <td>
                        <?php 
                                echo $ver[1];
                                
                                ?>

                    </td>
                    <td>
                        <input type="button" name="add" class="btn btn-info sm-3" data-toggle="tooltip" value="&#xf05a"
                            data-placement="top" title="Agregar"
                            style="font-family:'FontAwesome', tahoma; font-size:10px;"
                            onclick="rem_rus('<?php echo $ver[1]?>')">
                    </td>
                    <?php }
                                    ?>

                </tr>
            </tbody>