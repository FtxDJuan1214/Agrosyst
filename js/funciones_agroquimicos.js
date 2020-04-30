function actualizar_tabla(){
	$('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');
}


function preloader(){
	jQuery('#preloader').show();
	jQuery('#form-add-agr').hide();
	cod_agr=$('#cod_agr').val();
	det_agr=$('#det_agr').val();
	des_ins=$('#des_ins').val();
	rec_agr=$('#rec_agr').val();
	pcr_agr=$('#pcr_agr').val();
	pen_agr=$('#pen_agr').val();
	pro_agr=$('input:radio[name=pro_agr]:checked').val();
	for_agr=$('#for_agr').val();
	cod_tag=$('#cod_tag').val();
	cod_tox=$('#cod_tox').val();
	est_agr=$('input:radio[name=est_agr]:checked').val();
	cod_unm=$('#uni_med').val();
	setTimeout ("crear_agroquimico(cod_agr,det_agr,des_ins,rec_agr,pcr_agr,pen_agr,pro_agr,for_agr,cod_tag,cod_tox,est_agr,cod_unm);", 1000);
}





function crear_agroquimico(cod_agr,det_agr,des_ins,rec_agr,pcr_agr,pen_agr,pro_agr,for_agr,cod_tag,cod_tox,est_agr,cod_unm){

   cadena='cod_agr='+ cod_agr+
   '&det_agr='+ det_agr +
   '&des_ins='+ des_ins +
   '&rec_agr='+ rec_agr +
   '&pcr_agr='+ pcr_agr +
   '&pen_agr='+ pen_agr +
   '&pro_agr='+ pro_agr +
   '&for_agr='+ for_agr +
   '&cod_tag='+ cod_tag +
   '&cod_tox='+ cod_tox +
   '&est_agr='+ est_agr +
   '&cod_unm='+ cod_unm ; 
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
   swal({
     title: "Estas seguro?",
     text: "Deseas eliminar este Lote?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
   })
   .then((willDelete) => {
     if (willDelete) {
       cadena="cod_ins="+cod_ins;
       $.ajax({
         type:"post",
         url:"../php/crud/agroquimicos/eliminar_agroquimico.php",
         data:cadena,
         success:function(r){
          alert(r);
           $('#tab_agroquimicos').load('../php/componentes/componentes_agroquimicos/tab_agroquimicos.php');
         }
       });
       swal("El lote se elimino!", {
         icon: "success",
       });
     } else {
       swal("Cancelado!");
     }
   });
 }




