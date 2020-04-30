<?php 
require'../../conexion.php';
?>
<h3>Teléfonos</h3>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-8 col-sm-11">
				<div id="div_tel_terup" class="input-group input-group-alternative" style="margin-bottom: 20px;">
					<input style="border-color: #fb6340;" id="tel_terup" type="text" class="form-control" placeholder="Teléfono" autocomplete="off" maxlength="10" >
				</div>
			</div>
			<div class="col-4 col-sm-1">
				<a href="#"><i class="fas fa-plus-circle text-default" style="font-size: 2rem;padding: 0px;margin-top: 7px;"; onclick="agregar_telefono();"></i></a>
			</div>
		</div>
	</div>
</div>
<?php
$ide_ter =$_POST['ide_ter']; 
$sql="SELECT tel_ter FROM tel_tercero WHERE ide_ter ='$ide_ter'";
$result=pg_query($conexion,$sql);
while($ver=pg_fetch_row($result)){
	?>
	<span class="badge badge-pill badge-info text-uppercase" style="font-size: 1rem; padding: 10px; margin-bottom: 5px;"><?php echo $ver[0] ?> <a href="#" onclick="eliminar_tel('<?php echo $ver[0] ?>');"><i class="fas fa-times text-info"></i></a></span>
	<?php
}
?>

<h3>Correos</h3>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-8 col-sm-11">
				<div id="div_eml_terup" class="input-group input-group-alternative" style="margin-bottom: 20px;">
					<input  style="border-color: #fb6340;" id="eml_terup" type="email" class="form-control" placeholder="Correo" autocomplete="off" maxlength="50" >
				</div>
			</div>
			<div class="col-4 col-sm-1">
				<a href="#"><i class="fas fa-plus-circle text-default" style="font-size: 2rem;padding: 0px;margin-top: 7px;"onclick="agregar_email();"></i></a>
			</div>
		</div>
	</div>
</div>
<?php
$ide_ter =$_POST['ide_ter']; 
$sql="SELECT ema_ter FROM email_tercero WHERE ide_ter ='$ide_ter'";
$result=pg_query($conexion,$sql);
while($ver=pg_fetch_row($result)){
	?>
	<span class="badge badge-pill badge-info text-uppercase" style="font-size: 1rem; padding: 10px; margin-bottom: 5px;"><?php echo $ver[0] ?> <a href="#" onclick="eliminar_eml('<?php echo $ver[0] ?>');"><i class="fas fa-times text-info"></i></a></span>
	<?php
}
?>
