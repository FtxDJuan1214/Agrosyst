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

  $("#myInput1").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable1 tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#myInput2").on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});
});

function cerrar_menu() {
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}

function objetoAjax() {
  var xmlhttp = false;
  try {
      xmlhttp = new ActiveXObject("MsxmL2.XMLHTTP");
  } catch (e) {
      try {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
          xmlhttp = false;
      }
  }
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
      xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

//----------------------------Mostrar tabla de agroquimicos asociados -------------------------------//
cod_afe = "";
cod_eta = "";
function tablaAgro(cod_etapa, codi_afe){
  //alert(cod_etapa+', '+codi_afe);
  cod_eta=cod_etapa;
  cod_afe = codi_afe;
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_relacion_etapas_agroquimicos/tab_agroquimicos_asociados.php",true);
	ajax.onreadystatechange = function(){
		if(ajax.readyState==4){
			document.getElementById("tablaAgro").innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cod_etapa="+ cod_etapa+"&cod_afe="+cod_afe);
}

//-----------------------------------------------------------//


function asociar(cod){
  $('#modal-mostrar').modal('toggle');


  ajax1 = objetoAjax();
	ajax1.open("POST","../php/componentes/componentes_relacion_etapas_agroquimicos/tab_mostrar_agroquimicos.php",true);
	ajax1.onreadystatechange = function(){
		if(ajax1.readyState==4){
			document.getElementById("tabla_agroquimicos").innerHTML = ajax1.responseText;
		}
	}
	ajax1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax1.send("cod_eta="+ cod_eta);
}

function asociarFinal(cod_agr){

  datos ="cod_eta="+cod_eta+
  "&cod_agr="+cod_agr+
  "&cod_afe="+cod_afe;
  
  $.ajax({
		type:"post",
		url:"../php/crud/relacion_etapas_agroquimico/crear_relacion.php",
		data:datos,
		success:function(r){
      //alert(r);
      if(r.includes('utilizado')){
        
        swal("", 'Este agroquímico ya está asociado a esta etapa' , "error");
      }else if(r.includes('Resource id')){	
			
        swal(
          '¡Agroquímico asociado!',
          '',
          'success'
        )
        tablaAgro(cod_eta, cod_afe);
			
		}else{
			swal("Verifica los datos!", r , "error");
		}
	}
  });
}

//---------------------------------------------------------------------//
function eliminarAsociacion(cod_agr){

  datos ="cod_eta="+cod_eta+
  "&cod_agr="+cod_agr+
  "&cod_afe="+cod_afe;
  //alert("datos "+datos);
  $.ajax({
		type:"post",
		url:"../php/crud/relacion_etapas_agroquimico/eliminar_relacion.php",
		data:datos,
		success:function(r){
      //alert(r);
      if(r.includes('Resource id')){	
			
        swal(
          '¡Asociación eliminada!',
          '',
          'success'
        )
        tablaAgro(cod_eta, cod_afe);
			
		}else{
			swal("Verifica los datos!", r , "error");
		}
	}
  });

}

//--------------------------Eliminar etapa-------------------------------------//
function eliminarEtapa(cod_etapa, codi_afe){

  datos ="cod_eta="+cod_etapa+
  "&cod_afe="+codi_afe;
  //alert("datos "+datos);
  $.ajax({
		type:"post",
		url:"../php/crud/relacion_etapas_agroquimico/eliminar_etapa.php",
		data:datos,
		success:function(r){
     // alert(r);
      if(r.includes('Resource id')){	
			
        swal(
          '¡Etapa de la plaga o enfermedad eliminada!',
          '',
          'success'
        )	
        location.reload();		
		}else{
			swal("Verifica los datos!", r , "error");
		}
	}
  });


}
