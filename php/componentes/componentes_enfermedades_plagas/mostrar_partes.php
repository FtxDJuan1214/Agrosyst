<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$partes =$_POST['partes']; 
?>

<div id="partes-mostrarf">
    <p align='center'>Partes afectadas de la planta
        agregadas:</p>

    <textarea readonly id="par_add" class="form-control" placeholder="Partes Afectadas Agregadas" rows="3"><?php echo $partes ?></textarea>
</div>