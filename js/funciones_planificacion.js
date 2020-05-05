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


//-----------Select escoger que tipo de interfaz mostrar según tipo de tarea-------------//
function cargar_select_tip() {
  tip_tar = $('#tip_tar').val();
  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/tipo_tarea.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("sel_enf_pla").innerHTML = ajax.responseText;
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("tip_tar=" + tip_tar);
}



//-----------Select para escoger si es enfermedad o plaga (se activa filtro entre enfemedades y plagas)-------------//
function cargar_enfermedades_plagas() {
  enf_pla = $('#sele_enf_pla').val();
  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/lista_plagas_enfermedades.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("enfe_plag").innerHTML = ajax.responseText;
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("sele_enf_pla=" + enf_pla);
}



//-------Select para escoger la es enfermedad o plaga (se activa filtro de las etapas con imagenes)----------------//
function cargar_etapas() {
  cod_enf_pla = $('#enf_o_plaga').val();
  //alert("codigo de enfermedad "+ cod_enf_pla);
  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/etapas.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("etapasN").innerHTML = ajax.responseText;
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("enf_o_plaga=" + cod_enf_pla);
}


//-----------------------------Mostrar tabla de agroquímicos para enfermedad según etapa--------------------------//
function selectEtapa(cod_etapa) {
    cod_eta = cod_etapa;
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_planificacion/tabla_agroquimicos_rec.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("tab_agr").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("cod_eta=" + cod_eta);
  
}

cadena_de_gastos_mostrar = "";
cadena_de_gastos_insertar = "";
cadena_nueva_planificacion = "";


function cargarTablaAdd(info){
alert("Envio: "+ info);
datos = info.split('_');
cod_agr = datos[0];
nom_agr = datos[1];
des_iac = datos[2];
dos_agr = datos[3];
rap_agr = datos[4];
can_sto = datos[5];
cod_eta = datos[6];
det_eta = datos[7];

cadena_de_gastos_mostrar = cadena_de_gastos_mostrar +cod_agr +","+nom_agr +","+rap_agr+"||";
cadena_de_gastos_insertar = cadena_de_gastos_insertar +cod_agr+"/"+nom_agr+"/"+des_iac+"/"+dos_agr+"/"+rap_agr+"/"+can_sto+"/"+cod_eta+"/"+det_eta+"||";
cadena_nueva_planificacion = cadena_nueva_planificacion  +nom_agr+"/"+des_iac+"/"+dos_agr+"/"+can_sto+"||";

mostrarAgroquimicos(cadena_de_gastos_mostrar);
}

function mostrarAgroquimicos(string_con_gastos){
  //alert("Info: " + string_con_gastos);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_planificacion/tabla_agroquimicos_add.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_agr2").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("info="+string_con_gastos);
}


function rem_agr(cod_agr) {

  alert("cod_agr " + cod_agr);

  sep = cadena_de_gastos_mostrar.split('||');
  indice = 0;
  found = false;

  for (i = 0; i < sep.length-1; i++) {
      sepr = sep[i].split(',');

      for (e = 0; e < sepr.length; e++) {
          if (cod_agr == sepr[e]) {
              indice = i;
              found = true;
              break;
          }
      }

      if(found==true){break;}
  }

  if(found == true){
    cadena_de_gastos_mostrar="";

    for (i = 0; i < sep.length-1; i++) {

      if(indice != i){
        cadena_de_gastos_mostrar= cadena_de_gastos_mostrar+sep[i]+"||";
      }
    }

    sep = cadena_de_gastos_insertar.split('||');

    cadena_de_gastos_insertar="";

    for (i = 0; i < sep.length-1; i++) {

      if(indice != i){
        cadena_de_gastos_insertar= cadena_de_gastos_insertar+sep[i]+"||";
      }
    }

  }  
  
  mostrarAgroquimicos(cadena_de_gastos_mostrar);

}

//--------------------------------------------------Mostrar tabla de nueva planificación----------------------------------------------//

function new_planificacion(){

tip_pla = $('#tip_tar').val();
info = "";
enfe_plag = $('#enf_o_plaga').val();

if(enfe_plag != null){
  info = tip_pla +"*"+enfe_plag+"*"+cadena_nueva_planificacion;
}else{
  info = tip_pla+"*"+cadena_nueva_planificacion;
}
alert("tip_pla "+tip_pla +"enf_o_plaga "+enfe_plag);
ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_planificacion/tabla_planificaciones.php", true);
	ajax.onreadystatechange=function(){
		if ( ajax.readyState==4 ) {
			document.getElementById("tab_pla").innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("info="+info);

}



//------------------------------------------------------------------------------------------------------------------------------//
$(document).ready(function() {

  toastr.info('Por favor, mientras ingrese los productos de la compra no recargue la pagina', '', {
      "positionClass": "toast-bottom-right",
      "closeButton": true,
      "progressBar": true
  });

  jQuery('#ver2').hide();
  $('#date-hour').load('../php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
  $('#menu').load('../php/componentes/menu/menu.php');

  $('#tip_tar').change(function() {
    cargar_select_tip();
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

});

function cargarSelecte() {  
  cod_enf_pla = $('#sele_enf_pla').val();
  cargar_enfermedades_plagas();
}

function cargarImagenes() {
  cod_enf_pla = $('#enf_o_plaga').val();
  cargar_etapas();
}

function cerrar_menu() {
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}