<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_enf_pla=$_POST['enf_o_plaga'];    
?>
<p>Por favor seleccione la etapa en la que está la enfermedad o plaga:</p>
<div id="etapas" name="etapas" class="input-group input-group-alternative" data-live-search="true" align="center">

    <?php
$query="SELECT DISTINCT afeccion.cod_afe, etapas_crecimiento.cod_eta, eta_x_afe.ima_eta, etapas_crecimiento.det_eta
    FROM public.afeccion, public.etapas_crecimiento, public.eta_x_afe
    WHERE afeccion.cod_afe = eta_x_afe.cod_afe
    AND etapas_crecimiento.cod_eta = eta_x_afe.cod_eta
    AND afeccion.cod_afe='$cod_enf_pla'
    AND (afeccion.cod_afe LIKE '1-%' or afeccion.cod_afe LIKE '$like%')";

   $result =pg_query($conexion,$query);
   while ($ver=pg_fetch_row($result)) {
       if($ver[3] != 'Prevención'){
<<<<<<< HEAD

        if($ver[2] != '' && $ver[2] != null){
            ?>
     
            <label align="center" style="margin: 15px;">
            <p align='center'><?php echo $ver[3] ?></p>
                <input type="radio" name="etapa" onclick="selectEtapa('<?php echo $ver[1] ?>')">
                <img src="../imagenes/<?php echo $ver[2] ?>" width="200">
            </label>
            
            <?php 



        }else{
=======
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
     ?>
     
    <label align="center" style="margin: 15px;">
    <p align='center'><?php echo $ver[3] ?></p>
        <input type="radio" name="etapa" onclick="selectEtapa('<?php echo $ver[1] ?>')">
<<<<<<< HEAD
        <img src="../imagenes/sinimagen.jpg" width="200">
    </label>
    
        <?php
         }
=======
        <img src="../imagenes/<?php echo $ver[2] ?>" width="200">
    </label>
    
    <?php 
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
   }
}

?>
</div>