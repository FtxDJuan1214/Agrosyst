//-------------------Abrir  y Cerrar Modal de Creación---------------------//
function cargarVentana() {

    swal("¡Agregarás una enfermedad o una plaga!",
        "Te pediremos algunos datos que no ayudarán a aconsejarte de una mejor forma, además, algunas imagenes de las etapas de crecimiento de la plaga o enfermedad, si no las tienes no hay problema, pero si puedes buscarlas antes de empezar, ¡Sería genial!", "");

    $('#div-btn-add-enf').hide();
    $('#crear_enf_pla').load('../php/componentes/componentes_enfermedades_plagas/agregar_enfermedad_plaga.php');
}

function cancelar() {

    swal({
            title: "¿Estás seguro?",
            text: "Se perderá la información que has registrado",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                document.getElementById("crear_enf_pla").innerHTML = "";
                $('#div-btn-add-enf').show();
            }
        });

}

//-----------Select escoger si se guarda enfermedad o plaga-------------//
function cargar_select_tip() {
    pla_o_enf = $('#pla_o_enf').val();
    //alert("a er "+ pla_o_enf);

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/select_patogeno_tipo.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("sel_pat_tip").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("pla_o_enf=" + pla_o_enf);

}

//--------------------------------Guardar partes afectadas----------------------------//
partes = "";

function guardarPartes() {

    partes = "";
    frutos = $('input:checkbox[name=frutos]:checked').val();
    tallo = $('input:checkbox[name=tallo]:checked').val();
    hojas = $('input:checkbox[name=hojas]:checked').val();
    flores = $('input:checkbox[name=flores]:checked').val();
    raiz = $('input:checkbox[name=raiz]:checked').val();
    enves = $('input:checkbox[name=enves]:checked').val();
    aerea = $('input:checkbox[name=aerea]:checked').val();


    if (frutos == undefined && tallo == undefined && hojas == undefined && flores == undefined && raiz == undefined && enves == undefined && aerea == undefined) {

        toastr.error('Por favor solo seleccione al menos una opción', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    } else {
        if (frutos != undefined) {
            partes = partes + " - " + "Frutos";
        }
        if (tallo != undefined) {
            partes = partes + " - " + "Tallo";
        }
        if (hojas != undefined) {
            partes = partes + " - " + "Hojas";
        }
        if (flores != undefined) {
            partes = partes + " - " + "Flores";
        }
        if (raiz != undefined) {
            partes = partes + " - " + "Raiz";
        }
        if (enves != undefined) {
            partes = partes + " - " + "Enves";
        }
        if (aerea != undefined) {
            partes = partes + " - " + "Aerea";
        }

        setTimeout("cargarTextPartes(partes)", 1000);

        jQuery('#form-add-partes').hide();
        jQuery('#preloader').show();
    }
}

function cargarTextPartes(partes) {
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_partes.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {

            $('#modal-partes-afe').modal('hide');
            jQuery('#form-add-partes').show();
            jQuery('#preloader').hide();

            document.getElementById("partes-mostrar").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("partes=" + partes);
}

//--------------------------------Guardar etapas afectadas----------------------------//
etapas = "";

function guardarEtapas() {

    etapas = "";
    inicio = $('input:checkbox[name=inicio]:checked').val();
    vegetativo = $('input:checkbox[name=vegetativo]:checked').val();
    ifloracion = $('input:checkbox[name=ifloracion]:checked').val();
    mfloracion = $('input:checkbox[name=mfloracion]:checked').val();
    fructificacion = $('input:checkbox[name=fructificacion]:checked').val();
    cosecha = $('input:checkbox[name=cosecha]:checked').val();


    if (inicio == undefined && vegetativo == undefined && ifloracion == undefined && mfloracion == undefined && fructificacion == undefined && cosecha == undefined) {

        toastr.error('Por favor solo seleccione al menos una opción', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    } else {
        if (inicio != undefined) {
            etapas = etapas + " - " + "Inicio";
        }
        if (vegetativo != undefined) {
            etapas = etapas + " - " + "Crecimiento";
        }
        if (ifloracion != undefined) {
            etapas = etapas + " - " + "Inicio floracion";
        }
        if (mfloracion != undefined) {
            etapas = etapas + " - " + "Maxima floracion";
        }
        if (fructificacion != undefined) {
            etapas = etapas + " - " + "Fructificacion";
        }
        if (cosecha != undefined) {
            etapas = etapas + " - " + "Cosecha";
        }

        setTimeout("cargarTextEtapas(etapas)", 1000);

        jQuery('#form-add-etapas').hide();
        jQuery('#preloader1').show();
    }
}

function cargarTextEtapas(etapas) {
    //alert(etapas);
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_etapas.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {

            $('#modal-etapas-afe').modal('hide');
            jQuery('#form-add-etapas').show();
            jQuery('#preloader1').hide();
            document.getElementById("etapas-afe-mostrar").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("etapas=" + etapas);
}

//--------------------------------Sintomas presentados----------------------------//
sintomas = "";
codigo_sintoma = "";

function guardarSintomas(datos, valores) {

    sintomas = "";
    datosS = datos.split('~');
    valoresS = valores.split('~');
    res = false;
    add = "";
    for (i = 1; i < datosS.length; i++) {

        resp = $('input:checkbox[name=' + datosS[i] + ']:checked').val();
        if (resp == 'on') {
            sintomas = sintomas + ", " + valoresS[i];
            codigo_sintoma = codigo_sintoma + "~" + datosS[i];
            res = true;
        }
    }
    if (res == false) {

        toastr.error('Por favor solo seleccione al menos una opción', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });
    } else {

        setTimeout("cargarTextSintomas(sintomas)", 1000);

        jQuery('#form-add-sintomas').hide();
        jQuery('#preloader2').show();
    }
}

function cargarTextSintomas(sintomas) {
    //alert(sintomas);
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_sintomas.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {

            $('#modal-sintomas').modal('hide');
            jQuery('#form-add-sintomas').show();
            jQuery('#preloader2').hide();
            document.getElementById("sintomas-mostrar").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("sintomas=" + sintomas);
}

//-------------------------------------Mostrar y agregar a tabla de etapas----------------------//
listado_etapas = "";
listado_fotos = "";
union_listados = "";

function mostrarTabEtapas() {

    eta_sel = $('#eta_sel').val();

    sep = eta_sel.split("||");
    cod_eta = sep[0];
    det_eta = sep[1];
    verf = listado_etapas_agregadas.includes(det_eta);

    if (verf == true) {

        toastr.error('Opción ya escogida.', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });
    } else {

        listado_etapas = cod_eta + "~" + det_eta + "||";

        ajax = objetoAjax();
        ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/tab_etapas_desarrollo.php", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                document.getElementById("tab_eta_ima").innerHTML = ajax.responseText;
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            }
        }
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("listado_etapas=" + listado_etapas + "&listado_fotos=" + listado_fotos);
    }


}

listado_etapas_agregadas = "";

function validateFileType(info, nombre) {

    var dato = document.getElementById(info);

    if (dato.files[0].size < 3000000) {

        document.getElementById("etapas-des-mostrar").innerHTML = "";

        sep = listado_etapas.split('||');
        indice = 0;
        found = false;
        found = false;

        for (i = 0; i < sep.length - 1; i++) {
            sepr = sep[i].split('~');

            for (e = 0; e < sepr.length; e++) {
                if (info == sepr[e]) {
                    indice = i;
                    found = true;
                    break;
                }
            }

            if (found == true) {
                break;
            }
        }


        var fileName = document.getElementById(info).value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
            if (found == true) {

                listado_fotos = info + "~" + fileName + "||";

            }
        } else {
            alert("Only jpg/jpeg and png files are allowed!");
        }


        //Guardar foto
        $('#listado_etapas').val(listado_etapas);
        $('#listado_fotos').val(listado_fotos);

        saveImage(info, nombre);
    } else {
        swal("¡La imagen es muy pesada!", 'Por favor seleccione otra', "error");
    }
}

