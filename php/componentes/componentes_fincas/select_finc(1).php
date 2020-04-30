<?php 
require '../../conexion.php';
$cod_dep=$_POST['cod_dep'];
 $query="SELECT cod_mun,nom_mun FROM municipio where cod_dep='$cod_dep'";
  $result =pg_query($conexion,$query);

$cadena="<select id='mun_dep' name='mun_dep' class='form-control' data-live-search='true'>
    <option value='' disabled selected>Selecciona municipio</option>";
        while ($ver=pg_fetch_row($result)) {
            $cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).'</option>';
        }

echo $cadena.'</select>';
?>
