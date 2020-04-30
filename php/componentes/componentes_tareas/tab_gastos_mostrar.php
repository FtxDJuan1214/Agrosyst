  <?php 
  session_start();
  require '../../conexion.php';
  $insumos =$_POST['gastos'];

  $array=explode("||", $insumos);
  $lenght=count($array) - 1;
  ?>
  <ul class="list-group">
    <?php 
    for($i =0; $i<$lenght ; $i++){
      $ver=explode(",", $array[$i]);
      ?>
      <li class="list-group-item"><?php echo "Descripción: ".$ver[0]."<br> Valor: ".$ver[1]."$ <br> Paga: ".$ver[2]; ?> <button onclick="res_gasto();"type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></li>
      <?php
    }
    ?>
  </ul>