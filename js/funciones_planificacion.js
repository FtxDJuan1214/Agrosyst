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


//------------------------Select escoger que tipo de interfaz mostrar según tipo de tarea--------------------//
function cargar_select_tip() {

  tip_tar = $('#tip_tar').val(); 

  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/tipo_tarea.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("sel_enf_pla").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("tip_tar=" + tip_tar);

  
  document.getElementById("sel_enf_pla").innerHTML = "";
  document.getElementById("enfe_plag").innerHTML = "";
  document.getElementById("etapasN").innerHTML = "";
  document.getElementById("tab_agr").innerHTML = "";
  document.getElementById("tab_agr2").innerHTML = "";
}



//-----------Select para escoger si es enfermedad o plaga (se activa filtro entre enfemedades y plagas)-------------//
function cargar_enfermedades_plagas() {
  enf_pla = $('#sele_enf_pla').val(); 

  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/lista_plagas_enfermedades.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("enfe_plag").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("sele_enf_pla=" + enf_pla);

  
  document.getElementById("enfe_plag").innerHTML = "";
  document.getElementById("etapasN").innerHTML = "";
  document.getElementById("tab_agr").innerHTML = "";
  document.getElementById("tab_agr2").innerHTML = "";

  
}      

//-------Select para escoger la es enfermedad o plaga (se activa filtro de las etapas con imagenes)----------------//
function cargar_etapas() {

  cod_enf_pla = $('#enf_o_plaga').val();
  tip_tar = $('#tip_tar').val();

  if(tip_tar == "Curación"){
   
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_planificacion/etapas.php", true);
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("etapasN").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
      }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("enf_o_plaga=" + cod_enf_pla);

  }else if(tip_tar == "Prevención"){

    selectEtapa("Prevención");
  //alert("lo envio como prevencion");

}else if(tip_tar == "Nutrición"){


}
document.getElementById("etapasN").innerHTML = "";
document.getElementById("tab_agr").innerHTML = "";
document.getElementById("tab_agr2").innerHTML = "";
}


//-----------------------------Mostrar tabla de agroquímicos para enfermedad según etapa--------------------------//
function selectEtapa(cod_etapa) {

  tip_tar = $('#tip_tar').val();  
  enf_o_plg = $('#enf_o_plaga').val(); 
  cod = cod_etapa;
  cod_eta = cod + "/"+enf_o_plg;
  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/tabla_agroquimicos_rec.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("tab_agr").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("cod_eta=" + cod_eta);

}

cadena_de_gastos_mostrar = "";
cadena_de_gastos_insertar = "";

cadena_nueva_planificacion = "";
codigo = "";
cod_agr_total = "";

agro=false;
function cargarTablaAdd(info) {  

  datos = info.split('_');
  cod_agr = datos[0];
  nom_agr = datos[1];
  des_iac = datos[2];
  dos_agr = datos[3];
  rap_agr = datos[4];
  can_sto = datos[5];
  enf_o_plaga = $('#enf_o_plaga').val();
  tip_tar = $('#tip_tar').val();

  if(cadena_de_gastos_mostrar.includes(nom_agr)){

    toastr.error('Este agroquímico ya está en la lista','',{
      "positionClass": "toast-top-center",
      "closeButton": false,
      "progressBar": true
    });

  }else{

    agro=true;

    cadena_de_gastos_mostrar = cadena_de_gastos_mostrar + cod_agr + "," + nom_agr + "," + rap_agr + "||";
    cadena_nueva_planificacion = cadena_nueva_planificacion + nom_agr + "~" + des_iac + "~" + dos_agr + "~" + can_sto +"~"+enf_o_plaga+"~"+tip_tar+"||";
    cod_agr_total = cod_agr_total+","+cod_agr;

    
    document.getElementById("tab_agr2").innerHTML = "";

    mostrarAgroquimicos(cadena_de_gastos_mostrar);
  }
}

function mostrarAgroquimicos(cadena) {

  ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_planificacion/tabla_agroquimicos_add.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("tab_agr2").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("info=" + cadena);
}

