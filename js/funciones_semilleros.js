function actualizar_tabla(){
	$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');
}


function preloader(){
	
	des_ins=$('#des_ins').val();
	cod_tso=$('#cod_tso').val();
	det_smr=$('#det_smr').val();	


	if(des_ins == "" || cod_tso == null || det_smr == ""){
		toastr.error('Todos los campos son requeridos','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		if (des_ins.length < 6 ){

			$('#div_des_ins').removeClass("input-group input-group-alternative");
			toastr.error('El nombre del semillero debe tener al menos 6 letras. ','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_smr.length < 11 ){
			$('#div_det_smr').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			jQuery('#preloader').show();
			jQuery('#form-add-smr').hide();
			setTimeout ("agregar_insumo(des_ins,cod_tso,det_smr);", 1000);		
		}
	}

}

function agregar_insumo(des_ins,cod_tso,det_smr){

	cadena ="des_ins="+des_ins+
	"&cod_tso="+cod_tso+
	"&det_smr="+det_smr;

	$.ajax({
		type:"post",
		data:cadena,
		url:"../php/crud/semilleros/agregar_insumo.php",
		success:function(r){
			if(r.trim()=='Resource id #6'){	
				actualizar_tabla();	
				$('#modal-form').modal('hide');
				var form = document.querySelector('#form-add-smr');
				form.reset();
				jQuery('#preloader').hide();
				jQuery('#form-add-smr').show();
				actualizar_tabla();	

				$.ajax({
					type:"post",
					url:"../php/crud/semilleros/agregar_semillero.php",
					data:cadena,
					success:function(r){
							alert("Semillero: " + r);
						}						
					});
				$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');
				swal("¡Insumo Agregado!"," ", "success");

			}else{
				swal("Verifica los datos!", r , "error");
				jQuery('#preloader').hide();
				jQuery('#form-add-smr').show();
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
	$('#cod_tsoup').val(parseInt(data[3]));
	$('#det_smrup').val(data[6].trim());
	global = data[0];
	global1 = data[1];
}



function preloaderup(){
	cod_smr = global;
	cod_ins = global1;
	des_insup=$('#des_insup').val();
	cod_tsoup=$('#cod_tsoup').val();
	det_smrup=$('#det_smrup').val();

	if(des_insup == "" || cod_tsoup == null || det_smrup == ""){
		toastr.error('Todos los campos son requeridos','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		if (des_insup.length < 6 ){

			$('#div_des_insup').removeClass("input-group input-group-alternative");
			toastr.error('El nombre del semillero debe tener al menos 6 letras. ','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if(det_smrup.length < 11 ){
			$('#div_det_smrup').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			jQuery('#preloaderup').show();
			jQuery('#form-up-smr').hide();
			setTimeout ("actualizar_semillero(cod_smr,cod_ins,des_insup,cod_tsoup,det_smrup);", 1000);	
		}
	}


}



function actualizar_semillero(global,global1,des_insup,cod_tsoup,det_smrup){
	cadena ="cod_smr="+global+
	"&cod_ins="+global1+
	"&des_insup="+des_insup+
	"&cod_tsoup="+cod_tsoup+
	"&det_smrup="+det_smrup;
	$.ajax({
		type:"post",
		url:"../php/crud/semilleros/actualizar_semillero.php",
		data:cadena,
		success:function(r){
			if(r.trim() =='Resource id #6' || r.trim() =='Resource id #7'){
				swal("¡Semillero Editado!"," ", "success");
				var form = document.querySelector('#form-up-smr');
				form.reset();
				$('#modal-form-up').modal('hide'); 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-smr').show();				       
				$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');

			}else{ 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-smr').show();
				$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');        
			}
		}
	});
}


function eliminar_semillero(datos){
	data= datos.split('||');
	global = data[0];
	global1 = data[1];
	swal({
		title: "¿Estás seguro?",
		text: "¿Deseas eliminar este semillero?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="cod_smr="+global+
			"&cod_ins="+global1;

			$.ajax({
				type:"post",
				url:"../php/crud/semilleros/eliminar_semillero.php",
				data:cadena,
				success:function(r){
					$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');
				}
			});
			swal("El semillero se ha eliminado!", {
				icon: "success",
			});
		} else {
			swal("Cancelado!");
		}
	});
	$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');
}



$(document).ready(function(){
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#tab_semilleros').load('../php/componentes/componentes_semilleros/tab_semilleros.php');
	$('#menu').load('../php/componentes/menu/menu.php');


	$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('#det_smr').keydown(function(){
		$('#div_det_smr').addClass("input-group input-group-alternative");
	});

	$('#des_ins').keydown(function(){
		$('#div_des_ins').addClass("input-group input-group-alternative");
	});

	$('#det_smrup').keydown(function(){
		$('#div_det_smrup').addClass("input-group input-group-alternative");
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