function saveImage(info, nombre) {

    var datos = new FormData($("#form-add-eta")[0]);
    $.ajax({
        type: "post",
        url: "../php/crud/plagas_enfermedades/agregar_etapa_imagen.php",
        data: datos,
        contentType: false,
        processData: false,
        success: function(r) {
            if (r.includes('Resource id')) {

                toastr.success('¡Etapa e imagen agregada!', '', {
                    "positionClass": "toast-bottom-right",
                    "closeButton": false,
                    "progressBar": true
                });

                listado_etapas_agregadas = listado_etapas_agregadas + nombre + " - ";

                ajax = objetoAjax();
                ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_etapas_desarrollo.php", true);
                ajax.onreadystatechange = function() {
                    if (ajax.readyState == 4) {
                        document.getElementById("etapas-des-mostrar").innerHTML = ajax.responseText;
                        $(function() {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    }
                }
                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ajax.send("listado_etapas_agregadas=" + listado_etapas_agregadas);
                document.getElementById("tab_eta_ima").innerHTML = "";
                document.getElementById(info).innerHTML = "";

            } else {
                swal("Verifica los datos!", r, "error");
            }
        }
    });
}

function guardarSinImagen(info, nombre) {

    cadena = 'info=' + info;
    $.ajax({
        type: "post",
        url: "../php/crud/plagas_enfermedades/agregar_etapa_no_imagen.php",
        data: cadena,
        success: function(r) {
            //alert(r);          
            if (r.includes('Resource id')) {
                toastr.success('¡Etapa agregada!', '', {
                    "positionClass": "toast-bottom-right",
                    "closeButton": false,
                    "progressBar": true
                });

                listado_etapas_agregadas = listado_etapas_agregadas + nombre + " - ";

                ajax = objetoAjax();
                ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/mostrar_etapas_desarrollo.php", true);
                ajax.onreadystatechange = function() {
                    if (ajax.readyState == 4) {
                        document.getElementById("etapas-des-mostrar").innerHTML = ajax.responseText;
                        $(function() {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    }
                }
                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ajax.send("listado_etapas_agregadas=" + listado_etapas_agregadas);
                document.getElementById("tab_eta_ima").innerHTML = "";
                document.getElementById(info).innerHTML = "";
            } else {
                swal("Verifica los datos!", r, "error");
            }
        }
    });



}

function remFila(dato) {

    sep = listado_etapas.split('||');
    indice = 0;
    found = false;

    for (i = 0; i < sep.length - 1; i++) {
        sepr = sep[i].split('~');

        for (e = 0; e < sepr.length; e++) {
            if (dato == sepr[e]) {
                indice = i;
                found = true;
                break;
            }
        }

        if (found == true) {
            break;
        }
    }

    if (found == true) {
        listado_etapas = "";

        for (i = 0; i < sep.length - 1; i++) {

            if (indice != i) {
                listado_etapas = listado_etapas + sep[i] + "||";
            }
        }

        sep = listado_fotos.split('||');

        listado_fotos = "";

        for (i = 0; i < sep.length - 1; i++) {

            if (indice != i) {
                listado_fotos = listado_fotos + sep[i] + "||";
            }
        }
    }


    mostrarEtapasUp(listado_etapas, listado_fotos);


}

function mostrarEtapasUp(listado_etapas, listado_fotos) {
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/tab_etapas_desarrollo.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("tab_eta_ima").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("listado_etapas=" + listado_etapas + "&listado_fotos=" + listado_fotos);
}

//-------------------------------------------Mostrar tabla de metodos de prevencion--------------------//

cadena_mostrar_rus = "";

function cargarTablaAdd(cad) {
    if (cad != "_") {
        datos = cad.split('_');
        cod_agr = datos[0];
        rus_agr = datos[1];
        cadena_mostrar_rus = cadena_mostrar_rus + rus_agr + "~";
        mostrarTablaAdd(cadena_mostrar_rus);
    } else {
        toastr.error('El campo está vacío.', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });
    }

}

function mostrarTablaAdd(cadena_mostrar_rus) {
    document.getElementById('cod_agr_rus').value = "";
    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/tab_metodos_agregados.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById("tab_met_agre").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("cad=" + cadena_mostrar_rus);
    document.getElementById('rus_agr').value = "";


}

function rem_rus(rus_agr) {

    sep = cadena_mostrar_rus.split('||');
    indice = 0;
    found = false;

    for (i = 0; i < sep.length - 1; i++) {
        sepr = sep[i].split(',');

        for (e = 0; e < sepr.length; e++) {
            if (rus_agr == sepr[e]) {
                indice = i;
                found = true;
                break;
            }
        }

        if (found == true) {
            break;
        }
    }

    if (found == true) {
        cadena_mostrar_rus = "";

        for (i = 0; i < sep.length - 1; i++) {

            if (indice != i) {
                cadena_mostrar_rus = cadena_mostrar_rus + sep[i] + "||";
            }
        }

    }

    mostrarTablaAdd(cadena_mostrar_rus);

}

//------------------------ Guardar enfermedad o plaga---------------------------//
afeccion = "";

function guardarEnfer_Plaga() {


    falta = "";
    pla_o_enf = $('#pla_o_enf').val();
    nom_afe = $('#nom_afe').val();
    nomc_afe = $('#nomc_afe').val();
    horario = $('#horario').val();
    epoca_a = $('#epoca_a').val();

    d_alert = "";

    if (pla_o_enf == null || nom_afe == '' || epoca_a == '') {

        alert_i = false;
        if (nom_afe == "") {

            $('#div_nom_afe').removeClass("input-group input-group-alternative");
            alert_i = true;
        } else {
            $('#div_nom_afe').addClass("input-group input-group-alternative");
        }

        if (nomc_afe == "") {

            $('#div_nomc_afe').removeClass("input-group input-group-alternative");
            alert_i = true;
        } else {
            $('#div_nomc_afe').addClass("input-group input-group-alternative");
        }


        if (pla_o_enf == null) {
            d_alert = d_alert + "Plaga o Enfermedad \n";
        }

        if (horario == null) {
            d_alert = d_alert + "Horario de ataque \n";
        }

        if (epoca_a == null) {
            d_alert = d_alert + "Epoca de ataque \n";
        }

        if (d_alert != "") {

            swal("Por favor escoja opcion en:", d_alert, "warning");

        } else {
            if (alert_i == true) {

                toastr.error('Por favor no deje campos vacíos.' + '', {
                    "positionClass": "toast-top-center",
                    "closeButton": false,
                    "progressBar": true
                });

            }
        }

    } else {

        partes_f = "";
        sintomas_f = "";
        metodos_f = cadena_mostrar_rus;
        // Patoge o tipo
        indiv = "";
        if (pla_o_enf == "Plaga") {
            afeccion = "Plaga";
            indiv = $('#sele_enf_pla1').val();
        } else if (pla_o_enf == "Enfermedad") {
            afeccion = "Enfermedad";
            indiv = $('#sele_enf_pla2').val();
        }

        if (indiv != null) {
            //Etapas
            if (etapas != "") {
                etapas_f = etapas;
            } else {
                falta = "Etapas.";
            }
            //Partes
            if (partes != "") {
                partes_f = partes;
            } else {
                falta = falta + "\nPartes.";
            }
            //Sintomas
            if (sintomas != "") {
                sintomas_f = codigo_sintoma;
            } else {
                falta = falta + "\nSintomas.";
            }
            if (falta != "") {
                //alert("Falta "+ falta);

                toastr.error(falta, 'Por favor llene o escoja opciones en todos los campos', {
                    "positionClass": "toast-top-center",
                    "closeButton": false,
                    "progressBar": true
                });
            } else {


                imp_alert = false;
                if (nom_afe.length > 30) {

                    $('#div_nom_afe').removeClass("input-group input-group-alternative");
                    imp_alert = true;

                    toastr.error('Nombre de la plaga o afección demasiado extenso', {
                        "positionClass": "toast-top-center",
                        "closeButton": false,
                        "progressBar": true
                    });
                } else {
                    $('#div_nom_afe').addClass("input-group input-group-alternative");
                }

                if (nomc_afe.length > 5) {

                    $('#div_nomc_afe').removeClass("input-group input-group-alternative");
                    imp_alert = true;

                    toastr.error('Nombre científico demasiado extenso', {
                        "positionClass": "toast-top-center",
                        "closeButton": false,
                        "progressBar": true
                    });
                } else {
                    $('#div_nomc_afe').addClass("input-group input-group-alternative");
                }


                if (imp_alert == false) {

                    cadena = 'pla_o_enf=' + pla_o_enf +
                        '&indiv=' + indiv +
                        '&nom_afe=' + nom_afe +
                        '&nomc_afe=' + nomc_afe +
                        '&horario=' + horario +
                        '&epoca_a=' + epoca_a +
                        '&etapas_f=' + etapas_f +
                        '&partes_f=' + partes_f +
                        '&sintomas_f=' + sintomas_f +
                        '&metodos_f=' + metodos_f;

                    if (pla_o_enf == "Plaga") {

                        $.ajax({
                            type: "post",
                            url: "../php/crud/plagas_enfermedades/agregar_plaga_enfermedad.php",
                            data: cadena,
                            success: function(r) {
                                //alert(r);          
                                if (r.includes('Resource id')) {
                                    //$('#div-btn-add-enf').show();
                                    $.ajax({
                                        type: "post",
                                        url: "../php/crud/plagas_enfermedades/agregar_plaga.php",
                                        data: cadena,
                                        success: function(res) {
                                            if (res.includes('Resource id')) {

                                                //$('#div-btn-add-enf').show();
                                                //-------------------------Ahora guardar las imagenes de las etapas-------------------------------//
                                                $('#crear_enf_pla').load('../php/componentes/componentes_enfermedades_plagas/agregar_etapas.php');

                                                //-----Guarda sintomas---//
                                                cadena = 'codigo_sintoma=' + codigo_sintoma;
                                                $.ajax({
                                                    type: "post",
                                                    url: "../php/crud/plagas_enfermedades/agregar_sintomas.php",
                                                    data: cadena,
                                                    success: function(r) {
                                                        $('#div-btn-add-enf').show();
                                                    }
                                                });
                                            } else {
                                                swal("Verifica los datos!", res, "error");
                                            }
                                        }
                                    });
                                } else {
                                    swal("Verifica los datos!", r, "error");
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            type: "post",
                            url: "../php/crud/plagas_enfermedades/agregar_plaga_enfermedad.php",
                            data: cadena,
                            success: function(r) {
                                //alert(r);          
                                if (r.includes('Resource id')) {
                                    $.ajax({
                                        type: "post",
                                        url: "../php/crud/plagas_enfermedades/agregar_enfermedad.php",
                                        data: cadena,
                                        success: function(res) {

                                            if (res.includes('Resource id')) {
                                                //$('#div-btn-add-enf').show();
                                                //-------------------------Ahora guardar las imagenes de las etapas-------------------------------//
                                                $('#crear_enf_pla').load('../php/componentes/componentes_enfermedades_plagas/agregar_etapas.php');
                                                //-----Guarda sintomas---//
                                                cadena = 'codigo_sintoma=' + codigo_sintoma;
                                                $.ajax({
                                                    type: "post",
                                                    url: "../php/crud/plagas_enfermedades/agregar_sintomas.php",
                                                    data: cadena,
                                                    success: function(r) {
                                                        //$('#div-btn-add-enf').show();
                                                    }
                                                });
                                            } else {
                                                swal("Verifica los datos!", res, "error");
                                            }
                                        }
                                    });
                                } else {
                                    swal("Verifica los datos!", r, "error");
                                }
                            }
                        });

                    }
                }

            }
        } else {
            toastr.error(falta, 'Por favor llene o escoja opciones en todos los campos', {
                "positionClass": "toast-top-center",
                "closeButton": false,
                "progressBar": true
            });
        }
    }
}

function finalizarall() {

    document.getElementById("crear_enf_pla").innerHTML = "";
    if (afeccion == "Plaga") {
        cambiarTabla('P');
        swal(
            'Todo salió bien!',
            'Nueva plaga creada!',
            'success'
        )
        $('#div-btn-add-enf').show();
        setTimeout("location.reload();", 1000);
    } else if (afeccion == "Enfermedad") {
        cambiarTabla('E');
        swal(
            'Todo salió bien!',
            'Nueva enfermedad creada!',
            'success'
        )
        $('#div-btn-add-enf').show();
        setTimeout("location.reload();", 1000);
    }

}

//-------------------------------Vista de tablas--------------------------------//
function cambiarTabla(dato) {

    if (dato == "P") {
        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
    } else if (dato == "E") {
        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
    }

}

//---------------------------------Actualizar plaga o enfermedad-------------------------------//
global = "";
tipod = "";
etapas = "";

function modalActualizar(datos, tipo) {
    //alert(datos + ' - '+ tipo);
    data = datos.split('||');

    $('#modal-actualizar-afeccion').modal('toggle');

    if (tipo == 'E') {
        $('#nom_afe_up').val(data[1]);
        $('#nomc_afe_up').val(data[2]);
        $('#horario_up').val(data[6]);
        $('#epoca_a_up').val(data[3]);
        etapas = data[5];
    } else {
        $('#nom_afe_up').val(data[1]);
        $('#nomc_afe_up').val(data[2]);
        $('#horario_up').val(data[5]);
        $('#epoca_a_up').val(data[3]);
        etapas = data[4];
    }

    global = data[0];
    tipod = tipo;
}

function preloaderup() {

    jQuery('#form-actualizar-afeccion').hide();

    cod_afe = global;
    nom_afe = $('#nom_afe_up').val();
    noc_afe = $("#nomc_afe_up").val();
    hat_afe = $('#horario_up').val();
    epo_afe = $('#epoca_a_up').val();

    setTimeout("actualizar_enf_pla(cod_afe,nom_afe,noc_afe,epo_afe,hat_afe,tipod);", 200);
}

function actualizar_enf_pla(cod_afe, nom_afe, noc_afe, epo_afe, hat_afe, tipo) {
    cadena = "cod_afe=" + global.trim() +
        "&nom_afe=" + nom_afe +
        "&noc_afe=" + noc_afe +
        "&epo_afe=" + epo_afe +
        "&hat_afe=" + hat_afe +
        "&tipo=" + tipo;
    //alert("cadena "+cadena);
    $.ajax({
        type: "post",
        url: "../php/crud/plagas_enfermedades/actualizar_enfermedad_plaga.php",
        data: cadena,
        success: function(r) {
            //alert(r);
            if (r.includes('Resource id')) {

                if (tipo == "P") {
                    swal("¡Plaga Editada!", " ", "success");
                    $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
                } else {
                    swal("¡Enfermedad Editada!", " ", "success");
                    $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                }

                var formr = document.querySelector('#form-actualizar-afe');
                setTimeout("formr.reset();", 500);
                $('#modal-actualizar-afeccion').modal('hide');
                jQuery('form-actualizar-afe').show();
            } else {
                jQuery('#form-actualizar-afe').show();
                if (tipo == "E") {
                    $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
                } else {
                    $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                }
            }
        }
    });
}
//------------------------------------------------Actualizar partes------------------------------------------//

function up_partes() {

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/up_partes.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {

            document.getElementById("mostrar_partes_up").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("cod_afe=" + global.trim());

}

function actualizarPartes() {

    partes = "";
    frutos = $('input:checkbox[name=frutos]:checked').val();
    tallo = $('input:checkbox[name=tallo]:checked').val();
    hojas = $('input:checkbox[name=hojas]:checked').val();
    flores = $('input:checkbox[name=flores]:checked').val();
    raiz = $('input:checkbox[name=raiz]:checked').val();
    enves = $('input:checkbox[name=enves]:checked').val();
    aerea = $('input:checkbox[name=aerea]:checked').val();


    if (frutos == undefined && tallo == undefined && hojas == undefined && flores == undefined && raiz == undefined && enves == undefined && aerea == undefined) {

        toastr.error('Por favor solo seleccione al menos una opción', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    } else {
        if (frutos != undefined) {
            partes = partes + " - " + "Frutos";
        }
        if (tallo != undefined) {
            partes = partes + " - " + "Tallo";
        }
        if (hojas != undefined) {
            partes = partes + " - " + "Hojas";
        }
        if (flores != undefined) {
            partes = partes + " - " + "Flores";
        }
        if (raiz != undefined) {
            partes = partes + " - " + "Raiz";
        }
        if (enves != undefined) {
            partes = partes + " - " + "Enves";
        }
        if (aerea != undefined) {
            partes = partes + " - " + "Aerea";
        }

        cadena = "partes=" + partes +
            "&cod_afe=" + global.trim();

        $.ajax({
            type: "post",
            url: "../php/crud/plagas_enfermedades/actualizar_partes.php",
            data: cadena,
            success: function(r) {
                if (r.includes('Resource id')) {

                    toastr.success('¡Partes afectadas actualizadas!', '', {
                        "positionClass": "toast-bottom-right",
                        "closeButton": false,
                        "progressBar": true
                    });
                    $('#modal-partes-afe-up').modal('hide');
                    if (tipod == 'E') {
                        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                    } else {
                        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
                    }
                }
            }
        });

    }

}

//---------------------------------------------------Actualizar etapas afectadas -------------------------------//
function up_etapas() {

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/up_etapas.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {

            document.getElementById("mostrar_etapas_up").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("etapas=" + etapas);

}


function actualizarEtapas() {

    etapas = "";
    inicio = $('input:checkbox[name=inicio]:checked').val();
    vegetativo = $('input:checkbox[name=vegetativo]:checked').val();
    ifloracion = $('input:checkbox[name=ifloracion]:checked').val();
    mfloracion = $('input:checkbox[name=mfloracion]:checked').val();
    fructificacion = $('input:checkbox[name=fructificacion]:checked').val();
    cosecha = $('input:checkbox[name=cosecha]:checked').val();


    if (inicio == undefined && vegetativo == undefined && ifloracion == undefined && mfloracion == undefined && fructificacion == undefined && cosecha == undefined) {

        toastr.error('Por favor solo seleccione al menos una opción', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });

    } else {
        if (inicio != undefined) {
            etapas = etapas + " - " + "Inicio";
        }
        if (vegetativo != undefined) {
            etapas = etapas + " - " + "Crecimiento";
        }
        if (ifloracion != undefined) {
            etapas = etapas + " - " + "Inicio floracion";
        }
        if (mfloracion != undefined) {
            etapas = etapas + " - " + "Maxima floracion";
        }
        if (fructificacion != undefined) {
            etapas = etapas + " - " + "Fructificacion";
        }
        if (cosecha != undefined) {
            etapas = etapas + " - " + "Cosecha";
        }

        cadena = "etapas=" + etapas +
            "&cod_afe=" + global.trim();

        $.ajax({
            type: "post",
            url: "../php/crud/plagas_enfermedades/actualizar_etapas.php",
            data: cadena,
            success: function(r) {
                if (r.includes('Resource id')) {

                    toastr.success('¡Etapas afectadas actualizadas!', '', {
                        "positionClass": "toast-bottom-right",
                        "closeButton": false,
                        "progressBar": true
                    });
                    $('#modal-etapas-afe-up').modal('hide');
                    if (tipod == 'E') {
                        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                    } else {
                        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
                    }
                }
            }
        });
    }
}
//--------------------------------------------------Actualizar sintomas--------------------------------------------//
function up_sintomas() {

    ajax = objetoAjax();
    ajax.open("POST", "../php/componentes/componentes_enfermedades_plagas/up_sintomas.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {

            document.getElementById("mostrar_sintomas_up").innerHTML = ajax.responseText;
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("cod_afe=" + global.trim());

}

function actualizarSintomas(datos, valores) {

    codigo_sintoma = "";
    datosS = datos.split('~');
    valoresS = valores.split('~');
    res = false;
    add = "";
    for (i = 1; i < datosS.length; i++) {

        resp = $('input:checkbox[name=' + datosS[i] + ']:checked').val();
        if (resp == 'on') {
            sintomas = sintomas + ", " + valoresS[i];
            codigo_sintoma = codigo_sintoma + "~" + datosS[i];
            res = true;
        }
    }
    if (res == false) {

        toastr.error('Por favor solo seleccione al menos una opción', '', {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "progressBar": true
        });
    } else {

        //alert(codigo_sintoma);
        cadena = "sintomas=" + codigo_sintoma +
            "&cod_afe=" + global.trim();

        $.ajax({
            type: "post",
            url: "../php/crud/plagas_enfermedades/actualizar_sintomas.php",
            data: cadena,
            success: function(r) {
                if (r.includes('Resource id')) {
                    toastr.success('¡Sintomas actualizados!', '', {
                        "positionClass": "toast-bottom-right",
                        "closeButton": false,
                        "progressBar": true
                    });
                    $('#modal-sintomas-up').modal('hide');
                    if (tipod == 'E') {
                        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                    } else {
                        $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
                    }
                }
            }
        });
    }
}


//---------------------------------------Eliminar plaga o enfermedad-----------------------------------//
function eliminar_plaga_enf(datos, tipo) {
    cod = datos.split('||');
    cod_afe = cod[0];
    tipoa = tipo;
    //alert("tipo "+ tipoa);

    swal({
            title: "¿Estás seguro?",
            text: "¿Deseas eliminar esta plaga o enfermedad?",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                cadena = "cod_afe=" + cod_afe.trim() +
                    "&tipoa=" + tipoa;
                $.ajax({
                    type: "post",
                    url: "../php/crud/plagas_enfermedades/comprobar_plaga_enfermedad.php",
                    data: cadena,
                    success: function(r) {
                        if (r.trim() == "") {
                            $.ajax({
                                type: "post",
                                url: "../php/crud/plagas_enfermedades/eliminar_plaga_enfermedad.php",
                                data: cadena,
                                success: function(res) {
                                    if (res.includes('Resource id')) {

                                        if (tipo == "P") {
                                            swal("¡Plaga Eliminada!", " ", "success");
                                            $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_plagas.php');
                                        } else {
                                            swal("¡Enfermedad Eliminada!", " ", "success");
                                            $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
                                        }
                                    }
                                }
                            });
                        } else {
                            swal(r, {
                                icon: "info",
                            });
                        }
                    }
                });
            } else {
                swal("¡Cancelado!");
            }
        });
}
//--------------------------------------Inicio----------------------------------------//
$(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#tab_enfermedades').load('../php/componentes/componentes_enfermedades_plagas/tab_enfermedades.php');
    $('#menu').load('../php/componentes/menu/menu.php');

    $('#nom_afe').keydown(function() {
        
        $('#div_nom_afe').addClass("input-group input-group-alternative");
    });

    $('#nomc_afe').keydown(function() {
        $('#div_nomc_afe').addClass("input-group input-group-alternative");
    });

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#det_semup').keydown(function() {
        $('#div_det_semup').addClass("input-group-alternative");
    });

    $('#modal-partes-afe').on('hidden.bs.modal', function(e) {
        $('#modal-form').modal('toggle');
    })



});

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