function actualizar_tabla(){
	$('#tab_terceros').load('../php/componentes/componentes_terceros/tab_terceros.php');
	$('#contadores').load('../php/componentes/componentes_terceros/contadores.php');
}

function objetoAjax(){
	var xmlhttp= false;
	try {
		xmlhttp = new  ActiveXObject("MsxmL2.XMLHTTP");
	}catch(e){
		try{
			xmlhttp = new  ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function preloader(){
	ide_ter=$('#ide_ter').val();
	pno_ter=$('#pno_ter').val();
	sno_ter=$('#sno_ter').val();
	pap_ter=$('#pap_ter').val();
	sap_ter=$('#sap_ter').val();
	tel_ter=$('#tel_ter').val();
	eml_ter=$('#eml_ter').val();
	tipo_per=$('#tipo_per').val();

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
			ide_ter=($('#cod_log').val()+$('#ide_ter').val()).trim();
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
		jQuery('#preloader').show();
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
			url:"../php/crud/terceros/agregar_tercero.php",
			success:function(r){
				$('#rr').val(r);
				result=$('#rr').val();
				if(result=='Resource id #6'){

					swal("Tercero agregado!"," ", "success");

					actualizar_tabla();
					$('#modal-form').modal('hide');

					var form = document.querySelector('#form-add-ter');
					form.reset();

					jQuery('#preloader').hide();
					jQuery('#form-add-ter').show();
					actualizar_tabla();
				// Insertar el telefono del tercero

				if(tel_ter==null||tel_ter==" "||tel_ter==""||tel_ter==''){}else{
					$.ajax({
						type:"post",
						url:"../php/crud/terceros/agregar_telefono.php",
						data:cadena,
					});
					actualizar_tabla();
				}

     			// Insertar el Email del tercero

     			if(eml_ter==null||eml_ter==" "||eml_ter==""||eml_ter==''){}else{ 	
     				$.ajax({
     					type:"post",
     					url:"../php/crud/terceros/agregar_email.php",
     					data:cadena,
     				});
     				$('#tab_terceros').load('php/componentes/componentes_terceros/tab_terceros.php');
     			}
     			// // Insertar el tipo de tercero del tercero
     			$.ajax({
     				type:"post",
     				url:"../php/crud/terceros/agregar_tipo_per.php",
     				data:cadena,
     			});
     			actualizar_tabla();

     		}else{
     			swal("Verifica los datos!", r , "error");
     			jQuery('#preloader').hide();
     			jQuery('#form-add-ter').show();
     		}
     	}

     });
	}else{
		jQuery('#preloader').hide();
		jQuery('#form-add-ter').show();
	}
}

var global = 0;
function llenarform(datos){
	data= datos.split('||');
	ced = data[0].split('-');
	
	$('#modal-form-up').modal('toggle');
	$('#ver_ced').val(ced[1]);

	$('#ide_terup').val(data[0].trim());
	$('#pno_terup').val(data[1]);
	$('#sno_terup').val(data[2]);
	$('#pap_terup').val(data[3]);
	$('#sap_terup').val(data[4]);
	$('#tipo_perup').val(parseInt(data[5]));
	llenar_contacto(data[0]);
	global=parseInt(data[5]);
}

function llenar_contacto(ide_ter){
	id=(ide_ter.trim());
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_terceros/telefonos.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("contacto").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("ide_ter="+id);
}

