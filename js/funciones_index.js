function preloader_d(){

	ide_ter=$('#ide_ter').val();
	pno_ter=$('#pno_ter').val();
	sno_ter=$('#sno_ter').val();
	pap_ter=$('#pap_ter').val();
	sap_ter=$('#sap_ter').val();
	tel_ter=$('#tel_ter').val();
	eml_ter=$('#eml_ter').val();
	tipo_per=1;


	cond_ide_ter =  Boolean(false);
	cond_pno_ter =  Boolean(false);
	cond_sno_ter =  Boolean(false);
	cond_pap_ter =  Boolean(false);
	cond_sap_ter =  Boolean(false);
	cond_tel_ter =  Boolean(false);
	cond_eml_ter =  Boolean(false);
	cond_tipo_per =  Boolean(false);
	expresion= /\w+@\w+\.+[a-z]/;
	
	if (ide_ter == "" || pno_ter == "" || pap_ter == "" || sap_ter == "" || tipo_per == null){
		//alert("id: " + ide_ter + "\nP_nom: " + pno_ter + "\nS_nom: " + sno_ter + "\nS_ape: " + sap_ter + "\nTel: " + tel_ter +"\nTipo: " + tipo_per);
		toastr.error('Algunos campos son obligatorios','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		if (isNaN(ide_ter)){
			$('#div_ide_ter').removeClass("input-group input-group-alternative");
			toastr.error('La cédula no puede tener letras','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if (ide_ter.length<8 || ide_ter.length>10){

			$('#div_ide_ter').removeClass("input-group input-group-alternative");
			toastr.error('La cédula debe tener entre 8 y 10 dígitos.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{

			$('#div_ide_ter').addClass("input-group input-group-alternative");
			cond_ide_ter =  Boolean(true);
			ide_ter=($('#ide_usuario').val()+$('#ide_ter').val()).trim();
		}

		if(tel_ter != ""){

			if (isNaN(tel_ter)){
				$('#div_tel_ter').removeClass("input-group input-group-alternative");
				toastr.error('El teléfono no puede tener letras','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else if (tel_ter.length<10){

				$('#div_tel_ter').removeClass("input-group input-group-alternative");
				toastr.error('El teléfono debe tener entre 10 dígitos.','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else {
				$('#div_tel_ter').addClass("input-group input-group-alternative");
				cond_tel_ter =  Boolean(true);
			}
		}else{
			cond_tel_ter =  Boolean(true);
		}

		if(eml_ter != ""){
			if (!expresion.test(eml_ter)) {
				$('#div_eml_ter').removeClass("input-group input-group-alternative");
				toastr.error('El correo no es válido','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else{
				$('#div_eml_ter').addClass("input-group input-group-alternative");
				cond_eml_ter =  Boolean(true);
			}
		}else{
			cond_eml_ter =  Boolean(true);
		}


	}

	if (cond_ide_ter == true && cond_tel_ter == true && cond_eml_ter == true){
		jQuery('#preloaderd').show();
		jQuery('#form-add-ter').hide();
		setTimeout ("agregar_tercero(ide_ter,pno_ter,sno_ter,pap_ter,sap_ter,tel_ter,eml_ter,tipo_per);", 1000);
	}
}

function agregar_tercero(ide_ter,pno_ter,sno_ter,pap_ter,sap_ter,tel_ter,eml_ter,tipo_per){
	if(ide_ter!=""){
		cadena ="ide_ter="+ide_ter+
		"&pno_ter="+pno_ter+
		"&sno_ter="+sno_ter+
		"&pap_ter="+pap_ter+
		"&sap_ter="+sap_ter+
		"&tel_ter="+tel_ter+
		"&eml_ter="+eml_ter+
		"&tipo_per="+tipo_per;
		$.ajax({
			type:"post",
			data:cadena,
			url:"php/crud/terceros/agregar_tercero.php",
			success:function(r){
				if(r.includes('Resource id')){

					swal("Tercero agregado!"," ", "success");


					var form = document.querySelector('#form-add-ter');
					form.reset();

					jQuery('#preloaderd').hide();
					jQuery('#form-add-ter').show();
					$('#duenios').load('php/componentes/componentes_index/duenios.php');
				// Insertar el telefono del tercero

				if(tel_ter==null||tel_ter==" "||tel_ter==""||tel_ter==''){}else{
					$.ajax({
						type:"post",
						url:"php/crud/terceros/agregar_telefono.php",
						data:cadena,
					});
				}

     			// Insertar el Email del tercero

     			if(eml_ter==null||eml_ter==" "||eml_ter==""||eml_ter==''){}else{ 	
     				$.ajax({
     					type:"post",
     					url:"php/crud/terceros/agregar_email.php",
     					data:cadena,
     				});
     			}
     			// // Insertar el tipo de tercero del tercero
     			$.ajax({
     				type:"post",
     				url:"php/crud/terceros/agregar_tipo_per.php",
     				data:cadena,
     				success:function(r){
     					//alert("tipo: " + r);
     					$('#duenios').load('php/componentes/componentes_index/duenios.php');
     				}
     			});
     			$('#duenios').load('php/componentes/componentes_index/duenios.php');
     			$('#modal-duenio').modal('hide');


     		}else{
     			swal("Verifica los datos!", r , "error");
     			jQuery('#preloaderd').hide();
     			jQuery('#form-add-ter').show();
     		}
     	}

     });
	}else{
		jQuery('#preloaderd').hide();
		jQuery('#form-add-ter').show();
		$('#modal-duenio').modal('hide');

	}
}


$(document).ready(function(){
	$('#duenios').load('php/componentes/componentes_index/duenios.php');
	$('#dep_fin').change(function(){
		recargarlista();      
	});

	$('#btn_save').click(function(){
		preloader();          
	});

	$('#ide_ter').keydown(function(){
		$('#div_ide_ter').addClass("input-group input-group-alternative");
	});

	$('#pno_ter').keydown(function(){
		$('#div_pno_ter').addClass("input-group input-group-alternative");
	});

	$('#sno_ter').keydown(function(){
		$('#div_sno_ter').addClass("input-group input-group-alternative");
	});

	$('#pap_ter').keydown(function(){
		$('#div_pap_ter').addClass("input-group input-group-alternative");
	});

	$('#sap_ter').keydown(function(){
		$('#div_sap_ter').addClass("input-group input-group-alternative");
	});

	$('#tel_ter').keydown(function(){
		$('#div_tel_ter').addClass("input-group input-group-alternative");
	});

	$('#eml_ter').keydown(function(){
		$('#div_eml_ter').addClass("input-group input-group-alternative");
	});

	$('#modal-duenio').on('hidden.bs.modal', function (e) {
		$('#modal-form').modal('hide');
	})


});

function recargarlista(){
	cod_dep=$('#dep_fin').val();
	$.ajax({
		type:"post",
		url:"php/componentes/componentes_fincas/select_finc.php",
		data:"cod_dep="+cod_dep,
		success:function(r){
			$('#muni_dep').html(r);
		}
	});
}

for (var i = 0 ; i<10; i++) {
	console.log("hola");
}

