

    //------------------------------------Guardar Ingrediente Activo----------------------------//
function guadarEtapa() {

    nom_eta = $('#nom_eta').val();    

    if (nom_eta != "") {
        
        datos ="nom_eta="+nom_eta;

        $.ajax({
            type:"post",
            url:"../php/crud/etapas/agregar_etapa.php",
            data:datos,
            success:function(r){
                if(r.includes('Resource id')){		
                
            swal(
              '¡Todo salió bien!',
              '¡Etapa creada!',
              'success'
            )
        
                $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
				$('#modal-form').modal('hide');
				var form = document.querySelector('#form-add-eta');
				form.reset();		
				jQuery('#preloader').hide();
                jQuery('#form-add-eta').show();
                
                
            }else{
                swal("Verifica los datos!", r , "error");
            }
        }
    });



    } else {
        swal("Advertencia..", "Por favor llene todos los campos.", "warning");
    }
}



//-------------------------------------Actualizar Ingrediente Activo---------------------------//
cod_eta = "";

function modalActualizar(datos){
	data= datos.split('||');
	$('#modal-form-up').modal('toggle');
    $('#nom_eta_up').val(data[1]);    
    cod_eta = data[0].trim();
}    

function actualizarEtapa_g(){

    nom_eta=$('#nom_eta_up').val(); 

    if (nom_eta != "") {
        
        setTimeout ("actualizarEtapa_d(cod_eta,nom_eta);", 1000);

    } else {
        swal("Advertencia..", "Por favor llene todos los campos.", "warning");
    }

}

function actualizarEtapa_d(cod_eta,nom_eta){

    cadena ="cod_eta="+cod_eta+
    "&nom_eta="+nom_eta;

    $.ajax({
        type:"post",
        url:"../php/crud/etapas/actualizar_etapa.php",
        data:cadena,
        success:function(r){
            if(r.includes('Resource id')){
                swal("¡Etapa editada!"," ", "success");
                var form = document.querySelector('#form-up-sem');
                form.reset();
                $('#modal-form-up').modal('hide'); 
                jQuery('#preloaderup').hide();
                jQuery('#form-up-sem').show();				       
                $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');

            }else{ 
                jQuery('#preloaderup').hide();
                jQuery('#form-up-sem').show();
                $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');      
            }
        }
    });
}

//----------------------------------------Eliinar Ingrediente Activo------------------------//

function eliminarEtapa(datos){
    data= datos.split('||');
    cod_eta = data[0].trim();
    swal({
        title: "¿Estás seguro?",
        text: "¿Deseas eliminar esta etapa?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            cadena="cod_eta="+cod_eta;

            $.ajax({
                type:"post",
                url:"../php/crud/etapas/eliminar_etapa.php",
                data:cadena,
                success:function(r){
<<<<<<< HEAD
                    if(r.includes('Resource id')){
                    swal("¡La etapa se ha eliminado!", {
                        icon: "success",
                    });
                    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
                }else{
                    swal("No se puede eliminare esta etapa", {
                        icon: "error",
                    });
                }
                }
            });
            
=======
                    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
                }
            });
            swal("La etapa se ha eliminado!", {
                icon: "success",
            });
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
        } else {
            swal("Cancelado!");
        }
    });
    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
}


//--------------------------------------Asociar a etapa----------------------------------//
cod_etap = "";
cod_afec="";
function asociar(cod_eta){
    cod_etap=cod_eta;

}

function seleccion_afe(cod_afe){
<<<<<<< HEAD
=======
alert(cod_afe);
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
cod_afec=cod_afe;
$('#modal-list-dos').modal('toggle');
$('#modal-list').modal('hide');

$('#codi_afe').val(cod_afec);
$('#codi_eta').val(cod_etap);
}

function validateFileType(){

    var datos = new FormData($("#form-list-dos")[0]);
    $.ajax({
        type: "post",
        url: "../php/crud/etapas/agregar_etapa_imagen.php",
        data: datos,
        contentType: false,
        processData: false,
        success: function(r) {
<<<<<<< HEAD
            //alert(r);
            if (r.includes('Resource id')) {               
=======
            alert(r);
            if (r.includes('Resource id')) {                
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                
                toastr.success('¡Todo salió bien!','',{
                    "positionClass": "toast-bottom-right",
                    "closeButton": false,
                    "progressBar": true
<<<<<<< HEAD
                });                
                $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
                document.getElementById("imagen_esc").value = "";
                $('#modal-list-dos').modal('hide');
            }else{
                swal("Esta etapa ya está registrada", '' , "error");
                document.getElementById("imagen_esc").value = "";
                $('#modal-list-dos').modal('hide');
                
=======
                });
            }else{
                swal("Verifica los datos!", r , "error");
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
            }
        }
    });
}

function guardarSinImagen(info,nombre){

    cadena ="cod_eta="+cod_etap+
    "&cod_afe="+cod_afec;
    $.ajax({
      type:"post",
      url:"../php/crud/etapas/agregar_etapa_no_imagen.php",
      data:cadena,
      success:function(r){
<<<<<<< HEAD
          //alert(r);
=======
          alert(r);
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
       if(r.includes('utilizado')){
        swal("Esta etapa ya tiene un registro de esta plaga o enfermedad", {
            icon: "error",
        });

       }else if(r.includes('Resource id')){
          toastr.success('¡Todo salió bien!','',{
              "positionClass": "toast-bottom-right",
              "closeButton": false,
              "progressBar": true
          });  
<<<<<<< HEAD
          $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
          $('#modal-list-dos').modal('hide');
       }else{
          swal("Esta etapa ya está registrada",'' , "error");
          $('#modal-list-dos').modal('hide');
=======
       }else{
          swal("Verifica los datos!", r , "error");
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
       }
      }
      });
  
    }
  
<<<<<<< HEAD
function eliminarAsociacion(cod_afe, cod_eta){

swal({
    title: "¿Estás seguro?",
    text: "¿Deseas eliminar esta enfermedad/plaga de esta etapa?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
})
.then((willDelete) => {
    if (willDelete) {

    cadena ="cod_afe="+cod_afe+
    "&cod_eta="+cod_eta;
//alert("cadena "+ cadena);
    $.ajax({
      type:"post",
      url:"../php/crud/etapas/eliminar_etapa_afeccion.php",
      data:cadena,
      success:function(r){
          alert(r);
       if(r.includes('utilizado')){
        swal("Esta etapa/enfermedad/plaga ya se encuentra ligada a un agroquímico", {
            icon: "error",
        });

       }else if(r.includes('Resource id')){
          toastr.success('¡Todo salió bien!','',{
              "positionClass": "toast-bottom-right",
              "closeButton": false,
              "progressBar": true
          });  
          $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
       }else{
          swal("Verifica los datos!", r , "error");
       }
      }
      });
    }
  });
}
=======

>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894

//--------------------------------------Inicio----------------------------------------//
$(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
    $('#menu').load('../php/componentes/menu/menu.php');

<<<<<<< HEAD
   

=======
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });    

    $("#myInput1").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable1 tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });  

    $('#det_semup').keydown(function() {
        $('#div_det_semup').addClass("input-group-alternative");
    });

    $('#modal-list-dos').on('hidden.bs.modal', function (e) {
        $('#modal-list').modal('toggle');
      })

<<<<<<< HEAD
      swal(
        'Administrador de Etapas de Enfermedades/Plagas',
        'Aquí podrás determinar las etapas de desarrollo de cada enfermedad o plaga.',
        'info'
      )

});



=======

});

>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("MsxmL2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }