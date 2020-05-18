<?php
require '../../conexion.php';

session_start();
$like = $_SESSION['idusuario'];
$cod_eta=$_POST['cod_eta'];

?>



<div class="table-responsive" id="tabla_agroquimicos">

<div class="form-group" id="tab_mostrar" name="tab_mostrar">
    <table
        class="table align-items-center table-flush table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Nombre Agroquímico</th>
                <th scope="col">Tipo de agroquímico</th>
                <th scope="col">Asociar</th>
            </tr>
        </thead>
        <tbody id="myTable2">
            <?php 
    $sql = "";
    $datos="";

    //Si es prevención lo filtra
    if($cod_eta == '1-1'){

        $sql="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, tipo_agroquimico.det_tag
        FROM public.agroquimicos, public.tipo_agroquimico
        WHERE agroquimicos.cod_tag = tipo_agroquimico.cod_tag       
        AND agroquimicos.cod_agr NOT LIKE '1-1'
        AND (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
		AND fun_agr like 'Prevención'";

    }else{

    $sql="SELECT agroquimicos.cod_agr, agroquimicos.nom_agr, tipo_agroquimico.det_tag
        FROM public.agroquimicos, public.tipo_agroquimico
        WHERE agroquimicos.cod_tag = tipo_agroquimico.cod_tag       
        AND agroquimicos.cod_agr NOT LIKE '1-1'
        AND (agroquimicos.cod_agr LIKE '1-%' or agroquimicos.cod_agr LIKE '$like%')
		AND fun_agr NOT LIKE 'Prevención'";
    }

    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){  
        
    $datos=$ver[0]."||".
    $ver[1]."||";
    ?>
            <tr>
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2] ?></td>
                <td><input type="button" name="add"
                        class="btn btn-primary sm-3"
                        data-toggle="tooltip"
                        data-placement="left" title="Asociar"
                        value="&#xf0a5    "
                        style="font-family:'FontAwesome',tahoma; font-size: 10px;"
                        onclick="asociarFinal('<?php echo $ver[0]?>')">
                </td>
            </tr>
            <?php 
    }
    ?>
        </tbody>
    </table>
    <br>
</div>