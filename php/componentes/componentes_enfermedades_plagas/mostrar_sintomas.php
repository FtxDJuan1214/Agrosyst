<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$sintomas =$_POST['sintomas']; 
?>

<div id="sintomas-mostrarf">
<p align='center'>Sintomas agregados:</p>

<textarea readonly id="sin-add" class="form-control"
    placeholder="Sintomas Agregados"
    rows="3"><?php echo $sintomas ?></textarea>
</div>