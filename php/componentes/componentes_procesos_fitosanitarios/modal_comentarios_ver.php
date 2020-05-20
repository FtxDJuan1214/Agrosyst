<?php 

require '../../conexion.php';

$cod_pfi =$_POST['cod_pfi'];

$sql1="SELECT cod_pfi, com_pfi, fec_com
FROM public.comentarios_pfi
WHERE cod_pfi = '$cod_pfi'";

$result1=pg_query($conexion,$sql1);
while($ver1=pg_fetch_row($result1)){                                            
?>
<div class="form-group">
    <div class="form-group">
        <h5 class="text-white"><?php echo $ver1[2].':' ?></h5>
        
        <div class="row">
        <div class="col-sm-11">
        <textarea readonly id="deta_are" name="deta_are" class="form-control" placeholder="Detalle"
            rows="3"><?php echo $ver1[1] ?></textarea>
        </div>
  <div class="col-sm-1">
  </div>
        </div>
    </div>
    <?php 
}
?>
</div>
<script>
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>