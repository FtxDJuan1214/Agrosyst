function actualizar_tabla(){
	$('#tab_otros').load('../php/componentes/componentes_otros/tab_otros.php');
}


function preloader(){

	des_ins=$('#des_ins').val();	
	cod_unm=$('#uni_med').val();
	det_otr=$('#det_otr').val().replace(/(\r\n|\n|\r)/gm," ");	

	if(des_ins == "" || cod_unm == null || det_otr == ""){
		if(des_ins == ""){

			toastr.error('Por favor ingresa el nombre del gasto','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_otr == ""){

			toastr.error(' Ingresa la descripción del gasto','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}
	}else{

		if (des_ins.length < 6 ){

			$('#div_des_ins').removeClass("input-group input-group-alternative");
			toastr.error('El nombre del gasto debe tener minimo 6 letras','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_otr.length < 11 ){
			$('#div_det_otr').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			jQuery('#preloader').show();
			jQuery('#form-add-otr').hide();
			setTimeout ("agregar_insumo(des_ins,cod_unm,det_otr);", 1000);
		}
	}
}



function agregar_insumo(des_ins,cod_unm,det_otr){
	
	cadena ="des_ins="+des_ins+		
	"&cod_unm="+cod_unm+
	"&det_otr="+det_otr;		

	$.ajax({
		type:"post",
		data:cadena,
		url:"../php/crud/otros/agregar_insumo.php",
		success:function(r){
			if(r.includes('Resource id')){				

				actualizar_tabla();
				$('#modal-form').modal('hide');

				var form = document.querySelector('#form-add-otr');
				form.reset();

				jQuery('#preloader').hide();
				jQuery('#form-add-otr').show();
				//Insertar el telefono del tercero

				if(cod_unm!=""){
					$.ajax({
						type:"post",
						url:"../php/crud/otros/agregar_otro.php",
						data:cadena,
						success: function(r){
							//alert(r);
						}
					});
					actualizar_tabla();
					
				}
				
				swal("¡Gasto Agregado!"," ", "success");
			}else{

				swal("Verifica los datos!", r , "error");
				jQuery('#preloader').hide();
				jQuery('#form-add-otr').show();
			}
		}
	});	
}


function llenarform(datos){
	data= datos.split('||');
	$('#modal-form-up').modal('toggle');
	$('#des_insup').val(data[2]);
	$('#tip_uni_medup').val(parseInt(data[6]));
	$('#uni_medup').val(parseInt(data[3]));
	$('#det_otrup').val(data[5]);
	global = data[0];
	global1 = data[1];
}



function preloaderup(){
	cod_otr = global;
	cod_ins = global1;

	des_insup=$('#des_insup').val();
	tip_uni_medup=$('#tip_uni_medup').val();
	uni_medup=$('#uni_medup').val();
	det_otrup=$('#det_otrup').val().replace(/(\r\n|\n|\r)/gm," ");	

	if(des_insup == "" || uni_medup == null || det_otrup == ""){
		if(des_insup == ""){

			toastr.error('Por favor ingresa el nombre del gasto','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_otrup == ""){

			toastr.error(' Ingresa la descripción del gasto','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}
	}else{

		if (des_insup.length < 6 ){

			$('#div_des_insup').removeClass("input-group input-group-alternative");
			toastr.error('El nombre del gasto debe tener minimo 6 letras','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_otrup.length < 11 ){
			$('#div_det_otrup').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			jQuery('#preloaderup').show();
			jQuery('#form-up-otr').hide();
			setTimeout ("actualizar_otro(cod_otr,cod_ins,des_insup,tip_uni_medup,uni_medup,det_otrup);", 1000);	
		}
	}
}



function actualizar_otro(global,global1,des_insup,tip_uni_medup,uni_medup,det_otrup){
	cadena ="cod_otr="+global+
	"&cod_ins="+global1+
	"&des_insup="+des_insup+
	"&tip_uni_medup="+tip_uni_medup+
	"&uni_medup="+uni_medup+
	"&det_otrup="+det_otrup;

	$.ajax({
		type:"post",
		url:"../php/crud/otros/actualizar_otro.php",
		data:cadena,
		success:function(r){
			if(r.includes('Resource id')){
				swal("¡Gato Editado!"," ", "success");
				var form = document.querySelector('#form-up-otr');
				form.reset();
				$('#modal-form-up').modal('hide'); 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-otr').show();				       
				$('#tab_otros').load('../php/componentes/componentes_otros/tab_otros.php');

			}else{
				alert(r); 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-otr').show();
				$('#tab_otros').load('../php/componentes/componentes_otros/tab_otros.php');        
			}
		}
	});
}


function eliminar_otro(datos){
	data= datos.split('||');
	global = data[0];
	global1 = data[1];
	swal({
		title: "¿Estás seguro?",
		text: "¿Deseas eliminar este gasto?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="cod_otr="+global+
			"&cod_ins="+global1;

			$.ajax({
				type:"post",
				url:"../php/crud/otros/eliminar_otro.php",
				data:cadena,
				success:function(r){
					$('#tab_otros').load('../php/componentes/componentes_otros/tab_otros.php');
				}
			});
			swal("Gasto eliminado!", {
				icon: "success",
			});
		} else {
			swal("Cancelado!");
		}
	});
	$('#tab_otros').load('../php/componentes/componentes_otros/tab_otros.php');
}


$(document).ready(function(){
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#tab_otros').load('../php/componentes/componentes_otros/tab_otros.php');
	$('#menu').load('../php/componentes/menu/menu.php');

	$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('#det_otr').keydown(function(){
		$('#div_det_otr').addClass("input-group input-group-alternative");
	});

	$('#des_ins').keydown(function(){
		$('#div_des_ins').addClass("input-group input-group-alternative");
	});

	$('#det_otrup').keydown(function(){
		$('#div_det_otrup').addClass("input-group input-group-alternative");
	});

	$('#des_insup').keydown(function(){
		$('#div_des_insup').addClass("input-group input-group-alternative");
	});

});


function cerrar_menu(){
	$('#sidenav-main').remove();
	jQuery('#ver1').hide();
	jQuery('#ver2').show();
}