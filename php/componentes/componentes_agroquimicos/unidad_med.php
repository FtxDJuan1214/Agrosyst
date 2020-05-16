<?php 
require '../../conexion.php';
$cod_tum=$_POST['uni_med'];
 $query="SELECT cod_unm,des_unm FROM unidad_de_medida where cod_tum='$cod_tum'";
  $result =pg_query($conexion,$query);

$cadena="<div class='input-group input-group-alternative'>
<<<<<<< HEAD
    <select required id='uni_med' class='form-control' data-live-search='true'>
=======
    <select id='uni_med' class='form-control' data-live-search='true'>
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
     <option value='' disabled selected>Unidad de medida</option>";
        while ($ver=pg_fetch_row($result)) {
            $cadena=$cadena.'<option value='.$ver[0].'>'.utf8_decode($ver[1]).'</option>';
        }

echo $cadena.'</select>
</div>';
?>
