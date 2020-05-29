<?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        header('location:index.php');
        }
        require_once 'php/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<style>
body {
        background-image: url("imagenes/Agro0.jpg");
} 
 
</style>
<head>
    <title>Registro de Usuario Agrosyst Co</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="assets/img/brand/favicon.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="librerias/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="librerias/Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="librerias/Login/css/util.css">
    <link rel="stylesheet" type="text/css" href="librerias/Login/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/scrollbar.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="librerias/Login/vendor/jquery/jquery-3.2.1.min.js"></script>

<!-- sweet_alert -->
<script src="assets/sweetalert/sweetalert.min.js"></script>

</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form role="form" id="form-add-usu" class="formlog">
                    <span class="login100-form-title p-b-26">
                        Nuevo Usuario
                    </span>
                    <span class="login100-form-title p-b-48">
                        <img src="imagenes/Logo.png" alt="Logotipo Agrosyst Cos" style="width:75px; align-self: center;">
                    </span>


                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text"  required id="nic_usu" name="nic_usu" autocomplete="off">
                        <span class="focus-input100" data-placeholder="Nombre"></span>
                    </div>

                    <div class="wrap-input100 validate-input input-group input-group-alternative" id="div_ema_usu" data-validate = "Valid email is: a@b.c">
                        <input class="input100" type="text"  required id="ema_usu" name="ema_usu" autocomplete="off">
                        <span class="focus-input100" data-placeholder="E-mail"></span>
                    </div>

                    <div class="wrap-input100 validate-input input-group input-group-alternative" data-validate = "Valid email is: a@b.c">
                        <input class="input100" type="text"  required id="usu_usu" name="usu_usu" autocomplete="off">
                        <span class="focus-input100" data-placeholder="Usuario"></span>
                    </div>

                    <div class="wrap-input100 validate-input input-group input-group-alternative" id="div_pas_usu" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password"  required id="pas_usu" name="pas_usu">
                        <span class="focus-input100" data-placeholder="Contraseña"></span>
                     
                    </div>

                    <div class="wrap-input100 validate-input input-group input-group-alternative" id="div_conf_pas_usu" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password"  required name="conf_pass" id="conf_pass">
                        <span class="focus-input100" data-placeholder="Confirme contraseña"></span>
                    </div>
                    
                    <div id="req_pas" class="alert alert-danger" role="alert" style="font-size: 0.8rem;">
                        <label for=""><strong>Requisitos de la contraseña</strong></label>
                        <ul>
                            <li id="special">Debe tener mínimo un caracter especial (.#$*@!)</li>
                            <li id="numbers">Debe tener mínimo un número</li>
                            <li id="mayus">Debe tener mínimo una mayúscula</li>
                            <li id="minus">Debe tener mínimo una minúscula</li>
                            <li id="lon">Debe tener mínimo 12 caracteres</li>
                            <li id="space">La contraseña no puede tener espacios</li>
                        </ul>
                    </div>
                    <div id="pas_ok" class="alert alert-success" role="alert"> 
                    <b>Contraseña segura</b>
                    </div>
                    <div id="req_conf" class="alert alert-danger" role="alert"> Las contraseñas no coinciden</div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" id="save" type="button" onclick="preloader();">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 p-t-20">
                            <a class="" href="login.php">
                                Iniciar sesion
                            </a>
                        </div>
                    </div>

                    
                </form>
                <img src="assets/img/icons/preloader.gif" id="preloader" style="margin: 10px auto;">
                    <script>
                      jQuery('#preloader').hide();
                    </script>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    

<!--===============================================================================================-->
    <script src="librerias/Login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="librerias/Login/vendor/bootstrap/js/popper.js"></script>
    <script src="librerias/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="librerias/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="librerias/Login/vendor/daterangepicker/moment.min.js"></script>
    <script src="librerias/Login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="librerias/Login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="librerias/Login/js/main.js"></script>
<!--===============================================================================================-->
    <script src="js/funciones_agregar_usu.js"></script>
    <!-- toastr -->
    <script src="assets/toastr/toastr.min.js"></script>
    <link type="text/css" href="assets/toastr/toastr.css" rel="stylesheet">

</body>
</html>



