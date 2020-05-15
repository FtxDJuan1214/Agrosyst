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

 //  toastr.info('Por favor, mientras ingrese los productos de la compra no recargue la pagina','',{
 //   "positionClass": "toast-bottom-right",
 //   "closeButton": true,
 //   "progressBar":true
 // });
  jQuery('#ver2').hide();
  $('#date-hour').load('../php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
  $('#menu').load('../php/componentes/menu/menu.php');

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