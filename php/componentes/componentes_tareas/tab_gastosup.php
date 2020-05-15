  <?php 
  session_start();
  require '../../conexion.php';
  $cod_cul=$_POST['cod_cul'];
  $cod_tar=$_POST['cod_tar'];
  $total=$_POST['total'];

  ?>
  <form role="form" id="form_up-crud_soc">
    <div class="row">
      <div class="col 10">
        <div class="form-group" style="display: none;">
          <?php   
          $sql1="SELECT cod_com FROM compras ORDER BY cod_com DESC LIMIT 1";
          $result=pg_query($conexion,$sql1);
          $cod=pg_fetch_row($result);                    
          ?>
          <input type="text" class="form-control" id="num_fact_up" name="num_fact" value="<?php echo "N° Factura: ".($cod[0]+1);?>" autocomplete="off" readonly>
        </div>

        <div class="form-group" style="display: none;">
          <div class="input-group ">
            <?php 
            date_default_timezone_set('America/Bogota');
            $d = date("d");
            $m = date("m");
            $y = date("Y");
            $fecha=$y."-".$m."-".$d;  
            ?>

            <input class="form-control datepicker" id="date_up"  name="date"  placeholder="Select date" type="text" value="<?php echo $fecha?>">
          </div>
        </div>


        <div class="form-group" style="display: none;">
          <?php $hoy = getdate();?>
          <input type="text" class="form-control" id="time_up" name="time"value="<?php echo $hoy['hours']." : ".$hoy['minutes']." : ".$hoy['seconds'] ?>" autocomplete="off" readonly>
        </div>


        <div class="form-group">
          <div class="input-group input-group-alternative" id="char_soc_up">
            <select id="cod_ter_soc_up" class="form-control"data-live-search="true">
              <option value="" disabled selected>Selecciona Socio</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group input-group-alternative">
            <select id="insumo_up" class="form-control" data-live-search="true">
              <option value="0" disabled selected>Selecciona gasto</option>
              <?php 
              $like =  $_SESSION['idusuario'];
              $codi_fin=$_SESSION['ide_finca'];
              $query="SELECT insumos.cod_ins,des_ins,des_unm from public.insumos 
                INNER JOIN otros ON insumos.cod_ins=otros.cod_ins
                INNER JOIN unidad_de_medida ON insumos.cod_unm=unidad_de_medida.cod_unm
                where otros.det_otr LIKE '$like%' or otros.det_otr LIKE '1-%'";
              $result =pg_query($conexion,$query);
              while ($ver=pg_fetch_row($result)) {
               ?>
               <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]?></option>

               <?php 
             }
             ?>
           </select>
         </div>
       </div>

       <div class="form-group">
        <div class="input-group input-group-alternative">
          <input id="cos_uni_up"  name="cos_uni" type="text" class="form-control" placeholder="Valor" autocomplete="off">
        </div>
      </div>

      <a href="#!" onclick="addgastosup('<?php echo$cod_cul.'||'.$cod_tar.'||'.$total ?>');" class="btn btn-info">Añadir</a>
    </div>
  </div>
</form>