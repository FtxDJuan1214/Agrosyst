<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_afe =$_POST['cod_afe']; 
$sintomas = "~";

$info="SELECT cod_sin FROM sin_x_afe, afeccion 
WHERE sin_x_afe.cod_afe=afeccion.cod_afe
AND sin_x_afe.cod_afe='$cod_afe'";  

    $result =pg_query($conexion,$info);
    while($ver=pg_fetch_row($result)){
        $sintomas = $sintomas.$ver[0].'~';
    }
?>


<div>
    <p align='center'>Por favor escoja los sintomas presentados por la
        planta a causa de
        la plaga o enfermedad en registro.</p>
    <?php 
        $like = $_SESSION['idusuario'];
        $sin = "SELECT cod_sin, det_sin
        FROM public.sintomas_afe
        WHERE cod_sin LIKE '$like%' or cod_sin LIKE '1-%'";
        $result=pg_query($conexion,$sin);
        $datos = "";
        $valores = "";

        while($ver=pg_fetch_row($result)){
            $datos = $datos."~".$ver[0];
            $valores = $valores."~".$ver[1];
        ?>
    <label>

<?php if(strpos($sintomas,$ver[0])){
    ?>
<input type="checkbox" name="<?php echo $ver[0] ?>" id="<?php echo $ver[0] ?>" name="<?php echo $ver[0] ?>" checked><?php echo $ver[1] ?>
<?php 
    }else{
?>
<input type="checkbox" name="<?php echo $ver[0] ?>" id="<?php echo $ver[0] ?>" name="<?php echo $ver[0] ?>"><?php echo $ver[1] ?>
<?php 
    } 
?>    
    </label><br>
    <?php 
        }
    ?>
</div>

<div class="text-center">
    <button type="button" class="btn btn-default my-4" id="btn_save3"
        style="font-family:'FontAwesome',tahoma; font-size: 11px;"
        onclick="actualizarSintomas('<?php echo $datos ?>','<?php echo $valores ?>');">Guardar</button>
</div>