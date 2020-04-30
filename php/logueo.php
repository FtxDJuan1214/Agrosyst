<?php
    session_start();
    require 'conexion.php';
    $usuario= $_POST['usuario'];
    $contraseña= $_POST['contraseña'];

    $consulta= "SELECT * FROM public.usuario WHERE  usu_usu='$usuario' and pas_usu='$contraseña'";
    $result=pg_query($conexion,$consulta);
    $filas=pg_num_rows($result);

    if($filas>0){
        $r = pg_fetch_row($result);
        $_SESSION['idusuario']=$r[0]."-";
        $_SESSION['usuario']=$usuario;
        header("location:../index.php");

        date_default_timezone_set('America/Bogota');
        $d = date("d");
        $m = date("m");
        $y = date("Y");
        $_SESSION['fecha_log']=$y."-".$m."-".$d;
    }else{
        header("location:../login.php");
    }
    pg_free_result($result);
    pg_close($conexion);