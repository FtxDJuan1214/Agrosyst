<?php
require '../../conexion.php';
// $num_fact = $_POST['num_fact'];
// $date = $_POST['date'];
// $time = $_POST['time'];
// $proveedor = $_POST['proveedor'];
// $tip_ins = $_POST['tip_ins'];
// $cod_ins = $_POST['cod_ins'];
// $can_sto = $_POST['can_sto'];
// $cos_uni = $_POST['cos_uni'];
// $cos_ins = $_POST['cos_ins'];
// $socio = $_POST['socio'];

$num_fact = "";
$date = "";
$time = "";
$proveedor = "";
$tip_ins = "";
$cod_ins = "";
$can_sto = "";
$cos_uni = "";
$cos_ins = "";
$socio = "";

$string = "fac:1,2019-06-21,18:41,1069765825,1,20,10,6000,60000,1069751813";
// $array=explode("/",$string);
$string2 = "fac:2,2019-06-22,22:41,2222222222,2,20,10,2000,20000,2222222222";

$string = $string."+".$string2;
echo $string;

$array=explode("+",$string);
foreach ($array as $imp ) {
    ?>
  <h2><?php echo $imp ?></h2><br>

  <?php 
    $arr2=explode(",",$imp);
      foreach ($arr2 as $arr ) {
       ?>
        <p style="border: double;"><?php echo $arr ?></p>
       <?php
      }
   ?>

  <?php
}
// list($num_fact,$date,$time,$proveedor,$tip_ins,$cod_ins,$can_sto,$cos_uni,$cos_ins,$socio)=$array;
?>

<!-- 
<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
   
      <th scope="col">Cod</th>
      <th scope="col">Insumo</th>
      <th scope="col">Unidad de medida</th>
      <th scope="col">Medida</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
     <tr>
      <td></td>
      <td></td>
      <td></td>
      <td> </td>
    </tr>
</tbody> -->