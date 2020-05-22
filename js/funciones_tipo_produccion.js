function preloader(){
  
  des_tpr=$('#des_tpr').val();
  cod_unm=$('#cod_unm').val();
  if (des_tpr== "" || cod_unm == null) {
    if(des_tpr==""){
      toastr.error('Por favor ingrese el nombre del tipo de producción','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    }else if ( cod_unm == null) {
      toastr.error('Por favor seleccione la unidad de medida','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    }
  }else{

    if (des_tpr.length < 4) {

      $('#div_des_tpr').removeClass("input-group input-group-alternative");
      toastr.error('La descripción es muy corta','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });

    }else{
      jQuery('#preloader').show();
      jQuery('#form-add-tipo').hide();
      setTimeout ("agregar_tipo_pro(des_tpr,cod_unm);", 1000);
    }
  }
  
}

function agregar_tipo_pro(des_tpr,cod_unm){
  
  cadena ="des_tpr="+des_tpr+
  "&cod_unm="+cod_unm;

  // alert("Totales: \n" + precio_total_convenios +"\n"+costo_gastos+"\n"+precio_total_insumos)
  
  $.ajax({
    type:"post",
    url:"../php/crud/tipo_produccion/agregar_tipo_produccion.php",
    data:cadena,
    success:function(r){
      if(r.includes('Resource id')){


        $('#tab_tipo_prod').load('../php/componentes/componentes_tipo_produccion/tab_tipo_prod.php');
        swal("Tipo de producción creado!"," ", "success");
        jQuery('#preloader').hide();
        jQuery('#form-add-tipo').show();
        $('#modal-form').modal('hide');
        var form = document.querySelector('#form-add-tipo');
        form.reset();
      }else{
        swal("Verifica los datos!", r , "error");
      }
    }
  });
}


function llenarform(datos){
  data = datos.split("||");
  $('#cod_tpr').val(data[0]); 
  $('#des_tpr').val(data[1]); 
  $('#cod_unm').val(data[2].trim());

  jQuery('#btn_update').show();
  jQuery('#btn_save').hide();

}


function preloaderup(){

  cod_tpr=$('#cod_tpr').val();
  des_tpr=$('#des_tpr').val();
  cod_unm=$('#cod_unm').val();

  if (des_tpr== "" || cod_unm == null) {
    if(des_tpr==""){
      toastr.error('Por favor ingrese el nombre del tipo de producción','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    }else if ( cod_unm == null) {
      toastr.error('Por favor seleccione la unidad de medida','',{
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar":true
    });
    }
  }else{

    if (des_tpr.length < 4) {

      $('#div_des_tpr').removeClass("input-group input-group-alternative");
      toastr.error('La descripción es muy corta','',{
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar":true
      });

    }else{
      jQuery('#preloader').show();
      jQuery('#form-add-tipo').hide();
      setTimeout ("editar_tipo_pro(cod_tpr,des_tpr,cod_unm);", 1000);
    }
  }

  

}



function editar_tipo_pro(cod_tpr,des_tpr,cod_unm){
  
  cadena ="cod_tpr="+cod_tpr+
  "&des_tpr="+des_tpr +
  "&cod_unm="+cod_unm;
  //alert(cadena);
  $.ajax({
    type:"post",
    url:"../php/crud/tipo_produccion/editar_tipo_produccion.php",
    data:cadena,
    success:function(r){
      if(r.includes('Resource id')){

        $('#tab_tipo_prod').load('../php/componentes/componentes_tipo_produccion/tab_tipo_prod.php');
        swal("Tipo de producción editado!"," ", "success");
        jQuery('#btn_update').show();
        jQuery('#btn_save').hide();
        jQuery('#preloader').hide();
        jQuery('#form-add-tipo').show();
        $('#modal-form').modal('hide');
        var form = document.querySelector('#form-add-tipo');
        form.reset();
      }else{
        swal("Verifica los datos!", r , "error");
      }
    }
  });
}



function eliminar_tipo_pro(cod_tpr){
  ide_ter=$('#ide_terup').val();
  swal({
    title: "Estas seguro?",
    text: "Deseas eliminar este tipo de producción?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      cadena="cod_tpr="+cod_tpr;
      $.ajax({
        type:"post",
        url:"../php/crud/tipo_produccion/eliminar_tipo_pod.php",
        data:cadena,
        success:function(r){
          if(r.includes('Resource id')){
            $('#tab_tipo_prod').load('../php/componentes/componentes_tipo_produccion/tab_tipo_prod.php');
            swal("El tipo de producción se elimino!", {
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


function resertbuttons(){
  jQuery('#btn_save').show();
  jQuery('#btn_update').hide();
}


$(document).ready(function(){
  jQuery('#ver2').hide();
  $('#date-hour').load('../php/componentes/menu/date-hour.php');
  $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
  $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
  $('#tab_tipo_prod').load('../php/componentes/componentes_tipo_produccion/tab_tipo_prod.php');
  $('#menu').load('../php/componentes/menu/menu.php');

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $('#des_tpr').keydown(function(){
    $('#div_des_tpr').addClass("input-group input-group-alternative");
  });

});

function cerrar_menu(){
  $('#sidenav-main').remove();
  jQuery('#ver1').hide();
  jQuery('#ver2').show();
}