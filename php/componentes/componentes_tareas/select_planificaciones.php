<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$cod_afe =$_POST['cod_afe'];

?>

<div class="input-group input-group-alternative">
    <select id="cod_plan" name="cod_plan" class="form-control" data-live-search="true" onchange="(mostrarPlanificacion());">
        <option value="">Selecciona planificación
        </option>
        <?php 

            $query="SELECT planificacion.cod_pla,planificacion.fec_pla,planificacion.det_pla from public.planificacion, public.procesos_fitosanitarios
            WHERE planificacion.cod_pfi = procesos_fitosanitarios.cod_pfi
            AND procesos_fitosanitarios.cod_afe = '$cod_afe'
            AND procesos_fitosanitarios.ffi_pfi is NULL";
            $result =pg_query($conexion,$query);
            while ($ver=pg_fetch_row($result)) {
                $sep = explode("-", $ver[0]);
            ?>

        <option value="<?php echo $ver[0] ?>"> N° <?php echo $sep[1] ?> - <?php echo $ver[2]?> - <?php echo $ver[1]?></option>

        <?php 
            }
        ?>
    </select>
</div>
<?php 

?>