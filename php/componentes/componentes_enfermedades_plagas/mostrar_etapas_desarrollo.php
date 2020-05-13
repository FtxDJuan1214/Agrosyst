<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$listado_etapas_agregadas =$_POST['listado_etapas_agregadas']; 
?>

<div id="etapas-mostrarf">
    <p align='center'>Etapas Agregadas: <?php echo $listado_etapas_agregadas ?></p>
    
</div>