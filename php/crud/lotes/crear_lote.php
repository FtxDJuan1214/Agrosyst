  <?php 
  require_once '../../conexion.php';     
  $nom_lot = ucwords(strtolower($_POST['nomb_lote']));
  $cod_fin = $_POST['NFinca'];
  $cod_unm = $_POST['UniMedida'];
  $med_lot = $_POST['medi_lote'];
  
  $sqx="SELECT cod_lot FROM public.lotes ORDER BY cod_lot DESC LIMIT 1";
  $res=pg_query($conexion,$sqx);
  $ver=pg_fetch_row($res);
  
  
  $cod_lot= 1;
  if (pg_num_rows($res) != 0) {
   $cod_lot=$ver[0] + 1;
 }
 
 $sql="INSERT INTO public.lotes(
 cod_lot, nom_lot, cod_fin, cod_unm, med_lot)
 VALUES ('$cod_lot','$nom_lot', '$cod_fin', '$cod_unm', '$med_lot')";
 echo $result=pg_query($conexion,$sql);
 ?>