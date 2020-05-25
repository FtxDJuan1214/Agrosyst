function hallar_can_y_pre(){
 $('#modal-paso_1').modal('hide');
 setTimeout("$('#modal-paso_2').modal('toggle');", 200);
}


function habilitar_inpts(){
  swal("Siguiente","Ingresa la cantidad y el costo unitario en los campos correspondientes.", "info");
  $('#modal-paso_1').modal('hide');
  $('#modal-paso_2').modal('hide');

  

  $("#can_sto").prop("readonly", false);
  $("#cos_uni").prop("readonly", false);
  $('#can_sto').prop("disabled", false); // Element(s) are now enabled.
  $('#cos_uni').prop("disabled", false); // Element(s) are now enabled.

  $("#can_sto").css("border-color", "#fb6340");
  $("#cos_uni").css("border-color", "#fb6340");
}



function subir_datos(){

  pass_cantidad = $('#pass_cantidad').val();
  pass_presentación = $('#pass_presentación').val();
  pass_costo = $('#pass_costo').val();

  if (pass_cantidad == "" || parseFloat(pass_cantidad) == 0) {

    toastr.error('La cantidad ingresada no es valida.','',{
     "positionClass": "toast-top-center",
     "closeButton": true,
     "progressBar":true
   });

  }else if (pass_presentación == "" || parseFloat(pass_presentación) == 0) {

    toastr.error('La presentación ingresada no es valida.','',{
     "positionClass": "toast-top-center",
     "closeButton": true,
     "progressBar":true
   });

  }else if (pass_costo == "" || parseFloat(pass_costo) == 0) {

    toastr.error('El costo ingresado no es valido.','',{
     "positionClass": "toast-top-center",
     "closeButton": true,
     "progressBar":true
   });

  }else{

    cantidad_total_uni = (pass_cantidad * pass_presentación);
    cos_total_pres = (pass_cantidad * pass_costo);

    cod_unit_uni = (cos_total_pres/cantidad_total_uni);

   $('#can_sto').prop("disabled", false); // Element(s) are now enabled.
   $('#cos_uni').prop("disabled", false); // Element(s) are now enabled.
   // $('#cos_mul').prop("disabled", false); // Element(s) are now enabled.
   // alert("Hols");
   can_sto = $('#can_sto').val(parseInt(cantidad_total_uni));
   cos_uni = $('#cos_uni').val(parseInt(cod_unit_uni));
   cos_mul = $('#cos_mul').val(parseInt(cos_total_pres));

   $('#modal-paso_2').modal('hide');


   var form = document.querySelector('#form-pasos');
   form.reset();
   habilitar();
 }

}

