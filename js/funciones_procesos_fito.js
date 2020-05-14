//--------------------------------------Inicio----------------------------------------//
$(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_procesos_fit').load('../php/componentes/componentes_procesos_fitosanitarios/tab_procesos_fit.php');
    $('#menu').load('../php/componentes/menu/menu.php');

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });    

    $('#det_semup').keydown(function() {
        $('#div_det_semup').addClass("input-group-alternative");
    });


});

//----------------------------Activar modal comentarios---------------------------//
function modalComentarios(codigo){

   var data = codigo.trim();
    $('#modal-form-new').modal('toggle');   

  ajax = objetoAjax();
  ajax.open("POST","../php/componentes/componentes_procesos_fitosanitarios/modal_comentarios.php", true);
  ajax.onreadystatechange=function(){
    if ( ajax.readyState==4 ) {
      document.getElementById("div_pfi").innerHTML=ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("cod_pfi="+data);
}

function addComentario(codigo){
    comentario = $('#text-comentario').val();    
    if(comentario != ""){

        datos ="codigo="+codigo+
                "&comentario="+comentario;
                
        setTimeout ("addComentarioDB(datos)", 1000);

        jQuery('#form-comentarios').hide();
        jQuery('#preloader').show(); 

    }else{

        swal("Advertencia..", "Por favor agregue un comentario." , "warning");
    }
}    


function addComentarioDB(datos){

    $.ajax({
        type:"post",
        url:"../php/crud/procesos_fitosanitarios/agregar_comentario.php",
        data:datos,
        success:function(r){
            if(r.includes('Resource id')){	
    
                swal(
                    'Todo salió bien!',
                    '¡Comentario agregado!',
                    'success'
                  )
                  
            $('#modal-form-new').modal('hide');
            jQuery('#form-comentarios').show();
            jQuery('#preloader').hide();  
                   
            
        }else{
            swal("Verifica los datos!", r , "error");
        }
    }
    });
    
    }
    
//--------------------------------------Eliminar comentario-------------------------------//

function eliminarComentario(codigo){

datos ="codigo="+codigo;
        setTimeout ("eliminarComentarioDB(datos)", 1000);
        jQuery('#form-comentarios').hide();
        jQuery('#preloader').show(); 
}

function eliminarComentarioDB(datos){

    $.ajax({
        type:"post",
        url:"../php/crud/procesos_fitosanitarios/eliminar_comentario.php",
        data:datos,
        success:function(r){
            if(r.includes('Resource id')){	
    
                swal(
                    'Todo salió bien!',
                    '¡Comentario eliminado!',
                    'success'
                  )

            $('#modal-form-new').modal('hide');
            jQuery('#form-comentarios').show();
            jQuery('#preloader').hide();  
            
        
            
        }else{
            swal("Verifica los datos!", r , "error");
        }
    }
    });
    
}
    
//-------------------------------Calificación de las tareas-----------------------------------//

function calificar(codigo){

cadena = codigo.split('*');
cod_lfi = cadena[0];
calif = cadena[1];


datos ="cod_lfi="+cod_lfi+
        "&calif="+calif;

$.ajax({
    type:"post",
    url:"../php/crud/procesos_fitosanitarios/calificacion.php",
    data:datos,
    success:function(r){
        if(r.includes('Resource id')){	

            swal(
                '¡Calificación Actualizada!',
                '',
                'success'
              )

        $('#modal-form-new').modal('hide');
        jQuery('#form-comentarios').show();
        jQuery('#preloader').hide();  
        
    
        
    }else{
        swal("Verifica los datos!", r , "error");
    }
}
});


}

//------------------------------------------------------------------------------------//

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