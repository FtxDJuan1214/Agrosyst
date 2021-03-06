<li class="nav-item dropdown">
  <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="media align-items-center">
      <span class="avatar avatar-sm rounded-circle">
        <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.png">
      </span>
    </div>
  </a>
  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
      <h6 class="text-overflow m-0">Acciones!</h6>
    </div>
    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-perfil1">
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



<!-- Modales -->

<div class="modal fade" id="modal-perfil1" tabindex="-1" role="dialog" aria-labelledby="modal-perfil1" aria-hidden="true" style="z-index: 1000;">
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
          <h2 class="text-white" id="nick1"><?php echo $datos[3]; ?></h2>
        </div>
        <form>

          <div class="row">
            <div class="col-sm-4">

              <div class="form-group mb-3">
                <label>Usuario:</label>
                <div class="input-group input-group-alternative">
                  <input style="border-color: #fb6340;" id="usu_usu1" type="text" disabled class="form-control" autocomplete="off" value="<?php echo $datos[1] ?>">
                </div>
              </div>

            </div>
            <div class="col-sm-8">

              <div class="form-group mb-3">
                <label>Correo:</label>
                <div class="input-group input-group-alternative">
                  <input style="border-color: #fb6340;" type="text" class="form-control" id="email1" autocomplete="off" disabled value="<?php
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
                <div class="input-group" id="div_cont_act1">
                  <input class="form-control" placeholder="contraseña" type="password" id="cont_act1">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="#" onclick="ver_con_11();"><i class="fa fa-eye-slash"></i></a></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group mb-3">

              <label>Nueva contraseña:</label>
              <div class="alert alert-danger" role="alert" style="font-size:0.8rem;" id="alerta1">

              </div>
              <script>
                jQuery('#alerta1').hide();
              </script>
              <div class="form-group">
                <div class="input-group" id="div_new_cont11">
                  <input class="form-control" placeholder="contraseña" type="password" id="new_cont11">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="#" onclick="ver_con_22();"><i class="fa fa-eye-slash"></i></a></span>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <div class="col-sm-12">
            <div class="form-group mb-3">
              <label>Confirmar contraseña: </label>

              <div class="form-group">
                <div class="input-group" id="div_new_cont22">
                  <input class="form-control" placeholder="contraseña" type="password" id="new_cont22">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="#" onclick="ver_con_33();"><i class="fa fa-eye-slash"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>





      </form>

      <div align="center">
        <button type="button" class="btn btn-white" id="guardar1" onclick="cambiar_contraseña1()" disabled>Actualizar información</button>
      </div>

    </div>
  </div>

</div>
</div>



