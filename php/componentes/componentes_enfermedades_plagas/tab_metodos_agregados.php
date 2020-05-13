<?php
require '../../conexion.php';
$cad = $_POST['cad'];
$array = explode("~",$cad);
$lenght = count($array)-1; 
?>
<div id="tab_rus_add" name="tab_rus_add">
    <div class="card-shadow">
        <div class="card-header">
        <p style="font-family:'FontAwesome',tahoma; font-size: 16px;"  align="center">Métodos Agregados</P>
        </div>
        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <td style="width:60px">Método Agregado</td>
                    <td style="width:10px"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    for($i=0;$i<$lenght; $i++){
                                                            
                 ?>
                <tr>
                    <td>
                        <?php 
                            echo $array[$i];                                
                            ?>
                    </td>
                    <td>
                        <input type="button" name="add" class="btn btn-danger sm-3" data-toggle="tooltip" value="&#xf00d"
                            data-placement="rigth" title="Agregar"
                            style="font-family:'FontAwesome', tahoma; font-size:10px;"
                            onclick="rem_rus('<?php echo $array[$i]?>')">
                    </td>
                    <?php }
                        ?>
                </tr>
            </tbody>