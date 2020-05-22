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

$infor="";
$name="";
?>



<div id="tab_agro" name="tab_agro">
<div class="alert alert-danger" role="alert"><center>
                        Por favor asegurese de cargar imagenes menores a un peso de: <strong>1000KB o 1MB</strong>.</center></div>
    <div class="card shadow">
        <div class="card-header">
            <h3 align='center' style="font-family:'FontAwesome',tahoma; font-size: 15px;">Etapas Agregadas</h3>
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
                        $infor=$ver[0];
                        $name=$ver[1];
                        $coincidir = false;
                    ?>

                <tr>
                    <td><?php echo $ver[1]?>
                    </td>
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
                        <input id="<?php echo $ver[0] ?>" name="<?php echo $ver[0] ?>" type="file" class="validate"
                            autocomplete="off" accept="image/*"
                            onchange="validateFileType('<?php echo $ver[0]?>','<?php echo $ver[1]?>')">

                            
                    </td>

                    <?php }else
                        {
                        ?>
                    <?php echo $fotos[$indice] ?></td>

                    <?php 
                            }
                        }else{
                            ?>
                    <input id="<?php echo $ver[0] ?>" name="<?php echo $ver[0] ?>" type="file" class="validate"
                        autocomplete="off" accept="image/*"
                        onchange="validateFileType('<?php echo $ver[0]?>','<?php echo $ver[1]?>')"></td>
                    <?php
                        }
                    ?>
                    <!----Borrar--->
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
    <br>
    
    <center>
    <input type="button" name="cargar" class="btn btn-success sm-4"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Planificar otra tarea" value="Guardar sin imagen"
                                                            style="font-family:'FontAwesome',tahoma; font-size: 12px;"
                                                            onclick="guardarSinImagen('<?php echo $infor ?>','<?php echo $name?>')">
</center>
</div>
