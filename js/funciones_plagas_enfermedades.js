
//-----------Select escoger si se guarda enfermedad o plaga-------------//
function cargar_select_tip() {
    pla_o_enf = $('#pla_o_enf').val();
    alert("a er "+ pla_o_enf);
  
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/select_patogeno_tipo.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("sel_pat_tip").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("pla_o_enf=" + pla_o_enf);  
    
  }

//--------------------------------Guardar partes afectadas----------------------------//
partes = "";
function guardarPartes(){

    partes = "";
    frutos=$('input:checkbox[name=frutos]:checked').val();
    tallo=$('input:checkbox[name=tallo]:checked').val();
    hojas=$('input:checkbox[name=hojas]:checked').val();
    flores=$('input:checkbox[name=flores]:checked').val();
    raiz=$('input:checkbox[name=raiz]:checked').val();
    enves=$('input:checkbox[name=enves]:checked').val();
    aerea=$('input:checkbox[name=aerea]:checked').val();


    if(frutos == undefined && tallo == undefined && hojas == undefined && flores == undefined && raiz == undefined && enves == undefined && aerea == undefined){
        
        toastr.error('Por favor solo seleccione al menos una opción','',{
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    }else{
        if(frutos != undefined){
            partes = partes + " - " + "Frutos";
        }if(tallo != undefined){
            partes = partes + " - " +"Tallo";
        }if(hojas != undefined){
            partes = partes + " - " +"Hojas";
        }if(flores != undefined){
            partes = partes + " - " +"Flores";
        }if(raiz != undefined){
            partes = partes + " - " +"Raiz";
        }if(enves != undefined){
            partes = partes + " - " +"Enves";
        }if(aerea != undefined){
            partes = partes + " - " +"Aerea";
        }

        setTimeout ("cargarTextPartes(partes)", 1000);
    
        jQuery('#form-add-partes').hide();
        jQuery('#preloader').show();       
    }
}
 
function cargarTextPartes(partes) {  
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_partes.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {     

        $('#modal-partes-afe').modal('hide');
        jQuery('#form-add-partes').show();
        jQuery('#preloader').hide();  

        document.getElementById("partes-mostrar").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("partes=" + partes);    
  }

//--------------------------------Guardar etapas afectadas----------------------------//
etapas = "";

function guardarEtapas(){

    etapas = "";
    vegetativo=$('input:checkbox[name=vegetativo]:checked').val();
    ifloracion=$('input:checkbox[name=ifloracion]:checked').val();
    mfloracion=$('input:checkbox[name=mfloracion]:checked').val();
    fructificacion=$('input:checkbox[name=fructificacion]:checked').val();
    cosecha=$('input:checkbox[name=cosecha]:checked').val();


    if(vegetativo == undefined && ifloracion == undefined && mfloracion == undefined && fructificacion == undefined && cosecha == undefined){
        
        toastr.error('Por favor solo seleccione al menos una opción','',{
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    }else{
        if(vegetativo != undefined){
            etapas = etapas + " - " +"Crecimiento";
        }if(ifloracion != undefined){
            etapas = etapas + " - " +"Inicio floracion";
        }if(mfloracion != undefined){
            etapas = etapas + " - " +"Máxima floracion";
        }if(fructificacion != undefined){
            etapas = etapas + " - " +"Fructificacion";
        }if(cosecha != undefined){
            etapas = etapas + " - " +"Cosecha";
        }

        setTimeout ("cargarTextEtapas(etapas)", 1000);
    
        jQuery('#form-add-etapas').hide();
        jQuery('#preloader1').show();        
    }
}
 
function cargarTextEtapas(etapas) {  
    //alert(etapas);
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_etapas.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {           

            $('#modal-etapas-afe').modal('hide');
            jQuery('#form-add-etapas').show();
            jQuery('#preloader1').hide();
            document.getElementById("etapas-afe-mostrar").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("etapas=" + etapas);    
  }

  //--------------------------------Sintomas presentados----------------------------//
sintomas = "";
function guardarSintomas(datos,valores){

    sintomas = "";
    datosS = datos.split('~');
    valoresS = valores.split('~');
    res = false;
    add = "";
    for(i=1;i<datosS.length;i++){
        
        resp=$('input:checkbox[name='+datosS[i]+']:checked').val();
        if(resp == 'on'){
            sintomas = sintomas +" - "+valoresS[i];
            res=true;
        }
    }
    if(res == false){

        toastr.error('Por favor solo seleccione al menos una opción','',{
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });
    }else{

        setTimeout ("cargarTextSintomas(sintomas)", 1000);
    
        jQuery('#form-add-sintomas').hide();
        jQuery('#preloader2').show();  
    }
}

function cargarTextSintomas(sintomas) {  
    alert(sintomas);
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_sintomas.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {           

            $('#modal-sintomas').modal('hide');
            jQuery('#form-add-sintomas').show();
            jQuery('#preloader2').hide();
            document.getElementById("sintomas-mostrar").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("sintomas=" + sintomas);    
  }
 
//-------------------------------------Mostrar y agregar a tabla de etapas----------------------//
listado_etapas="";
listado_fotos="";
union_listados ="";
function mostrarTabEtapas() {   

    eta_sel = $('#eta_sel').val(); 

    sep = eta_sel.split("||");
    cod_eta = sep[0];
    det_eta = sep[1];
    verf =listado_etapas.includes(det_eta);

    if(verf==true){
    
        toastr.error('Opción ya escogida.','',{
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });
    }else{

    listado_etapas = listado_etapas+cod_eta+"~"+det_eta+"||";
    alert("listado_etapas "+ listado_etapas + " y el otro "+ listado_fotos);

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/tab_etapas_desarrollo.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("tab_eta_ima").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("listado_etapas="+listado_etapas+"&listado_fotos="+listado_fotos);
    }    
    
    
  }

function validateFileType(info){


    sep = listado_etapas.split('||');
    indice = 0;
    found = false;
    found = false;
  
    for (i = 0; i < sep.length - 1; i++) {
        sepr = sep[i].split('~');
  
        for (e = 0; e < sepr.length; e++) {
            if (info == sepr[e]) {
                indice = i;
                found = true;
                break;
            }
        }
  
        if (found == true) {
            break;
        }
    }    

    var fileName = document.getElementById(info).value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){        
        if (found == true) {

            listado_fotos = listado_fotos+info+"~"+fileName+"||";
          
        } 
    }else{
        alert("Only jpg/jpeg and png files are allowed!");
    }   
}

function remFila(dato){

  sep = listado_etapas.split('||');
  indice = 0;
  found = false;

  for (i = 0; i < sep.length - 1; i++) {
      sepr = sep[i].split('~');

      for (e = 0; e < sepr.length; e++) {
          if (dato == sepr[e]) {
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
    listado_etapas = "";

      for (i = 0; i < sep.length - 1; i++) {

          if (indice != i) {
            listado_etapas = listado_etapas + sep[i] + "||";
          }
      }  
      
      sep = listado_fotos.split('||');

      listado_fotos = "";

      for (i = 0; i < sep.length - 1; i++) {

          if (indice != i) {
            listado_fotos = listado_fotos + sep[i] + "||";
          }
      }
  }
  mostrarEtapasUp(listado_etapas);


}

function mostrarEtapasUp(listado_fotos) {
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/tab_etapas_desarrollo.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("tab_eta_ima").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("listado_etapas=" + listado_fotos);
  }

  //-------------------------------------------Mostrar tabla de metodos de prevencion--------------------//

cadena_mostrar_rus= "";

function cargarTablaAdd(cad){
	datos=cad.split('_');
	cod_agr = datos[0];
	rus_agr = datos[1];
	cadena_mostrar_rus = cadena_mostrar_rus + cod_agr + ","  + rus_agr + "||";
	mostrarTablaAdd(cadena_mostrar_rus);


}

  function mostrarTablaAdd(cadena_mostrar_rus){
    document.getElementById('tab_met_pre').value="";
    alert("que encuentra "+ cadena_mostrar_rus);
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_enfermedades_plagas/tab_metodos_agregados.php",true);
	ajax.onreadystatechange = function(){
		if(ajax.readyState==4){
			document.getElementById("tab_met_agre").innerHTML = ajax.responseText;

		}
	}
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("cad="+ cadena_mostrar_rus);

}

function rem_rus(rus_agr) {

	sep = cadena_mostrar_rus.split('||');
	indice = 0;
	found = false;
  
	for (i = 0; i < sep.length - 1; i++) {
		sepr = sep[i].split(',');
  
		for (e = 0; e < sepr.length; e++) {
			if (rus_agr == sepr[e]) {
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
		cadena_mostrar_rus = "";
  
		for (i = 0; i < sep.length - 1; i++) {
  
			if (indice != i) {
				cadena_mostrar_rus = cadena_mostrar_rus + sep[i] + "||";
			}
		}
  
	}
  
	mostrarTablaAdd(cadena_mostrar_rus);
  
  }

  //------------------------ Guardar enfermedad o plaga---------------------------//
function guardarEnfer_Plaga(){

    falta = "";
  pla_o_enf = $('#pla_o_enf').val();
  nom_afe = $('#nom_afe').val();
  nomc_afe = $('#nomc_afe').val();
  horario = $('#horario').val();
  epoca_a = $('#epoca_a').val();
  etapas_f = "";
  partes_f = "";
  sintomas_f = "";
  metodos_f = "";
  // Patoge o tipo
  indiv = "";
  if(pla_o_enf == "Plaga"){
    indiv = $('#sele_enf_pla1').val();
  }else if(pla_o_enf == "Enfermedad"){
    indiv = $('#sele_enf_pla2').val();
  }
  //Etapas
  if(etapas != ""){
    etapas_f= etapas;
  }else{
    falta = "Etapas";
  }
  //Partes
  if(partes != ""){
    partes_f= partes;
  }else{
    falta = falta +", Partes";
  }
   //Sintomas
   if(sintomas != ""){
    sintomas_f= sintomas;
  }else{
    falta = falta +", Sintomas";
  }
  //Metodos de prevención
  if(cadena_mostrar_rus != ""){
    metodos_f= cadena_mostrar_rus;
  }else{
    falta = falta +", Métodos de prevención";
  }
if(falta != ""){
  alert("Falta "+ falta);
}else{

    cadena='pla_o_enf='+ pla_o_enf+
    '&indiv='+ indiv+
    '&nom_afe='+ nom_afe+
    '&nomc_afe='+ nomc_afe+
    '&horario='+ horario+
    '&epoca_a='+ epoca_a +
    '&etapas_f='+ etapas_f +
    '&partes_f='+ partes_f +
    '&sintomas_f='+ sintomas_f+
    '&metodos_f='+ metodos_f;

    if(pla_o_enf == "Plaga"){

    $.ajax({
      type:"post",
      url:"../php/crud/plagas_enfermedades/agregar_plaga_enfermedad.php",
      data:cadena,
      success:function(r){
          alert(r);          
       if(r.includes('Resource id')){
        $.ajax({
            type:"post",
            url:"../php/crud/plagas_enfermedades/agregar_plaga.php",
            data:cadena,
            success:function(res){
                alert(res);
                swal("¡Plaga agregada!"," ", "success");
                $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
            }						
        });  
        }
      }
    });
}else{

    $.ajax({
        type:"post",
        url:"../php/crud/plagas_enfermedades/agregar_plaga_enfermedad.php",
        data:cadena,
        success:function(r){
            alert(r);          
         if(r.includes('Resource id')){
          $.ajax({
              type:"post",
              url:"../php/crud/plagas_enfermedades/agregar_enfermedad.php",
              data:cadena,
              success:function(res){
                  alert(res);
                  swal("¡Enfermedad agregada!"," ", "success");
                  $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
              }						
          });  
          }
        }
      });

}
}

}
//--------------------------------------Inicio----------------------------------------//
$(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
    $('#tab_met_pre').load('../php/componentes/componentes_enfermedades_plagas/tab_metodos_prevencion.php');
    $('#menu').load('../php/componentes/menu/menu.php');

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });      

    $('#det_semup').keydown(function() {
        $('#div_det_semup').addClass("input-group-alternative");
    });

    $('#modal-partes-afe').on('hidden.bs.modal', function (e) {
		$('#modal-form').modal('toggle');
    })

  $('#eta_sel').change(function() {
    mostrarTabEtapas();
  });

  $('#pla_o_enf').change(function() {
    cargar_select_tip();
  });


});

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