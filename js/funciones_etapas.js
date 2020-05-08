

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
                    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
                }
            });
            swal("La etapa se ha eliminado!", {
                icon: "success",
            });
        } else {
            swal("Cancelado!");
        }
    });
    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
}




//--------------------------------------Inicio----------------------------------------//
$(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_etapas').load('../php/componentes/componentes_etapas/tab_etapas.php');
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