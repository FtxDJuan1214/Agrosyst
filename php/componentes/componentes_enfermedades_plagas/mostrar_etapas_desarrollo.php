<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$listado_etapas_agregadas =$_POST['listado_etapas_agregadas']; 
?>

<div id="etapas-mostrarf">
    <p align='center'>Etapas Agregadas:</p>
    <textarea id="eta_add" class="form-control" placeholder="Etapas Afectadas Agregadas" rows="2" readonly ><?php echo $listado_etapas_agregadas ?></textarea>
</div>