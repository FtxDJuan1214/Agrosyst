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

	des_tar=$('#des_tar').val();
	fin_tar=$('#fin_tar').val();
	fif_tar=$('#fif_tar').val();
	actividad=$('#tipo_lab').val();
	fitosanitario=$('#enf_fit').val();
	cod_cul =  $('#cod_cul').val();

	var fechaInicio = new Date(fin_tar.trim()).getTime();
	var fechaFin    = new Date(fif_tar.trim()).getTime();

	if(des_tar == ""  || fin_tar == null || fif_tar == null || actividad == null || cod_cul == null){
		toastr.error('Todos los campos son obligatorios','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{
		bien = true;

		if(des_tar.length < 4){

			$('#div_des_tar').removeClass("input-group input-group-alternative");
			toastr.error('La descripción es muy corta.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});

			bien = false;
		}


		if (actividad == 2) {
			if (fitosanitario == "" ) {

				toastr.error('Todos los campos son obligatorios','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

				bien = false;

			}else if(fitosanitario.length < 4){
				$('#div_enf_fit').removeClass("input-group input-group-alternative");
				toastr.error('El nombre de la enfermedad es muy corto.','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

				bien = false;
			}
		}

		if (fin_tar == fif_tar) {

			toastr.error('Las fechas de inicio y final no pueden ser las mismas','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});
			bien = false;

		}else if(parseFloat(fechaInicio) > parseFloat(fechaFin)){

			toastr.error('La fecha de finalización no puede ser anterior a la inicial','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});
			bien = false;
		}

		if (cadena_de_convenios_insertar == "") {

			toastr.error('Esta tarea debe tener minimo un convenio agregado.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});
			bien = false;
		}
		
		if (bien == true){

			swal({
				title: "Si no está seguro, por favor verifique el formulario antes dar OK.",
				text: "¡Una vez creada la tarea solo podrá:\nAumentar el tiempo de duración.\nAgregar (Convenios, insumos y gastos).\n\nUNA VEZ CREADA NO SE PODRÁ ELIMINAR!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {

					jQuery('#preloader').show();
					jQuery('#form-add-tarea').hide();
					setTimeout ("agregar_tarea(des_tar,fin_tar,fif_tar);", 1000);

				} else {
					swal("Revise la información ingresada!", {
						icon: "info",
					});
				}
			});
		}
	}

	
}

function agregar_tarea(des_tar,fin_tar,fif_tar){
	
	cadena ="des_tar="+des_tar+
	"&fin_tar="+fin_tar+
	"&fif_tar="+fif_tar+
	"&actividad="+actividad+
	"&fitosanitario="+fitosanitario +
	"&val_tar="+ (precio_total_insumos+ precio_total_convenios + costo_gastos)+
	"&cod_cul="+cod_cul +
	"&cadena_de_convenios_insertar="+cadena_de_convenios_insertar +
	"&cadena_de_gastos_insertar="+cadena_de_gastos_insertar +
	"&cadena_de_insumos_insertar="+cadena_de_insumos_insertar;

	// alert("Totales: \n" + precio_total_convenios +"\n"+costo_gastos+"\n"+precio_total_insumos)
	
	$.ajax({
		type:"post",
		url:"../php/crud/tareas/agregar_tarea.php",
		data:cadena,
		success:function(r){
			if(r=='Resource id #6'){
			//Agregar el tipo de labor

			$.ajax({
				type:"post",
				url:"../php/crud/tareas/agregar_tipo_tarea.php",
				data:cadena,
				success:function(r){
					//alert(r);
				}
			});

			//Agregar los convenios a la tarea
			$.ajax({
				type:"post",
				url:"../php/crud/tareas/agregar_convenios.php",
				data:cadena,
				success:function(r){
					//alert(r);
				}
			});

			//Agregar los Insumos a la tarea
			$.ajax({
				type:"post",
				url:"../php/crud/tareas/agregar_insumos.php",
				data:cadena,
				success:function(r){
					//alert("Insumos"+r);
				}
			});

			//Agregar otros gastos si los hay
			if(cadena_de_gastos_insertar != ""){
				var veces_gastos = cadena_de_gastos_insertar.split("||");

				for (var i = 0; i < veces_gastos.length - 1; i++) {

					datos = veces_gastos[i].split("/");

					comprar( (parseFloat(datos[0]) + i), datos[1], datos[2], datos[3], datos[4], datos[5], datos[6]);
				}
			}
			res_insu();
			res_conv();
			res_gasto();

			document.getElementById("tab_conve_agregar").innerHTML = "";
			document.getElementById("tab_insumos_agregar").innerHTML = "";
			document.getElementById("tab_gastos_agregar").innerHTML = "";

			
			$('#tab_lab').load('../php/componentes/componentes_tareas/tab_tareas.php');

			precio_total_convenios= 0 ;
			precio_total_insumos= 0 ;
			swal("Tarea creada!"," ", "success");
			jQuery('#preloader').hide();
			jQuery('#form-add-tarea').show();
			$('#modal-form').modal('hide');
			var form = document.querySelector('#form-add-tarea');
			form.reset();
			jQuery('#fitosanitario').hide();
		}else{
			jQuery('#preloader').hide();
			jQuery('#form-add-tarea').show();
			swal("Verifica los datos!", r , "error");
		}
	}
});
}

function comprar( num_fact, fec_con, hor_com, proveedor, comprador, cos_tot, productos){

	insumos=productos.split(',');

	cantiad=parseFloat(insumos[2]);
	insumo=parseFloat(insumos[1]);
	precio=parseFloat(insumos[3]);

	cadena="num_fact="+ num_fact +
	"&fec_con="+ fec_con +
	"&hor_com="+ hor_com +
	"&proveedor="+ proveedor +
	"&comprador="+ comprador+
	"&cos_tot="+ cos_tot +
	"&insumo="+ insumo +
	"&socio="+ comprador +
	"&cantiad="+ cantiad +
	"&precio="+ precio;
	//alert(cadena);
	$.ajax({
		type:"post",
		url:"../php/crud/tareas/crear_gastos.php",
		data:cadena,
		success:function(r){
			//alert(r);
		}

	});
}



//------------------------------------------------------------------------------------

function verconvenios(){
	$('#modal-form').modal('hide');
	cod_cul=$('#cod_cul').val();
	fin_lab=$('#fin_tar').val();
	fif_lab=$('#fif_tar').val();
	id=parseFloat(cod_cul);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_convenios.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_conve").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cod_cul="+id+"&fin_tar="+fin_lab+"&fif_tar="+fif_lab);
}
function verconvenios2(string_con_convenios){
	id=parseFloat(string_con_convenios);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_convenios_mostrar.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_conve_agregar").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("convenios="+string_con_convenios);
}


function verinsumos(){
	$('#modal-form').modal('hide');
	cod_cul=$('#cod_cul').val();
	id=parseFloat(cod_cul);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_insumos.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_insumo").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cod_cul="+id);
}
function verinsumos2(string_con_insumos){
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_insumos_mostrar.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_insumos_agregar").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("insumos="+string_con_insumos);
}



precio_total_convenios= 0 ;
precio_total_insumos= 0 ;


cadena_de_convenios_mostrar = "";
cadena_de_convenios_insertar = "";

var lista=[];

function stringconvenios(seleccion){
	dat = seleccion.split(",");

	esta = new Boolean(false);

	lista.forEach(function(i){
		if (i == dat[0]) {
			esta = true;
		}
	});
	
	if(esta == false){
		toastr.success('Convenio agregado','',{
			"positionClass": "toast-bottom-right",
			"closeButton": true,
			"progressBar":true
		});
		lista.push(dat[0]);
		precio_total_convenios = precio_total_convenios + parseFloat(dat[2]);
		cadena_de_convenios_insertar = cadena_de_convenios_insertar + dat[0] + "||";
		cadena_de_convenios_mostrar = cadena_de_convenios_mostrar + seleccion + "||";
		// alert("Insertar: " + cadena_de_convenios_insertar);
		// alert("Mostrar: " + cadena_de_convenios_mostrar);
		//alert("Tot conv: " + precio_total_convenios);
		verconvenios2(cadena_de_convenios_mostrar);
	}else{
		toastr.info('Este convenio ya está agregado.','',{
			"positionClass": "toast-bottom-right",
			"closeButton": true,
			"progressBar":true
		});
	}
}


cadena_de_gastos_mostrar = "";
cadena_de_gastos_insertar = "";

function cargar_soc(){
	$('#modal-form').modal('hide');
	cod_cul=$('#cod_cul').val();
	ajax2 = objetoAjax();
	ajax2.open("POST","../php/componentes/componentes_convenio/opc_socios.php", true);
	ajax2.onreadystatechange=function(){
		if ( ajax2.readyState==4 ) {
			document.getElementById("char_soc").innerHTML=ajax2.responseText;
		}
	}
	ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax2.send("cod_cul="+cod_cul);

	vergastos(cadena_de_gastos_mostrar);
}

costo_gastos = 0;

function string_gastos(){

	num_fact=$('#num_fact').val();
	factura=num_fact.split(':');


	num_fact=factura[1].trim();//**
	fec_con=$('#date').val();//**
	hor_com=$('#time').val();//**
	proveedor=$('#socio').val();//**
	comprador=$('#socio').val();//**
	cos_tot=$('#cos_uni').val();//**
	productos="4,"+ $('#insumo').val() + ",1,"+ cos_tot;//**

	descripcion=$("#insumo option:selected").text();
	valor= cos_tot;
	socio= comprador;
	nombres = $("#socio option:selected").text();

	if(descripcion == "" || valor == "" || socio == null){
		toastr.error('Debe llenar todos los campos','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else if(isNaN(valor)){
		toastr.error('El valor debe ser númerico','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{

		costo_gastos = costo_gastos + parseFloat(valor);
		cadena_de_gastos_mostrar =cadena_de_gastos_mostrar +  descripcion + ","+valor +","+ nombres + "||";
		cadena_de_gastos_insertar = cadena_de_gastos_insertar + num_fact + "/" + fec_con + "/" + hor_com + "/" + proveedor + "/" + comprador + "/" + cos_tot + "/" + productos + "||";
		
		vergastos(cadena_de_gastos_mostrar);

		//alert("Total: " + costo_gastos + "\nCADENA: \n\n" + cadena_de_gastos_insertar);
		$('#insumo').val(0);
		$('#cos_uni').val("");
		$('#socio').val(0);
	}

}

function vergastos(string_con_gastos){
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_gastos_mostrar.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_gastos_agregar").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("gastos="+string_con_gastos);

	ajax1 = objetoAjax();
	ajax1.open("POST","../php/componentes/componentes_tareas/tab_gastos.php", true);
	ajax1.onreadystatechange=function(){
		if ( ajax1.readyState==4 ) {
			document.getElementById("tab_gastos").innerHTML=ajax1.responseText;
		}
	}
	ajax1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax1.send("cadena="+string_con_gastos);
}

function stringconvenios(seleccion){
	dat = seleccion.split(",");
	esta = new Boolean(false);

	lista.forEach(function(i){
		if (i == dat[0]) {
			esta = true;
		}
	});
	if(esta == false){
		toastr.success('Convenio agregado','',{
			"positionClass": "toast-bottom-right",
			"closeButton": true,
			"progressBar":true
		});
		lista.push(dat[0]);
		precio_total_convenios = precio_total_convenios + parseFloat(dat[2]);
		cadena_de_convenios_insertar = cadena_de_convenios_insertar + dat[0] + "||";
		cadena_de_convenios_mostrar = cadena_de_convenios_mostrar + seleccion + "||";
		// alert("Insertar: " + cadena_de_convenios_insertar);
		// alert("Mostrar: " + cadena_de_convenios_mostrar);
		//alert("Tot conv: " + precio_total_convenios);
		verconvenios2(cadena_de_convenios_mostrar);
	}else{
		toastr.info('Este convenio ya está agregado.','',{
			"positionClass": "toast-bottom-right",
			"closeButton": true,
			"progressBar":true
		});
	}
}

cadena_de_insumos_mostrar = "";
cadena_de_insumos_insertar = "";

var lista1=[];

function stringinsumos(seleccion){
	dat = seleccion.split(",");
	input = '#cant_usar'+dat[0];
	div = '#div_cant_usar'+dat[0];
	cant_usar = $(input).val();


	esta = new Boolean(false);

	lista1.forEach(function(i){
		if (i == dat[0]) {
			esta = true;
		}
	});

	if(esta == false){
		if(cant_usar != ""){
			if(parseFloat(cant_usar) != 0){
				if(parseFloat(cant_usar) <= parseFloat(dat[1])){

					toastr.success('Insumo agregado','',{
						"positionClass": "toast-bottom-right",
						"closeButton": true,
						"progressBar":true
					});
					cant_usar = $(input).val("");
					lista1.push(dat[0]);
					cadena_de_insumos_insertar = cadena_de_insumos_insertar + dat[0] + "-" + dat[1] + "-" + dat[3]+"-"+ (parseFloat(dat[3])  * parseFloat(dat[4])) +"||";
					cadena_de_insumos_mostrar = cadena_de_insumos_mostrar + "Insumo: "+ 
					dat[5] +"<br>Cantidad: " + dat[3]+" "+ dat[2]+"<br>Valor:"+ (parseFloat(dat[3])  * parseFloat(dat[4])) + "||";
					precio_total_insumos= precio_total_insumos + (parseFloat(dat[3])  * parseFloat(dat[4])) ;
					// alert("Insertar: " + cadena_de_insumos_insertar);
					// alert("Mostrar: " + cadena_de_insumos_mostrar);
					// alert("Tot ins: " + precio_total_insumos);
					verinsumos2(cadena_de_insumos_mostrar);

				}else{
					$(div).removeClass("input-group input-group-alternative");
					toastr.error('La cantidad ingresada supera a la disponible en el stock','',{
						"positionClass": "toast-top-center",
						"closeButton": true,
						"progressBar":true
					});
				}
			}else{
				$(div).removeClass("input-group input-group-alternative");
				toastr.error('La cantidad no puede ser cero','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});
			}
		}else{
			$(div).removeClass("input-group input-group-alternative");
			toastr.error('Debe indicar la cantidad numerica que va a usar.','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});		
		}
	}else{
		toastr.info('Este insumo ya está agregado.','',{
			"positionClass": "toast-bottom-right",
			"closeButton": true,
			"progressBar":true
		});
	}

	$(input).keydown(function(){
		$(div).addClass("input-group input-group-alternative");
	});
}


//------------------------------------------------------------------------------------

function res_gasto(){
	cadena_de_gastos_mostrar = "";
	cadena_de_gastos_insertar = "";
	costo_gastos = 0;
	vergastos("");

}

function res_conv(){
	cadena_de_convenios_mostrar = "";
	cadena_de_convenios_insertar = "";
	while(lista.length > 0)
		lista.pop(); 
	verconvenios2("");
	precio_total_convenios= 0 ;

}

function res_insu(){
	cadena_de_insumos_mostrar = "";
	cadena_de_insumos_insertar = "";
	while(lista1.length > 0)
		lista1.pop(); 
	verinsumos2("");
	precio_total_insumos= 0 ;
}

//------------------------------------------------------------------------------------

//*********************************************************************************************************
function edaddconvenios(datos){
	data = datos.split("||");
	verconveniosup(data[6],data[3],data[4],data[2],data[0]);
}

function verconveniosup(cod_cul,fin_lab,fif_lab,total,tar){
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_conveniosup.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_conve2").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cod_cul="+cod_cul+"&fin_tar="+fin_lab+"&fif_tar="+fif_lab+"&total="+total+"&tar="+tar);
}

function addconveniosup(datos){
	
	data = datos.split("||");
	nuevotot =  (parseFloat(data[4]) + parseFloat(data[6]));
	cadena = "cod_con=" + data[0] + "&cod_tar=" + data[5] + "&nuevotot=" + nuevotot;
	//alert(cadena);
	//Agregar los convenios a la tarea
	$.ajax({
		type:"post",
		url:"../php/crud/tareas/agregar_conveniosup.php",
		data:cadena,
		success:function(r){
			//alert(r);
			verconveniosup(data[1],data[2],data[3],nuevotot,data[5]);
			$('#tab_lab').load('../php/componentes/componentes_tareas/tab_tareas.php');
			toastr.success('Convenio agregado','',{
				"positionClass": "toast-bottom-right",
				"closeButton": true,
				"progressBar":true
			});
		}
	});
}
//*********************************************************************************************************


//*********************************************************************************************************
function edaddinsumos(datos){
	data = datos.split("||");
	verinsumosup(data[6],data[0],data[2]);
}

function verinsumosup(cod_cul,tarea,total){
	id=parseFloat(cod_cul);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_insumosup.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_insumo2").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cod_cul="+id + "&cod_tar=" + tarea + "&total_tar=" + total);
}

function addinsumosup(datos){

	dat = datos.split(",");
	input = '#cant_usarup'+dat[1];
	div = '#div_cant_usarup'+dat[1];

	tarea = dat[0];
	stock = dat[1];
	cant_disponible = dat[2];
	cant_usar = dat[3];
	precio = dat[4];
	tot_tar = dat[5];
	cod_cul = dat[6];

	cadena = "cod_tar="+tarea+"&cod_sto="+stock+"&cin_tar="+cant_usar+"&can_sto="+cant_disponible+"&precio_in="+precio+"&tot_tar="+tot_tar;
	//alert("cadena: " + cadena);
	if(cant_usar != ""){
		if(parseFloat(cant_usar) != 0){
			if(parseFloat(cant_usar) <= parseFloat(cant_disponible)){

				$.ajax({
					type:"post",
					url:"../php/crud/tareas/agregar_insumosup.php",
					data:cadena,
					success:function(r){
						//alert(r);
						tot = parseFloat(r);
						if(tot != 0 ){
							$('#tab_lab').load('../php/componentes/componentes_tareas/tab_tareas.php');
							toastr.success('Insumo agregado','',{
								"positionClass": "toast-bottom-right",
								"closeButton": true,
								"progressBar":true
							});
							verinsumosup(cod_cul,tarea,tot);
						}else{
							alert(r);
						}

					}
				});

			}else{
				$(div).removeClass("input-group input-group-alternative");
				toastr.error('La cantidad ingresada supera a la disponible en el stock','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});
			}
		}else{
			$(div).removeClass("input-group input-group-alternative");
			toastr.error('La cantidad no puede ser cero','',{
				"positionClass": "toast-top-center",
				"closeButton": true,
				"progressBar":true
			});
		}
	}else{
		$(div).removeClass("input-group input-group-alternative");
		toastr.error('Debe indicar la cantidad numerica que va a usar.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});		
	}

	$(input).keydown(function(){
		$(div).addClass("input-group input-group-alternative");
	});

}

function edaddgastos(datos){
	data = datos.split("||");
	vargastosup(data[6],data[0],data[2]);
	document.getElementById("char_soc").innerHTML = "";


	ajax2 = objetoAjax();
	ajax2.open("POST","../php/componentes/componentes_convenio/opc_socios.php", true);
	ajax2.onreadystatechange=function(){
		if ( ajax2.readyState==4 ) {
			document.getElementById("char_soc_up").innerHTML=ajax2.responseText;
		}
	}
	ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax2.send("cod_cul="+data[6]);

}

function vargastosup(cod_cul,tarea,total){
	id=parseFloat(tarea);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_gastosup.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_gastos2").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cod_tar="+id+"&cod_cul="+cod_cul+"&total="+total);
}


function addgastosup(info){
	again = info.split('||');
	//alert(again);
	num_fact_up=$('#num_fact_up').val();
	factura=num_fact_up.split(':');


	num_fact=factura[1].trim();//**
	fec_con=$('#date_up').val();//**
	hor_com=$('#time_up').val();//**
	proveedor=$('#socio').val();//**
	comprador=$('#socio').val();//**
	cos_tot=$('#cos_uni_up').val();//**
	productos="4,"+ $('#insumo_up').val() + ",1,"+ cos_tot;//**

	descripcion=$("#insumo option:selected").text();
	valor= cos_tot;
	socio= comprador;
	nombres = $("#socio option:selected").text();

	if(descripcion == "" || valor == "" || socio == null){
		toastr.error('Debe llenar todos los campos','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else if(isNaN(valor)){
		toastr.error('El valor debe ser númerico','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{
		Ntotal = parseFloat(again[2]) + parseFloat(cos_tot);
		comprar2(num_fact, fec_con, hor_com, proveedor, comprador, cos_tot, productos,again[0],again[1],Ntotal);
	}

}


function comprar2(num_fact, fec_con, hor_com, proveedor, comprador, cos_tot, productos,cultivo,tarea,ntotal){

	insumos=productos.split(',');

	cantiad=parseFloat(insumos[2]);
	insumo=parseFloat(insumos[1]);
	precio=parseFloat(insumos[3]);

	cadena="num_fact="+ num_fact +
	"&fec_con="+ fec_con +
	"&hor_com="+ hor_com +
	"&proveedor="+ proveedor +
	"&comprador="+ comprador+
	"&cos_tot="+ cos_tot +
	"&insumo="+ insumo +
	"&socio="+ comprador +
	"&cantiad="+ cantiad +
	"&precio="+ precio + 
	"&tarea="+ tarea + 
	"&ntotal="+ ntotal;
	//alert(cadena);
	$.ajax({
		type:"post",
		url:"../php/crud/tareas/crear_gastos2.php",
		data:cadena,
		success:function(r){
			//alert(r);
			edaddgastos(tarea+"|| ||"+ntotal+"|| || || ||"+cultivo);
			$('#tab_lab').load('../php/componentes/componentes_tareas/tab_tareas.php');
			toastr.success('Gasto agregado','',{
				"positionClass": "toast-bottom-right",
				"closeButton": true,
				"progressBar":true
			});
		}

	});
}






function llenarform(datos){
	data = datos.split("||");
	$('#cod_tar_up').val(data[0]);	
	$('#tipo_tar').text(data[7]);	
	$('#des_tare').val(data[1]);
	$('#fin_tare').val(data[3]);
	$.ajax({
		type:"post",
		url:"../php/componentes/componentes_tareas/fecha_ed.php",
		data:"fecha="+data[4],
		success:function(r){
			$('#fecha2').html(r);
		}
	});
	$("#ffi_tar").attr("value");
	$('#valor').text("Total: $"+data[2]);

}


function preloaderup(){

	cod_tar_up = $('#cod_tar_up').val();
	descipcion = $('#des_tare').val();
	ffin_tare = $('#ffi_tarea').val();

	var fechaInicio = new Date($('#fin_tare').val());
	var fechaFin    = new Date(ffin_tare);

	if(descipcion == "" || ffin_tare == ""){
		toastr.error('Todos los campos son obligatorios','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else if(descipcion.length < 4){

		toastr.error('La descripción es muy corta.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else if(ffin_tare == $('#fin_tare').val()){

		toastr.error('Las fechas de inicio y finalización no pueden ser las mismas.','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else if(fechaInicio.getTime() > fechaFin.getTime()){

		toastr.error('Las fecha de finalización no puede ser anterior a la inicial','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});
	}else{
		jQuery('#preloaderup').show();
		jQuery('#form_tarea_up').hide();
		setTimeout ("editar_tarea(cod_tar_up,descipcion,ffin_tare);", 1000);
	}

	

}



function editar_tarea(cod_tar_up,descipcion,ffin_tare){
	
	cadena ="cod_tar_up="+cod_tar_up+
	"&descipcion="+descipcion +
	"&fin_tar="+ffin_tare;
	
	$.ajax({
		type:"post",
		url:"../php/crud/tareas/actualizar_tarea.php",
		data:cadena,
		success:function(r){
			if(r=='Resource id #6'){
				$('#tab_lab').load('../php/componentes/componentes_tareas/tab_tareas.php');
				$('#modal-editar').modal('hide');
				jQuery('#preloaderup').hide();
				jQuery('#form_tarea_up').show();
				swal("Tarea editada!"," ", "success");
			}else{
				jQuery('#preloaderup').hide();
				jQuery('#form_tarea_up').show();
				swal("Verifica los datos!", r , "error");
			}
		}
	});
}


$(document).ready(function(){
	jQuery('#fitosanitario').hide();
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#tab_lab').load('../php/componentes/componentes_tareas/tab_tareas.php');
	$('#menu').load('../php/componentes/menu/menu.php');

	$('#modal-insumos').on('hidden.bs.modal', function (e) {
		$('#modal-form').modal('toggle');
	})

	$('#modal-convenios').on('hidden.bs.modal', function (e) {
		$('#modal-form').modal('toggle');
	})

	$('#modal-gastos').on('hidden.bs.modal', function (e) {
		$('#modal-form').modal('toggle');
	})

	$('#cod_cul').change(function(){

		res_conv();
		res_insu();
		res_gasto();

		document.getElementById("tab_conve_agregar").innerHTML = "";
		document.getElementById("tab_insumos_agregar").innerHTML = "";
		document.getElementById("tab_gastos_agregar").innerHTML = "";

		precio_total_convenios= 0 ;
		costo_gastos = 0;
		precio_total_insumos = 0;
		$('#btn-add-conv').removeAttr("disabled"); 
		$('#btn-add-ins').removeAttr("disabled"); 
		$('#btn-add-gasto').removeAttr("disabled"); 


	});

	$('#num_registros').change(function(){
		Cargar_tab_n_registros();
	})

	$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('#des_tar').keydown(function(){
		$('#div_des_tar').addClass("input-group-alternative");
	});

	$('#enf_fit').keydown(function(){
		$('#div_enf_fit').addClass("input-group-alternative");
	});

});





function actividad(){
	act=$('#tipo_lab').val();
	if (act!=2){
		jQuery('#fitosanitario').hide();
	}else{
		jQuery('#fitosanitario').show();
	}
}

function cerrar_menu(){
	$('#sidenav-main').remove();
	jQuery('#ver1').hide();
	jQuery('#ver2').show();
}



function Cargar_tab_n_registros(){
	registros =  $('#num_registros').val();
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_tareas/tab_tareas_numerg.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_lab").innerHTML=ajax.responseText;
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
  ajax.open("POST","../php/componentes/componentes_tareas/tab_tareas_fechas.php", true);
  ajax.onreadystatechange=function(){
  	if ( ajax.readyState==4 ) {
  		document.getElementById("tab_lab").innerHTML=ajax.responseText;
  	}
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("fini="+fi+"&ffin="+ff);
}