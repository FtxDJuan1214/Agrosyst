  <?php 
  session_start();
  require '../../conexion.php';
  $convenios =$_POST['convenios'];

  $array=explode("||", $convenios);
  $lenght=count($array) - 1;
  ?>
  <ul class="list-group">
    <?php 
    for($i =0; $i<$lenght ; $i++){

      $arr2=explode(",",$array[$i]);
      ?>
      <li class="list-group-item"><?php echo $arr2[1]; ?> <button onclick="res_conv();"type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></li>
      <?php
    }
    ?>
  </ul>