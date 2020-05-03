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

  alert("Cod etp: " + cod_etapa);
}



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
    alert("varible escogida "+ $('#tip_tar').val());
    cargar_select_tip();
});




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