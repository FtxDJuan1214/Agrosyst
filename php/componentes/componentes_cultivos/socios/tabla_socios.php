<?php 
$cod_cul=$_POST['cod_cul'];
?>
<div class="row">
  <div class="card bg-default shadow" style="width: 100%; ">
    <div class="table-responsive">
      <table class="table align-items-center table-dark table-flush">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Cc</th>
            <th scope="col">Socio</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          require '../../../conexion.php';
          $sql="SELECT cod_cul,act_cul.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter 
          FROM act_cul INNER JOIN terceros ON terceros.ide_ter=act_cul.ide_ter
          WHERE cod_cul='$cod_cul'"; 
          $result=pg_query($conexion,$sql);
          while($ver=pg_fetch_row($result)){
            $datos=$ver[0];
            ?>
            <tr>

              <td style="max-width: 85px;"><?php $array=explode("-", $ver[1]); echo $array[1]; ?></td>
              <td><?php echo $ver[2]." ".$ver[3]." ".$ver[4]." ".$ver[5] ?></td>

              <td>
               <a href="#"  onclick="eliminar_socio(' <?php  echo $ver[1] ?> ')"><div class="icon-sm icon-shape bg-gradient-red text-white rounded-circle "><i class="fas fa-backspace text-white"></i></div></a>
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