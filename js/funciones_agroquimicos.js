function actualizar_tabla(){
	$('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');
}



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


  function cargarAgro(){
		$('#div-btn-add').hide();
		$('#crear_agroq').load('../php/componentes/componentes_agroquimicos/add_agroquimicos.php');
	}

$(document).ready(function(){
  
	jQuery('#ver2').hide();
	$('#date-hour').load('../php/componentes/menu/date-hour.php');
	$('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
	$('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
	$('#menu').load('../php/componentes/menu/menu.php');
	$('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');
	$('#tab_rus').load('../php/componentes/componentes_agroquimicos/tab_recom_uso.php');
	
  });



function preloader(){
	cod_agr=$('#cod_agr').val();
	nom_agr=$('#nom_agr').val();
	pre_agr=$("#pre_agr").val();  
	dos_agr=$('#dos_agr').val();
	des_ins=$('#des_ins').val();
	rap_agr=$('#rap_agr').val();
	pcr_agr=$('#pcr_agr').val();
	pen_agr=$('#pen_agr').val();
	pro_agr=$('#pro_agr').val();
	cod_for=$('#cod_for').val();
	cod_tag=$('#cod_tag').val();
	cod_tox=$('#cod_tox').val();
	est_agr=$('#est_agr').val();
	cod_unm=$('#uni_med').val();
	cod_iac=$('#cod_iac').val();
	fun_agr=$('#fun_agr').val();
	add_rus_agr = cadena_mostrar_rus;
	
	crear_agroquimico(cod_agr,nom_agr,pre_agr,des_ins,dos_agr,rap_agr,pcr_agr,pen_agr,pro_agr,cod_for,cod_tag,cod_tox,est_agr,cod_unm,cod_iac,fun_agr,add_rus_agr);
	
}


cadena_mostrar_rus= "";

function cargarTablaAdd(cad){
	datos=cad.split('_');
	cod_agr = datos[0];
	rus_agr = datos[1];
	cadena_mostrar_rus = cadena_mostrar_rus + cod_agr + ","  + rus_agr + "||";
	mostrarTablaAdd(cadena_mostrar_rus);


}

function mostrarTablaAdd(cadena_mostrar_rus){
	document.getElementById('rus_agr').value="";
	ajax = objetoAjax();
	ajax.open("POST","../php/componentes/componentes_agroquimicos/tab_rus_add.php",true);
	ajax.onreadystatechange = function(){
		if(ajax.readyState==4){
			document.getElementById("tab_rus_agre").innerHTML = ajax.responseText;

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

function crear_agroquimico(cod_agr,nom_agr,pre_agr,des_ins,dos_agr,rap_agr,pcr_agr,pen_agr,pro_agr,cod_for,cod_tag,cod_tox,est_agr,cod_unm,cod_iac,fun_agr,add_rus_agr){
	
   cadena='cod_agr='+ cod_agr+
   '&nom_agr='+ nom_agr +' - '+pre_agr +
   '&des_ins='+ des_ins +
   '&dos_agr='+ dos_agr +
   '&rap_agr='+ rap_agr +
   '&pcr_agr='+ pcr_agr +
   '&pen_agr='+ pen_agr +
   '&pro_agr='+ pro_agr +
   '&cod_for='+ cod_for +
   '&cod_tag='+ cod_tag +
   '&cod_tox='+ cod_tox +
   '&est_agr='+ est_agr +
   '&cod_unm='+ cod_unm +
   '&cod_iac='+ cod_iac +
   '&fun_agr='+ fun_agr+ 
   '&add_rus_agr='+ add_rus_agr;
   $.ajax({
     type:"post",
     url:"../php/crud/agroquimicos/agregar_agroquimico.php",
     data:cadena,
     success:function(r){
		 
       if(r=='Resource id #6Resource id #8'){
         swal("Agroquímico agregado!"," ", "success");
         $('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');
         var form = document.querySelector('#form-add-agr');
         form.reset();
         jQuery('#preloader').hide();
         jQuery('#form-add-agr').show();
         $('#modal-form').modal('hide');

       }
     }
   });

 }





function llenarform(datos){
	data= datos.split('||');
	$('#modal-form-up').modal('toggle');
	$('#des_insup').val(data[2]);
	$('#tip_uni_medup').val(parseInt(data[8]));
	$('#uni_medup').val(parseInt(data[5]));
	$('#det_agrup').val(data[7]);
	global = data[0];
	global1 = data[1];
}



function preloaderup(){
	jQuery('#preloaderup').show();
	jQuery('#form-up-agr').hide();
	cod_agr = global;
	cod_ins = global1;
	des_insup=$('#des_insup').val();
	est_agrup=$("input[name='est_agrup']:checked").val();
	cla_agrup=$("input[name='cla_agrup']:checked").val();
	tip_uni_medup=$('#tip_uni_medup').val();
	uni_medup=$('#uni_medup').val();
	det_agrup=$('#det_agrup').val();

	setTimeout ("actualizar_agroquimico(cod_agr,cod_ins,des_insup,est_agrup,cla_agrup,tip_uni_medup,uni_medup,det_agrup);", 1000);	
}



function actualizar_agroquimico(global,global1,des_insup,est_agrup,cla_agrup,tip_uni_medup,uni_medup,det_agrup){
	cadena ="cod_agr="+global+
	"&cod_ins="+global1+
	"&des_insup="+des_insup+
	"&est_agrup="+est_agrup+
	"&cla_agrup="+cla_agrup+
	"&tip_uni_medup="+tip_uni_medup+
	"&uni_medup="+uni_medup+
	"&det_agrup="+det_agrup;
	$.ajax({
		type:"post",
		url:"../php/crud/agroquimicos/actualizar_agroquimico.php",
		data:cadena,
		success:function(r){
			$('#rr').val(r);
			result=$('#rr').val();
			if(result=='Resource id #6' || result=='Resource id #7'){
				swal("¡Agroquímico Editado!"," ", "success");
				var form = document.querySelector('#form-up-agr');
				form.reset();
				$('#modal-form-up').modal('hide'); 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-agr').show();				       
				$('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');

			}else{
				alert(r); 
				jQuery('#preloaderup').hide();
				jQuery('#form-up-agr').show();
				$('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');        
			}
		}
	});
}






 function eliminar_agroquimico(datos){
 	cod=datos.split('||');
	 cod_ins=cod[1];
	 cod_agr=cod[0];
   swal({
     title: "Estas seguro?",
     text: "Deseas eliminar este Agroquímico?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
   })
   .then((willDelete) => {
     if (willDelete) {
	   cadena="cod_ins="+cod_ins+
	   "&cod_agr="+cod_agr.trim();
       $.ajax({
         type:"post",
         url:"../php/crud/agroquimicos/eliminar_agroquimico.php",
         data:cadena,
         success:function(r){
		   location.reload();
		   
         }
       });
       swal("El Agroquímico se elimino!", {
         icon: "success",
       });
     } else {
       swal("Cancelado!");
     }
   });
 }
 
	