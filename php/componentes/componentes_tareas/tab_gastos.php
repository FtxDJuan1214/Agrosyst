  <?php 
  session_start();
  require '../../conexion.php';
  $ver =$_POST['cadena'];
  $array=explode("||", $ver);
  $lenght=count($array) - 1;
  ?>
  <div class="row">
    <div class="card bg-default shadow" style="width: 100%; ">
      <div class="table-responsive">
        <table class="table align-items-center table-dark table-flush">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Descripción</th>
              <th scope="col">Valor</th>
              <th scope="col">Socio que paga</th>
              <th scope="col">Borrar</th>
            </tr>
          </thead>
          <tbody>
            
            <?php 
            for($i =0; $i<$lenght ; $i++){
              $ver=explode(",", $array[$i]);
              ?>
              <tr>
                <td><?php echo $ver[0] ?></td>
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2] ?></td>
                <td>
                 <a href="#" onclick="res_gasto();"><div class="icon-sm icon-shape bg-gradient-red text-white rounded-circle "><i class="fas fa-backspace text-white"></i></div></a>
               </td>
             </tr>
             <?php
           }
           ?>
           
         </tbody>
       </table>
     </div>
   </div>
 </div>