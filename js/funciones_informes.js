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


$(document).ready(function(){
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#menu').load('../php/componentes/menu/menu.php');

	$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('#cod_cul').change(function(){

		total_inversion = 0;
		total_recuperado = 0;
		total_kilogramos = 0;
		total_inversion = 0;
		if ($('#cod_cul').val() != null) {


			ajax2 = objetoAjax();
			ajax2.open("POST","../php/componentes/componenetes_informes/graficas_socios.php", true);
			ajax2.onreadystatechange=function(){
				if ( ajax2.readyState==4 ) {
					document.getElementById("graficas_socios_div").innerHTML=ajax2.responseText;

					if ($('#cod_cul_chart').val() != "") {
						cadena = "cod_cul="+$('#cod_cul_chart').val()+ "&nom_cul=" + $("#nom_cul_chart").val();
						$.ajax({
							type:"post",
							url:"../php/componentes/aportes/aporte_socios_informe.php",
							data:cadena,
							success:function(r){
								if(r.trim() != "null"){
									res = r.trim();
									datos = res.split("||");

									let socios = [];
									let dinero = [];
									let dataset = []
									let colors = ['#fb6340','#ffd600','#8965e0','#f5365c'];
									for ( i = 0;  i < datos.length - 1; i++) {

										aportes = datos[i].split("-");
										socios.push(aportes[0]);
										dinero.push(parseFloat(aportes[1]));
										total_inversion = total_inversion + parseFloat(aportes[1]);
										dataset.push({
											label: aportes[0],
											backgroundColor: colors[i],
											data: [parseFloat(aportes[2]),parseFloat(aportes[3]),parseFloat(aportes[4])]
										})
									}

									jQuery('#div_de_aportes').show();
									cargar_aportes();
									document.getElementById("informe_socio").innerHTML="";

									ch1 = new Chart(document.getElementById("doughnut-chart"), {
										type: 'doughnut',
										data: {
											labels: socios,
											datasets: [
											{
												label: "Aportes detallados",
												backgroundColor: ["#5e72e4", "#11cdef"],
												data: dinero,
											}
											]
										},
										options: {
											title: {
												display: true,
												text: 'Aportes de los socios en el cultivo',
												fontColor: '#8898aa',
												fontSize: 16
											}
										}
									});

									ch2 = new Chart(document.getElementById("bar-chart-grouped"), {
										type: 'bar',
										data: {
											labels: ["Convenios", "Insumos", "Gastos"],
											datasets: dataset
										},
										options: {
											title: {
												display: true,
												text: 'Aportes de los socios por convenios, insumos y gastos',
												fontColor: '#8898aa',
												fontSize: 16
											}
										}
									});
								}else{
									jQuery('#div_de_aportes').hide();
								}
							}
						});

					}

				}
			}
			ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			ajax2.send("cod_cul="+$('#cod_cul').val()+ "&nom_cul=" + $("#cod_cul option:selected").text());


			//----------------------------------------------Informes del cultivo-------------------------------------------


			ajax3 = objetoAjax();
			ajax3.open("POST","../php/componentes/componenetes_informes/graficas_cultivo.php", true);
			ajax3.onreadystatechange=function(){
				if ( ajax3.readyState==4 ) {
					document.getElementById("graficas_cultivos_div").innerHTML=ajax3.responseText;

					if ($('#cod_cul_chart_pro').val() != "") {
						cadena = "cod_cul="+$('#cod_cul_chart_pro').val()+ "&nom_cul=" + $("#nom_cul_chart_pro").val();
						$.ajax({
							type:"post",
							url:"../php/componentes/aportes/produccion_cultivos_informe.php",
							data:cadena,
							success:function(r){
								if(r.trim() != "null"){
									res = r.trim();
									datos = res.split("**");
									agrupados = datos[0].split("||");
									//Graficas para los cultivos 
									jQuery('#graficas_cultivos_div').show();
									let fechas = [];
									let dinero = [];
									let kilos = []
									for ( i = 0;  i < agrupados.length - 1; i++) {

										aportes = agrupados[i].split(",");
										fechas.push(aportes[0]);
										dinero.push(parseFloat(aportes[1]));
										total_recuperado = total_recuperado + parseFloat(aportes[1]);
										total_kilogramos = total_kilogramos + parseFloat(aportes[2]);
										kilos.push(parseFloat(aportes[2]));
									}

									new Chart(document.getElementById("line-chart-dinero"), {
										type: 'line',
										data: {
											labels: fechas,
											datasets: [{ 
												data: dinero,
												label: "Dinero",
												borderColor: "#2dce89",
												fill: true
											}
											]
										},
										options: {
											title: {
												display: true,
												text: 'Dinero recaudado durante las producciones del cultivo'
											}
										}
									});

									new Chart(document.getElementById("line-chart-kg"), {
										type: 'line',
										data: {
											labels: fechas,
											datasets: [{ 
												data: kilos,
												label: "Kilogramos de tomate",
												borderColor: "#B070C1",
												fill: true
											}
											]
										},
										options: {
											title: {
												display: true,
												text: 'Kilogramos de tomate recolectados en las producciones'
											}
										}
									});

									$('#total_dinero').text("Total de dinero recaudado: $ " + total_recuperado );
									$('#total_kilos').text("Total de kilogramos recolectados:  " + total_kilogramos + "Kg");	


									agrupados = datos[1].split("||");
									

									let tipos_prod = [];
									let kilos_prod = []
									for ( i = 0;  i < agrupados.length - 1; i++) {

										aportes = agrupados[i].split(",");
										tipos_prod.push(aportes[0]);
										kilos_prod.push(parseFloat(aportes[1]));
									}	

									new Chart(document.getElementById("pie-chart"), {
										type: 'pie',
										data: {
											labels: tipos_prod,
											datasets: [{
												label: "Population (millions)",
												backgroundColor: ["#11cdef", "#8e5ea2","#fb6340","#2dce89","#c45850"],
												data: kilos_prod
											}]
										},
										options: {
											title: {
												display: true,
												text: 'Predicted world population (millions) in 2050'
											}
										}
									});	

									
									new Chart(document.getElementById("bar-chart-horizontal"), {
										type: 'horizontalBar',
										data: {
											labels: [ "Inversion","Recaudo"],
											datasets: [
											{
												label: "Dinero",
												backgroundColor: ["#f5365c","#2dce89"],
												data: [datos[2],total_recuperado]
											}
											]
										},
										options: {
											legend: { display: false },
											title: {
												display: true,
												text: 'Predicted world population (millions) in 2050'
											}
										}
									});	


									if (datos[2] >= total_recuperado) {
										jQuery('#car_ganando').hide();
										jQuery('#car_perdiendo').show();
										document.getElementById('diferencai_per').innerHTML = "$ "+(datos[2] - total_recuperado)+".";

									}else{

										jQuery('#car_ganando').show();
										jQuery('#car_perdiendo').hide();

										document.getElementById('diferencai_gan').innerHTML = "$ "+(total_recuperado - datos[2])+".";
										

									}	
								}else{
									jQuery('#graficas_cultivos_div').hide();
								}
							}
						});

					}

				}
			}
			ajax3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			ajax3.send("cod_cul="+$('#cod_cul').val()+ "&nom_cul=" + $("#cod_cul option:selected").text());


		}

		
	});

});