<script >
  $('#modal-perfil1').on('show.bs.modal', function (e) {
    setTimeout("$('.modal-backdrop').removeClass('modal-backdrop');", 100);
  });


  function cambiar_contraseña1(){
    contraseña_actual = $('#cont_act1').val();
    contraseña_nueva1 = $('#new_cont11').val();
    contraseña_nueva2 = $('#new_cont22').val();

    mensaje="Hola, su contraseña se ha cambiado correctamente. Deberá utilizarla la próxima vez que inicie sesión en el sistema.";
    title = 'Cambio de contraseña Agrosyst Co';

    if(contraseña_actual == ""){

      $("#cont_act1").css("border-color", "#fb6340");
      toastr.error('Debe digitar la contraseña actual.', '', {
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar": true
      });

    }else if (contraseña_nueva1 == ""){
     $("#new_cont11").css("border-color", "#fb6340");
     toastr.error('Debe digitar la nueva contraseña actual.', '', {
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar": true
    });

   }else if(contraseña_nueva2 ==""){
    $("#new_cont22").css("border-color", "#fb6340");
    toastr.error('Debe confirmar la nueva contraseña.', '', {
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar": true
    });

  }else if (contraseña_nueva1 != contraseña_nueva2) {

    $("#new_cont11").css("border-color", "#fb6340");
    $("#new_cont22").css("border-color", "#fb6340");

    toastr.error('Las contraseñas no coinciden, por favor verifique.', '', {
      "positionClass": "toast-top-center",
      "closeButton": true,
      "progressBar": true
    });
  }else{

    $.ajax({
      type:"post",
      data:"con_usu="+contraseña_actual+"&usu_usu="+$('#usu_usu1').val(),
      url:"../php/crud/usuarios/verificar.php",
      success:function(r){
        if (r.trim() == "1") {
          $.ajax({
            type: "post",
            data: "new_con="+contraseña_nueva1,
            url:"../php/crud/usuarios/actualizar_usuario.php",
            success:function(e){

              if (e.includes('Resource id')) {

                toastr.success('La contraseña se cambio.', '', {
                  "positionClass": "toast-top-center",
                  "closeButton": true,
                  "progressBar": true
                });

                $.ajax({
                  type: "post",
                  data: "ema_usu=" + $('#email1').val().trim()+"&nic_usu=" +$('#nick1').text().trim() +"&mensaje="+mensaje.trim()+"&title="+title.trim(),
                  url:"../php/crud/usuarios/enviar_correo.php",
                  success:function(r){
                    setTimeout("window.location.replace('../php/logout.php');",2000);
                  }
                });

                
              }else{
                alert(r);
              }
            }

          });
        }else if(r.trim()== "0"){
          $("#cont_act1").css("border-color", "#fb6340");
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

$('#cont_act1').keydown(function(){
  $("#cont_act1").css("border-color", "#cad1d7");
});
$('#new_cont11').keyup(function(){
 $("#new_cont11").css("border-color", "#cad1d7");
 medidor1();
});
$('#new_cont22').keydown(function(){
  $("#new_cont22").css("border-color", "#cad1d7");
});


function medidor1(){
  mensaje = "";

  contraseña = $('#new_cont11').val();
  var espacios = false;
  var letras = false;
  var mayusculas = false;
  var numeros = false;
  var cont = 0;

  if (contraseña.length !=0) {
    while (!espacios && (cont < contraseña.length)) {
      if (contraseña.charAt(cont) == " ")
        espacios = true;
      cont++;
    }

    for (var x = 0; x < contraseña.length; x++) {
      var c = contraseña.charAt(x);
      if ((c >= 'a' && c <= 'z')) {
        letras =  true;
      }
    }

    for (var x = 0; x < contraseña.length; x++) {
      var c = contraseña.charAt(x);
        // Si no está entre a y z, ni entre A y Z, ni es un espacio
        if ((c >= 'A' && c <= 'Z')) {
          mayusculas =  true;
        }
      }

      for (var x = 0; x < contraseña.length; x++) {
        var c = contraseña.charAt(x);
        // Si no está entre a y z, ni entre A y Z, ni es un espacio
        if ((parseInt(c) >= 0 && parseInt(c) <= 9)) {
          numeros =  true;
        }
      }

      fuerza = 0;

      if (contraseña.length <12) {

        mensaje += "☹️ La contraseña debe tener mínimo 12 caracteres ("+ (contraseña.length)+"/12)<br>";

      }else{
       fuerza++;
     }

     if(!letras){
       mensaje += "☹️ La contraseña debe tener letras<br>";
     }else{
      fuerza++;
    }

    if(!mayusculas){
     mensaje += "☹️ La contraseña debe tener al menos una mayúscula<br>";
   }else{
    fuerza++;
  }

  if(!numeros){
   mensaje += "☹️ La contraseña debe tener números<br>";
 }else{
  fuerza++;
}

special = /^(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:"'<>,./?])/;

if (!special.test(contraseña)) {
 mensaje += "☹️ La contraseña debe tener al menos un caracter especial, ejemplo: '@#$%^&*'<br>";
}else{
 fuerza++;
}

if (espacios) {
  mensaje += "☹️ La contraseña no puede contener espacios en blanco<br>";
  $('#alerta1').removeClass("alert-info");
  $('#alerta1').removeClass("alert-success");
  $('#alerta1').removeClass("alert-warning");

  $('#alerta1').addClass("alert-danger");

  $('#guardar1').prop("disabled", true); 

}else{

  if (fuerza >= 0 && fuerza < 2) {

    $('#alerta1').removeClass("alert-info");
    $('#alerta1').removeClass("alert-success");
    $('#alerta1').removeClass("alert-warning");

    $('#alerta1').addClass("alert-danger");

  }else if (fuerza >=2 && fuerza < 4){
    $('#alerta1').removeClass("alert-info");
    $('#alerta1').removeClass("alert-success");
    $('#alerta1').removeClass("alert-danger");

    $('#alerta1').addClass("alert-warning");

  }
  else if (fuerza == 4){
    $('#alerta1').removeClass("alert-danger");
    $('#alerta1').removeClass("alert-success");
    $('#alerta1').removeClass("alert-warning");

    $('#alerta1').addClass("alert-info");

  }else if (fuerza ==5){
    $('#alerta1').removeClass("alert-info");
    $('#alerta1').removeClass("alert-warning");
    $('#alerta1').removeClass("alert-danger");

    $('#alerta1').addClass("alert-success");

    mensaje += "🙂 La contraseña es segura<br>";
    $('#guardar1').prop("disabled", false); 
  }
  if (fuerza != 5){
   $('#guardar1').prop("disabled", true); 
 }
}
document.getElementById("alerta1").innerHTML = mensaje;
jQuery('#alerta1').show();

}else{
 jQuery('#alerta1').hide();
}

}

function ver_con_11(){
  if($('#div_cont_act1 input').attr("type") == "text"){
    $('#div_cont_act1 input').attr('type', 'password');
    $('#div_cont_act1 i').addClass( "fa-eye-slash" );
    $('#div_cont_act1 i').removeClass( "fa-eye" );
  }else if($('#div_cont_act1 input').attr("type") == "password"){
    $('#div_cont_act1 input').attr('type', 'text');
    $('#div_cont_act1 i').removeClass( "fa-eye-slash" );
    $('#div_cont_act1 i').addClass( "fa-eye" );
  }
}


function ver_con_22(){
  if($('#div_new_cont11 input').attr("type") == "text"){
    $('#div_new_cont11 input').attr('type', 'password');
    $('#div_new_cont11 i').addClass( "fa-eye-slash" );
    $('#div_new_cont11 i').removeClass( "fa-eye" );
  }else if($('#div_new_cont11 input').attr("type") == "password"){
    $('#div_new_cont11 input').attr('type', 'text');
    $('#div_new_cont11 i').removeClass( "fa-eye-slash" );
    $('#div_new_cont11 i').addClass( "fa-eye" );
  }
}


function ver_con_33(){
  if($('#div_new_cont22 input').attr("type") == "text"){
    $('#div_new_cont22 input').attr('type', 'password');
    $('#div_new_cont22 i').addClass( "fa-eye-slash" );
    $('#div_new_cont22 i').removeClass( "fa-eye" );
  }else if($('#div_new_cont22 input').attr("type") == "password"){
    $('#div_new_cont22 input').attr('type', 'text');
    $('#div_new_cont22 i').removeClass( "fa-eye-slash" );
    $('#div_new_cont22 i').addClass( "fa-eye" );
  }
}
</script>
