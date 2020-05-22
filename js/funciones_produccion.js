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
	
	cod_cul=$('#cultivo').val();
	ide_ter=$('#cliente').val();
	if(cod_cul == null || ide_ter == null){
		if (cod_cul){
			toastr.error('Seleccione un cultivo','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if (ide_ter){
			toastr.error('Seleccione el cliente de la producción','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}
	}else{
		jQuery('#preloader').show();
		jQuery('#form-add-produccion').hide();
		setTimeout ("crear_produccion(cod_cul,ide_ter);", 1000);
	}
	
}

function crear_produccion(cod_cul,ide_ter){
	if (cod_cul != null) {

		$.ajax({
			type:"post",
			url:"../php/crud/produccion/crear_produccion.php",
			data:"cod_cul="+cod_cul+"&ide_ter="+ide_ter,
			success:function(r){
				if(parseInt(r) > 0){
					$('#modal-crud-gozar').modal('toggle');

					var form = document.querySelector('#form-add-produccion');
					form.reset();
					resetselects();

					$('#cod_pro').val(r);
					$('#cod_cul').val(cod_cul);
					$('#ide_ter').val(ide_ter);
					
					swal("Por favor llena los siguientes datos"," ", "success");
					document.getElementById("tab_producciones").innerHTML = "";
					jQuery('#preloader').hide();
					jQuery('#form-add-produccion').show();

				}else{
					swal("Verifica los datos!", r , "error");
				}
			}
		});

	}else{
		toastr.error('Debe seleccionar un cultivo para crear una producción','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		jQuery('#preloader').hide();
		jQuery('#form-add-produccion').show();
	}
	
	
}


function llenarform(datos){

	data = datos.split("||");

	cod_tpr=$('#tip_prod').val(data[1].trim());
	cod_pro=$('#cod_pro').val(data[0].trim());

	$.ajax({
		type:"post",
		url:"../php/componentes/componentes_tareas/fecha_ed.php",
		data:"fecha="+ data[3].trim(),
		success:function(r){
			$('#fecha').html(r);
			jQuery('#lbl_fec').hide();
			jQuery('#lbl_fec_prod').show();
		}
	});

	ctp_goz=$('#ctp_goz').val(data[5].trim());
	pre_goz=$('#pre_goz').val(data[6].trim());
	cpt_goz=$('#cpt_goz').val(data[4].trim());
	cod_cul=$('#cod_cul').val(data[7].trim());


	placehollder = data[9].split("-")[1].toLowerCase();

	ultimo = placehollder.charAt(placehollder.length - 1);
	if (ultimo.toLowerCase() == 's') {
		placehollder = placehollder.substr(0, str.length - 1)
	}

	$('#tx_capacidad').text("Capacidad por " + placehollder.trim() + " en Kg:");
	jQuery("#cpt_goz").attr("placeholder", "Capacidad por " + placehollder.trim() + " en Kg.");

	$('#tx_pre').text("precio de " + placehollder.trim() + ":");
	jQuery("#pre_goz").attr("placeholder", "Precio de " + placehollder.trim());

	ultimo = placehollder.charAt(placehollder.length - 1);
	if (ultimo.toLowerCase() != 's') {
		placehollder = placehollder.trim()+"s";
	}

	$('#tx_cantidad').text("Cantidad de " + placehollder.trim() + ":");
	jQuery("#ctp_goz").attr("placeholder", "Cantidad de " + placehollder.trim());    


	jQuery('#btn_update').show();
	jQuery('#btn_save1').hide();

}


function preloaderup(){

	cod_tpr=$('#tip_prod').val();
	cod_pro=$('#cod_pro').val();
	fec_goz=$('#ffi_tarea').val();
	ctp_goz=$('#ctp_goz').val();
	pre_goz=$('#pre_goz').val();
	cpt_goz=$('#cpt_goz').val();
	cod_cul=$('#cod_cul').val();

	bien = validar(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul);

	if (bien == true) {
		setTimeout ("agregar_producciones(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul);", 500);
	}
	

}



function agregar_producciones(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul){
	
	cadena ="cod_tpr=" + cod_tpr +
	"&cod_pro=" + cod_pro +
	"&fec_goz=" + fec_goz +
	"&ctp_goz=" + ctp_goz +
	"&pre_goz=" + pre_goz +
	"&cpt_goz=" + cpt_goz;
	//alert(cadena);
	$.ajax({
		type:"post",
		url:"../php/crud/produccion/crear_producciones.php",
		data:cadena,
		success:function(r){
			if(r.includes('Resource id')){

				swal("Producción agregada!"," ", "success");
				var form = document.querySelector('#form-add-producciones');
				form.reset();
				resetselects();

				$('#tx_capacidad').text("Capacidad por unidad");
				jQuery("#cpt_goz").attr("placeholder", "Capacidad por unidad");

				$('#tx_pre').text("precio de unidad");
				jQuery("#pre_goz").attr("placeholder", "Precio de unidad");

				$('#tx_cantidad').text("Cantidad de unidades");
				jQuery("#ctp_goz").attr("placeholder", "Cantidad de unidades"); 

				ajax2 = objetoAjax();
				ajax2.open("POST","../php/componentes/componentes_produccion/tab_producciones.php", true);
				ajax2.onreadystatechange=function(){
					if ( ajax2.readyState==4 ) {
						document.getElementById("tab_producciones").innerHTML=ajax2.responseText;
					}
				}
				ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				ajax2.send("cod_pro="+$('#cod_pro').val().trim());

			}else{
				Produccion = $("#tip_prod option:selected").text().split("-")[0].toLowerCase();
				swal("la producción de tomate "+ Produccion +" ya está registrada, si quiere aumentar o cambiar la cantidad debe editar esa producción!","", "warning");
			}
		}
	});
}


function preloaderup1(){

	cod_tpr=$('#tip_prod').val();
	cod_pro=$('#cod_pro').val();
	fec_goz=$('#ffi_tarea').val();
	ctp_goz=$('#ctp_goz').val();
	pre_goz=$('#pre_goz').val();
	cpt_goz=$('#cpt_goz').val();
	cod_cul=$('#cod_cul').val();

	bien = validar(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul);

	if (bien == true) {
		setTimeout ("editar_producciones(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul);", 500);
	}

	

}

function editar_producciones(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul){
	
	cadena ="cod_tpr=" + cod_tpr +
	"&cod_pro=" + cod_pro +
	"&fec_goz=" + fec_goz +
	"&ctp_goz=" + ctp_goz +
	"&pre_goz=" + pre_goz +
	"&cpt_goz=" + cpt_goz;
	//alert(cadena);
	$.ajax({
		type:"post",
		url:"../php/crud/produccion/editar_producciones.php",
		data:cadena,
		success:function(r){
			if(r.includes('Resource id')){

				ajax2 = objetoAjax();
				ajax2.open("POST","../php/componentes/componentes_produccion/tab_producciones.php", true);
				ajax2.onreadystatechange=function(){
					if ( ajax2.readyState==4 ) {
						document.getElementById("tab_producciones").innerHTML=ajax2.responseText;
					}
				}
				ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				ajax2.send("cod_pro="+cod_pro);

				swal("Producción editada!"," ", "success");
				var form = document.querySelector('#form-add-producciones');
				form.reset();
				resetselects();

				$('#tx_capacidad').text("Capacidad por unidad");
				jQuery("#cpt_goz").attr("placeholder", "Capacidad por unidad");

				$('#tx_pre').text("precio de unidad");
				jQuery("#pre_goz").attr("placeholder", "Precio de unidad");

				$('#tx_cantidad').text("Cantidad de unidades");
				jQuery("#ctp_goz").attr("placeholder", "Cantidad de unidades"); 

				jQuery('#btn_update').hide();
				jQuery('#btn_save1').show();



			}else{
				swal("Verifica los datos!", r , "error");
			}
		}
	});
}

function eliminar_produccion(cod_pro,cod_tpr){

	ajax2 = objetoAjax();
	ajax2.open("POST","../php/componentes/componentes_produccion/tab_producciones.php", true);
	ajax2.onreadystatechange=function(){
		if ( ajax2.readyState==4 ) {
			document.getElementById("tab_producciones").innerHTML=ajax2.responseText;
		}
	}
	ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax2.send("cod_pro="+cod_pro);

	swal("Producción editada!"," ", "success");
	var form = document.querySelector('#form-add-producciones');
	form.reset();
	resetselects();

	$('#tx_capacidad').text("Capacidad por unidad");
	jQuery("#cpt_goz").attr("placeholder", "Capacidad por unidad");

	$('#tx_pre').text("precio de unidad");
	jQuery("#pre_goz").attr("placeholder", "Precio de unidad");

	$('#tx_cantidad').text("Cantidad de unidades");
	jQuery("#ctp_goz").attr("placeholder", "Cantidad de unidades"); 

	jQuery('#btn_update').hide();
	jQuery('#btn_save1').show();

	swal({
		title: "Estas seguro?",
		text: "Deseas eliminar esta producción?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="cod_pro="+cod_pro+"&cod_tpr=" + cod_tpr;
			$.ajax({
				type:"post",
				url:"../php/crud/produccion/eliminar_producciones.php",
				data:cadena,
				success:function(r){
					if(r.includes('Resource id')){
						ajax2 = objetoAjax();
						ajax2.open("POST","../php/componentes/componentes_produccion/tab_producciones.php", true);
						ajax2.onreadystatechange=function(){
							if ( ajax2.readyState==4 ) {
								document.getElementById("tab_producciones").innerHTML=ajax2.responseText;
							}
						}
						ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						ajax2.send("cod_pro="+cod_pro);
						swal("La producción se elimino!", {
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


function editar(cod_pro,cod_tpr,ide_ter){

	$('#cod_pro').val(cod_pro);
	$('#cod_cul').val(cod_tpr.trim());
	$('#ide_ter').val(ide_ter.trim());


	ajax2 = objetoAjax();
	ajax2.open("POST","../php/componentes/componentes_produccion/tab_producciones.php", true);
	ajax2.onreadystatechange=function(){
		if ( ajax2.readyState==4 ) {
			document.getElementById("tab_producciones").innerHTML=ajax2.responseText;
		}
	}
	ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax2.send("cod_pro=" + cod_pro.trim());

	$('#modal-crud-gozar').modal('toggle');

}



function eliminar_todo(cod_pro,cod_cuñ){


	swal({
		title: "Estas seguro?",
		text: "Deseas eliminar TODA la producción?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			cadena="cod_pro="+cod_pro+"&cod_cuñ=" + cod_cuñ;
			$.ajax({
				type:"post",
				url:"../php/crud/produccion/eliminar_produccion.php",
				data:cadena,
				success:function(r){
					if(r.includes('Resource id')){
						$('#tab_tipo_prod').load('../php/componentes/componentes_produccion/tab_produccion.php');						
						swal("La producción se elimino!", {
							icon: "info",
						});
					}else{
						alert(r);
					}
					
				}
			});
			
		} else {
			swal("Cancelado!");
		}
	});
}


function editar_toda_produccion(){
	$('#modal-crud-gozar').modal('hide');
	$('#tab_tipo_prod').load('../php/componentes/componentes_produccion/tab_produccion.php');

	cod_pro = $('#cod_pro').val(); 
	ide_ter = $('#ide_ter').val();
	if(cod_pro != "" && ide_ter != null){
		cadena="cod_pro="+cod_pro+"&ide_ter=" + ide_ter;
		$.ajax({
			type:"post",
			url:"../php/crud/produccion/actualizar_cliente.php",
			data:cadena,
			success:function(r){
				if(r.includes('Resource id')){
					$('#tab_tipo_prod').load('../php/componentes/componentes_produccion/tab_produccion.php');					
				}					
			}
		});
	}
}


function Cargar_tab_n_registros(){
	registros =  $('#num_registros').val();
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_produccion/tab_produccion_numreg.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_tipo_prod").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("num_reg="+registros);
}

function Cargar_tab_fechas(){
	fi =  $('#fecha_ini_filtro').val();
	ff =  $('#fecha_fin_filtro').val();

	var f = new Date();
	if(f.getMonth() +1 <10){
		fecha = f.getFullYear()+"-0"+(f.getMonth() + 1)+"-"+f.getDate();
	}else{
		fecha = f.getFullYear()+"-"+f.getMonth()+"-"+f.getDate();
	}
	$('#fecha_ini_filtro').val(fecha);
	$('#fecha_fin_filtro').val(fecha);
  //document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + );

  ajax = objetoAjax();
  ajax.open("POST","../php/componentes/componentes_produccion/tab_produccion_fechas.php", true);
  ajax.onreadystatechange=function(){
  	if ( ajax.readyState==4 ) {
  		document.getElementById("tab_tipo_prod").innerHTML=ajax.responseText;
  	}
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("fini="+fi+"&ffin="+ff);
}


$(document).ready(function(){
	//alert("Arreglar lo de los selects");
	jQuery('#ver2').hide();

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	$('#num_registros').change(function(){
		Cargar_tab_n_registros();
	})

	$('#modal-crud-gozar').on('hidden.bs.modal', function (e) {
		$('#modal-produccion').modal('hide');
		$('#tab_tipo_prod').load('../php/componentes/componentes_produccion/tab_produccion.php');
		var form = document.querySelector('#form-add-producciones');
		form.reset();
		resetselects();
	})

	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#tab_tipo_prod').load('../php/componentes/componentes_produccion/tab_produccion.php');
	$('#menu').load('../php/componentes/menu/menu.php');

	$.ajax({
		type:"post",
		url:"../php/componentes/componentes_tareas/fecha_ed.php",
		data:"fecha="+$('#date').val(),
		success:function(r){
			$('#fecha').html(r);
			jQuery('#lbl_fec').hide();
			jQuery('#lbl_fec_prod').show();
		}
	});

	$('#tip_prod').change(function(){
		placehollder = $("#tip_prod option:selected").text().split("-")[1].toLowerCase();

		ultimo = placehollder.charAt(placehollder.length - 1);
		if (ultimo.toLowerCase() == 's') {
			placehollder = placehollder.substr(0, str.length - 1)
		}

		$('#tx_capacidad').text("Capacidad por " + placehollder.trim() + " en Kg:");
		jQuery("#cpt_goz").attr("placeholder", "Capacidad por " + placehollder.trim() + " en Kg.");

		$('#tx_pre').text("precio de " + placehollder.trim() + ":");
		jQuery("#pre_goz").attr("placeholder", "Precio de " + placehollder.trim());

		ultimo = placehollder.charAt(placehollder.length - 1);
		if (ultimo.toLowerCase() != 's') {
			placehollder = placehollder.trim()+"s";
		}

		$('#tx_cantidad').text("Cantidad de " + placehollder.trim() + ":");
		jQuery("#ctp_goz").attr("placeholder", "Cantidad de " + placehollder.trim());    
	});


	$('#ctp_goz').keydown(function(){
		$('#div_ctp_goz').addClass("input-group input-group-alternative");
	});
	$('#pre_goz').keydown(function(){
		$('#div_pre_goz').addClass("input-group input-group-alternative");
	});

	$('#cpt_goz').keydown(function(){
		$('#div_cpt_goz').addClass("input-group input-group-alternative");
	});
});


function cerrar_menu(){
	$('#sidenav-main').remove();
	jQuery('#ver1').hide();
	jQuery('#ver2').show();
}


function validar(cod_tpr,cod_pro,fec_goz,ctp_goz,pre_goz,cpt_goz,cod_cul){
	//alert("cadena");
	bien = true;

	if(cod_tpr == null || fec_goz == "" || ctp_goz == "" || pre_goz == "" || cpt_goz == ""){

		if (cod_tpr == null) {
			toastr.error('Selecione el tipo de producción','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if (fec_goz == "") {
			toastr.error('Verdifique la fecha','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if (cpt_goz == "") {
			toastr.error('Ingrese la capacidad de la canastilla o bulto','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if (ctp_goz == "") {
			toastr.error('Ingrese la cantidad de canastillas o bultos recolectados','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}else if (pre_goz == "") {
			toastr.error('Ingrese el precio por canastilla','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
		}
		bien = false;
	}else{

		if(isNaN(cpt_goz)){
			$('#div_cpt_goz').removeClass("input-group input-group-alternative");
			toastr.error('La capacidad debe ser númerica','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;

		}else if (parseFloat(cpt_goz) == 0){

			$('#div_cpt_goz').removeClass("input-group input-group-alternative");
			toastr.error('La capacidad no puede ser cero','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;
			
		}

		if(isNaN(ctp_goz)){
			$('#div_ctp_goz').removeClass("input-group input-group-alternative");
			toastr.error('La cantidad debe ser númerica','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;

		}else if (parseFloat(ctp_goz) == 0){

			$('#div_ctp_goz').removeClass("input-group input-group-alternative");
			toastr.error('La cantidad no puede ser cero','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;
			
		}

		if(isNaN(pre_goz)){
			$('#div_pre_goz').removeClass("input-group input-group-alternative");
			toastr.error('El precio debe ser númerico','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;

		}else if (parseFloat(pre_goz) == 0){

			$('#div_pre_goz').removeClass("input-group input-group-alternative");
			toastr.error('El precio no puede ser cero','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;
			
		}

	}
	return bien;
}


function resetselects(){
	// $('#cod_cul').val(0);
	// $('#ide_ter').val(0);
	$('#tip_prod').val(0);
	$('#cliente').val(0);
	$('#cultivo').val(0);
}