 <?php 

 require '../../conexion.php';
 session_start();
 $like = $_SESSION['idusuario'];
 $cod_cul =$_POST['cod_cul'];    
 ?>
 <select id="cod_ter_soc" name="cod_ter_soc" class="form-control"data-live-search="true">
  <option value="" disabled selected>Selecciona Socio que pagará</option>


  <?php
  $query="SELECT act_cul.ide_ter,terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter FROM public.act_cul 
  INNER JOIN terceros ON terceros.ide_ter = act_cul.ide_ter 
  where cod_cul='$cod_cul'";
  $result =pg_query($conexion,$query);
  while ($ver=pg_fetch_row($result)) {
   ?>
   <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]." ". $ver[2]." ". $ver[3]." ". $ver[4] ?></option>

   <?php 
 }
 ?>
</select>


