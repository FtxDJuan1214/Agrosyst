 function preloader(){
   nomb_lote=$('#nom_lot').val();
   NFinca=$('#nom_fin').val();
   UniMedida=$('#uni_med').val();
   medi_lote=$('#med_lot').val();


   if(nomb_lote == "" || NFinca == null || UniMedida == null || medi_lote == ""){
    if(nomb_lote == ""){
      toastr.error('Por favor escriba el nombre del lote','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }else if(NFinca == null){
      toastr.error('Por favor seleccione la finca en donde está el lote','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }
    else if(UniMedida == null){
      toastr.error('Por favor seleccione la unidad de medida del lote','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }
    else if(medi_lote == ""){
      toastr.error('Por favor ingrese la medida del lote','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }
  }else{

    if (isNaN(medi_lote)){
      $('#div_med_lot').removeClass("input-group input-group-alternative");
      toastr.error('La medida del lote debe ser numérica.','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });

    }else if (parseFloat(medi_lote) == 0){

      $('#div_med_lot').removeClass("input-group input-group-alternative");
      toastr.error('La medida no puede ser cero.','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });

    }else{
      $('#div_med_lot').addClass("input-group input-group-alternative");
      //alert("area libre: "+area_free);
      $.ajax({
       type:"post",
       url:"../php/componentes/componentes_lotes/unidad_medida.php",
       data:"uni_med="+UniMedida,
       success:function(r){
       med_lot=(r*medi_lote);
       //alert("medida del lote: "+med_lot);
       if (med_lot <= area_free) {
         jQuery('#preloader').show();
         jQuery('#form-add-lote').hide();
         setTimeout ("crear_lote(nomb_lote,NFinca,UniMedida,medi_lote);", 1000);
       }else{
         toastr.error('La medida del lote sobrepasa al espacio disponible en la finca','',{
           "positionClass": "toast-top-center",
           "closeButton": true,
           "progressBar":true
         });
         $('#div_med_lot').removeClass("input-group input-group-alternative");
         jQuery('#preloader').hide();
         jQuery('#form-add-lote').show();
       }
     }
   });
    }
    
  }




}

function crear_lote(nomb_lote,NFinca,UniMedida,medi_lote){

 cadena='nomb_lote='+ nomb_lote+
 '&NFinca='+ NFinca +
 '&UniMedida='+ UniMedida +
 '&medi_lote='+ medi_lote; 

 $.ajax({
   type:"post",
   url:"../php/crud/lotes/crear_lote.php",
   data:cadena,
   success:function(r){
     if(r.includes('Resource id')){
       swal("Lote agregado!"," ", "success");
       $('#tab_lotes').load('../php/componentes/componentes_lotes/tab_lotes.php');
       var form = document.querySelector('#form-add-lote');
       form.reset();
       jQuery('#preloader').hide();
       jQuery('#form-add-lote').show();
       $('#modal-form').modal('hide');

     }else{
       swal("Error!",r, "error");
      jQuery('#preloader').hide();
      jQuery('#form-add-lote').show();
    }
  }
});

}

var med_ant=0;
function llenarform(datos){
 data=datos.split('||');
 var form = document.querySelector('#form-up-lote');
 form.reset();
 $('#modal-form-up').modal('toggle');
 $('#cod_lot').val(parseFloat(data[0]));
 $('#nom_lotup').val(data[1]);
 $('#nom_finup').val(parseFloat(data[4]));

 $('#nom_finup').val();
 jQuery('#notificacionup').show();
 medidaup();

 uni_med=parseFloat(data[7]);
 $.ajax({
   type:"post",
   url:"../php/componentes/componentes_lotes/unidad_med_up.php",
   data:"uni_med="+uni_med,
   success:function(r){
     $('#select3').html(r);
     $('#uni_med_up').val(parseFloat(data[5]));
     uni_med_up=$('#uni_med_up').val();
     $.ajax({
       type:"post",
       url:"../php/componentes/componentes_lotes/unidad_medida.php",
       data:"uni_med="+uni_med_up,
       success:function(r){
         med_ant=parseFloat(data[8]);
         med_ant=med_ant*r;
       }
     });
   }
 });

 $('#med_lotup').val(parseFloat(data[8]));
}

function preloaderup(){

 cod_lot=$('#cod_lot').val();
 nom_lotup=$('#nom_lotup').val();
 nom_finup=$('#nom_finup').val();
 uni_med_up=$('#uni_med_up').val();
 med_lotup=$('#med_lotup').val();

 if(nom_lotup == "" || nom_finup == "" || uni_med_up == "" || med_lotup == ""){
  toastr.error('Todos los campos son requridos','',{
   "positionClass": "toast-top-center",
   "closeButton": true,
   "progressBar":true
 });
}else{
  if (isNaN(med_lotup)){
    $('#div_med_lotup').removeClass("input-group input-group-alternative");
    toastr.error('La medida del lote debe ser numérica.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });

  }else if (parseFloat(med_lotup) == 0){

    $('#div_med_lotup').removeClass("input-group input-group-alternative");
    toastr.error('La medida no puede ser cero.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });

  }else{

      // // medida nueva del lote
      jQuery('#preloaderup').show();
      jQuery('#form-up-lote').hide();
      $.ajax({
       type:"post",
       url:"../php/componentes/componentes_lotes/unidad_medida.php",
       data:"uni_med="+uni_med_up,
       success:function(r){
         med_lot=(r*med_lotup);

       // alert('medida anterior = '+med_ant+'   medida nueva = '+med_lot);
       if (med_lot <= area_free) {
         cadena="cod_lot="+cod_lot+
         "&nom_lotup="+nom_lotup+
         "&nom_finup="+nom_finup+
         "&uni_med_up="+uni_med_up+
         "&med_lotup="+med_lotup;
         $.ajax({
           type:"post",
           url:"../php/crud/lotes/actualizar_lote.php",
           data:cadena,
           success:function(r){
             if(r.includes('Resource id')){
               swal("Lote Editado!"," ", "success");
               $('#tab_lotes').load('../php/componentes/componentes_lotes/tab_lotes.php');
               var form = document.querySelector('#form-up-lote');
               form.reset();
               jQuery('#preloaderup').hide();
               jQuery('#form-up-lote').show();
               $('#modal-form-up').modal('hide');
             }else{
               swal("Error!",r, "error");
               jQuery('#preloaderup').hide();
               jQuery('#form-up-lote').show();
             }
           }
         });
       }else{

         if ( med_lot <= med_ant) {
           cadena="cod_lot="+cod_lot+
           "&nom_lotup="+nom_lotup+
           "&nom_finup="+nom_finup+
           "&uni_med_up="+uni_med_up+
           "&med_lotup="+med_lotup;
           $.ajax({
             type:"post",
             url:"../php/crud/lotes/actualizar_lote.php",
             data:cadena,
             success:function(r){
               if(r.includes('Resource id')){
                 swal("Lote Editado!"," ", "success");
                 $('#tab_lotes').load('../php/componentes/componentes_lotes/tab_lotes.php');
                 var form = document.querySelector('#form-up-lote');
                 form.reset();
                 jQuery('#preloaderup').hide();
                 jQuery('#form-up-lote').show();
                 $('#modal-form-up').modal('hide');
               }else{
                 jQuery('#preloaderup').hide();
                 jQuery('#form-up-lote').show();
               }
             }
           });
         }else{

           toastr.info('Si queda mas espacio disponible en la finca, pero no puede aumentar el tamaño del lote, borre este lote y cree uno nuevo con la medida correcta.','',{
             "positionClass": "toast-top-center",
             "timeOut": "9000",
             "closeButton": true,
             "progressBar":true
           });
           toastr.error('La medida del lote sobrepasa al espacio disponible en la finca','',{
             "positionClass": "toast-top-center",
             "closeButton": true,
             "progressBar":true
           });

           jQuery('#preloaderup').hide();
           jQuery('#form-up-lote').show();}
         }

       }
     });

    }
  }
}

function eliminar_lote(cod_lot){
 swal({
   title: "Estas seguro?",
   text: "Deseas eliminar este Lote?",
   icon: "warning",
   buttons: true,
   dangerMode: true,
 })
 .then((willDelete) => {
   if (willDelete) {
     cadena="cod_lot="+cod_lot;
     $.ajax({
       type:"post",
       url:"../php/crud/lotes/eliminar_lote.php",
       data:cadena,
       success:function(r){
         $('#tab_lotes').load('../php/componentes/componentes_lotes/tab_lotes.php');
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



$(document).ready(function(){
  $('#tab_lotes').load('../php/componentes/componentes_lotes/tab_lotes.php');
  $('#calculadora').load('../php/componentes/calculadora/calculadora.php');
  $('#menu').load('../php/componentes/menu/menu.php');
  $('#date-hour').load('../php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
  jQuery('#ver2').hide();
  $('#TUniMedida').change(function(){
    recargarlista();      
  });
  medida();

  $('#med_lot').keydown(function(){
    $('#div_med_lot').addClass("input-group input-group-alternative");
  });

  $('#med_lotup').keydown(function(){
    $('#div_med_lotup').addClass("input-group input-group-alternative");
  });

  
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

});


function cargar_select(){
  $('#TUniMedida').val(1);
  recargarlista();  
}
var medfin=0;
function recargarlista(){
  cod_tum=$('#TUniMedida').val();
  $.ajax({
    type:"post",
    url:"../php/componentes/componentes_lotes/unidad_med.php",
    data:"uni_med="+cod_tum,
    success:function(r){
      $('#select2').html(r);
    }
  });
}

function medida(){
  cod_fin=$('#nom_fin').val();
  $.ajax({
    type:"post",
    url:"../php/componentes/componentes_lotes/medida_finca.php",
    data:"cod_fin="+cod_fin,
    success:function(r){
      area_free=r;
      $.ajax({
        type:"post",
        url:"../php/componentes/componentes_lotes/notificacion.php",
        data:"medida="+area_free+"&cod_fin="+cod_fin,
        success:function(r){
          $('#notificacion').html(r);
        }
      });

    }
  });

}

function medidaup(){
  cod_finup=$('#nom_finup').val();
  cod_lot=$('#cod_lot').val();
  $.ajax({
    type:"post",
    url:"../php/componentes/componentes_lotes/medida_fincaup.php",
    data:"cod_fin="+cod_finup+"&cod_lot="+cod_lot,
    success:function(r){
      area_free=r;
      $.ajax({
        type:"post",
        url:"../php/componentes/componentes_lotes/notificacionup.php",
        data:"medida="+area_free+"&cod_fin="+cod_finup,
        success:function(r){
          $('#notificacionup').html(r);
        }
      });

    }
  });

}

    //boton flotante
    $('.botonF1').hover(function(){
      $('.flotante').addClass('animacionVer');
    })
    $('.contenedor').mouseleave(function(){
      $('.flotante').removeClass('animacionVer');
    })

    function cerrar_menu(){
      $('#sidenav-main').remove();
      jQuery('#ver1').hide();
      jQuery('#ver2').show();
    }



