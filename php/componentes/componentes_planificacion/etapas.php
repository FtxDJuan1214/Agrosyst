<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_enf_pla=$_POST['enf_o_plaga'];    
?>
<p>Por favor seleccione la etapa en la que está la enfermedad o plaga:</p>
<div id="etapas" name="etapas" class="input-group input-group-alternative" data-live-search="true">

    <?php
$query="SELECT afeccion.cod_afe, etapas_crecimiento.cod_eta, eta_x_afe.ima_eta
    FROM public.afeccion, public.etapas_crecimiento, public.eta_x_afe
    WHERE afeccion.cod_afe = eta_x_afe.cod_afe
    AND etapas_crecimiento.cod_eta = eta_x_afe.cod_eta
    AND afeccion.cod_afe='$cod_enf_pla'";

   $result =pg_query($conexion,$query);
   while ($ver=pg_fetch_row($result)) {
     ?>
    <label style="margin: 5px;">
        <input type="radio" name="test"  onclick="selectEtapa('<?php echo $ver[1] ?>')">
        <img src="../imagenes/<?php echo $ver[2] ?>" width="200">
    </label>
    
    <?php 
   }

?>
</div>