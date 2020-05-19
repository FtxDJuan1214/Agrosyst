<?php
require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];

$cod_cul =$_POST['cod_cul'];
?>

<div class="text-center text-muted mb-4">
    <h4 style="font-family:'FontAwesome',tahoma; font-size: 14px;" align="center">
        HISTORIAL NUTRICIONAL
    </h4>
</div>

<table class="table align-items-center table-flush table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col">
                <center>Nombre tarea</center>
            </th>
            <th scope="col">
                <center>Descripción</center>
            </th>
            <th scope="col">
                <center>Fecha</center>
            </th>
            <th>
                <center>Insumo</center>
            </th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 

        $sql="SELECT tarea.cod_tar, labores.nom_lab, tarea.des_tar, tarea.fin_tar, stock.cod_ins, insumos.des_ins
        from tarea
        INNER JOIN utilizar ON utilizar.cod_tar = tarea.cod_tar
        INNER JOIN stock ON stock.cod_sto = utilizar.cod_sto
        INNER JOIN insumos on insumos.cod_ins = stock.cod_ins
        INNER JOIN labores ON tarea.cod_lab = labores.cod_lab
        INNER JOIN efectuar ON efectuar.cod_tar=tarea.cod_tar
        INNER JOIN convenio ON convenio.cod_con=efectuar.cod_con
        INNER JOIN ejecutar ON ejecutar.cod_con=convenio.cod_con
        INNER JOIN cultivos ON cultivos.cod_cul=ejecutar.cod_cul
        INNER JOIN fertilizantes ON fertilizantes.cod_ins=insumos.cod_ins
        AND cultivos.cod_cul = '$cod_cul'
        ORDER BY tarea.des_tar ASC";
        
        $result=pg_query($conexion,$sql);
        while($ver=pg_fetch_row($result)){  
            
            ?>
        <tr>
            <td>
                <center><?php echo $ver[1] ?></center>
            </td>
            <td>
                <center><?php echo $ver[2] ?></center>
            </td>
            <td>
                <center><?php echo $ver[3] ?></center>
            </td>
            <td>
                <center><?php echo $ver[5] ?></center>
            </td>
        </tr>
        <?php 
  }
  ?>
    </tbody>
</table>

<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>