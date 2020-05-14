
//----------------------------Segundo Ingrediente-------------------------------------//
function muestra_oculta(id){
    if (document.getElementById){ 
    var el = document.getElementById(id); 
    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; 
    }
    }
    window.onload = function(){
    muestra_oculta('nomd_iac');
    }

    //------------------------------------Guardar Ingrediente Activo----------------------------//
function guadarIngrediente() {

    ica1 = $('input:checkbox[name=ica1]:checked').val();
    ica2 = $('input:checkbox[name=ica2]:checked').val();
    nom_iac = $('#nom_iac').val();
    nomd_iac = $('#nomd_iac').val();

    if(ica1 == "SI" && ica2 == "NO"){

        toastr.error('Por favor solo seleccione una opción','',{
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    }else if(ica1 == "SI" || ica2 == "NO"){ 

    ica = "";
    if (ica1 != undefined) {
        ica = ica1;
    } else if (ica2 != undefined) {
        ica = ica2;
    }

    if (nom_iac != "" && ica != "") {
        nombre = nom_iac;

        if(nomd_iac != ""){
            nombre = nombre +"-"+nomd_iac;
        }

        datos ="nombre="+nombre+
        "&ica="+ica;

        $.ajax({
            type:"post",
            url:"../php/crud/ingredientes_activos/crear_ingrediente_activo.php",
            data:datos,
            success:function(r){
                if(r.includes('Resource id')){		
                
            swal(
              'Todo salió bien!',
              'Ingrediente activo creado!',
              'success'
            )
        
                $('#tab_ingredientes_activos').load('../php/componentes/componentes_ingredientes_activos/tab_ingredientes_activos.php');
				$('#modal-form').modal('hide');
				var form = document.querySelector('#form-add-iac');
				form.reset();		
				jQuery('#preloader').hide();
                jQuery('#form-add-iac').show();
                
                
            }else{
                swal("Verifica los datos!", r , "error");
            }
        }
    });



    } else {
        swal("Advertencia..", "Por favor llene todos los campos.", "warning");
    }
}
}


//-------------------------------------Actualizar Ingrediente Activo---------------------------//
cod_iac = "";

function modalActualizar(datos){
	data= datos.split('||');
	$('#modal-form-up').modal('toggle');
    $('#nom_iac_up').val(data[1]);

    if(data[2] == "SI"){
        document.getElementById("ica1up").checked = true;
        document.getElementById("ica2up").checked = false;
    }else{
        document.getElementById("ica1up").checked = false;
        document.getElementById("ica2up").checked = true;
    }
    cod_iac = data[0].trim();
}    

function actualizarIngrediente_g(){

	ica1 = $('input:checkbox[name=ica1]:checked').val();
    ica2 = $('input:checkbox[name=ica2]:checked').val();
    nom_iac = $('#nom_iac_up').val();

    if(ica1 == "SI" && ica2 == "NO"){

        toastr.error('Por favor solo seleccione una opción','',{
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    }else if(ica1 == "SI" || ica2 == "NO"){  

    ica = "";
    if (ica1 != undefined) {
        ica = ica1;
    } else if (ica2 != undefined) {
        ica = ica2;
    }


    if (nom_iac != "" && ica != "") {
        nombre = nom_iac;

        setTimeout ("actualizarIngrediente_d(cod_iac,nombre,ica);", 1000);

    } else {
        swal("Advertencia..", "Por favor llene todos los campos.", "warning");
    }
}
}

function actualizarIngrediente_d(cod_iac,nombre,ica){

    cadena ="cod_iac="+cod_iac+
    "&des_iac="+nombre+
    "&pro_iac="+ica;

    $.ajax({
        type:"post",
        url:"../php/crud/ingredientes_activos/actualizar_ingrediente_activo.php",
        data:cadena,
        success:function(r){
            if(r.includes('Resource id')){
                swal("¡Ingrediente Activo editado!"," ", "success");
                var form = document.querySelector('#form-up-sem');
                form.reset();
                $('#modal-form-up').modal('hide'); 
                jQuery('#preloaderup').hide();
                jQuery('#form-up-sem').show();				       
                $('#tab_ingredientes_activos').load('../php/componentes/componentes_ingredientes_activos/tab_ingredientes_activos.php');

            }else{ 
                jQuery('#preloaderup').hide();
                jQuery('#form-up-sem').show();
                $('#tab_ingredientes_activos').load('../php/componentes/componentes_ingredientes_activos/tab_ingredientes_activos.php');        
            }
        }
    });
}

//----------------------------------------Eliinar Ingrediente Activo------------------------//

function eliminarIngrediente(datos){
    data= datos.split('||');
    cod_iac = data[0].trim();
    swal({
        title: "¿Estás seguro?",
        text: "¿Deseas eliminar este Ingrediente Activo?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            cadena="cod_iac="+cod_iac;

            $.ajax({
                type:"post",
                url:"../php/crud/ingredientes_activos/eliminar_ingrediente_activo.php",
                data:cadena,
                success:function(r){
                    $('#tab_ingredientes_activos').load('../php/componentes/componentes_ingredientes_activos/tab_ingredientes_activos.php');
                }
            });
            swal("El ingrediente activo se ha eliminado!", {
                icon: "success",
            });
        } else {
            swal("Cancelado!");
        }
    });
    $('#tab_ingredientes_activos').load('../php/componentes/componentes_ingredientes_activos/tab_ingredientes_activos.php');
}




//--------------------------------------Inicio----------------------------------------//
$(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_ingredientes_activos').load('../php/componentes/componentes_ingredientes_activos/tab_ingredientes_activos.php');
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

function cerrar_menu() {
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
  }