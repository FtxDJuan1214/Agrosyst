<?php 

require '../../conexion.php';
session_start();
$like = $_SESSION['idusuario'];
$num_plan=$_POST['num_plan'];    
?>

<div class="form-group" id="cod_plan" name="cod_plan">
                                                            <input type="text" class="form-control" id="num_plan"
                                                                name="num_plan"
                                                                value="<?php echo "Planificación N°: ".($num_plan+1);?>"
                                                                autocomplete="off" readonly>
                                                        </div>