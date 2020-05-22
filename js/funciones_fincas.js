 function preloader(){

  cod_fin=$('#cod_fin').val();
  nom_fin=$('#nom_fin').val();
  det_fin=$('#det_fin').val().replace(/(\r\n|\n|\r)/gm," "); 
  due_fin=$('#due_fin').val();
  dep_fin=$('#dep_fin').val();
  mun_dep=$('#mun_dep').val();
  uni_med=$('#uni_med').val();
  med_fin=$('#med_fin').val();

  if(nom_fin == "" || det_fin == "" || due_fin== null || dep_fin == null || mun_dep == null || ide_ter == null || uni_med == null || med_fin == ""){
   toastr.error('Algunos campos están incompletos','',{
     "positionClass": "toast-top-center",
     "closeButton": true,
     "progressBar":true
   });
 }else{
  bien = true;
  if (isNaN(med_fin)){
    $('#div_med_fin').removeClass("input-group input-group-alternative");
    toastr.error('El tamaño de la finca debe ser númerico.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    bien = false;
  }else if (parseFloat(med_fin) == 0){

    $('#div_med_fin').removeClass("input-group input-group-alternative");
    toastr.error('El tamaño de la finca no puede ser cero.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    bien = false;
  }

  if(nom_fin.length <5){
    $('#div_nom_fin').removeClass("input-group input-group-alternative");
    toastr.error('El nombre es muy corto.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    })
    bien = false;
  }else if(det_fin.length <10){
   $('#div_det_fin').removeClass("input-group input-group-alternative");
   toastr.error('La descripción es muy corta.','',{
    "positionClass": "toast-top-center",
    "closeButton": true,
    "progressBar":true
  })
   bien = false;
 }

 if(bien == true){
  jQuery('#preloader').show();
  jQuery('#form-add-finca').hide();
  setTimeout ("crear_finca(cod_fin,nom_fin,det_fin,due_fin,dep_fin,mun_dep,uni_med,med_fin);", 1000);
}
}



}

function crear_finca(cod_fin,nom_fin,det_fin,due_fin,dep_fin,mun_dep,uni_med,med_fin){
  var datos=new FormData($("#form-add-finca")[0]);
  $.ajax({
   type:"post",
   url:"php/crud/fincas/crear_finca.php",
   data:datos,
   contentType: false,
   processData: false,
   success:function(r){
     //alert("erre: " +r);
     if(r.includes('Resource id')){
       var form = document.querySelector('#form-add-finca');
       form.reset();
       jQuery('#preloader').hide();
       jQuery('#form-add-finca').show();
       $('#modal-form').modal('hide');

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

  nom_finup = $('#nom_finup').val(); 
  det_finup = $('#det_finup').val().replace(/(\r\n|\n|\r)/gm," ");  
  due_finup = $('#ide_ter_up').val(); 
  dep_finup = $('#dep_finup').val(); 
  mun_fin_up = $('#mun_fin_up').val(); 
  ide_ter_up = $('#ide_ter_up').val(); 
  uni_medup = $('#uni_medup').val(); 
  med_finup = $('#med_finup').val(); 

  if(nom_finup == "" || det_finup == "" || due_finup== null ||  dep_finup == null || mun_fin_up == null || ide_ter_up == null || uni_medup == null || med_finup == ""){
   toastr.error('Algunos campos están incompletos','',{
     "positionClass": "toast-top-center",
     "closeButton": true,
     "progressBar":true
   });
 }else{
  bien = true;
  if (isNaN(med_finup)){
    $('#div_med_finup').removeClass("input-group input-group-alternative");
    toastr.error('El tamaño de la finca debe ser númerico.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    bien = false;
  }else if (parseFloat(med_finup) == 0){

    $('#div_med_finup').removeClass("input-group input-group-alternative");
    toastr.error('El tamaño de la finca no puede ser cero.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    bien = false;
  }

  if(nom_finup.length <5){
    $('#div_nom_finup').removeClass("input-group input-group-alternative");
    toastr.error('El nombre es muy corto.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    })
    bien = false;
  }else if(det_finup.length <10){
   $('#div_det_finup').removeClass("input-group input-group-alternative");
   toastr.error('La descripción es muy corta.','',{
    "positionClass": "toast-top-center",
    "closeButton": true,
    "progressBar":true
  })
   bien = false;
 }

 if(bien == true){
  
  jQuery('#preloaderup').show();
  jQuery('#form-up-fin').hide();
  setTimeout ("actualizar_finca();", 1000);  
}
}

}



function actualizar_finca(){
  var datos=new FormData($("#form-up-fin")[0]);
  $.ajax({
    type:"post",
    url:"php/crud/fincas/actualizar_finca.php",
    data:datos,
    contentType: false,
    processData: false,
    success:function(e){
      r=e.trim();
      if(r.includes('Resource id')){
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


$(document).ready(function(){
  $('#date-hour').load('php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('php/componentes/menu/actions-sm-scr.php');
  jQuery('#ver2').hide();

  $('#med_finup').keydown(function(){
    $('#div_med_finup').addClass("input-group input-group-alternative");
  });
  $('#nom_finup').keydown(function(){
    $('#div_nom_finup').addClass("input-group-alternative");
  });
  $('#det_finup').keydown(function(){
    $('#div_det_finup').addClass("input-group input-group-alternative");
  });

  $('#nom_fin').keydown(function(){
    $('#div_nom_fin').addClass("input-group input-group-alternative");
  });
  $('#det_fin').keydown(function(){
    $('#div_det_fin').addClass("input-group-alternative");
  });
  $('#med_fin').keydown(function(){
    $('#div_med_fin').addClass("input-group input-group-alternative");
  });

});


function cerrar_menu(){
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}