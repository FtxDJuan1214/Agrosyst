//--------------------------------------Inicio----------------------------------------//
$(document).ready(function () {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    //$('#tab_procesos_fit').load('../php/componentes/componentes_procesos_fitosanitarios/tab_todos_procesos.php');
    $('#menu').load('../php/componentes/menu/menu.php');

    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#det_semup').keydown(function () {
        $('#div_det_semup').addClass("input-group-alternative");
    });


});

//----------------------------Activar modal comentarios---------------------------//
nom_cult = "";
function modalComentarios(codigo, nom_cul) {

    nom_cult = nom_cul;
    var data = codigo.trim();
    $('#modal-form-new').modal('toggle');

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_procesos_fitosanitarios/modal_comentarios.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            document.getElementById("div_pfi").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("cod_pfi=" + data);
}

function addComentario(codigo) {
    comentario = $('#text-comentario').val();
    if (comentario != "") {

        datos = "codigo=" + codigo +
            "&comentario=" + nom_cult + ': ' + comentario;

        setTimeout("addComentarioDB(datos)", 1000);

        jQuery('#form-comentarios').hide();
        jQuery('#preloader').show();

    } else {

        swal("Advertencia..", "Por favor agregue un comentario.", "warning");
    }
}


function addComentarioDB(datos) {

    $.ajax({
        type: "post",
        url: "../php/crud/procesos_fitosanitarios/agregar_comentario.php",
        data: datos,
        success: function (r) {
            if (r.includes('Resource id')) {

                swal(
                    'Todo salió bien!',
                    '¡Comentario agregado!',
                    'success'
                )

                $('#modal-form-new').modal('hide');
                jQuery('#form-comentarios').show();
                jQuery('#preloader').hide();

                //setTimeout ("location.reload();", 1000);


            } else {
                swal("Verifica los datos!", r, "error");
            }
        }
    });

}

//--------------------------------------Eliminar comentario-------------------------------//

function eliminarComentario(codigo) {

    datos = "codigo=" + codigo;
    setTimeout("eliminarComentarioDB(datos)", 1000);
    jQuery('#form-comentarios').hide();
    jQuery('#preloader').show();
}

function eliminarComentarioDB(datos) {

    $.ajax({
        type: "post",
        url: "../php/crud/procesos_fitosanitarios/eliminar_comentario.php",
        data: datos,
        success: function (r) {
            if (r.includes('Resource id')) {

                swal(
                    'Todo salió bien!',
                    '¡Comentario eliminado!',
                    'success'
                )

                $('#modal-form-new').modal('hide');
                jQuery('#form-comentarios').show();
                jQuery('#preloader').hide();



            } else {
                swal("Verifica los datos!", r, "error");
            }
        }
    });

}

//-------------------------------Calificación de las tareas-----------------------------------//

function calificar(codigo) {

    cadena = codigo.split('*');
    cod_lfi = cadena[0];
    calif = cadena[1];


    datos = "cod_lfi=" + cod_lfi +
        "&calif=" + calif;

    $.ajax({
        type: "post",
        url: "../php/crud/procesos_fitosanitarios/calificacion.php",
        data: datos,
        success: function (r) {
            if (r.includes('Resource id')) {

                swal(
                    '¡Calificación Actualizada!',
                    '',
                    'success'
                )

                $('#modal-form-new').modal('hide');
                jQuery('#form-comentarios').show();
                jQuery('#preloader').hide();
                $('#tab_procesos_fit').load('../php/componentes/componentes_procesos_fitosanitarios/tab_procesos_fit.php');


            } else {
                swal("Verifica los datos!", r, "error");
            }
        }
    });


}
//------------------------------Terminar proceso --------------------------------------//

function terminarProceso(cod_pfi, cod_cul) {

    //Enviar tambien el codigo del cultivo
    swal({
        title: "¡Importante!",
        text: "Antes de terminar un proceso asegurese de que todas las tareas relacionadas esten calificadas",
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
        .then((willDelete) => {
            if (willDelete) {

                cadena = "cod_pfi=" + cod_pfi.trim() +
                    "&cod_cul=" + cod_cul;
                $.ajax({
                    type: "post",
                    url: "../php/crud/procesos_fitosanitarios/terminar_proceso.php",
                    data: cadena,
                    success: function (r) {
                        alert(r);
                        if (r.includes('Resource id')) {
                            swal("¡Proceso concluido!", " ", "success");
                            $('#tab_procesos_fit').load('../php/componentes/componentes_procesos_fitosanitarios/tab_procesos_fit.php');

                        } else {
                            swal("", "Por favor antes de terminar el proceso, agregue un comentario sobre su lucha contra esta enfermedad/plaga.", "info");
                        }
                    }
                });
            }
        });

}
//---------------------------------Modal comentarios de solo ver-------------------------------//
function modalComentariosVer(codigo) {

    var data = codigo.trim();
    $('#modal-form-new').modal('toggle');

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_procesos_fitosanitarios/modal_comentarios_ver.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            document.getElementById("div_pfi").innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("cod_pfi=" + data);
}
//-----------------------------------------Informe--------------------------------//

function informe(datos){
    data= datos.split('||');
    cod_cul = data[0];
    cod_pfi=data[1];
    nom_cul=data[2];
	alert(cod_cul+' y '+cod_pfi);
		window.open('../php/componentes/componentes_procesos_fitosanitarios/informe.php/?c='+cod_cul+'&d='+cod_pfi+'&n='+nom_cul);
	
}

//------------------------------------------------------------------------------------//

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

function cerrar_menu() {
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
}

function mostrar_tabla() {
    cod = $('#cod').val(); 
    if (cod == '1') {

        ajax = objetoAjax();
        ajax.open("POST", "../php/componentes/componentes_procesos_fitosanitarios/tab_procesos_fit.php", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                document.getElementById("tab_procesos_fit").innerHTML = ajax.responseText;
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            }
        }
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("cod=" + cod);
    } else if(cod == '2'){

        ajax = objetoAjax();
        ajax.open("POST", "../php/componentes/componentes_procesos_fitosanitarios/tab_todos_procesos.php", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                document.getElementById("tab_procesos_fit").innerHTML = ajax.responseText;
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            }
        }
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("cod=" + cod);
    }
}