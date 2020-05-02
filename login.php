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
<head>
    <title>Login Agrosyst</title>
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
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="post" action="php/logueo.php" class="formlog">
                    <span class="login100-form-title p-b-26">
                        Bienvenido
                    </span>
                    <span class="login100-form-title p-b-48">
                        <img src="imagenes/Logo.png" alt="Logotipo agrosyst" style="width:75px; align-self: center;">
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <input class="input100" type="text"  required name="usuario" autocomplete="off">
                        <span class="focus-input100" data-placeholder="Usuario"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password"  required name="contraseña">
                        <span class="focus-input100" data-placeholder="Contraseña"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit">
                                Login
                            </button>
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

</body>
</html>