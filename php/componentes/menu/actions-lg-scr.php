 <li class="nav-item dropdown">
     <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <div class="media align-items-center">
             <span class="avatar avatar-sm rounded-circle">
                 <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.png">
             </span>
             <div class="media-body ml-2 d-none d-lg-block">
                 <span class="mb-0 text-sm  font-weight-bold">Administrador</span>
             </div>
         </div>
     </a>
     <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
         <div class=" dropdown-header noti-title">
             <h6 class="text-overflow m-0">Bienvenido!</h6>
         </div>
         <a id="ver1" href="#" class="dropdown-item" onclick="cerrar_menu();">
             <i class="ni ni-align-left-2"></i>
             <span>Cerrar menu</span>
         </a>
         <a id="ver2" href="" class="dropdown-item">
             <i class="ni ni-align-left-2"></i>
             <span>Ver menu</span>
         </a>
         <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-perfil">
             <i class="ni ni-single-02"></i>
             <span>Mi Perfil</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="../php/logout.php" class="dropdown-item">
             <i class="ni ni-user-run"></i>
             <span>Cerrar sesión</span>
         </a>
     </div>
 </li>


 <script type="text/javascript">
jQuery('#ver2').hide();
 </script>


 <!-- Modales -->

 <div class="modal fade" id="modal-perfil" tabindex="-1" role="dialog" aria-labelledby="modal-perfil" aria-hidden="true"
     style="z-index: 1000;">
     <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
         <div class="modal-content bg-gradient-primary">

             <div class="modal-header">
                 <h5 class="modal-title" id="modal-title-notification">Mi perfil</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>

             <div class="modal-body">
                 <?php 
        session_start();
        require "../../conexion.php";
        $like = $_SESSION['idusuario'];
        $id = explode("-",$like);
        $user="SELECT * FROM public.usuario WHERE  id_usu='$id[0]'";
        $res=pg_query($conexion,$user);
        $datos = pg_fetch_row($res);
        ?>
                 <div class="py-3 text-center">
                     <i class="fa fa-user" style="font-size: 5rem;"></i>
                     <h2 class="text-white" id="nick"><?php echo $datos[3]; ?></h2>
                 </div>
                 <form>

                     <div class="row">
                         <div class="col-sm-4">

                             <div class="form-group mb-3">
                                 <label>Usuario:</label>
                                 <div class="input-group input-group-alternative">
                                     <input style="border-color: #fb6340;" id="usu_usu" type="text" disabled
                                         class="form-control" autocomplete="off" value="<?php echo $datos[1] ?>">
                                 </div>
                             </div>

                         </div>
                         <div class="col-sm-8">

                             <div class="form-group mb-3">
                                 <label>Correo:</label>
                                 <div class="input-group input-group-alternative">
                                     <input style="border-color: #fb6340;" type="text" class="form-control" id="email"
                                         autocomplete="off" disabled value="<?php
                  echo $datos[4]?>">
                                 </div>
                             </div>

                         </div>
                         <div class="col-sm-12 text-center">
                             <hr class="dashed" style="border: dashed 2px;">
                             <h3 class="text-white">Cambiar contraseña</h3>
                         </div>

                         <div class="col-sm-12">

                             <div class="form-group mb-3">
                                 <label>Contraseña actual: </label>

                                 <div class="form-group">
                                     <div class="input-group" id="div_cont_act">
                                         <input class="form-control" placeholder="contraseña" type="password"
                                             id="cont_act">
                                         <div class="input-group-append">
                                             <span class="input-group-text"><a href="#" onclick="ver_con_1();"><i
                                                         class="fa fa-eye-slash"></i></a></span>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div class="form-group mb-3">

                                 <label>Nueva contraseña:</label>
                                 <div class="alert alert-danger" role="alert" style="font-size:0.8rem;" id="alerta">

                                 </div>
                                 <script>
                                 jQuery('#alerta').hide();
                                 </script>
                                 <div class="form-group">
                                     <div class="input-group" id="div_new_cont1">
                                         <input class="form-control" placeholder="contraseña" type="password"
                                             id="new_cont1">
                                         <div class="input-group-append">
                                             <span class="input-group-text"><a href="#" onclick="ver_con_2();"><i
                                                         class="fa fa-eye-slash"></i></a></span>
                                         </div>
                                     </div>
                                 </div>
                             </div>


                         </div>
                         <div class="col-sm-12">
                             <div class="form-group mb-3">
                                 <label>Confirmar contraseña: </label>

                                 <div class="form-group">
                                     <div class="input-group" id="div_new_cont2">
                                         <input class="form-control" placeholder="contraseña" type="password"
                                             id="new_cont2">
                                         <div class="input-group-append">
                                             <span class="input-group-text"><a href="#" onclick="ver_con_3();"><i
                                                         class="fa fa-eye-slash"></i></a></span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>





                 </form>

                 <div align="center">
                     <button type="button" class="btn btn-white" id="guardar" onclick="cambiar_contraseña()"
                         disabled>Actualizar información</button>
                 </div>

             </div>
         </div>

     </div>
 </div>

 <script>
