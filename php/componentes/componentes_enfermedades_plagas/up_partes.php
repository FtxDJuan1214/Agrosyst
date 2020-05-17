
<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_afe =$_POST['cod_afe']; 
$etapas = "";

$info="SELECT partes_planta_afe.det_par FROM public.partes_planta_afe, public.afeccion
WHERE partes_planta_afe.cod_afe = afeccion.cod_afe
AND partes_planta_afe.cod_afe = '$cod_afe'";  

    $result =pg_query($conexion,$info);
    while($ver=pg_fetch_row($result)){
        $etapas = $etapas.'-'.$ver[0];
    }
?>


<p align='center'>Por favor escoja todas las partes que son afectadas
    por la plaga o enfermedad en registro.</p>
<label>
<?php if(strpos($etapas,'Frutos')){?>
<input type="checkbox" name="frutos" id="frutos" name="frutos" checked>Frutos
<?php 
    }else{
?>
<input type="checkbox" name="frutos" id="frutos" name="frutos">Frutos
<?php 
    } 
?>  
</label><br>
<label>

<?php if(strpos($etapas,'Tallo')){?>
<input type="checkbox" name="tallo" id="tallo" name="tallo" checked>Tallo
<?php 
    }else{
?>
<input type="checkbox" name="tallo" id="tallo" name="tallo">Tallo
<?php 
    } 
?>
</label><br>
<label>
<?php if(strpos($etapas,'Hojas')){?>
<input type="checkbox" name="hojas" id="hojas" name="hojas" checked>Hojas
<?php 
    }else{
?>
<input type="checkbox" name="hojas" id="hojas" name="hojas">Hojas
<?php 
    } 
?>  
</label><br>
<label>
<?php if(strpos($etapas,'Flores')){?>
<input type="checkbox" name="flores" id="flores" name="flores" checked>Flores
<?php 
    }else{
?>
<input type="checkbox" name="flores" id="flores" name="flores">Flores
<?php 
    } 
?> 
</label><br>
<label>
<?php if(strpos($etapas,'Raiz')){?>
<input type="checkbox" name="raiz" id="raiz" name="raiz" checked>Raiz
<?php 
    }else{
?>
<input type="checkbox" name="raiz" id="raiz" name="raiz">Raiz
<?php 
    } 
?>    
</label><br>
<label>
<?php if(strpos($etapas,'Enves')){?>
<input type="checkbox" name="enves" id="enves" name="enves" checked>Enves
<?php 
    }else{
?>
<input type="checkbox" name="enves" id="enves" name="enves">Enves
<?php 
    } 
?> 
</label><br>
<label>
<?php if(strpos($etapas,'Aerea')){?>
<input type="checkbox" name="aerea" id="aerea" name="aerea" checked>Aerea
<?php 
    }else{
?>
<input type="checkbox" name="aerea" id="aerea" name="aerea">Aerea
<?php 
    } 
?>  
</label><br>

<div class="text-center">
    <button type="button" class="btn btn-default my-4" id="btn_save1" onclick="actualizarPartes();"
        style="font-family:'FontAwesome',tahoma; font-size: 11px;">Actualizar</button>
</div>