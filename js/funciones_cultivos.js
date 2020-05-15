function n_cul(){
  var form = document.querySelector('#form-nom-cultivo');
  form.reset();
  jQuery('#btn_actualizar').hide();
  jQuery('#btn_guardar').show();
}
function agregar_nom_cul(){
  nomb_cultivo=$('#nomb_cultivo').val();
  if (nomb_cultivo != "") {
    if (nomb_cultivo.length > 3 ) {
      $.ajax({
        type:"post",
        url:"../php/crud/cultivos/add_nom_cul.php",
        data:"nomb_cultivo="+nomb_cultivo,
        success:function(r){
          if(r.includes('Resource id')){
            var form = document.querySelector('#form-nom-cultivo');
            form.reset();
            $('#nombre_cultivo').load('../php/componentes/componentes_cultivos/nom_cul.php');
            $('#nombre_cultivo2').load('../php/componentes/componentes_cultivos/nom_cul_up.php');
            $('#cultivos').load('../php/componentes/componentes_cultivos/sub_tab_cultivos.php');
          }
        }
      });
    }else{
      toastr.error('El nombre debe tener al menos cuatro letras.','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }
  }else{
    toastr.error('El campo ed nombre no puede estar vacio.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
  }
}
var codigo_cul=0;
function editar_nom_cul(datos){
  data= datos.split('||');
  codigo_cul=data[0];
  nombre = data[1].split('-');
  nomb_cultivo=$('#nomb_cultivo').val(nombre[1]);
  jQuery('#btn_actualizar').show();
  jQuery('#btn_guardar').hide();
}

function actualizar_nom_cul(){
  nomb_cultivo=$('#nomb_cultivo').val();
  $.ajax({
    type:"post",
    url:"../php/crud/cultivos/up_nom_cul.php",
    data:"nomb_cultivo="+nomb_cultivo+"&cod_cul="+codigo_cul,
    success:function(r){
      if(r.includes('Resource id')){
        var form = document.querySelector('#form-nom-cultivo');
        form.reset();
        jQuery('#btn_actualizar').hide();
        jQuery('#btn_guardar').show();
        $('#nombre_cultivo').load('../php/componentes/componentes_cultivos/nom_cul.php');
        $('#nombre_cultivo2').load('../php/componentes/componentes_cultivos/nom_cul_up.php');
        $('#cultivos').load('../php/componentes/componentes_cultivos/sub_tab_cultivos.php');
      }
    }
  });
}

function eliminar_nom_cul(cod_ncu){
  swal({
    title: "Estas seguro?",
    text: "Deseas eliminar este cultivo?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:"post",
        url:"../php/crud/cultivos/del_nom_cul.php",
        data:"cod_ncu="+cod_ncu,
        success:function(r){
          if(r.includes('Resource id')){
            swal("se elimino!", {
              icon: "success",
            });
            $('#nombre_cultivo').load('../php/componentes/componentes_cultivos/nom_cul.php');
            $('#nombre_cultivo2').load('../php/componentes/componentes_cultivos/nom_cul_up.php');
            $('#cultivos').load('../php/componentes/componentes_cultivos/sub_tab_cultivos.php');
          }else{
            toastr.error('Este cultivo esta siendo utilizado y no se puede borrar.','',{
              "positionClass": "toast-top-center",
              "closeButton": true,
              "progressBar":true
            });
          }
        }
      });

    } else {
      swal("Cancelado!");
    }
  });
}
//-----------------------------------------------------------------------------------------------------------------------------------

