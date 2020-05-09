<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$listado_etapas=$_POST['listado_etapas'];    
$listado_fotos=$_POST['listado_fotos']; 

$array = explode("||",$listado_etapas);
$lenght=count($array) - 1;

if($listado_fotos != ''){
$fotos = explode("||",$listado_fotos);
$cfotos=count($fotos) - 1;
}

$coincidir = false;
$indice = "";
?>



<div id="tab_agro" name="tab_agro">
    <div class="card shadow">
        <div class="card-header">
            <h3 align='center'>Etapas agregadas</h3>
        </div>

        <table class="table align-items-center table-flush" id="tab_ima">
            <thead class="thead-light">
                <tr>
                    <th>Nombre etapa</th>
                    <th>Imagen</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                        for($i =0; $i<$lenght; $i++){
                        $ver=explode("~", $array[$i]);
                        $coincidir = false;
                    ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td>
                        <!--Verifico si ya tiene imagen-->
                        <?php

                    if($listado_fotos != ''){
                        for($i =0; $i<$cfotos; $i++){
                            $comp=explode("~", $fotos[$i]);
                            if($comp[0] == $ver[0]){
                                $coincidir = true; 
                                $indice = $i;
                            break;                           
                            }                   
                        }
                        
                        if($coincidir == false){
                        ?>
                        <input id="<?php echo $ver[0] ?>" name="foto_eta" type="file" class="validate"
                            autocomplete="off" accept="image/*" onchange="validateFileType('<?php echo $ver[0] ?>')">
                    </td>

                    <?php }else
                        {
                        ?>
                    <?php echo $fotos[$indice] ?></td>

                    <?php 
                            }
                        }else{
                            ?>
                    <input id="<?php echo $ver[0] ?>" name="foto_eta" type="file" class="validate" autocomplete="off"
                        accept="image/*" onchange="validateFileType('<?php echo $ver[0] ?>')"></td>
                    <?php
                        }
                    ?>
                    <td> <input type="button" name="cargar" class="btn btn-danger sm-3" data-toggle="tooltip"
                            data-placement="top" title="Quitar" value="&#xf00d    "
                            style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                            onclick="remFila('<?php echo $ver[1] ?>')">

                    </td>
                </tr><?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>