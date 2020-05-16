<?php
require '../../conexion.php';
?>

    <div class="card-shadow form-group">
        <div class="card-header">
        <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;" align="center">Recomendaciones de Uso</h4>
        </div>
                <table class="table align-items-center table-flush table-hover" data-toggle="tooltip" data-placement="top"
                    title="Recomendaciones que nos ayudan a recordarte a proteger tu salud. No es obligatorio.">
                    <thead class="thead-light">
                        <tr>
                            <td>Recomedación</td>
                            <td>Agregar</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" hidden  id="cod_agr_rus" name="cod_agr_rus">
                                <div>
<<<<<<< HEAD
                                    <textarea id="rus_agr" name="rus_agr"class="form-control" pattern="[A-Za-z0-9]{1,200}"
                                             rows="4"></textarea>
=======
                                    <input type="text" name="rus_agr" id="rus_agr" class="form-control">
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                </div>
                                
                            </td>
                            <td>
<<<<<<< HEAD
                                <input type="button" name="add" class="btn btn-primary sm-3" data-toggle="tooltip" value="&#xf0a5"
                                data-placement="top" title="Agregar recomendación" style="font-family:'FontAwesome', tahoma; font-size:10px;" 
=======
                                <input type="button" name="add" class="btn btn-info sm-3" data-toggle="tooltip" value="&#xf05a"
                                data-placement="top" title="Agregar" style="font-family:'FontAwesome', tahoma; font-size:10px;" 
>>>>>>> 8413f4c33df2dae8e7aee7ec4cd79e75b50ce894
                                onclick="cargarTablaAdd($('#cod_agr_rus').val()+'_'+$('#rus_agr').val())">
                            </td>
                        
                        </tr>
                    </tbody>

                </table>
    </div>


<script>
$(document).ready(function(){
   $('#cod_agr').keyup(function(){
    var value = $(this).val();
    $('#cod_agr_rus').val(value);

   });
});
</script>