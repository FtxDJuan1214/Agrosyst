  <?php 
  session_start();
  require '../../conexion.php';
  $cod_cul =$_POST['cod_cul'];
  $fin_tar =$_POST['fin_tar'];
  $fif_tar =$_POST['fif_tar'];
  $total =$_POST['total'];
  $tarea =$_POST['tar'];
  ?>
  <div class="row">
    <h3 class="modal-title centered">Convenios desde <?php echo $fin_tar." a ".$fif_tar; ?></h3><br><br>
    <div class="card bg-default shadow" style="width: 100%; ">
      <div class="table-responsive">
        <table class="table align-items-center table-dark table-flush">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Fechas</th>
              <th scope="col">Trabajador</th>
              <th scope="col">Socio</th>
              <th scope="col">Valor</th>
              <th scope="col">Agregar</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $codi_fin=$_SESSION['ide_finca'];
            $sql="SELECT convenio.cod_con,convenio.fec_con,fincas.cod_fin, fincas.nom_fin, cultivos.cod_cul, nombre_cultivo.des_ncu
            FROM public.fincas, public.lotes, public.cultivos, public.nombre_cultivo, public.ejecutar, 
            public.convenio
            WHERE fincas.cod_fin=lotes.cod_fin AND lotes.cod_lot=cultivos.cod_lot
            AND nombre_cultivo.cod_ncu=cultivos.cod_ncu AND cultivos.cod_cul=ejecutar.cod_cul 
            AND convenio.cod_con=ejecutar.cod_con  and cultivos.cod_cul = '$cod_cul' and fincas.cod_fin='$codi_fin' 
            AND convenio.fec_con between '$fin_tar' and '$fif_tar'
            ORDER BY convenio.fec_con DESC";
            $result=pg_query($conexion,$sql);
            while($ver=pg_fetch_row($result)){

             $validar = " SELECT * FROM efectuar where cod_con = '$ver[0]'";
             $rex=pg_query($conexion,$validar);
             $filas=pg_num_rows($rex);
             if ($filas == 0) {
             $datos=$ver[0]."||".$cod_cul."||".$fin_tar."||".$fif_tar."||".$total."||".$tarea;
             ?>
             <tr>
               <td><?php echo $ver[1] ?></td>


               <?php
               $sql1="SELECT  ide_ter
               FROM public.act_con where cod_con='$ver[0]'"; 
               $r=pg_query($conexion,$sql1);
               $persona="";
               $cont = 0;
               while($se=pg_fetch_row($r)){
                ?>
                <td><?php
                $q="SELECT terceros.ide_ter,pno_ter,sno_ter,pap_ter,sap_ter
                FROM public.terceros WHERE terceros.ide_ter ='$se[0]'";
                $ress =pg_query($conexion,$q);
                $noms=pg_fetch_row($ress);
                if($cont==0){
                  $cont++;
                }
                echo $noms[1]." ".$noms[2]."<br>".$noms[3]." ".$noms[4];
                $persona=$se[0]."*".$persona;
                ?>
              </td>
              <?php 
            }
            ?>


            <td><?php 
            $sql2=" SELECT hor_jor,vho_jor FROM jornales WHERE cod_con='$ver[0]'"; 
            $result1=pg_query($conexion,$sql2);
            $see=pg_fetch_row($result1);
            if($see!=0){
  
              echo "Pago jornal: <br>".($see[0]*$see[1]);
              $datos = $datos."||".($see[0]*$see[1]);
            }

            $sql2="SELECT val_cot,convenio.fec_con,ffi_con,des_cot FROM contratos INNER JOIN convenio on contratos.cod_con=convenio.cod_con 
            and contratos.cod_con='$ver[0]'"; 
            $result1=pg_query($conexion,$sql2);
            $see=pg_fetch_row($result1);
            if($see!=0){
             echo 'Valor contrato: <br>'.$see[0];
             $datos = $datos."||".$see[0];
           }
           ?></td>
           <td> <button class="btn btn-sm btn-secondary btn-icon-only rounded-circle" type="button" 
            onclick="addconveniosup('<?php  echo $datos ?> ')">
            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
          </button></td>

        </tr>
        <?php 
      }
      }
      ?>
    </tbody>
  </table>
</div>
</div>
</div>