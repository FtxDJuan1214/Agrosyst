<?php 
require '../../conexion.php';
?>
<script src="../assets/js/argon.js?v=1.0.0"></script>
<?php 
$fecha=$_POST['fecha'];
$cadena="<div class='form-group'>
                    <label id='lbl_fec' > fecha inicio:</label>
                    <div class='input-group input-group-alternative'>
                      <div class='input-group-prepend'>
                        <span class='input-group-text'><i class='ni ni-calendar-grid-58'></i></span>
                      </div>
                    <input class='form-control datepicker' id='fin_cul_up' placeholder='Select date' type='text'value='$fecha'>
                  </div>
                </div>";

echo $cadena;
?>
