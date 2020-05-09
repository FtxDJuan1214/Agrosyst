<?php 
require '../../conexion.php';
$cod_tum=$_POST['uni_med'];
 $query="SELECT cod_unm,des_unm FROM unidad_de_medida where cod_tum='$cod_tum'";
  $result =pg_query($conexion,$query);

$cadena="<div class='input-group input-group-alternative'>
    <select id='uni_med' class='form-control' data-live-search='true'>
     <option value='' disabled selected>Unidad de medida</option>";
        while ($ver=pg_fetch_row($result)) {
            $cadena=$cadena.'<option value='.$ver[0].'>'.utf8_decode($ver[1]).'</option>';
        }

echo $cadena.'</select>
</div>';
?>
