<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$etapas =$_POST['etapas']; 
?>

<div id="etapas-mostrarf">
    <p align='center'>Etapas de la planta afectadas agregadas:</p>
    <textarea id="eta_add" class="form-control" placeholder="Etapas Afectadas Agregadas" rows="2" readonly ><?php echo $etapas ?></textarea>
</div>