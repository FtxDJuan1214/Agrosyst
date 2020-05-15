 <?php 

 require '../../conexion.php';
 session_start();
 $like = $_SESSION['idusuario'];
 $cod_cul =$_POST['cod_cul'];    
 ?>

 <?php
 $queryasda="SELECT act_cul.ide_ter,terceros.pno_ter,terceros.sno_ter,terceros.pap_ter,terceros.sap_ter FROM public.act_cul 
 INNER JOIN terceros ON terceros.ide_ter = act_cul.ide_ter 
 where cod_cul='$cod_cul'";
 $resultasda =pg_query($conexion,$queryasda);
 if (pg_num_rows($resultasda) == 2) {
  $aporte_total_cultivo = 0;
  while ($ver=pg_fetch_row($resultasda)) {

    //Sacar cada socio
    $total_aporte = 0;
    //Buscar aportes por convenios ****************************************************************************************
    $sql1="SELECT DISTINCT convenio.cod_con, act_con.ide_ter, ejecutar.cod_cul FROM convenio , act_con, ejecutar ,efectuar
    where convenio.cod_con = act_con.cod_con and act_con.cod_con = efectuar.cod_con
    and efectuar.cod_con = ejecutar.cod_con and ejecutar.cod_cul = '$cod_cul' and ide_ter = '$ver[0]'"; 
    $r=pg_query($conexion,$sql1);
    while($se=pg_fetch_row($r)){
      // echo "---Convenio: ".$se[0];

      $sql2=" SELECT hor_jor,vho_jor FROM jornales WHERE cod_con='$se[0]'"; 
      $result1=pg_query($conexion,$sql2);
      $see=pg_fetch_row($result1);
      if($see!=0){
        // echo "      $".($see[0]*$see[1])."<br>";
        $total_aporte = $total_aporte + ($see[0]*$see[1]);
      }

      $sql2="SELECT val_cot,convenio.fec_con FROM contratos INNER JOIN convenio on contratos.cod_con=convenio.cod_con 
      and contratos.cod_con='$se[0]'"; 
      $result1=pg_query($conexion,$sql2);
      $see=pg_fetch_row($result1);
      if($see!=0){
        // echo "      $".$see[0]."<br>";
        $total_aporte = ($total_aporte + $see[0]);
      }

    }
    
    //echo "CC: ".$ver[0]."  ".$ver[1]." ".$ver[3].":  ".$total_aporte." Convenios <br>";


    //buscar aportes por insumos / gastos ********************************************************************************
    $total_insumos = 0;
    $sql5="SELECT DISTINCT cultivos.cod_cul, tarea.cod_tar, insumos.des_ins, utilizar.cin_tar, utilizar.pin_tar, 
    terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
    FROM duenio, terceros, act_cul, cultivos, ejecutar, convenio, efectuar, tarea, utilizar, stock, insumos, compras, registrar, comprar 
    WHERE cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con AND convenio.cod_con=efectuar.cod_con
    AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_tar=utilizar.cod_tar AND utilizar.cod_sto=stock.cod_sto
    AND stock.cod_ins=insumos.cod_ins AND stock.cod_sto = registrar.cod_sto  AND registrar.cod_com = compras.cod_com
    AND compras.cod_com = comprar.cod_com AND comprar.ide_ter = terceros.ide_ter AND terceros.ide_ter = duenio.ide_ter
    and ejecutar.cod_cul = '$cod_cul' and terceros.ide_ter = '$ver[0]'";
    $res=pg_query($conexion,$sql5);
    while($seee=pg_fetch_row($res)){
      //echo $seee[5]." ".$seee[6]." : ".$seee[4]."<br>";
      $total_insumos = $total_insumos + $seee[4];
    }

    $sql5="SELECT DISTINCT cultivos.cod_cul, tarea.cod_tar, insumos.des_ins, utilizar.cin_tar, utilizar.pin_tar, 
    terceros.pno_ter, terceros.sno_ter, terceros.pap_ter, terceros.sap_ter
    FROM socio, terceros, act_cul, cultivos, ejecutar, convenio, efectuar, tarea, utilizar, stock, insumos, compras, registrar, comprar 
    WHERE cultivos.cod_cul=ejecutar.cod_cul AND ejecutar.cod_con=convenio.cod_con AND convenio.cod_con=efectuar.cod_con
    AND efectuar.cod_tar=tarea.cod_tar AND tarea.cod_tar=utilizar.cod_tar AND utilizar.cod_sto=stock.cod_sto
    AND stock.cod_ins=insumos.cod_ins AND stock.cod_sto = registrar.cod_sto  AND registrar.cod_com = compras.cod_com
    AND compras.cod_com = comprar.cod_com AND comprar.ide_ter = terceros.ide_ter AND terceros.ide_ter = socio.ide_ter
    and ejecutar.cod_cul = '$cod_cul' and terceros.ide_ter = '$ver[0]'";
    $res=pg_query($conexion,$sql5);
    while($seee=pg_fetch_row($res)){
      //echo $seee[5]." ".$seee[6]." : ".$seee[4]."<br>";
      $total_insumos = $total_insumos + $seee[4];
    }

     //echo "CC: ".$ver[0]."  ".$ver[1]." ".$ver[3].":  ".$total_insumos." Insumos <br>";

     $convenios_aporte["$ver[1] $ver[2] $ver[3] $ver[4]"] = $total_aporte + $total_insumos; // Se crea la key Farton

     $aporte_total_cultivo  =  $aporte_total_cultivo + $total_aporte + $total_insumos;
   }
   if ($aporte_total_cultivo != 0 ) {
     ?>

     <div class="row col-md-12"  style="margin: 10px auto;">
      <div class="card bg-gradient-default col-md-9">
        <div class="card-body">
          <div class="mb-2 text-center">
            <span class="h2 text-white"><?php echo $_POST['nom_cul'] ?></span><br>
            <span class="h4 text-white"><?php echo "Total de la inversión:  $ ".$aporte_total_cultivo; ?>.</span>
          </div>
        </div>
        <div class="row">
          <?php 
          $dif = 0;
          $pora = 0;
          $porb = 0;
          $pera = 0;
          $perb = 0;
          foreach($convenios_aporte as $tercero=>$total)
          {
            ?>

            <div class="col">
              <p class="text-white"><?php echo  $tercero?></p>
              <small class="text-white"> Ha aportado: $ <?php echo $total.".<br>equivalente al ".round($porcentaje = ($total * 100) / $aporte_total_cultivo)."% del total de la inversión." ?> </small>
              <div class="progress progress-xs my-2">
                <div class="progress-bar bg-gradient-success" style="width: <?php echo round($porcentaje = ($total * 100) / $aporte_total_cultivo)  ?>%"></div>
              </div>
            </div>
            <?php

            if($pora == 0){
              $pora = round($porcentaje = ($total * 100) / $aporte_total_cultivo);
              $pera = $tercero;
            }else{
              $porb = round($porcentaje = ($total * 100) / $aporte_total_cultivo);
              $perb = $tercero;
            }
          }
          ?>
        </div>
      </div>
      <?php 
      if(abs($dif = ($porb - $pora )) >= 0 && abs($dif = ($porb - $pora )) <= 10 ){

        ?>
        <div class="col-md-3" style="margin-top: 10px auto; margin-top: 10px;">
          <div class="alert alert-info" role="alert">
            <span class="alert-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
            <span class="alert-text"><strong>Estado!</strong> La diferencia de aportes está en <?php echo abs($dif = ($porb - $pora ))?>%, es buena.<br>Lo ideal es que este mas cerca a cero para que haya equidad en los aportes de los socios.</span>
          </div>
        </div>
      </div>
      <?php  
    }else{
      ?>
      <div class="col-md-3" style="margin-top: 10px auto; margin-top: 10px;">
        <div class="alert alert-warning" role="alert">
          <span class="alert-icon"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
          <span class="alert-text"><strong>Atención!</strong>  La diferencia de aportes está en <?php echo abs($dif = ($porb - $pora ))?>%, Se recomienda que 
            <?php 
            if ($pora < $porb) {
              echo $pera;
            }else{
              echo $perb;
            }
            ?>
          realice esta compra, para que la diferencia de aportes disminuya.</span>
        </div>
      </div>
      <?php
    }
  }
}
?>




