<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$tip_tar =$_POST['tip_tar']; 

if($tip_tar == 'Curación' || $tip_tar == 'Prevención'){
?>

<select id="sele_enf_pla" name="sele_enf_pla" class="form-control" data-live-search="true"  onchange="cargar_enfermedades_plagas()">
    <option value="" disabled selected>Escoja la enfermedad o plaga</option>
    <option value="" disabled selected>¿Enfermedad o Plaga?</option>
    <option value="1">Enfermedad</option>
    <option value="2">Plaga</option>
</select>
<?php 
}
?>