$('#modal-perfil').on('show.bs.modal', function(e) {
    setTimeout("$('.modal-backdrop').removeClass('modal-backdrop');", 100);
});


function cambiar_contraseña() {
    contraseña_actual = $('#cont_act').val();
    contraseña_nueva1 = $('#new_cont1').val();
    contraseña_nueva2 = $('#new_cont2').val();

    mensaje =
        "Hola, su contraseña se ha cambiado correctamente. Deberá utilizarla la próxima vez que inicie sesión en el sistema.";
    title = 'Cambio de contraseña Agrosyst Co';

    if (contraseña_actual == "") {

        $("#cont_act").css("border-color", "#fb6340");
        toastr.error('Debe digitar la contraseña actual.', '', {
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar": true
        });

    } else if (contraseña_nueva1 == "") {
        $("#new_cont1").css("border-color", "#fb6340");
        toastr.error('Debe digitar la nueva contraseña actual.', '', {
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar": true
        });

    } else if (contraseña_nueva2 == "") {
        $("#new_cont2").css("border-color", "#fb6340");
        toastr.error('Debe confirmar la nueva contraseña.', '', {
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar": true
        });

    } else if (contraseña_nueva1 != contraseña_nueva2) {

        $("#new_cont1").css("border-color", "#fb6340");
        $("#new_cont2").css("border-color", "#fb6340");

        toastr.error('Las contraseñas no coinciden, por favor verifique.', '', {
            "positionClass": "toast-top-center",
            "closeButton": true,
            "progressBar": true
        });
    } else {

        $.ajax({
            type: "post",
            data: "con_usu=" + contraseña_actual + "&usu_usu=" + $('#usu_usu').val(),
            url: "../php/crud/usuarios/verificar.php",
            success: function(r) {
                if (r.trim() == "1") {
                    $.ajax({
                        type: "post",
                        data: "new_con=" + contraseña_nueva1,
                        url: "../php/crud/usuarios/actualizar_usuario.php",
                        success: function(e) {

                            if (e.includes('Resource id')) {

                                toastr.success('La contraseña se cambio.', '', {
                                    "positionClass": "toast-top-center",
                                    "closeButton": true,
                                    "progressBar": true
                                });

                                $.ajax({
                                    type: "post",
                                    data: "ema_usu=" + $('#email').val().trim() +
                                        "&nic_usu=" + $('#nick').text().trim() +
                                        "&mensaje=" + mensaje.trim() + "&title=" + title
                                        .trim(),
                                    url: "../php/crud/usuarios/enviar_correo.php",
                                    success: function(r) {
                                        setTimeout(
                                            "window.location.replace('../php/logout.php');",
                                            2000);
                                    }
                                });


                            } else {
                                alert(r);
                            }
                        }

                    });
                } else if (r.trim() == "0") {
                    $("#cont_act").css("border-color", "#fb6340");
                    toastr.error('La contraseña no actual no es correcta.', '', {
                        "positionClass": "toast-top-center",
                        "closeButton": true,
                        "progressBar": true
                    });
                }
            }

        });
    }
}

$('#cont_act').keydown(function() {
    $("#cont_act").css("border-color", "#cad1d7");
});
$('#new_cont1').keyup(function() {
    $("#new_cont1").css("border-color", "#cad1d7");
    medidor();
});
$('#new_cont2').keydown(function() {
    $("#new_cont2").css("border-color", "#cad1d7");
});


