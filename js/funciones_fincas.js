 function preloader(){

   jQuery('#preloader').show();
   jQuery('#form-add-finca').hide();

   setTimeout ("crear_finca();", 1000);
 }

 function crear_finca(){
  var datos=new FormData($("#form-add-finca")[0]);
  $.ajax({
   type:"post",
   url:"php/crud/fincas/crear_finca.php",
   data:datos,
   contentType: false,
   processData: false,
   success:function(r){
    if(r=='Resource id #4' || r=='Resource id #6'){
     var form = document.querySelector('#form-add-finca');
     form.reset();
     jQuery('#preloader').hide();
     jQuery('#form-add-finca').show();
     $('#modal-form').modal('hide');

     cod_fin=$('#cod_fin').val();
     nom_fin=$('#nom_fin').val();
     det_fin=$('#det_fin').val();
     due_fin=$('#due_fin').val();
     dep_fin=$('#dep_fin').val();
     mun_dep=$('#mun_dep').val();
     uni_med=$('#uni_med').val();
     med_fin=$('#med_fin').val();

     cadena='cod_fin='+ cod_fin+
     '&nom_fin='+ nom_fin +
     '&det_fin='+ det_fin +
     '&due_fin='+ due_fin +
     '&dep_fin='+ dep_fin +
     '&mun_dep='+ mun_dep +
     '&uni_med='+ uni_med +
     '&med_fin='+ med_fin;
     $.ajax({

       type:"post",
       url:"php/crud/fincas/enviar_cod.php",
       data:cadena,
     })
     $.ajax({
       type:"post",
       url:"finca_actual.php",
       data:cadena,
     });
     swal("Finca agregada!"," ", "success");
     jQuery('#preloader').hide();
     jQuery('#form-add-finca').show();
     location.href="home.php";
   }else{
    alert(r);
  }
}
});
}


function preloaderup(){
  jQuery('#preloaderup').show();
  jQuery('#form-up-fin').hide();
  setTimeout ("actualizar_finca();", 1000);  
}



function actualizar_finca(){
  var datos=new FormData($("#form-up-fin")[0]);
  $.ajax({
    type:"post",
    url:"php/crud/fincas/actualizar_finca.php",
    data:datos,
    contentType: false,
    processData: false,
    success:function(r){
      $('#result').val(r);
      e=$('#result').val();
      if(e=='Resource id #4' || e=='Resource id #6' || e=='Resource id #7'){
        swal("¡Finca Editada!"," ", "success");
        var form = document.querySelector('#form-up-fin');
        form.reset();
        window.location="home.php"; 
        
      }else{
        alert(r); 
        $('#modal-form-ed').modal('hide'); 
        jQuery('#preloaderup').hide();
        jQuery('#form-up-fin').show();     
      }
    }
  });
}

function llenarform(datos){
  data=datos.split('||');
  cod=data[0].split('-');
  $('#cod_ver').val(cod[1]);


  $('#fin_cod_up').val(data[0]);
  $('#nom_finup').val(data[1]);
  $('#det_finup').val(data[2]);
  $('#dep_finup').val(parseInt(data[3]));
  $('#mun_fin_up').val(parseInt(data[5]));
  $('#uni_medup').val(parseInt(data[8]));
  $('#ide_ter_up').val((data[10].trim()));
  $('#med_finup').val(parseFloat(data[7]));
  $('#nom_fot').val(data[15]);
}
