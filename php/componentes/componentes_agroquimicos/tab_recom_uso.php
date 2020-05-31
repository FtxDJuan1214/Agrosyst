<?php
require '../../conexion.php';
?>

    <div class="card-shadow form-group">
        <div class="card-header">
        <h4 style="font-family:'FontAwesome',tahoma; font-size: 12px;" align="center">Recomendaciones de Uso</h4>
        </div>
                <table class="table align-items-center table-flush table-hover" data-toggle="tooltip" data-placement="left"
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
                                    <textarea id="rus_agr" name="rus_agr"class="form-control" pattern="[A-Za-z0-9]{1,200}"
                                             rows="4"></textarea>
                                </div>
                                
                            </td>
                            <td>
                                <input type="button" name="add" class="btn btn-primary sm-3" data-toggle="tooltip" value="&#xf0a5"
                                data-placement="left" title="Agregar recomendación" style="font-family:'FontAwesome', tahoma; font-size:15px;" 
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