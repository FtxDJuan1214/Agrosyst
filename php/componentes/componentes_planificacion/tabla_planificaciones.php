<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$info=$_POST['info'];    
$array = explode('*',$info);
$lenght=count($array);

$div = "";
$name = "";
$grupo = "";

if($lenght == 2){
    $grupo = explode('||',$array[1]);
    $name = $array[0];
}else if($lenght == 3){
    $grupo = explode('||',$array[2]);
    $query="SELECT afeccion.nom_afe FROM afeccion WHERE cod_afe='$array[1]'";
                                    $result =pg_query($conexion,$query);
                                    $ver=pg_fetch_row($result);
                                    $name = $array[0].' - '.$ver[0];
}     


$contar=count($grupo)-1;

?>



<div id="tab_plan" name="tab_plan">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <strong>Lista de planificaciones</strong>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Tipo</th>
                                <th scope="col">Agroquímico</th>
                                <th scope="col">Ingrediente activo</th>
                                <th scope="col">Dosis</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                for($i=0;$i<$contar;$i++){

                                    $div = explode('/',$grupo[$i]);                                
                            ?>
                            <tr>
                            
                                <td><?php echo $div[0] ?></td>
                                <td><?php echo $div[1] ?></td>
                                <td><?php echo $div[2] ?></td>
                                <td><?php echo $div[3] ?></td>
                                <td><?php echo $div[4] ?></td>
                                
                            </tr>
                            <?php 
                                }
                                ?>

                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: center;">
                    <a style="align-self: center;" class="btn btn-success my-4"
                        onclick="terminar_plan();">Terminar planificación</a>
                    <a style="align-self: center;" class="btn btn-warning my-4">Cancelar</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; 2019 <a href="#" class="font-weight-bold ml-1" target="_blank">Agrosyst</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="#" class="nav-link" target="_blank">Ver manual</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" target="_blank">Sobre nosotros</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</div>

<script>
$(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>