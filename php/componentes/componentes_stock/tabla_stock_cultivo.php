<?php
session_start();
require '../../conexion.php';
$selec = $_POST['seleccion'];
$like = $_SESSION['idusuario'];
$codi_fin=$_SESSION['ide_finca'];
?>

<table class="table align-items-center table-flush table-hover">
  <?php 
  if($selec == "finca"){
    ?>
    <thead class="thead-light">
      <tr>
        <th scope="col">Codigo</th>
        <th scope="col">Insumo</th>
        <th scope="col">cantidad</th>      
        <th scope="col">Precio Unitario</th>
        <th scope="col">Propietario</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php
      $sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
      unidad_de_medida.des_unm,terceros.ide_ter, 
      terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, 
      fincas.cod_fin
      FROM insumos, stock, registrar, compras, comprar, terceros, duenio, 
      unidad_de_medida, act_cul, lotes ,cultivos, fincas
      WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
      AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
      AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter
      AND terceros.ide_ter = act_cul.ide_ter AND act_cul.cod_cul = cultivos.cod_cul
      AND cultivos.cod_lot =  lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin
      AND unidad_de_medida.cod_unm=insumos.cod_unm  AND  terceros.ide_ter LIKE '$like%' 
      AND fincas.cod_fin = '$codi_fin'"; 

      $result=pg_query($conexion,$sql);
      while($ver=pg_fetch_row($result)){
        $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
        $rex=pg_query($conexion,$excluir);
        $filas=pg_num_rows($rex);
        if ($filas == 0) {
         ?>

         <tr 
         <?php 
         if($ver[1] == "0"){
          echo "style='background: rgba(232,170,27,.3)'";
        } 
        ?>
        >
        <td><?php echo $ver[0] ?></td>
        <td><?php 

        $pos = strpos($ver[3], "-");
        if ($pos=="") {
          echo $ver[3];
        }else{
          echo explode("-",$ver[3])[1];
        }?>

      </td>
      <td><?php 
      $unm=explode("-",$ver[4]);
      echo $ver[1].$unm[1]?>

    </td>
    <td>
      <?php
      $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
      $r=pg_query($conexion,$sqf);
      $cont=0;
      $pre=0;
      while($see=pg_fetch_row($r)){
        ++$cont;
        $pre=$pre+$see[0];
      }
      echo "$ ".intval(($pre)/$cont);
      ?>
    </td>
    <td><?php 
    echo $ver[6]." ".$ver[7]." ".$ver[8]." ".$ver[9]; 
    ?></td>
  </tr>
  <?php 
}}
$sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
unidad_de_medida.des_unm,terceros.ide_ter, 
terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter, 
fincas.cod_fin
FROM insumos, stock, registrar, compras, comprar, terceros, socio, 
unidad_de_medida, act_cul, lotes ,cultivos, fincas
WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
AND terceros.ide_ter = act_cul.ide_ter AND act_cul.cod_cul = cultivos.cod_cul
AND cultivos.cod_lot =  lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin
AND unidad_de_medida.cod_unm=insumos.cod_unm  AND  terceros.ide_ter LIKE '$like%' 
AND fincas.cod_fin = '$codi_fin'"; 

$result=pg_query($conexion,$sql);
while($ver=pg_fetch_row($result)){
  $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
  $rex=pg_query($conexion,$excluir);
  $filas=pg_num_rows($rex);
  if ($filas == 0) {
   ?>
   <tr 
   <?php 
   if($ver[1] == "0"){
    echo "style='background: rgba(232,170,27,.3)'";
  } 
  ?>
  >
  <td><?php echo $ver[0] ?></td>
  <td><?php 

  $pos = strpos($ver[3], "-");
  if ($pos=="") {
   echo $ver[3];
 }else{
  echo explode("-",$ver[3])[1];
}?>

</td>
<td>
  <td><?php 
  $unm=explode("-",$ver[4]);
  echo $ver[1].$unm[1]?>

</td>
<td>
  <?php
  $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
  $r=pg_query($conexion,$sqf);
  $cont=0;
  $pre=0;
  while($see=pg_fetch_row($r)){
    ++$cont;
    $pre=$pre+$see[0];
  }
  echo "$ ".intval(($pre)/$cont);
  ?>
</td>
<td><?php 
echo $ver[6]." ".$ver[7]." ".$ver[8]." ".$ver[9]; 
?></td>
</tr>
<?php 
}}
}else{
  ?>
  <thead class="thead-light">
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Insumo</th>
      <th scope="col">cantidad</th>      
      <th scope="col">Precio Unitario</th>
      <th scope="col">Propietario</th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php
    $sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
    unidad_de_medida.des_unm,terceros.ide_ter, 
    terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
    FROM insumos, stock, registrar, compras, comprar, terceros, duenio, unidad_de_medida,  cultivos, act_cul
    WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
    AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
    AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=duenio.ide_ter
    AND unidad_de_medida.cod_unm=insumos.cod_unm AND terceros.ide_ter=act_cul.ide_ter 
    AND act_cul.cod_cul=cultivos.cod_cul AND cultivos.cod_cul = '$selec'
    AND  terceros.ide_ter LIKE '$like%'"; 


    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
      $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
      $rex=pg_query($conexion,$excluir);
      $filas=pg_num_rows($rex);
      if ($filas == 0) {
        ?>
        <tr 
        <?php 
        if($ver[1] == "0"){
          echo "style='background: rgba(232,170,27,.3)'";
        } 
        ?>
        >
        <td><?php echo $ver[0] ?></td>
        <td><?php 

        $pos = strpos($ver[3], "-");
        if ($pos=="") {
         echo $ver[3];
       }else{
        echo explode("-",$ver[3])[1];
      }?>

    </td>
    <td><?php 
    $unm=explode("-",$ver[4]);
    echo $ver[1].$unm[1]?>

  </td>
  <td>
    <?php
    $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
    $r=pg_query($conexion,$sqf);
    $cont=0;
    $pre=0;
    while($see=pg_fetch_row($r)){
      ++$cont;
      $pre=$pre+$see[0];
    }
    echo "$ ".intval(($pre)/$cont);
    ?>
  </td>
  <td><?php 
  echo $ver[6]." ".$ver[7]." ".$ver[8]." ".$ver[9]; 
  ?></td>
</tr>
<?php 
}
}

