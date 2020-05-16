<?php
require '../../conexion.php';
?>

<table class="table align-items-center table-flush table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col">CC</th>
            <th scope="col">Nombres</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Tipo Tercero</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
    session_start();
    $like = $_SESSION['idusuario'];
    $sql="SELECT * FROM public.terceros where terceros.ide_ter LIKE '$like%'"; 
    $result=pg_query($conexion,$sql);
    while($ver=pg_fetch_row($result)){
        ?>
        <tr>

            <td> <span class="bold"><?php 
            $partes=explode("-", $ver[0]);
            echo $partes[1] ?></span></td>
            <td><?php echo $ver[1].' '.$ver[2].' '.$ver[3].' '.$ver[4] ?></td>

            <td>
                <?php 

             $sql2="SELECT tel_ter
             FROM public.tel_tercero where ide_ter='$ver[0]'"; 
             $result2=pg_query($conexion,$sql2);
             while($see1=pg_fetch_row($result2)){
                $longitud = count($see1);
                for($i=0; $i<$longitud; $i++){
                    echo $see1[$i]; 
                    echo "<br>";
                }}
                ?>
            </td>

            <td>
                <?php 

                $sql3="SELECT ema_ter
                FROM public.email_tercero where ide_ter='$ver[0]'"; 
                $result1=pg_query($conexion,$sql3);
                while($see=pg_fetch_row($result1)){
                    $longitud = count($see);
                    for($i=0; $i<$longitud; $i++){
                        echo $see[$i]; 
                        echo "<br>";
                    }}
                    ?>
            </td>

            <td>
                <?php 

                    $sql2="SELECT cod_tra
                    FROM public.trabajador where ide_ter='$ver[0]'"; 
                    $result1=pg_query($conexion,$sql2);
                    $see=pg_fetch_row($result1);
                    if($see!=0){
                        echo 'Trabajador';
                        $datos=$ver[0]."||".
                        $ver[1]."||".
                        $ver[2]."||".
                        $ver[3]."||".
                        $ver[4]."||".
                        '3';
                    }

                    $sql2="SELECT cod_soc
                    FROM public.socio where ide_ter='$ver[0]'"; 
                    $result1=pg_query($conexion,$sql2);
                    $see=pg_fetch_row($result1);
                    if($see!=0){
                        echo 'Socio';
                        $datos=$ver[0]."||".
                        $ver[1]."||".
                        $ver[2]."||".
                        $ver[3]."||".
                        $ver[4]."||".
                        '2';
                    }

                    $sql2="SELECT cod_pro
                    FROM public.proveedor where ide_ter='$ver[0]'"; 
                    $result1=pg_query($conexion,$sql2);
                    $see=pg_fetch_row($result1);
                    if($see!=0){
                        echo 'Proveedor';
                        $datos=$ver[0]."||".
                        $ver[1]."||".
                        $ver[2]."||".
                        $ver[3]."||".
                        $ver[4]."||".
                        '4';
                    }

                    $sql2="SELECT cod_due
                    FROM public.duenio where ide_ter='$ver[0]'"; 
                    $result1=pg_query($conexion,$sql2);
                    $see=pg_fetch_row($result1);
                    if($see!=0){
                        echo 'Duenio';
                        $datos=$ver[0]."||".
                        $ver[1]."||".
                        $ver[2]."||".
                        $ver[3]."||".
                        $ver[4]."||".
                        '1'; 
                    }

                    $sql2="SELECT cod_cli
                    FROM public.cliente where ide_ter='$ver[0]'"; 
                    $result1=pg_query($conexion,$sql2);
                    $see=pg_fetch_row($result1);
                    if($see!=0){
                        echo 'Cliente';
                        $datos=$ver[0]."||".
                        $ver[1]."||".
                        $ver[2]."||".
                        $ver[3]."||".
                        $ver[4]."||".
                        '5'; 
                    }

                    ?>
            </td>

            <td class="text-right">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#" onclick="llenarform(' <?php  echo $datos ?> ')">
                            <div><i class="fas fa-pencil-alt" style="margin-right: 14px;"></i>Editar</div>
                        </a>
                        <a class="dropdown-item" href="#" onclick="eliminar_tercero(' <?php  echo $datos ?> ')">
                            <div><i class="fas fa-times" style="margin-right: 14px;"></i>Eliminar</div>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        <?php 
}
?>
    </tbody>