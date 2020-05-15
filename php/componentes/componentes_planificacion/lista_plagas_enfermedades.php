<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$enf_pla =$_POST['sele_enf_pla'];    
?>
<select id="enf_o_plaga" name="enf_o_plaga" class="form-control" data-live-search="true" onchange="cargar_etapas()">
    <option value="" disabled selected>Escoja la enfermedad o plaga</option>


    <?php
 if($enf_pla == 1){

      $query="SELECT afeccion.cod_afe,afeccion.nom_afe FROM public.afeccion, public.enfermedades
      WHERE afeccion.cod_afe = enfermedades.cod_afe AND (afeccion.cod_afe LIKE '1-%' or afeccion.cod_afe LIKE '$like%')";
    $result =pg_query($conexion,$query);
    while ($ver=pg_fetch_row($result)) {
      ?>
    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]?></option>
    <?php 
    }
 }else if($enf_pla == 2){

    $query="SELECT afeccion.cod_afe,afeccion.nom_afe FROM public.afeccion, public.plagas
    WHERE afeccion.cod_afe = plagas.cod_afe AND (afeccion.cod_afe LIKE '1-%' or afeccion.cod_afe LIKE '$like%')";
    $result =pg_query($conexion,$query);
    while ($ver=pg_fetch_row($result)) {
      ?>
    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]?></option>
    <?php 
    }

 }
?>
</select>