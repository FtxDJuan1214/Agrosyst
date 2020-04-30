function actualizar_tabla(){
	$('#tab_semillas').load('../php/componentes/componentes_semillas/tab_semillas.php');
}


function preloader(){
	des_ins=$('#des_ins').val();
	cod_tsa=$('#cod_tsa').val();
	cod_unm=$('#cod_unm').val();
	det_sem=$('#det_sem').val();	
	if(des_ins == "" || cod_tsa == null || cod_unm == null || det_sem == ""){
		toastr.error('Todos los campos son requeridos','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		if (des_ins.length < 6 ){

			$('#div_des_ins').removeClass("input-group input-group-alternative");
			toastr.error('El nombre de la semilla debe tener al menos 6 letras. ','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_sem.length < 11 ){
			$('#div_det_sem').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			jQuery('#preloader').show();
			jQuery('#form-add-sem').hide();
			setTimeout ("agregar_insumo(des_ins,cod_tsa,cod_unm,det_sem);", 1000);
		}
	}
}

function agregar_insumo(des_ins,cod_tsa,cod_unm,det_sem){
	
	cadena ="des_ins="+des_ins+
	"&cod_tsa="+cod_tsa+
	"&cod_unm="+cod_unm+
	"&det_sem="+det_sem;

	$.ajax({
		type:"post",
		data:cadena,
		url:"../php/crud/semillas/agregar_insumo.php",
		success:function(r){
			result=r.trim();
			if(result=='Resource id #6' || result=='Resource id #7'){

				actualizar_tabla();
				$('#modal-form').modal('hide');
				var form = document.querySelector('#form-add-sem');
				form.reset();
				actualizar_tabla();

				jQuery('#preloader').hide();
				jQuery('#form-add-sem').show();

				if(cod_tsa!=""){
					$.ajax({
						type:"post",
						url:"../php/crud/semillas/agregar_semilla.php",
						data:cadena,						
					});					
				}

				swal("¡Insumo Agregado!"," ", "success");
				actualizar_tabla();
			}else{
				swal("Verifica los datos!", r , "error");
				jQuery('#preloader').hide();
				jQuery('#form-add-sem').show();
			}
		}

	});
	
}
global = "";
global1 = "";


function llenarform(datos){
	data= datos.split('||');
	$('#modal-form-up').modal('toggle');
	$('#des_insup').val(data[2]);
	$('#cod_tsaup').val(parseInt(data[3]));
	$('#cod_unmup').val(parseInt(data[5]));
	$('#det_semup').val(data[7].trim());
	global = data[0];
	global1 = data[1];
}



function preloaderup(){
	cod_sem = global;
	cod_ins = global1;

	des_insup=$('#des_insup').val();
	cod_tsaup=$('#cod_tsaup').val();
	cod_unmup=$('#cod_unmup').val();
	det_semup=$('#det_semup').val();

	if(des_insup == "" || cod_tsaup == null || cod_unmup == null || det_semup == ""){
		toastr.error('Todos los campos son requeridos','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		if (des_insup.length < 6 ){

			$('#div_des_insup').removeClass("input-group input-group-alternative");
			toastr.error('El nombre de la semilla debe tener al menos 6 letras. ','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_semup.length < 11 ){
			$('#div_det_semup').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			jQuery('#preloaderup').show();
			jQuery('#form-up-sem').hide();
			setTimeout ("actualizar_semilla(cod_sem,cod_ins,des_insup,cod_tsaup,cod_unmup,det_semup);", 1000);
		}

		
	}
}



	function actualizar_semilla(global,global1,des_insup,cod_tsaup,cod_unmup,det_semup){
		cadena ="cod_sem="+global+
		"&cod_ins="+global1+
		"&des_insup="+des_insup+
		"&cod_tsaup="+cod_tsaup+
		"&cod_unmup="+cod_unmup+
		"&det_semup="+det_semup;
		$.ajax({
			type:"post",
			url:"../php/crud/semillas/actualizar_semilla.php",
			data:cadena,
			success:function(r){
				result=r.trim();
				if(result=='Resource id #6' || result=='Resource id #7'){
					swal("¡Semilla Editada!"," ", "success");
					var form = document.querySelector('#form-up-sem');
					form.reset();
					$('#modal-form-up').modal('hide'); 
					jQuery('#preloaderup').hide();
					jQuery('#form-up-sem').show();				       
					$('#tab_semillas').load('../php/componentes/componentes_semillas/tab_semillas.php');

				}else{
					alert(r); 
					jQuery('#preloaderup').hide();
					jQuery('#form-up-sem').show();
					$('#tab_semillas').load('../php/componentes/componentes_semillas/tab_semillas.php');        
				}
			}
		});
	}


	function eliminar_semilla(datos){
		data= datos.split('||');
		global = data[0];
		global1 = data[1];
		swal({
			title: "¿Estás seguro?",
			text: "¿Deseas eliminar esta semilla?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				cadena="cod_sem="+global+
				"&cod_ins="+global1;

				$.ajax({
					type:"post",
					url:"../php/crud/semillas/eliminar_semilla.php",
					data:cadena,
					success:function(r){
						$('#tab_semillas').load('../php/componentes/componentes_semillas/tab_semillas.php');
					}
				});
				swal("La semilla se ha eliminado!", {
					icon: "success",
				});
			} else {
				swal("Cancelado!");
			}
		});
		$('#tab_semillas').load('../php/componentes/componentes_semillas/tab_semillas.php');
	}


	$(document).ready(function(){
		$('#date-hour').load('../php/componentes/menu/date-hour.php');
		$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
		$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
		$('#tab_semillas').load('../php/componentes/componentes_semillas/tab_semillas.php');
		$('#menu').load('../php/componentes/menu/menu.php');

		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});



		$('#des_ins').keydown(function(){
			$('#div_des_ins').addClass("input-group input-group-alternative");
		});

		$('#det_sem').keydown(function(){
			$('#div_det_sem').addClass("input-group-alternative");
		});

		$('#des_insup').keydown(function(){
			$('#div_des_insup').addClass("input-group input-group-alternative");
		});

		$('#det_semup').keydown(function(){
			$('#div_det_semup').addClass("input-group-alternative");
		});


	});

	function cerrar_menu(){
		$('#sidenav-main').remove();
		jQuery('#ver1').hide();
		jQuery('#ver2').show();
	}