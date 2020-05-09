<?php
require '../../conexion.php';
?>

    <div class="card-shadow form-group">
        <div class="card-header">
            Métodos de prevención
        </div>
                <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                        <tr>
                            <td>Método</td>
                            <td>Agregar</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" hidden  id="cod_agr_rus" name="cod_agr_rus">
                                <div>
                                    <input type="text" name="rus_agr" id="rus_agr" class="form-control">
                                </div>
                                
                            </td>
                            <td>
                                <input type="button" name="add" class="btn btn-info sm-3" data-toggle="tooltip" value="&#xf05a"
                                data-placement="top" title="Agregar" style="font-family:'FontAwesome', tahoma; font-size:10px;" 
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