function comprar(){
  num_fact=$('#num_fact').val();
  if(num_fact != ""){
    factura=num_fact.split(':');
  }
  num_fact=factura[1];
  fec_con=$('#date').val();
  hor_com=$('#time').val();
  proveedor=$('#proveedor').val();
  comprador=$('#cod_ter_soc').val();
  cos_tot=$('#cos_tot').val();
  productos=$('#informacion').val();
  cultivo=$('#cod_cul').val();

  cadena="num_fact="+ num_fact +
  "&fec_con="+ fec_con +
  "&hor_com="+ hor_com +
  "&proveedor="+ proveedor +
  "&comprador="+ comprador+
  "&cos_tot="+ cos_tot;
    // alert(cadena);

    if(num_fact == "" || fec_con == "" || hor_com == "" || proveedor == null
     || comprador == null || cos_tot == "" || productos == "" || cultivo == null){

      toastr.error('Algunos campos están incompletos','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });

  }else{
    $.ajax({
      type:"post",
      url:"../php/crud/compras/crear_compras.php",
      data:cadena,
      success:function(r){
        if(r.includes('Resource id')){
          //alert("Crear compras:" + r);
          //Insertar el comprador y el vendedor
          $.ajax({
            type:"post",
            url:"../php/crud/compras/crear_comprar.php",
            data:cadena,
            success:function(r){
             //alert("Crear comprar:" + r);
           }
         });


           //Llenar en el stock
           arreglo=$('#informacion').val();

           insumos=arreglo.split('+');
           for (i=0; i< ((insumos.length)-1);i++) {


             productos=insumos[i].split(',');

             cantiad=parseInt(productos[2]);
             insumo=parseInt(productos[1]);
             precio=parseInt(productos[3]);

             datos="num_fact="+ num_fact +
             "&fec_con="+ fec_con +
             "&hor_com="+ hor_com +
             "&insumo="+ insumo +
             "&socio="+ comprador +
             "&cantiad="+ cantiad +
             "&precio="+ precio;

             // alert(datos);

             $.ajax({
               type:"post",
               url:"../php/crud/compras/llenar_stock.php",
               data:datos,
               success:function(r){
                 //alert("Llenar stock:\n" + r);
               }
             });

             swal("Compra realizada!"," ", "success");
             window.location="compras.php";
           }
         }
       }
     })
  }
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
  ajax2 = objetoAjax();
  ajax2.open("POST","../php/componentes/componentes_compras/opc_socios.php", true);
  ajax2.onreadystatechange=function(){
    if ( ajax2.readyState==4 ) {
      document.getElementById("soc_opc").innerHTML=ajax2.responseText;
    }
  }
  ajax2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax2.send("cod_cul="+cultivo);
}


$(document).ready(function(){


  cargar_aportes();

  $('#can_sto').keydown(function(){
    $("#can_sto").css("border-color", "#cad1d7");
  });
  $('#cos_uni').keydown(function(){
    $("#cos_uni").css("border-color", "#cad1d7");
  });

  jQuery('#ver2').hide();
  $('#date-hour').load('../php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
  $('#menu').load('../php/componentes/menu/menu.php');
  
  $('#calculadora').load('../php/componentes/calculadora/calculadora.php');

  $('#cos_uni').keyup(function(){

    can_sto=parseInt($('#can_sto').val());
    cos_uni=parseInt($('#cos_uni').val());
    if($('#can_sto').val() != ""){
      total=((can_sto)*(cos_uni));
      $('#cos_mul').val(total);
      habilitar();
    }
  });
  $('#can_sto').keyup(function(){

    can_sto=parseInt($('#can_sto').val());
    cos_uni=parseInt($('#cos_uni').val());
    if($('#cos_uni').val() != ""){
      total=((can_sto)*(cos_uni));
      $('#cos_mul').val(total);
      habilitar();
    }
  });

  $('#tip_ins').change(function(){
   document.getElementById("tempo").style.display = "none";
   escoger_insumo();     
 });

  $('#cod_cul').change(function(){
    cargar_socios();
    cargar_aportes();
    document.getElementById("aportes_chart").innerHTML="";
  });

  $('#socio').change(function(){
  });
});


function escoger_insumo(){
  tip_ins=$('#tip_ins').val();
  $.ajax({
    type:"post",
    url:"../php/componentes/componentes_compras/tipo_insumo.php",
    data:"tip_ins="+tip_ins,
    success:function(r){
     document.getElementById("ins_esc").style = "";
     $('#ins_esc').html(r);
   }
 });
}



function cerrar_menu(){
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}


function cargar_aportes(){
  if ($('#cod_cul').val() != null) {
   ajax = objetoAjax();
   ajax.open("POST","../php/componentes/aportes/aporte_socios.php", true);
   ajax.onreadystatechange=function(){
    if ( ajax.readyState==4 ) {
      document.getElementById("aportes_chart").innerHTML=ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("cod_cul="+$('#cod_cul').val()+ "&nom_cul=" + $("#cod_cul option:selected").text());
}
}

function habilitar(){
  cost = $('#cos_mul').val();
  if (!isNaN(cost) && cost != '0') {
   $('#cargar').removeAttr("disabled" );
   $('#cargar').addClass( "btn-default");
   $('#cargar').removeClass('btn-danger');
 }else{

  $('#cargar').removeClass( "btn-default" );
  $('#cargar').addClass('btn-danger');

  $("#cargar").attr("disabled", true);
}
}


function validar(){

   $('#can_sto').prop("disabled", true); // Element(s) are now enabled.
  $('#cos_uni').prop("disabled", true); // Element(s) are now enabled.

  num_fact = $('#num_fact').val();
  date = $('#date').val();
  time = $('#time').val();
  cod_cul = $('#cod_cul').val();
  cod_ter_soc = $('#cod_ter_soc').val();
  proveedor = $('#proveedor').val();
  ins_esc = $('#ins_esc').val();
  cod_ins = $('#cod_ins').val();



  if(num_fact = "" || date == "" || time == "" || cod_cul == null || cod_ter_soc == null || proveedor == null || cod_ins == null){

    if(num_fact == ""){
     toastr.error('El número de factura no es valido','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }else  if(date == ""){
     toastr.error('Por favor ingresa una fecha','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }else  if(time == ""){
     toastr.error('Ingrese una hora','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }else  if(cod_cul == null){
     toastr.error('Antes de continuar, seleccione un cultivo.','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }else  if(cod_ter_soc == null){
     toastr.error('Antes de continuar, seleccione el socio que pagará esta compra.','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }else  if(proveedor == null){
     toastr.error('Antes de continuar, seleccione el proveedor que le venderá.','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }else  if(cod_ins == null){
     toastr.error('Antes de continuar, seleccione el  tipo y el insumo que va a agregar a la compra.','',{
       "positionClass": "toast-top-center",
       "closeButton": true,
       "progressBar":true
     });
   }

 }else{
  $('#modal-paso_1').modal('toggle');
}
}

  //boton flotante
  $('.botonF1').hover(function(){
    $('.flotante').addClass('animacionVer');
  })
  $('.contenedor').mouseleave(function(){
    $('.flotante').removeClass('animacionVer');
  })