//----------------------------------------------Eliminar registro de agroquimico escogido---------------------------------//
function rem_agr(cod_agr) {

  sep = cadena_de_gastos_mostrar.split('||');
  indice = 0;
  found = false;

  for (i = 0; i < sep.length - 1; i++) {
    sepr = sep[i].split(',');

    for (e = 0; e < sepr.length; e++) {
      if (cod_agr == sepr[e]) {
        indice = i;
        found = true;
        break;
      }
    }

    if (found == true) {
      break;
    }
  }

  if (found == true) {
    cadena_de_gastos_mostrar = "";

    for (i = 0; i < sep.length - 1; i++) {

      if (indice != i) {
        cadena_de_gastos_mostrar = cadena_de_gastos_mostrar + sep[i] + "||";
      }
    }

    sep = cadena_de_gastos_insertar.split('||');

    cadena_de_gastos_insertar = "";

    for (i = 0; i < sep.length - 1; i++) {

      if (indice != i) {
        cadena_de_gastos_insertar = cadena_de_gastos_insertar + sep[i] + "||";
      }
    }

    sep = cadena_nueva_planificacion.split('||');
    cadena_nueva_planificacion = "";

    for (i = 0; i < sep.length - 1; i++) {

      if (indice != i) {
        cadena_nueva_planificacion = cadena_nueva_planificacion + sep[i] + "||";
      }
    }

  }

  mostrarAgroquimicos(cadena_de_gastos_mostrar);

}
//--------------------------------------------------Mostrar tabla de nueva planificación----------------------------------------------//

function new_planificacion() {

  tip_pla = $('#tip_tar').val();
  epoca = $('#epoca').val();
  det_pla = $('#det_pla').val();
  info = "";
  //
  enf_o_plaga = $('#enf_o_plaga').val();
  tip_tar = $('#tip_tar').val();

  if(tip_pla != null && epoca != null && agro != false && det_pla != '' && cadena_de_gastos_mostrar != ''){

    
    info = cadena_nueva_planificacion;

    
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_planificacion/tabla_planificaciones.php", true);
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("tab_pla").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
          //actualizar_codigo();
        }
      }
      ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      ajax.send("info=" + info);

      cadena_de_gastos_insertar = cadena_de_gastos_insertar + cod_agr +"/"+enf_o_plaga +"/"+tip_tar +"/"+cod_agr_total+ "/"+det_pla+"||";
      cod_agr_total="";
      
      document.getElementById("tip_tar").value = "";
      document.getElementById("det_pla").value = "";
      document.getElementById("sel_enf_pla").innerHTML = "";
      document.getElementById("enfe_plag").innerHTML = "";
      document.getElementById("etapasN").innerHTML = "";
      document.getElementById("tab_agr").innerHTML = "";
      document.getElementById("tab_agr2").innerHTML = "";

      cadena_de_gastos_mostrar="";
      

    }else{
      swal("Advertencia..", "Por favor llene todos los campos." , "warning");

    }
  }
  
//-----------------------------------------Guardar planificación------------------------------------------------//

function agregar_plan() {  
  
  
  num_pla = $('#num_pla').val().split(' ')[2].trim();
  det_pla = $('#det_pla').val();
  epoca = $('#epoca').val();
  fecha = $('#date').val();
  tip_tar = $('#tip_tar').val();

  
  datos ="num_pla="+num_pla+
  "&epoca="+epoca+
  "&fecha="+fecha+  
  "&info="+cadena_de_gastos_insertar+
  "&num_plan="+num_pla;
  $.ajax({
    type:"post",
    url:"../php/crud/planificacion/agregar_planificacion.php",
    data:datos,
    success:function(r){
     if(r.includes('Resource id')){	

      swal(
        'Todo salió bien!',
        'Planificación creada!',
        'success'
        );

      document.getElementById("mostrar_todo").innerHTML = "";    
      ajax1 = objetoAjax();
      ajax1.open("POST", "../php/componentes/componentes_planificacion/vista_planificacion.php", true);
      ajax1.onreadystatechange = function() {
        if (ajax1.readyState == 4) {
          document.getElementById("mostrar_todo").innerHTML = ajax1.responseText;
          document.getElementById("tab_pla").innerHTML = "";
        }
      }
      ajax1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      ajax1.send("datos=" + datos);
    }else{
     swal("Verifica los datos!", r , "error");
   }
 }
});

}

function cancelar_plan(){

  swal({
    title: "¿Estás seguro?",
    text: "Se perderá la información que has registrado",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      setTimeout ("location.reload();", 300);
    }
  });
}


//------------------------------------------------------------------------------------------------------------------------------//
$(document).ready(function() {

  jQuery('#ver2').hide();
  $('#date-hour').load('../php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
  $('#menu').load('../php/componentes/menu/menu.php');

  $('#tip_tar').change(function() {
    cargar_select_tip();
  });

  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })

});

function cerrar_menu() {
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}