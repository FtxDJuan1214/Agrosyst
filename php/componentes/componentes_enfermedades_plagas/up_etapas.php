<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$etapas =$_POST['etapas']; 

?>


<p align='center'>Por favor escoja todas las etapas de la planta en las
    que
    son afectadas
    por la plaga o enfermedad en registro.</p>
<label>
<?php if(strpos($etapas,'Crecimiento')){?>
<input type="checkbox" name="vegetativo" id="vegetativo" name="vegetativo" checked>Crecimiento
<?php 
    }else{
?>
<input type="checkbox" name="vegetativo" id="vegetativo" name="vegetativo">Crecimiento
<?php 
    } 
?>  
</label><br>
<label>
<?php if(strpos($etapas,'Inicio floracion')){?>
<input type="checkbox" name="ifloracion" id="ifloracion" name="ifloracion" checked>Inicio de floracion
<?php 
    }else{
?>
<input type="checkbox" name="ifloracion" id="ifloracion" name="ifloracion">Inicio de floracion
<?php 
    } 
?>  
</label><br>
<label>
<?php if(strpos($etapas,'Maxima floracion')){?>
<input type="checkbox" name="mfloracion" id="mfloracion" name="mfloracion" checked>Maxima floracion
<?php 
    }else{
?>
<input type="checkbox" name="mfloracion" id="mfloracion" name="mfloracion">Maxima floracion
<?php 
    } 
?>  
</label><br>
<label>
<?php if(strpos($etapas,'Fructificacion')){?>
<input type="checkbox" name="fructificacion" id="fructificacion" name="fructificacion" checked>Inicio de fructificacion
<?php 
    }else{
?>
<input type="checkbox" name="fructificacion" id="fructificacion" name="fructificacion">Inicio de fructificacion
<?php 
    } 
?>  
</label><br>
<label>
<?php if(strpos($etapas,'Cosecha')){?>
<input type="checkbox" name="cosecha" id="cosecha" name="cosecha" checked>Cosecha
<?php 
    }else{
?>
<input type="checkbox" name="cosecha" id="cosecha" name="cosecha">Cosecha
<?php 
    } 
?> 
</label>

<div class="text-center">
    <button type="button" class="btn btn-default my-4" id="btn_save2" onclick="actualizarEtapas();"
        style="font-family:'FontAwesome',tahoma; font-size: 11px;">Actualizar</button>
</div>