$sql="SELECT DISTINCT stock.cod_sto, stock.can_sto, insumos.cod_ins,insumos.des_ins,
unidad_de_medida.des_unm,terceros.ide_ter, 
terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
FROM insumos, stock, registrar, compras, comprar, terceros, socio, unidad_de_medida,  cultivos, act_cul
WHERE insumos.cod_ins=stock.cod_ins AND stock.cod_sto=registrar.cod_sto 
AND registrar.cod_com=compras.cod_com AND compras.cod_com=comprar.cod_com
AND comprar.ide_ter=terceros.ide_ter AND terceros.ide_ter=socio.ide_ter
AND unidad_de_medida.cod_unm=insumos.cod_unm AND terceros.ide_ter=act_cul.ide_ter 
AND act_cul.cod_cul=cultivos.cod_cul AND cultivos.cod_cul = '$selec'
AND  terceros.ide_ter LIKE '$like%'"; 

$result=pg_query($conexion,$sql);
while($ver=pg_fetch_row($result)){
  $excluir="SELECT  otros.cod_ins from otros where otros.cod_ins = '$ver[2]'"; 
  $rex=pg_query($conexion,$excluir);
  $filas=pg_num_rows($rex);
  if ($filas == 0) {
    ?>
    <tr 
    <?php 
    if($ver[1] == "0"){
      echo "style='background: rgba(232,170,27,.3)'";
    } 
    ?>
    >
    <td><?php echo $ver[0] ?></td>
    <td><?php 

    $pos = strpos($ver[3], "-");
    if ($pos=="") {
     echo $ver[3];
   }else{
    echo explode("-",$ver[3])[1];
  }?>

</td>
<td><?php 
$unm=explode("-",$ver[4]);
echo $ver[1].$unm[1]?>

</td>
<td>
  <?php
  $sqf="SELECT pre_sto FROM pre_sto WHERE cod_sto='$ver[0]'"; 
  $r=pg_query($conexion,$sqf);
  $cont=0;
  $pre=0;
  while($see=pg_fetch_row($r)){
    ++$cont;
    $pre=$pre+$see[0];
  }
  echo "$ ".intval(($pre)/$cont);
  ?>
</td>
<td><?php 
echo $ver[6]." ".$ver[7]." ".$ver[8]." ".$ver[9]; 
?></td>
</tr>
<?php 
}
}
}
?>
</tbody>
</table>