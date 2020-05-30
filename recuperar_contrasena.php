<?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        header('location:index.php');
        }
?>
<!DOCTYPE html>
<html lang="en">
<style>
body {
        background-image: url("imagenes/Agro0.jpg");
} 
 
</style>
<head><meta charset="gb18030">
    <title>Login Agrosyst Co</title>
    
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
<!--===============================================================================================-->
<!-- toastr -->
<script src="assets/toastr/toastr.min.js"></script>
<link type="text/css" href="assets/toastr/toastr.css" rel="stylesheet">

<!-- sweet_alert -->
<script src="assets/sweetalert/sweetalert.min.js"></script>

</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="post" action="php/logueo.php" class="formlog">
                    <span class="login100-form-title p-b-26">
                        Recuperación de contraseña
                    </span>
                    <span class="login100-form-title p-b-48">
                        <img src="imagenes/Logo.png" alt="Logotipo Agrosyst Co" style="width:75px; align-self: center;">
                    </span>
                    <div class="alert alert-info" role="alert"><center>
                                        Por favor ingrese el correo con el que se registró.</center></div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <input class="input100" type="email" autocomplete="off" id="correo" pattern=".+@globex.com">
                        <span class="focus-input100" data-placeholder="correo"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="button" onclick="recuperar();">
                                Recuperar
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
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="librerias/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
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

    <!-- funciones -->
    <script src="js/funciones_login.js"></script>

</body>
</html>