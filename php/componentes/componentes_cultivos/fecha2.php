<?php 
require '../../conexion.php';
?>
<script src="../assets/js/argon.js?v=1.0.0"></script>
<?php 
$fecha=$_POST['fecha'];
$cadena="<div class='form-group'>
<label >fecha Finalización</label>
<div class='input-group input-group-alternative'>
<div class='input-group-prepend'>
<span class='input-group-text'><i class='ni ni-calendar-grid-58'></i></span>
</div>
<input class='form-control datepicker' id='fif_cul_up' placeholder='Select date' type='text'value='$fecha'>
</div>
</div>";

echo $cadena;
?>

<script >

	$(document).ready(function(){
		$('#fif_cul_up').blur(function() {setTimeout("intervalob();",100)}); 
		$('#fin_cul_up').blur(function() {setTimeout("intervalob();",100)}); 
	});


	function intervalob(){
		fin_cul=$('#fin_cul_up').val();
		fif_cul=$('#fif_cul_up').val();
		cadena="fin_cul="+fin_cul+"&fif_cul="+fif_cul;
		$.ajax({
			type:"post",
			url:"../php/componentes/componentes_cultivos/duracion_cul.php",
			data:cadena,
			success:function(r){
				tiempo = r.split("||");
				$('#dur_cul_up').val(tiempo[0]+' años '+tiempo[1]+' meses '+tiempo[2]+' dias');
				total_dias=parseFloat(tiempo[3]);
				dias_actuales = parseFloat(tiempo[4]);
				anios=parseFloat(tiempo[0]);
				$('#borrar').text("dias: " + total_dias + "dias hoy: " + dias_actuales);
				if (tiempo[0] < 1) {

					$('#tip_cul_up').val(1);

				} else if ((tiempo[0] = 1)){

					if (( tiempo[1] >= 0) && ( tiempo[2] > 0)) {

						$('#tip_cul_up').val(2);

					} else if (( tiempo[1] = 0) && ( tiempo[2] = 0)){
						$('#tip_cul_up').val(1);
					}

				} 
				if (anios >=2) {
					$('#tip_cul_up').val(2);
				}

				if (dias_actuales > 0 && dias_actuales != total_dias) {

					if(dias_actuales > 0 && dias_actuales <= 3){
						$('#est_cul_up').val(1);
					}else if(dias_actuales > 3 && dias_actuales <=210){
						$('#est_cul_up').val(2);
					}else if (dias_actuales > 210 && dias_actuales <= 240) {
						$('#est_cul_up').val(3);
					}else if (dias_actuales > 240 && dias_actuales <= 300) {
						$('#est_cul_up').val(4);
					}else if (dias_actuales > 300 && dias_actuales <= 365) {
						$('#est_cul_up').val(5);
					}else if (dias_actuales > 365 && dias_actuales < total_dias) {
						$('#est_cul_up').val(6);
					}
				}else if(dias_actuales > 0 && dias_actuales == total_dias){
					$('#est_cul_up').val(7);
				}

				if(dias_actuales == 0){
					$('#est_cul').val(1);
				}

			}
		})
	}
</script>