function medidor() {
    mensaje = "";

    contraseña = $('#new_cont1').val();
    var espacios = false;
    var letras = false;
    var mayusculas = false;
    var numeros = false;
    var cont = 0;

    if (contraseña.length != 0) {
        while (!espacios && (cont < contraseña.length)) {
            if (contraseña.charAt(cont) == " ")
                espacios = true;
            cont++;
        }

        for (var x = 0; x < contraseña.length; x++) {
            var c = contraseña.charAt(x);
            if ((c >= 'a' && c <= 'z')) {
                letras = true;
            }
        }

        for (var x = 0; x < contraseña.length; x++) {
            var c = contraseña.charAt(x);
            // Si no está entre a y z, ni entre A y Z, ni es un espacio
            if ((c >= 'A' && c <= 'Z')) {
                mayusculas = true;
            }
        }

        for (var x = 0; x < contraseña.length; x++) {
            var c = contraseña.charAt(x);
            // Si no está entre a y z, ni entre A y Z, ni es un espacio
            if ((parseInt(c) >= 0 && parseInt(c) <= 9)) {
                numeros = true;
            }
        }

        fuerza = 0;

        if (contraseña.length < 12) {

            mensaje += "☹️ La contraseña debe tener mínimo 12 caracteres (" + (contraseña.length) + "/12)<br>";

        } else {
            fuerza++;
        }

        if (!letras) {
            mensaje += "☹️ La contraseña debe tener letras<br>";
        } else {
            fuerza++;
        }

        if (!mayusculas) {
            mensaje += "☹️ La contraseña debe tener al menos una mayúscula<br>";
        } else {
            fuerza++;
        }

        if (!numeros) {
            mensaje += "☹️ La contraseña debe tener números<br>";
        } else {
            fuerza++;
        }

        special = /^(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:"'<>,./?])/;

        if (!special.test(contraseña)) {
            mensaje += "☹️ La contraseña debe tener al menos un caracter especial, ejemplo: '@#$%^&*'<br>";
        } else {
            fuerza++;
        }

        if (espacios) {
            mensaje += "☹️ La contraseña no puede contener espacios en blanco<br>";
            $('#alerta').removeClass("alert-info");
            $('#alerta').removeClass("alert-success");
            $('#alerta').removeClass("alert-warning");

            $('#alerta').addClass("alert-danger");

            $('#guardar').prop("disabled", true);

        } else {

            if (fuerza >= 0 && fuerza < 2) {

                $('#alerta').removeClass("alert-info");
                $('#alerta').removeClass("alert-success");
                $('#alerta').removeClass("alert-warning");

                $('#alerta').addClass("alert-danger");

            } else if (fuerza >= 2 && fuerza < 4) {
                $('#alerta').removeClass("alert-info");
                $('#alerta').removeClass("alert-success");
                $('#alerta').removeClass("alert-danger");

                $('#alerta').addClass("alert-warning");

            } else if (fuerza == 4) {
                $('#alerta').removeClass("alert-danger");
                $('#alerta').removeClass("alert-success");
                $('#alerta').removeClass("alert-warning");

                $('#alerta').addClass("alert-info");

            } else if (fuerza == 5) {
                $('#alerta').removeClass("alert-info");
                $('#alerta').removeClass("alert-warning");
                $('#alerta').removeClass("alert-danger");

                $('#alerta').addClass("alert-success");

                mensaje += "🙂 La contraseña es segura<br>";
                $('#guardar').prop("disabled", false);
            }
            if (fuerza != 5) {
                $('#guardar').prop("disabled", true);
            }
        }
        document.getElementById("alerta").innerHTML = mensaje;
        jQuery('#alerta').show();

    } else {
        jQuery('#alerta').hide();
    }

}

function ver_con_1() {
    if ($('#div_cont_act input').attr("type") == "text") {
        $('#div_cont_act input').attr('type', 'password');
        $('#div_cont_act i').addClass("fa-eye-slash");
        $('#div_cont_act i').removeClass("fa-eye");
    } else if ($('#div_cont_act input').attr("type") == "password") {
        $('#div_cont_act input').attr('type', 'text');
        $('#div_cont_act i').removeClass("fa-eye-slash");
        $('#div_cont_act i').addClass("fa-eye");
    }
}


function ver_con_2() {
    if ($('#div_new_cont1 input').attr("type") == "text") {
        $('#div_new_cont1 input').attr('type', 'password');
        $('#div_new_cont1 i').addClass("fa-eye-slash");
        $('#div_new_cont1 i').removeClass("fa-eye");
    } else if ($('#div_new_cont1 input').attr("type") == "password") {
        $('#div_new_cont1 input').attr('type', 'text');
        $('#div_new_cont1 i').removeClass("fa-eye-slash");
        $('#div_new_cont1 i').addClass("fa-eye");
    }
}


function ver_con_3() {
    if ($('#div_new_cont2 input').attr("type") == "text") {
        $('#div_new_cont2 input').attr('type', 'password');
        $('#div_new_cont2 i').addClass("fa-eye-slash");
        $('#div_new_cont2 i').removeClass("fa-eye");
    } else if ($('#div_new_cont2 input').attr("type") == "password") {
        $('#div_new_cont2 input').attr('type', 'text');
        $('#div_new_cont2 i').removeClass("fa-eye-slash");
        $('#div_new_cont2 i').addClass("fa-eye");
    }
}
 </script>