function cerrar_menu(){
	$('#sidenav-main').remove();
	jQuery('#ver1').hide();
	jQuery('#ver2').show();
}

function cargar_aportes(){
	if ($('#cod_cul').val() != null) {
		ajax = objetoAjax();
		ajax.open("POST","../php/componentes/aportes/aporte_socios_inf.php", true);
		ajax.onreadystatechange=function(){
			if ( ajax.readyState==4 ) {
				document.getElementById("informe_socio").innerHTML=ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ajax.send("cod_cul="+$('#cod_cul').val()+ "&nom_cul=" + $("#cod_cul option:selected").text());
	}
}


function informe_general(){
	cod_cul = $('#cod_cul').val();
	if (cod_cul != null) {
		window.open('../php/componentes/componenetes_informes/informe_general_cultivo.php/?c='+cod_cul);
	}else{
		swal("Atención!","Debe seleccionar el cultivo para poder generar este reporte", {
			icon: "info",
		});
	}
}

function informe_aportes_socios(){
	cod_cul = $('#cod_cul').val();
	if (cod_cul != null) {
		window.open('../php/componentes/componenetes_informes/informe_aporte_socios.php/?c='+cod_cul);
	}else{
		swal("Atención!","Debe seleccionar el cultivo para poder generar este reporte", {
			icon: "info",
		});
	}
}

function informe_rendimiento_cul(){
	cod_cul = $('#cod_cul').val();
	if (cod_cul != null) {
		window.open('../php/componentes/componenetes_informes/informe_rendimiento_cultivo.php/?c='+cod_cul);
	}else{
		swal("Atención!","Debe seleccionar el cultivo para poder generar este reporte", {
			icon: "info",
		});
	}
}


function informe_produccion_cul(){
	cod_cul = $('#cod_cul').val();
	if (cod_cul != null) {
		window.open('../php/componentes/componenetes_informes/informe_produccion_cultivo.php/?c='+cod_cul);
	}else{
		swal("Atención!","Debe seleccionar el cultivo para poder generar este reporte", {
			icon: "info",
		});
	}
}


function informe_tareas_cultivo(){
	cod_cul = $('#cod_cul').val();
	if (cod_cul != null) {
		window.open('../php/componentes/componenetes_informes/informe_tareas_cultivo.php/?c='+cod_cul);
	}else{
		swal("Atención!","Debe seleccionar el cultivo para poder generar este reporte", {
			icon: "info",
		});
	}
}


function Informe_completo_cultivo(){
	cod_cul = $('#cod_cul').val();
	if (cod_cul != null) {
		window.open('../php/componentes/componenetes_informes/informe_completo_cultivo.php/?c='+cod_cul);
	}else{
		swal("Atención!","Debe seleccionar el cultivo para poder generar este reporte", {
			icon: "info",
		});
	}
}

