<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$pla_o_enf =$_POST['pla_o_enf']; 

if($pla_o_enf == 'Plaga'){
?>

<select id="sele_enf_pla1" name="sele_enf_pla1" class="form-control" data-live-search="true">
    <option value="" disabled selected>Escoja el tipo de plaga</option>
    <option value="Insecto">Insecto</option>
    <option value="Parasito">Parasito</option>
</select>
<?php 
}else if($pla_o_enf == 'Enfermedad'){
    ?>
    <select id="sele_enf_pla2" name="sele_enf_pla2" class="form-control" data-live-search="true">
        <option value="" disabled selected>Escoja el patogeno causante</option>
        <option value="Hongo">Hongo</option>
        <option value="Virus">Virus</option>
    </select>
    <?php 

}
?>