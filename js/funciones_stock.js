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

function ver_por_cultivo(){
	seleccion = $('#ver_x_cultivo').val();
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_stock/tabla_stock_cultivo.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tabla_stock").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("seleccion="+ seleccion);
}

$(document).ready(function(){
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#menu').load('../php/componentes/menu/menu.php');
	$('#calculadora').load('../php/componentes/calculadora/calculadora.php');

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



  //boton flotante
  $('.botonF1').hover(function(){
  	$('.flotante').addClass('animacionVer');
  })
  $('.contenedor').mouseleave(function(){
  	$('.flotante').removeClass('animacionVer');
  })