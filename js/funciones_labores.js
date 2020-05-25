function actualizar_tabla(){
	$('#tab_lab').load('../php/componentes/componentes_labores/tab_lab.php');
}


function preloader(){
	
	nom_lab=$('#nom_lab').val();
	det_lab=$('#det_lab').val().replace(/(\r\n|\n|\r)/gm," ");	

	if(nom_lab == "" || det_lab == "" ){

		if(nom_lab == ""){
			toastr.error('Por favor ingrese el nombre de la labor','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if(det_lab == ""){
			toastr.error('Por favor ingrese la descripción de la labor','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}

	}else if (nom_lab.length < 5){
		$('#div_nom_lab').removeClass("input-group input-group-alternative");
		toastr.error('El nombre de la labor es muy corto.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});

	}else if(det_lab.length < 10){
		$('#div_det_lab').removeClass("input-group input-group-alternative");
		toastr.error('La descripción es muy corta.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});

	}else{
		jQuery('#preloader').show();
		jQuery('#form-add-lab').hide();
		setTimeout ("agregar_labor(nom_lab,det_lab);", 1000);
	}

	
}

function agregar_labor(nom_lab,det_lab){
	
	cadena ="nom_lab="+nom_lab+
	"&det_lab="+det_lab;

	$.ajax({
		type:"post",
		data:cadena,
		url:"../php/crud/labores/agregar_labor.php",
		success:function(r){
			if(r.includes('Resource id')){
				actualizar_tabla();
				$('#modal-form').modal('hide');

				var form = document.querySelector('#form-add-lab');
				form.reset();
				actualizar_tabla();

				jQuery('#preloader').hide();
				jQuery('#form-add-lab').show();

				swal("Labor Agregada!","", "success");
			}else{
				swal("Verifica los datos!", r , "error");
				jQuery('#preloader').hide();
				jQuery('#form-add-lab').show();
			}
		}
	});	
}

var global = 0;

function llenarform(datos){
	data= datos.split('||');
	$('#nom_labup').val(data[1]);
	$('#det_labup').val(data[2].trim());
	$('#modal-form-up').modal('toggle');
	global = data[0];
}



function preloaderup(){
	
	cod_lab = global;
	nom_labup=$('#nom_labup').val();
	det_labup=$('#det_labup').val().replace(/(\r\n|\n|\r)/gm," ");	

	if(nom_labup == "" || det_labup == "" ){

		if(nom_labup == ""){
			toastr.error('Por favor ingrese el nombre de la labor','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if(det_labup == ""){
			toastr.error('Por favor ingrese la descripción de la labor','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}

	}else if (nom_labup.length < 5){
		$('#div_nom_labup').removeClass("input-group input-group-alternative");
		toastr.error('El nombre de la labor es muy corto.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});

	}else if(det_labup.length < 10){
		$('#div_det_labup').removeClass("input-group input-group-alternative");
		toastr.error('La descripción es muy corta.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});

	}else{
		jQuery('#preloaderup').show();
		jQuery('#form-up-lab').hide();
		setTimeout ("actualizar_labor(cod_lab,nom_labup,det_labup);", 1000);	
	}



}


function actualizar_labor(global,nom_labup,det_labup){
	cadena ="cod_lab="+global+
	"&nom_labup="+nom_labup+
	"&det_labup="+det_labup;
	$.ajax({
		type:"post",
		url:"../php/crud/labores/actualizar_labor.php",
		data:cadena,
		success:function(r){
			if(r.includes('Resource id')){
				swal("¡Labor Editada!"," ", "success");
				var form = document.querySelector('#form-up-lab');
				form.reset();
				$('#modal-form-up').modal('hide'); 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-lab').show();				       
				$('#tab_lab').load('../php/componentes/componentes_labores/tab_lab.php');

			}else{
				jQuery('#preloaderup').hide();
				jQuery('#form-up-lab').show();
				$('#tab_lab').load('../php/componentes/componentes_labores/tab_lab.php');        
			}
		}
	});
	$.ajax({
		type:"post",
		url:"../php/crud/labores/actualizar_labor.php",
		data:cadena,
		success:function(r){
			med_ant=parseFloat(data[8]);
			med_ant=med_ant*r;
		}
	});
}


function eliminar_labor(datos){
	data= datos.split('||');
	global = data[0];
	swal({
		title: "¿Estás seguro?",
		text: "¿Deseas eliminar esta labor?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="cod_lab="+global;
			$.ajax({
				type:"post",
				url:"../php/crud/labores/eliminar_labor.php",
				data:cadena,
				success:function(r){
					$('#tab_lab').load('../php/componentes/componentes_labores/tab_lab.php');
				}
			});
			swal("La labor se ha eliminado!", {
				icon: "success",
			});
		} else {
			swal("Cancelado!");
		}
	});
	$('#tab_lab').load('../php/componentes/componentes_labores/tab_lab.php');
}

function cerrar_menu(){
	$('#sidenav-main').remove();
	jQuery('#ver1').hide();
	jQuery('#ver2').show();
}

$(document).ready(function(){
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#tab_lab').load('../php/componentes/componentes_labores/tab_lab.php');
	$('#menu').load('../php/componentes/menu/menu.php');
	$('#calculadora').load('../php/componentes/calculadora/calculadora.php');
	
	$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('#det_lab').keydown(function(){
		$('#div_det_lab').addClass("input-group input-group-alternative");
	});
	$('#nom_lab').keydown(function(){
		$('#div_nom_lab').addClass("input-group-alternative");
	});
	$('#nom_labup').keydown(function(){
		$('#div_nom_labup').addClass("input-group input-group-alternative");
	});
	$('#det_labup').keydown(function(){
		$('#div_det_labup').addClass("input-group-alternative");
	});

});



  //boton flotante
  $('.botonF1').hover(function(){
  	$('.flotante').addClass('animacionVer');
  })
  $('.contenedor').mouseleave(function(){
  	$('.flotante').removeClass('animacionVer');
  })