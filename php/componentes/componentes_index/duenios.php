<?php 
 require '../../conexion.php';
  session_start();
  $like = $_SESSION['idusuario'];
?>
<div class="form-group mb-3">
  <div class="input-group input-group-alternative">
    <select id="due_fin" name="due_fin" class="form-control"data-live-search="true">
      <option value="" disabled selected>Selecciona dueño</option>
      <?php 
      $query="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter FROM public.terceros INNER JOIN dueño ON terceros.ide_ter=dueño.ide_ter where terceros.ide_ter LIKE '$like%'";
      $result =pg_query($conexion,$query);
      while ($ver=pg_fetch_row($result)) {
       ?>
       <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]." ".$ver[2]." ".$ver[3]." ".$ver[4]; ?></option>
       <?php 
     }
     ?>
   </select>
 </div>
</div>