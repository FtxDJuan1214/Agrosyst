 <?php 

 require '../../conexion.php';
 session_start();
 $like = $_SESSION['idusuario'];
 $cod_cul =$_POST['cod_cul'];

 $detalles = "";


 ?>

 <?php
 $queryasda="SELECT DISTINCT gozar.fec_goz,tipo_de_produccion.des_tpr, gozar.cpt_goz,gozar.ctp_goz, gozar.pre_goz,produccion.cod_pro
 FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
 public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
 WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
 AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
 AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
 AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  gozar.fec_goz ASC";
 $resultasda =pg_query($conexion,$queryasda);
 if (pg_num_rows($resultasda) != 0) {

  $sql1="SELECT fec_goz FROM gozar ORDER BY fec_goz ASC LIMIT 1";
  $res=pg_query($conexion,$sql1);
  $ver1=pg_fetch_row($res);
  $fecha=strval($ver1[0]);

  $produccion_rendimiento = "";  
  $dinero = 0;
  $kilos = 0;
  while ($ver=pg_fetch_row($resultasda)) {

    if (strcmp($fecha, strval($ver[0])) !== 0){
      $detalles =  $detalles.$fecha.",". $dinero.",".$kilos."||";
      $fecha = strval($ver[0]);
      $dinero = 0;
      $kilos = 0;
    }
    $dinero = $dinero + (floatval($ver[3]) * floatval($ver[4]));
    $kilos = $kilos + (floatval($ver[2]) * floatval($ver[3]));

  }
  $detalles =  $detalles.$fecha.",". $dinero.",".$kilos."||**";

  $queryasda="SELECT DISTINCT gozar.fec_goz,tipo_de_produccion.des_tpr, gozar.cpt_goz,gozar.ctp_goz
  FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
  public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
  WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
  AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
  AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
  AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  tipo_de_produccion.des_tpr ASC";
  $resultasda =pg_query($conexion,$queryasda);

  $sql1="SELECT DISTINCT gozar.fec_goz,tipo_de_produccion.des_tpr, gozar.cpt_goz,gozar.ctp_goz
  FROM public.tipo_de_produccion, public.produccion, public.gozar, public.cultivos, 
  public.nombre_cultivo, public.ejecutar,public.lotes, public.fincas, public.unidad_de_medida, public.terceros
  WHERE tipo_de_produccion.cod_tpr=gozar.cod_tpr AND gozar.cod_pro=produccion.cod_pro
  AND produccion.cod_cul=cultivos.cod_cul AND cultivos.cod_cul=ejecutar.cod_cul AND nombre_cultivo.cod_ncu=cultivos.cod_ncu
  AND cultivos.cod_lot = lotes.cod_lot AND lotes.cod_fin = fincas.cod_fin AND tipo_de_produccion.cod_unm = unidad_de_medida.cod_unm 
  AND produccion.ide_ter = terceros.ide_ter AND cultivos.cod_cul = '$cod_cul' ORDER BY  tipo_de_produccion.des_tpr ASC LIMIT 1";
  $res=pg_query($conexion,$sql1);
  $ver1=pg_fetch_row($res);
  $fecha=strval($ver1[1]);

  $kilos = 0;
  while ($ver=pg_fetch_row($resultasda)) {

    if (strcmp($fecha, strval($ver[1])) !== 0){
      $detalles =  $detalles."".explode("-", $fecha)[1].",".$kilos."||";
      $fecha = strval($ver[1]);
      $dinero = 0;
      $kilos = 0;
    }
    $kilos = $kilos + (floatval($ver[2]) * floatval($ver[3]));

  }
  $detalles =   $detalles."".explode("-", $fecha)[1].",".$kilos."||";

  $sqya = "SELECT DISTINCT tarea.cod_tar, tarea.des_tar, tarea.fin_tar, tarea.ffi_tar, cultivos.cod_cul, nombre_cultivo.des_ncu, cultivos.npl_cul,lotes.nom_lot,tarea.val_tar 
  FROM fincas, lotes, cultivos, ejecutar, convenio, efectuar, tarea, nombre_cultivo, labores
  WHERE fincas.cod_fin=lotes.cod_fin AND nombre_cultivo.cod_ncu = cultivos.cod_ncu AND lotes.cod_lot=cultivos.cod_lot 
  AND cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con 
  AND convenio.cod_con=efectuar.cod_con AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_lab = labores.cod_lab and cultivos.cod_cul = '$cod_cul'
  ORDER BY tarea.fin_tar ASC";
  $resasad =pg_query($conexion,$sqya);
  $aportes = 0;
  while ($ver=pg_fetch_row($resasad)) {
    $aportes = $aportes + floatval($ver[8]);
  }
  $detalles =   $detalles."**".$aportes;
  echo $detalles;
}else{
  echo "null";
}
?>