var total_dias_up=0;
function preloader(){

  intervaloa();

  fin_cul=$('#fin_cul').val();
  fif_cul=$('#fif_cul').val();
  npl_cul=$('#npl_cul').val();
  tip_cul=$('#tip_cul').val();
  dur_cul=$('#dur_cul').val();
  est_cul=$('#est_cul').val();
  nom_cul=$('#nom_cul').val();
  cod_lot=$('#cod_lot').val();
  mod_cul=$('#mod_cul').val();
  dia_cul=total_dias;

  if(fin_cul == "" || fif_cul == "" || npl_cul == "" || tip_cul == null || dur_cul == "" || est_cul == null || nom_cul == null || cod_lot == null || mod_cul == null || dia_cul == ""){
    toastr.error('Todos los campos son requeridos.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
  }else{

    var fechaInicio = new Date(fin_cul.trim()).getTime();
    var fechaFin    = new Date(fif_cul.trim()).getTime();

    if(fif_cul == fin_cul){
      toastr.error('La fechas de duración del cultivo no pueden ser las mismas.','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }else if(parseFloat(fechaInicio) > parseFloat(fechaFin)){

      toastr.error('La fecha de finalización no puede ser anterior a la inicial','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
      bien = false;
    }else{

      if (isNaN(npl_cul)){
        $('#div_npl_cul').removeClass("input-group input-group-alternative");
        toastr.error('El campo para el número de plantas solo puede contener números.','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });

      }else if (parseFloat(npl_cul) == 0){
        $('#div_npl_cul').removeClass("input-group input-group-alternative");
        toastr.error('El número de plantas no puede ser cero.','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });

      }else {
        $('#div_npl_cul').addClass("input-group input-group-alternative");
        jQuery('#preloader').show();
        jQuery('#form-add-cultivo').hide();
        setTimeout ("agregar_cultivo(fin_cul,fif_cul,npl_cul,tip_cul,dur_cul,est_cul,nom_cul,cod_lot,dia_cul,mod_cul);", 1000);
      }

    }

  }


}

function agregar_cultivo(fin_cul,fif_cul,npl_cul,tip_cul,dur_cul,est_cul,nom_cul,cod_lot,dia_cul,mod_cul){
  cadena ="fin_cul="+fin_cul+
  "&fif_cul="+fif_cul+
  "&npl_cul="+npl_cul+
  "&tip_cul="+tip_cul+
  "&dur_cul="+dur_cul+
  "&est_cul="+est_cul+
  "&nom_cul="+nom_cul+
  "&cod_lot="+cod_lot+
  "&mod_cul="+mod_cul+
  "&dia_cul="+dia_cul;
  console.log("Días del cultivo: " + dia_cul);
  $.ajax({
    type:"post",
    url:"../php/crud/cultivos/crear_cultivos.php",
    data:cadena,
    success:function(r){
        //alert(r);
        if(r.includes('Resource id')){
          var form = document.querySelector('#form-add-cultivo');
          form.reset();
          jQuery('#preloader').hide();
          jQuery('#form-add-cultivo').show();
          $('#modal-form').modal('hide');
          swal("Cultivo agregado!"," ", "success");

         //--------------------saber el id agregado-------------------------------------------------------------
         $.ajax({
          type:"post",
          url:"../php/componentes/componentes_cultivos/cod_cultivo.php",
          data:"fecha="+cod_lot,
          success:function(r){
            cod_cul=parseFloat(r);
            //alert(cod_cul);
            $('#modal-socios').modal('toggle');
            var form = document.querySelector('#form-crud_soc');
            form.reset();
            table_socios(cod_cul);
          }
        });


         $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');
       }else{
        jQuery('#preloader').hide();
        jQuery('#form-add-cultivo').show();
        toastr.error('No se pudo crear el cultiv.','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });
        $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');        
      }
    }
  });
}

function llenarform (datos){ 
  $('#modal-form-up').modal('toggle');
  abrir_editar = true;
  var form = document.querySelector('#form-up-cultivo');
  form.reset();
  data = datos.split('||');
  cod_cul=data[0];
  total_dias_up=data[3];
  $('#nom_cul_up').val(parseFloat(data[8]));
  $.ajax({
    type:"post",
    url:"../php/componentes/componentes_cultivos/fecha1.php",
    data:"fecha="+data[1],
    success:function(r){
      $('#fecha1').html(r);
    }
  });
  $.ajax({
    type:"post",
    url:"../php/componentes/componentes_cultivos/fecha2.php",
    data:"fecha="+data[2],
    success:function(r){
      $('#fecha2').html(r);
    }
  });
  $('#dur_cul_up').val(data[6]);
  $('#npl_cul_up').val(data[4]);
  $('#est_cul_up').val(parseFloat(data[7]));
  $('#tip_cul_up').val(parseFloat(data[5]));
  $('#cod_lot_up').val(parseFloat(data[10]));
  $('#mod_cul_up').val(parseFloat(data[12]));
}


function preloaderup(){

  fin_cul=$('#fin_cul_up').val();
  fif_cul=$('#fif_cul_up').val();
  npl_cul=$('#npl_cul_up').val();
  tip_cul=$('#tip_cul_up').val();
  dur_cul=$('#dur_cul_up').val();
  est_cul=$('#est_cul_up').val();
  nom_cul=$('#nom_cul_up').val();
  cod_lot=$('#cod_lot_up').val();
  mod_cul=$('#mod_cul_up').val();
  if (total_dias==0) {
    dia_cul=total_dias_up;
  }
  else{
    dia_cul=total_dias;
  }

  if(fin_cul == "" || fif_cul == "" || npl_cul == "" || tip_cul == null || dur_cul == "" || est_cul == null || nom_cul == null || cod_lot == null || mod_cul == null || dia_cul == ""){
    toastr.error('Todos los campos son requeridos.','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
  }else{

    if(fif_cul == fin_cul){
      toastr.error('La fechas de duración del cultivo no pueden ser las mismas.','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }else{

      if (isNaN(npl_cul)){
        $('#div_npl_cul_up').removeClass("input-group input-group-alternative");
        toastr.error('El campo para el número de plantas solo puede contener números.','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });

      }else if (parseFloat(npl_cul) == 0){
        $('#div_npl_cul_up').removeClass("input-group input-group-alternative");
        toastr.error('El número de plantas no puede ser cero.','',{
          "positionClass": "toast-top-center",
          "closeButton": true,
          "progressBar":true
        });

      }else {
        $('#div_npl_cul_up').addClass("input-group input-group-alternative");
        jQuery('#preloaderup').show();
        jQuery('#form-up-cultivo').hide();
        jQuery('#preloader').hide();
        jQuery('#form-add-cultivo').show();
        setTimeout ("actualizar_cultivo(cod_cul,fin_cul,fif_cul,npl_cul,tip_cul,dur_cul,est_cul,nom_cul,cod_lot,dia_cul,mod_cul);", 1000);  
      }

    }

  }
  
}

function actualizar_cultivo(cod_cul,fin_cul,fif_cul,npl_cul,tip_cul,dur_cul,est_cul,nom_cul,cod_lot,dia_cul,mod_cul){
  cadena ="cod_cul="+cod_cul+
  "&fin_cul="+fin_cul+
  "&fif_cul="+fif_cul+
  "&npl_cul="+npl_cul+
  "&tip_cul="+tip_cul+
  "&dur_cul="+dur_cul+
  "&est_cul="+est_cul+
  "&nom_cul="+nom_cul+
  "&cod_lot="+cod_lot+
  "&mod_cul="+mod_cul+
  "&dia_cul="+dia_cul;
  $.ajax({
    type:"post",
    url:"../php/crud/cultivos/actualizar_cultivos.php",
    data:cadena,
    success:function(r){
      if(r.includes('Resource id')){
        var form = document.querySelector('#form-up-cultivo');
        form.reset();
        jQuery('#preloaderup').hide();
        jQuery('#form-up-cultivo').show();
        $('#modal-form-up').modal('hide');
        swal("Cultivo Editado!"," ", "success");
        $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');

      }else{
        //alert(r); 
        jQuery('#preloaderup').hide();
        jQuery('#form-up-cultivo').show();
        $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');        
      }
    }
  });
}


function eliminar_cultivo(cod_cul){
  swal({
    title: "Estas seguro?",
    text: "Deseas eliminar este cultivo?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        type:"post",
        url:"../php/crud/cultivos/confrim_del.php",
        data:"cod_cul="+cod_cul,
        success:function(r){
          if (r.trim()=="") {

            $.ajax({
              type:"post",
              url:"../php/crud/cultivos/eliminar_cultivo.php",
              data:"cod_cul="+parseFloat(cod_cul),
              success:function(r){
                if(r.includes('Resource id')){
                  $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');    
                  swal("El cultivo elimino!", { 
                    icon: "success",
                  });
                }else{
                  toastr.error('Este cultivo esta siendo utilizado y no se puede borrar, o los socios tiene compras registradas.','',{
                    "positionClass": "toast-top-center",
                    "closeButton": true,
                    "progressBar":true
                  });
                }
              }
            });

          }else{
            swal(r, {
              icon: "info",
            });
          }
        }
      });

    } else {
      swal("Cancelado!");
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

function crud_socios(){
  $('#modal-socios').modal('toggle');
  $('#modal-form-up').modal('hide');
  var form = document.querySelector('#form-crud_soc');
  form.reset();
  
  table_socios(cod_cul);
}

function table_socios(codi_cul){
  ajax = objetoAjax();
  ajax.open("POST","../php/componentes/componentes_cultivos/socios/tabla_socios.php", true);
  ajax.onreadystatechange=function(){
    if ( ajax.readyState==4 ) {
      document.getElementById("tabla_socios").innerHTML=ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("cod_cul="+codi_cul);
}


function guardar_soc(){
  cod_ter_soc=$('#cod_ter_soc').val();
  if (cod_ter_soc!= null) {
    $.ajax({
      type:"post",
      url:"../php/crud/cultivos/add_socio.php",
      data:"cod_cul="+cod_cul+"&cod_ter_soc="+cod_ter_soc,
      success:function(r){
        if(r.includes('Resource id')){
          table_socios(cod_cul);
          $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');
          var form = document.querySelector('#form-crud_soc');
          form.reset();
        }else{
          toastr.error('Puede que el socio ya este agregado al cultivo','',{
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar":true
          });
        }
      }
    });
  }
}

function eliminar_socio(ide_ter){
  // alert(ide_ter);
  // alert(cod_cul);
  $.ajax({
    type:"post",
    url:"../php/crud/cultivos/del_socio.php",
    data:"ide_ter="+ide_ter.trim()+"&cod_cul="+cod_cul,
    success:function(r){
      if(r.includes('Resource id')){
       table_socios(cod_cul);
       $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');
     }else{
      toastr.warning('',r,{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });
    }
  }
});
}
//-----------------------------------------------------------------------------------------------------------------------------------

abrir_editar = false;

$(document).ready(function(){
 $('#tab_cultivos').load('../php/componentes/componentes_cultivos/tab_cultivos.php');
 $('#date-hour').load('../php/componentes/menu/date-hour.php');
 $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
 $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
 $('#nombre_cultivo').load('../php/componentes/componentes_cultivos/nom_cul.php');
 $('#nombre_cultivo2').load('../php/componentes/componentes_cultivos/nom_cul_up.php');
 $('#cultivos').load('../php/componentes/componentes_cultivos/sub_tab_cultivos.php');
 $('#menu').load('../php/componentes/menu/menu.php');
 jQuery('#btn_actualizar').hide();
 $('#fif_cul').blur(function() {setTimeout("intervaloa();",100)});
 $('#fin_cul').blur(function() {setTimeout("intervaloa();",100)});
 jQuery('#ver2').hide();
});

$('#npl_cul').keydown(function(){
  $('#div_npl_cul').addClass("input-group input-group-alternative");
});

$('#npl_cul_up').keydown(function(){
  $('#div_npl_cul_up').addClass("input-group input-group-alternative");
});



$('#modal-socios').on('hidden.bs.modal', function (e) {
  if(abrir_editar == true){
   $('#modal-form-up').modal('toggle'); 
 }
})


$('#modal-form-up').on('hidden.bs.modal', function (e) {
  abrir_editar == false;
})

last_modal = "";

$('#modal-form-up').on('show.bs.modal', function (e) {
  last_modal = "#modal-form-up";
})

$('#modal-form').on('show.bs.modal', function (e) {
  last_modal = "#modal-form";
})

$('#modal-cultivos').on('show.bs.modal', function (e) {
  $('#modal-form-up').modal('hide'); 
  $('#modal-form').modal('hide'); 
})


$('#modal-cultivos').on('hidden.bs.modal', function (e) {
  $(last_modal).modal('toggle'); 
})

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


var total_dias=0;

function intervaloa(){
  fin_cul=$('#fin_cul').val();
  fif_cul=$('#fif_cul').val();
  cadena="fin_cul="+fin_cul+"&fif_cul="+fif_cul;
  $.ajax({
   type:"post",
   url:"../php/componentes/componentes_cultivos/duracion_cul.php",
   data:cadena,
   success:function(r){
    tiempo = r.split("||");
    $('#dur_cul').val(tiempo[0]+' años '+tiempo[1]+' meses '+tiempo[2]+' dias');
    total_dias=parseFloat(tiempo[3]);
    dias_actuales = parseFloat(tiempo[4]);
    anios=parseFloat(tiempo[0]);
    $('#borrar').text("dias: " + total_dias + "dias hoy: " + dias_actuales);
    if (tiempo[0] < 1) {

      $('#tip_cul').val(1);

    } else if ((tiempo[0] = 1)){

      if (( tiempo[1] >= 0) && ( tiempo[2] > 0)) {

       $('#tip_cul').val(2);

     } else if (( tiempo[1] = 0) && ( tiempo[2] = 0)){
      $('#tip_cul').val(1);
    }

  } 
  if (anios >=2) {
   $('#tip_cul').val(2);
 }

 if (dias_actuales > 0 && dias_actuales != total_dias) {

  if(dias_actuales > 0 && dias_actuales <= 3){
    $('#est_cul').val(1);
  }else if(dias_actuales > 3 && dias_actuales <=210){
    $('#est_cul').val(2);
  }else if (dias_actuales > 210 && dias_actuales <= 240) {
    $('#est_cul').val(3);
  }else if (dias_actuales > 240 && dias_actuales <= 300) {
    $('#est_cul').val(4);
  }else if (dias_actuales > 300 && dias_actuales <= 365) {
    $('#est_cul').val(5);
  }else if (dias_actuales > 365 && dias_actuales < total_dias) {
    $('#est_cul').val(6);
  }
}else if(dias_actuales > 0 && dias_actuales == total_dias){
 $('#est_cul').val(7);
}

}
})
}

$("#myInput").on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $("#myTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
  });
});

function cerrar_menu(){
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}