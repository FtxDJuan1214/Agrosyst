  <?php 
  session_start();
  require '../../conexion.php';
  $insumos =$_POST['insumos'];

  $array=explode("||", $insumos);
  $lenght=count($array) - 1;
  ?>
  <ul class="list-group">
    <?php 
    for($i =0; $i<$lenght ; $i++){
      ?>
      <li class="list-group-item"><?php echo $array[$i]; ?> <button onclick="res_insu();"type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></li>
      <?php
    }
    ?>
  </ul>