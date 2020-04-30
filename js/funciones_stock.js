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