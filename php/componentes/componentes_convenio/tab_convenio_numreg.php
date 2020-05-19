<?php
require '../../conexion.php';
session_start();
$codi_fin=$_SESSION['ide_finca'];
$num_reg = $_POST['num_reg'];

?>

<table class="table align-items-center table-flush table-hover">
  <thead class="thead-light">
    <tr>
      <!-- <th scope="col">Código</th> -->
      <th scope="col">Fecha</th>
      <th scope="col">Trabajador</th>
      <th scope="col">Socio</th>
      <th scope="col">Tipo de convenio</th>
      <th acope="col">Cultivo</th>
      <th acope="col">Estado</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php 
    $sql="SELECT convenio.cod_con,convenio.fec_con,fincas.cod_fin, fincas.nom_fin, cultivos.cod_cul, nombre_cultivo.des_ncu, lotes.nom_lot,cultivos.npl_cul
    FROM public.fincas, public.lotes, public.cultivos, public.nombre_cultivo, public.ejecutar, 
    public.convenio
    WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot
    AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND cultivos.cod_cul=ejecutar.cod_cul 
    AND convenio.cod_con=ejecutar.cod_con and fincas.cod_fin='$codi_fin' ORDER BY convenio.fec_con DESC limit '$num_reg'"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
     ?>
     <tr>

      <!-- <td><?php echo $ver[0] ?></td> -->
      <td><?php echo $ver[1] ?></td>

      <?php
      $sql1="SELECT  ide_ter
      FROM public.act_con where cod_con='$ver[0]'"; 
      $r=pg_query($conexion,$sql1);
      $persona="";
      while($se=pg_fetch_row($r)){
        ?>
        <td><?php
        $q="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter
        FROM public.terceros WHERE terceros.ide_ter ='$se[0]'";
        $ress =pg_query($conexion,$q);
        $noms=pg_fetch_row($ress);

        echo $noms[1]." ".$noms[2]."<br>".$noms[3]." ".$noms[4];
        $persona=$se[0]."*".$persona;
        ?>
      </td>
      <?php 
    }
    ?>
    <td>
      <?php 
      $sql2=" SELECT hor_jor,vho_jor FROM jornales WHERE cod_con='$ver[0]'"; 
      $result1=pg_query($conexion,$sql2);
      $see=pg_fetch_row($result1);
      if($see!=0){

        ?>
        <button type="button" class="btn btn-sm btn-white" data-toggle="tooltip" data-placement="left" title="<?php
        echo 'Horas a trabajar: '.$see[0].'Hrs.  Valor de la hora: '.$see[1].'$. Pago diario: '.($see[0]*$see[1]).'$.'?>">
        <?php echo 'Jornal';
        $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$see[0]."||".$see[1]."||".'1'."||".$ver[4]."||".$persona;
        ?>
      </button>


      <?php
    }

    $sql2="SELECT val_cot,convenio.fec_con,ffi_con,des_cot FROM contratos INNER JOIN convenio on contratos.cod_con=convenio.cod_con 
    and contratos.cod_con='$ver[0]'"; 
    $result1=pg_query($conexion,$sql2);
    $see=pg_fetch_row($result1);
    if($see!=0){
      ?>
      <button type="button" class="btn btn-sm btn-white" data-toggle="tooltip" data-placement="left" title="<?php
      echo 'Valor contrato: '.$see[0].'$.  Fecha inicio: '.$see[1].'. Fecha fin: '.($see[2]).'. Objeto del contrato: '.$see[3].'.'?>">
      <?php echo 'Contrato'; 
      $datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$see[0]."||".$see[1]."||".$see[2]."||".'2'."||".$see[3]."||".$ver[4]."||".$persona;   
      ?>
    </button>
    <?php
  }
  ?>
</td>
<td><?php $array=explode("-", $ver[5]); echo $array[1]."<br>".$ver[6]."<br>".$ver[7]." Plantas"?></td>
<td>
  <?php 

  $consulta5= "SELECT * FROM public.efectuar WHERE  cod_con='$ver[0]'";
  $result5=pg_query($conexion,$consulta5);
  $filas5=pg_num_rows($result5);
  if($filas5 > 0 ){
    echo "<p class='text-success' style='font-size: 0.9rem;' >Efectuado</>";
  }else{
    echo "<p class='text-warning' style='font-size: 0.9rem;' >Sin efectuar</>";
  }

  ?>
</td>
<td>
 <a href="#"  onclick="eliminar_convenio(' <?php  echo $ver[0] ?> ')"><div class="icon-sm icon-shape bg-gradient-red text-white rounded-circle "><i class="fas fa-backspace text-white"></i></div></a>
</td>
</tr>
<?php 
}
?>
</tbody>