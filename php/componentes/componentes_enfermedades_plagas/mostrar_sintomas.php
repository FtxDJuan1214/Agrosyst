<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$sintomas =$_POST['sintomas']; 
$final ="";
if($sintomas[0] == ","){
    $final =substr($sintomas, 1);
}else{
    $final = $sintomas;
}

?>

<div id="sintomas-mostrarf">
<p align='center'>Sintomas agregados:</p>

<textarea readonly id="sin-add" class="form-control"
    placeholder="Sintomas Agregados"
    rows="2"><?php echo $final ?></textarea>
</div>