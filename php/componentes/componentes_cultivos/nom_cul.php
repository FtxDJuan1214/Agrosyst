<div class="row">
  <div class="col-8 col-sm-10">
    <div class="form-group mb-3">
      <div class="input-group input-group-alternative">
        <select id="nom_cul" class="form-control"data-live-search="true">
          <option value="" disabled selected>Cultivo</option>
          <?php 
          session_start();
          require '../../conexion.php';
          $like = $_SESSION['idusuario'];
          $query="SELECT * FROM nombre_cultivo  WHERE des_ncu LIKE'$like%'  ORDER BY cod_ncu ASC";
          $result =pg_query($conexion,$query);
          echo $result;
          while ($ver=pg_fetch_row($result)) {
           ?>
            <option value="<?php echo $ver[0] ?>"><?php $array=explode("-", $ver[1]); echo $array[1]; ?></option>

           <?php 
         }
         ?>
       </select>
     </div>
   </div>
 </div>
 <div class="col-4 col-sm-2" data-toggle="tooltip" data-placement="bottom" title="Nombres de cultivos">
  <a href="#"><i class="fas fa-spa text-verde"  style="font-size: 2rem;padding: 0px;margin-top: 7px;"; data-toggle="modal" data-target="#modal-cultivos" onclick="n_cul();"></i></a>
</div>

</div>