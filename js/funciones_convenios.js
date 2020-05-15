 function preloader(){

   fec_con=$('#fec_con').val();
   trabajador=$('#trabajador').val();
   socio=$('#socio').val();
   cod_cul=$('#cod_cul').val();
   tipo_con=$('#tipo_con').val();
   des_cont=$('#des_cont').val();
   val_cont=$('#val_cont').val();
   ffi_con=$('#ffi_con').val();
   hor_jor=$('#hor_jor').val();
   vho_hor=$('#vho_hor').val();

   if(fec_con == "" || trabajador == null || socio == null || cod_cul == null || tipo_con == null ){

    toastr.error('Todos los campos son obligatorios','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });

  }else{

    if(tipo_con ==1){//JORNAL
      if(hor_jor == "" || vho_hor == ""){
        toastr.error('Todos los campos son obligatorios','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });
      }else{
        bien = false;

        if (isNaN(hor_jor)){
          $('#div_hor_jor').removeClass("input-group input-group-alternative");
          toastr.error('Las horas no pueden tener letras.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
          bien = false;
        }else if (parseFloat(hor_jor) == 0 || parseFloat(hor_jor) > 12 ){

          $('#div_hor_jor').removeClass("input-group input-group-alternative");
          toastr.error('Las horas a trabajar deben estar en un rango de 12 horas.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
          bien = false;
        }else{
          $('#div_hor_jor').addClass("input-group input-group-alternative");
          bien = true;
        } 


        if (isNaN(vho_hor)){
          $('#div_vho_hor').removeClass("input-group input-group-alternative");
          toastr.error('El valor de la hora debe ser númerico.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
          bien = false;
        }else if (parseFloat(vho_hor) == 0){

          $('#div_vho_hor').removeClass("input-group input-group-alternative");
          toastr.error('El valor de la hora de trabajo no puede ser cero.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
          bien = false;
        }else{
          $('#div_vho_hor').addClass("input-group input-group-alternative");
          bien = true;
        }

        if(bien == true){

          swal({
            title: "Si no está seguro, por favor verifique el formulario antes dar OK.",
            text: "¡Una vez creado el convenio no podrá ser editado,\ny solo se podrá eliminar si no ha sido efectuado!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

              jQuery('#preloader').show();
              jQuery('#form-add-convenio').hide();
              setTimeout ("crear_convenio(fec_con,trabajador,socio,cod_cul,tipo_con,des_cont,val_cont,ffi_con,hor_jor,vho_hor);", 1000);

            } else {
              swal("Revise la información ingresada!", {
                icon: "info",
              });
            }
          });

          
        }

      }   
    }else{//CONTRATO

      if(des_cont == "" || val_cont == ""){
        toastr.error('Todos los campos son obligatorios','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });
      }else{
        bien = false;

        if (isNaN(val_cont)){
          $('#div_val_cont').removeClass("input-group input-group-alternative");
          toastr.error('El valor del contrato no pueden tener letras.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
          bien = false;
        }else if (parseFloat(val_cont) == 0){

          $('#div_val_cont').removeClass("input-group input-group-alternative");
          toastr.error('El valor del contrato no puede ser cero.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
          bien = false;
        }else{
          $('#div_val_cont').addClass("input-group input-group-alternative");
          bien = true;
        }

        if(fec_con == ffi_con){
          toastr.error('Las fechas de inicio y fin del contrato no pueden ser las mismas.','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });

          bien = false;
        }


        if(bien == true){
          swal({
            title: "Si no está seguro, por favor verifique el formulario antes dar OK.",
            text: "¡Una vez creado el convenio no podrá ser editado,\ny solo se podrá eliminar si no ha sido efectuado!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

             jQuery('#preloader').show();
             jQuery('#form-add-convenio').hide();
             setTimeout ("crear_convenio(fec_con,trabajador,socio,cod_cul,tipo_con,des_cont,val_cont,ffi_con,hor_jor,vho_hor);", 1000);

           } else {
            swal("Revise la información ingresada!", {
              icon: "info",
            });
          }
        });
        }

      }   

    }
    
  }

}

function crear_convenio(fec_con,trabajador,socio,cod_cul,tipo_con,des_cont,val_cont,ffi_con,hor_jor,vho_hor){
 cadena='fec_con='+fec_con+
 '&trabajador='+trabajador+
 '&socio='+socio+
 '&cod_cul='+cod_cul+
 '&tipo_con='+tipo_con+
 '&des_cont='+des_cont+
 '&val_cont='+val_cont+
 '&ffi_con='+ffi_con+
 '&hor_jor='+hor_jor+
 '&vho_hor='+vho_hor;
 $.ajax({
   type:"post",
   url:"../php/crud/convenios/crear_convenio.php",
   data:cadena,
   success:function(r){
     if(r.includes('Resource id')){

       var form = document.querySelector('#form-add-convenio');
       form.reset();

       $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
       jQuery('#preloader').hide();
       jQuery('#form-add-convenio').show();
       $('#modal-form').modal('hide');

       jQuery('#contrato').hide();
       jQuery('#jornal').hide();

       $('#trabajador').val(0);
       $('#socio').val(0);
       $('#cod_cul').val(0);
       $('#tipo_con').val(0);

       swal("Convenio agregado!"," ", "success");

       $.ajax({
         type:"post",
         url:"../php/crud/convenios/crear_terceros.php",
         data:cadena,
         success:function(r){
           $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
         }
       });

       $.ajax({
         type:"post",
         url:"../php/crud/convenios/crear_tipo_convenio.php",
         data:cadena,
         success:function(r){
           $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
         }
       });

       $.ajax({
         type:"post",
         url:"../php/crud/convenios/cultivo_convenio.php",
         data:cadena,
         success:function(r){
           $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
         }
       });

       $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
       document.getElementById("aportes_chart").innerHTML="";

     }else{
       alert(r);
       jQuery('#preloader').show();
       jQuery('#form-add-convenio').hide();
       setTimeout ("crear_convenio(fec_con,trabajador,socio,cod_cul,tipo_con,des_cont,val_cont,ffi_con,hor_jor,vho_hor);", 1000);
     }
   }
 });
 $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');

}
function eliminar_convenio(cod_con){
 swal({
   title: "Estas seguro?",
   text: "Deseas eliminar este convenio?",
   icon: "warning",
   buttons: true,
   dangerMode: true,
 })
 .then((willDelete) => {
   if (willDelete) {
     cadena="cod_con="+cod_con;
     $.ajax({
       type:"post",
       url:"../php/crud/convenios/confirmar_convenio.php",
       data:cadena,
       success:function(r){
        if(r.trim()==""){
         $.ajax({
           type:"post",
           url:"../php/crud/convenios/eliminar_convenio.php",
           data:cadena,
           success:function(r){
            if (r.includes('Resource id')) {
             swal("El convenio se elimino!", {
               icon: "success",
             });
           }else{
            alert(r);
          }
          $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
        }
      });
       }else{
        swal(r, {
          icon: "info",
        });
      }
      $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
    }
  });
   } else {
     swal("Cancelado!");
   }
 });
 $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
}
var global = 0;

function  llenarform(datos){

 var form = document.querySelector('#form_up_conv');
 form.reset();

 data=datos.split('||');
 $('#modal-form-up').modal('toggle');
 $.ajax({
  type:"post",
  url:"../php/componentes/componentes_convenio/fecha1.php",
  data:"fecha="+data[1],
  success:function(r){
    $('#fecha1').html(r);
  }
});
 $('#ide_ter_up').val(parseInt(data[2]));
 $('#cod_conup').val(parseInt(parseInt(data[0])));

 if (data[5]==1){
   global=1;
   jQuery('#jornal_up').show();
   jQuery('#contrato_up').hide();
   $('#hor_jorup').val(parseInt(data[3]));
   $('#vho_horup').val(parseInt(data[4]));
   $('#cod_cul_up').val(parseInt(data[6]))
   terceros=data[7].split('*'); 
   $('#trabajadorup').val(parseInt(terceros[1]))
   $('#socioup').val(parseInt(terceros[0]))


 }else {
   global=2;

   jQuery('#contrato_up').show();
   jQuery('#jornal_up').hide();
   $('#des_contup').val(data[7]);
   $('#val_contup').val(parseInt(data[3]));
   $('#cod_cul_up').val(parseInt(data[8]));
   terceros=data[9].split('*'); 
   $('#trabajadorup').val(parseInt(terceros[1]))
   $('#socioup').val(parseInt(terceros[0]))

   $.ajax({
    type:"post",
    url:"../php/componentes/componentes_convenio/fecha2.php",
    data:"fecha="+data[5],
    success:function(r){
      $('#fecha2').html(r);
    }
  });
 }
}


function preloaderup(){

 jQuery('#preloaderup').show();
 jQuery('#form_up_conv').hide();
 cod_conup=$('#cod_conup').val();
 fec_con_up=$('#fec_con_up').val();
 ide_ter_up=$('#ide_ter_up').val();
 cod_cul_up=$('#cod_cul_up').val();
 des_contup=$('#des_contup').val();
 val_contup=$('#val_contup').val();
 ffi_conup=$('#ffi_conup').val();
 hor_jorup=$('#hor_jorup').val();
 vho_horup=$('#vho_horup').val();
 setTimeout ("actualizar_convenio(cod_conup,fec_con_up,ide_ter_up,cod_cul_up,des_contup,val_contup,ffi_conup,hor_jorup,vho_horup);", 1000);
}


function actualizar_convenio(cod_conup,fec_con_up,ide_ter_up,cod_cul_up,des_contup,val_contup,ffi_conup,hor_jorup,vho_horup){
 cadena="fec_con="+fec_con_up+
 "&ide_ter_up="+ide_ter_up+
 "&cod_cul_up="+cod_cul_up+
 "&des_contup="+des_contup+
 "&val_contup="+val_contup+
 "&ffi_conup="+ffi_conup+
 "&hor_jorup="+hor_jorup+
 "&vho_horup="+vho_horup+
 "&cod_con="+parseInt(cod_conup)+
 "&tipo_con="+global;
 alert(cadena);
 $.ajax({
   type:"post",
   url:"../php/crud/convenios/actualizar_convenio.php",
   data:cadena,
   success:function(r){
     if(r.includes('Resource id')){
       $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
       swal("Convenio agregado!"," ", "success");
       $.ajax({
         type:"post",
         url:"../php/crud/convenios/actualizar_tipo_convenio.php",
         data:cadena,
         success:function(e){
           if(e.includes('Resource id')){
           }else{
             alert(r);
           }
         }
       });
       $.ajax({
         type:"post",
         url:"../php/crud/convenios/cultivo_convenio_up.php",
         data:cadena,
         success:function(r){
           $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
         }
       });
       $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
       jQuery('#preloaderup').hide();
       jQuery('#form_up_conv').show();
       $('#modal-form-up').modal('hide');
     }    
   }
 });
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

function cargar_socios(){
  cultivo =  $('#cod_cul').val();
  ajax = objetoAjax();
  ajax.open("POST","../php/componentes/componentes_convenio/opc_socios.php", true);
  ajax.onreadystatechange=function(){
    if ( ajax.readyState==4 ) {
      document.getElementById("soc_opc").innerHTML=ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("cod_cul="+cultivo);
}


function Cargar_tab_n_registros(){
  registros =  $('#num_registros').val();
  ajax = objetoAjax();
  ajax.open("POST","../php/componentes/componentes_convenio/tab_convenio_numreg.php", true);
  ajax.onreadystatechange=function(){
    if ( ajax.readyState==4 ) {
      document.getElementById("tab_convenios").innerHTML=ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("num_reg="+registros);
}

function Cargar_tab_fechas(){
  fi =  $('#fecha_ini_filtro').val();
  ff =  $('#fecha_fin_filtro').val();

  var f = new Date();
  if(f.getMonth() +1 <10){
    fecha = f.getFullYear()+"-0"+(f.getMonth() + 1)+"-"+f.getDate();
  }else{
    fecha = f.getFullYear()+"-"+f.getMonth()+"-"+f.getDate();
  }
  $('#fecha_ini_filtro').val(fecha);
  $('#fecha_fin_filtro').val(fecha);
  //document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + );

  ajax = objetoAjax();
  ajax.open("POST","../php/componentes/componentes_convenio/tab_convenio_fechas.php", true);
  ajax.onreadystatechange=function(){
    if ( ajax.readyState==4 ) {
      document.getElementById("tab_convenios").innerHTML=ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("fini="+fi+"&ffin="+ff);
}


$(document).ready(function(){
 jQuery('#ver2').hide();
 jQuery('#contrato').hide();
 jQuery('#jornal').hide();
 jQuery('#contrato_up').hide();
 jQuery('#jornal_up').hide();

 $('#date-hour').load('../php/componentes/menu/date-hour.php');
 $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
 $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');

 $('#tab_convenios').load('../php/componentes/componentes_convenio/tab_convenio.php');
 $('#menu').load('../php/componentes/menu/menu.php');

 $("#myInput").on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $("#myTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});


 $('#hor_jor').keydown(function(){
  $('#div_hor_jor').addClass("input-group input-group-alternative");
});

 $('#vho_hor').keydown(function(){
  $('#div_vho_hor').addClass("input-group input-group-alternative");
});

 $('#val_cont').keydown(function(){
  $('#div_val_cont').addClass("input-group input-group-alternative");
});

 $('#tipo_con').change(function(){
  if ($('#tipo_con').val()==1) 
  {
    jQuery('#contrato').hide();
    jQuery('#jornal').show();
  }else{

    jQuery('#contrato').show();
    jQuery('#jornal').hide();
  }  
});

 $('#cod_cul').change(function(){
  cargar_socios();
})

 $('#num_registros').change(function(){
  Cargar_tab_n_registros();
})

});

function cerrar_menu(){
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}

function cargar_aportes(){
  document.getElementById("aportes_chart").innerHTML="";
  if ($('#cod_cul').val() != null) {
   ajax2 = objetoAjax();
   ajax2.open("POST","../php/componentes/aportes/aporte_socios_form.php", true);
   ajax2.onreadystatechange=function(){
    if ( ajax2.readyState==4 ) {
      document.getElementById("aportes_chart").innerHTML=ajax2.responseText;
    }
  }
  ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax2.send("cod_cul="+$('#cod_cul').val()+ "&nom_cul=" + $("#cod_cul option:selected").text());
}
}