function agregar_telefono(){

	tel_ter=$('#tel_terup').val();
	if(tel_terup != ""){

		cond_tel_terup =  Boolean(false);

		if (isNaN(tel_ter)){
			$('#div_tel_terup').removeClass("input-group input-group-alternative");
			toastr.error('El teléfono no puede tener letras','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else if (tel_ter.length != 10){

			$('#div_tel_terup').removeClass("input-group input-group-alternative");
			toastr.error('El teléfono debe tener entre 10 dígitos.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else {
			$('#div_tel_terup').addClass("input-group input-group-alternative");
			cond_tel_terup =  Boolean(true);
		}

		if(cond_tel_terup == true){
			ide_ter=$('#ide_terup').val();
			cadena="ide_ter="+ide_ter+
			"&tel_ter="+tel_ter;

			$.ajax({
				type:"post",
				url:"../php/crud/terceros/agregar_telefono.php",
				data:cadena,
				success:function(r){
					result =toString(r);
					if (result=='Resource id #6'){
						llenar_contacto(ide_ter);
						actualizar_tabla();
					}else{
						llenar_contacto(ide_ter);
						actualizar_tabla();
					}
				}
			});
		}

	}else{

		$('#div_tel_terup').removeClass("input-group input-group-alternative");
		toastr.error('Debe llenar este campo','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}

	$('#tel_terup').keydown(function(){
		$('#div_tel_terup').addClass("input-group input-group-alternative");
	});
	
}


function agregar_email(){
	ema_ter=$('#eml_terup').val();
	if(ema_ter!=""){

		cond_tel_terup =  Boolean(false);
		expresion= /\w+@\w+\.+[a-z]/;

		if (!expresion.test(ema_ter)) {
			$('#div_eml_terup').removeClass("input-group input-group-alternative");
			toastr.error('El correo no es válido','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

		}else{
			$('#div_eml_terup').addClass("input-group input-group-alternative");
			ide_ter=$('#ide_terup').val();
			cadena="ide_ter="+ide_ter+
			"&eml_ter="+ema_ter;
			$.ajax({
				type:"post",
				url:"../php/crud/terceros/agregar_email.php",
				data:cadena,
				success:function(r){
					result =toString(r);
					if (result=='Resource id #6'){
						llenar_contacto(ide_ter);
					}else{
						llenar_contacto(ide_ter);
					}
				}
			});
		}
	}else{
		$('#div_eml_terup').removeClass("input-group input-group-alternative");
		toastr.error('Debe llenar este campo','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}

	$('#eml_terup').keydown(function(){
		$('#div_eml_terup').addClass("input-group input-group-alternative");
	});
}


function eliminar_eml(eml){
	ide_ter=$('#ide_terup').val();
	swal({
		title: "Estas seguro?",
		text: "Deseas eliminar este email?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="eml_ter="+eml;
			$.ajax({
				type:"post",
				url:"../php/crud/terceros/eliminar_eml.php",
				data:cadena,
				success:function(r){
					actualizar_tabla();
					llenar_contacto(ide_ter);
				}
			});
			swal("El telefono se elimino!", {
				icon: "success",
			});
		} else {
			swal("Cancelado!");
		}
	});
}

function eliminar_tel(eml){
	ide_ter=$('#ide_terup').val();
	swal({
		title: "Estas seguro?",
		text: "Deseas eliminar este teléfono?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="eml_ter="+eml;
			$.ajax({
				type:"post",
				url:"../php/crud/terceros/eliminar_tel.php",
				data:cadena,
				success:function(r){
					actualizar_tabla();
					llenar_contacto(ide_ter);
				}
			});
			swal("El telefono se elimino!", {
				icon: "success",
			});
		} else {
			swal("Cancelado!");
		}
	});
}

function preloaderup(){
	ide_terup=$('#ide_terup').val();
	pno_terup=$('#pno_terup').val();
	sno_terup=$('#sno_terup').val();
	pap_terup=$('#pap_terup').val();
	sap_terup=$('#sap_terup').val();
	tel_terup=$('#tel_terup').val();
	eml_terup=$('#eml_terup').val();
	tipo_perup=$('#tipo_perup').val();
	expresion= /\w+@\w+\.+[a-z]/;

	

	if(pno_terup == "" || pap_terup == "" || sap_terup == ""){
		toastr.error('Algunos campos son obligatorios','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		cond_tel_terup =  Boolean(false);
		cond_eml_terup =  Boolean(false);

		if(tel_terup !=""){
			if (isNaN(tel_terup)){
				$('#div_tel_terup').removeClass("input-group input-group-alternative");
				toastr.error('El teléfono no puede tener letras','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else if (tel_terup.length != 10){

				$('#div_tel_terup').removeClass("input-group input-group-alternative");
				toastr.error('El teléfono debe tener entre 10 dígitos.','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else {
				$('#div_tel_terup').addClass("input-group input-group-alternative");
				cond_tel_terup =  Boolean(true);
			}
		}else{
			cond_tel_terup =  Boolean(true);
		}

		if(eml_terup != ""){
			if (!expresion.test(eml_terup)) {
				$('#div_eml_terup').removeClass("input-group input-group-alternative");
				toastr.error('El correo no es válido','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else{
				cond_eml_terup =  Boolean(true);
			}
		}else{
			cond_eml_terup =  Boolean(true);
		}

		if(cond_eml_terup == true && cond_tel_terup == true){

			jQuery('#preloaderup').show();
			jQuery('#form-up-ter').hide();

			setTimeout ("actualizar_tercero(ide_terup,pno_terup,sno_terup,pap_terup,sap_terup,tel_terup,eml_terup,tipo_perup);", 1000);	
		}
	}

	$('#eml_terup').keydown(function(){
		$('#div_eml_terup').addClass("input-group input-group-alternative");
	});

	$('#tel_terup').keydown(function(){
		$('#div_tel_terup').addClass("input-group input-group-alternative");
	});

}


function actualizar_tercero(ide_terup,pno_terup,sno_terup,pap_terup,sap_terup,tel_terup,eml_terup,tipo_perup){
	cadena="ide_ter="+ide_terup+
	"&pno_ter="+pno_terup+
	"&sno_ter="+sno_terup+
	"&pap_ter="+pap_terup+
	"&sap_ter="+sap_terup+
	"&tel_ter="+tel_terup+
	"&eml_ter="+eml_terup+
	"&global="+global+
	"&tipo_per="+tipo_perup;
	$.ajax({
		type:"post",
		data:cadena,
		url:"../php/crud/terceros/actualizar_tercero.php",
		success:function(r){
			$('#rrr').val(r);
			result=$('#rr').val();
			if (result='Resource id #6'){
				actualizar_tabla();
				$('#modal-form-up').modal('hide');

				var form = document.querySelector('#form-up-ter');
				form.reset();
				swal("Datos editados!"," ", "success");
				jQuery('#preloaderup').hide();
				jQuery('#form-up-ter').show();

				if (tel_terup!=""){
					$.ajax({
						type:"post",
						url:"../php/crud/terceros/agregar_telefono.php",
						data:cadena,
					});
					actualizar_tabla();

				}

				if(eml_terup!=""){
					$.ajax({
						type:"post",
						url:"../php/crud/terceros/agregar_email.php",
						data:cadena,
					});
					actualizar_tabla();
				}

				if (tipo_perup!=global){
					$.ajax({

						type:"post",
						url:"../php/crud/terceros/eliminar_tipo_per.php",
						data:cadena,
						success:function(r){
							// alert(r);
						}

					});

					$.ajax({
						type:"post",
						url:"../php/crud/terceros/agregar_tipo_per.php",
						data:cadena,
						success:function(r){
							// alert(r);
						}
					});
					actualizar_tabla();
				}
				actualizar_tabla();
			}
		}
	});
}


function eliminar_tercero(datos){
	data= datos.split('||');
	nombre = data[1]+" "+data[2]+" "+data[3]+" "+data[4];
	swal({
		title: "Estas seguro?",
		text: "Deseas eliminar a "+nombre+" de la lista de terceros?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="ide_ter="+data[0].trim()+"&global="+parseInt(data[5]);
			
			$.ajax({
				type:"post",
				url:"../php/crud/terceros/comprobar_tercero.php",
				data:cadena,
				success:function(r){
					if(r.trim()==""){
						$.ajax({
							type:"post",
							url:"../php/crud/terceros/eliminar_tipo_per.php",
							data:cadena,
							success:function(r){
							}
						});
						$.ajax({
							type:"post",
							url:"../php/crud/terceros/eliminar_tercero.php",
							data:cadena,
							success:function(r){
								$('#tab_terceros').load('../php/componentes/componentes_terceros/tab_terceros.php');	
							}
						});
						$('#contadores').load('../php/componentes/componentes_terceros/contadores.php');
						swal("El tercero se elimino!", {
							icon: "success",
						});
					}else{
						swal(r, {
							icon: "info",
						});
					}
				}
			});
			
		} else {
			swal("Cancelado!");
		}
	});

}


$(document).ready(function(){

	$('#contadores').load('../php/componentes/componentes_terceros/contadores.php');
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    //$('#footer').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_terceros').load('../php/componentes/componentes_terceros/tab_terceros.php');
    $('#menu').load('../php/componentes/menu/menu.php');

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
    

    $("#myInput").on("keyup", function() {
    	var value = $(this).val().toLowerCase();
    	$("#myTable tr").filter(function() {
    		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    	});
    });
});


function cerrar_menu(){
	$('#sidenav-main').remove();
	jQuery('#ver1').hide();
	jQuery('#ver2').show();
}