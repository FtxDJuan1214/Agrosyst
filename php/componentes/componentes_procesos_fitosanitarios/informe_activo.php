<?php 
require '../../conexion.php';
session_start();
    $like = $_SESSION['idusuario'];

date_default_timezone_set('America/Bogota');
  $d = date("d");
  $m = date("m");
  $y = date("Y");
  $fecha=$y."-".$m."-".$d;
$cod_cul =$_GET['c'];
$cod_pfi =$_GET['d'];
$nom_cul =$_GET['n'];


$tar = "SELECT fitosanitaria.cod_fit, labores.nom_lab, labores.det_lab, 
fitosanitaria.cal_fit, tarea.fin_tar, tarea.cod_tar, afeccion.nom_afe, fitosanitaria.aoi_fit
FROM fitosanitaria 
INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
INNER JOIN labores ON tarea.cod_lab = labores.cod_lab
INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
INNER JOIN convenio ON efectuar.cod_con = convenio.cod_con
INNER JOIN ejecutar ON ejecutar.cod_con = convenio.cod_con
INNER JOIN cultivos ON cultivos.cod_cul = ejecutar.cod_cul
WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
AND procesos_fitosanitarios.ffi_pfi IS null
AND cultivos.cod_cul = '$cod_cul'
AND fitosanitaria.aoi_fit IS NULL
AND procesos_fitosanitarios.cod_pfi = '$cod_pfi'";

$tar1=pg_query($conexion,$tar);
$tar2=pg_query($conexion,$tar);
$tar3=pg_query($conexion,$tar);
$tar4=pg_query($conexion,$tar);
$tar5=pg_query($conexion,$tar);
$resC=pg_num_rows($tar5);
//
$info=pg_fetch_row($tar1);

require('../../../assets/pdf/mpdf.php');
$html='
<html lang="es">

<head>
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../assets/css/informes.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <h5 style="font-size:16px">Agrosyst Co.<span style="color:green"></span> Informe generado el '.$fecha.'
            </h5>
        </div>
        <div style="width:100%;background:#a892a8;"></div>
        <div style="width:100%; text-align:center;">
            <h2>Proceso contra '.$info[6].' en el cultivo '.$nom_cul.'</h2>
        </div>
        <p style="font-weight:bold;">Estado: </p>
        <p style="margin-left:7px;color:#15CA19"><b>ACTIVO</b></p>
        <p style="font-weight:bold">Fecha de inicio de la plaga/enfermedad: </p>
        <p style="margin-left:7px;">'.$info[4].'</p>
        <p style="font-weight:bold"></p>';

$html.='<table>
            <thead style="width:100%;">
                <tr style="background:#BEBAD8;">
                    <th>Nombre Labor</th>
                    <th>Fecha Realización</th>
                    <th>Calificación Labor</th>
                    <th>Agroquímicos Utilizados</th>
                    
                </tr>
            </thead>
            <tbody>';
        $html.='<tr style="background:#E4E3EA;">
                    <td>';while($tareas=pg_fetch_row($tar2)){
                        $html.='<p style="margin-left:7px;"> 	'.$tareas[1]; $html.='</p><br>';
                    }
                    $html.='</td>
                    <td>';while($tareas=pg_fetch_row($tar3)){
                        $html.='<p style="margin-left:7px;"><center> 	'.$tareas[4]; $html.='</center></p><br>';
                    }
                    $html.='</td>
                    <td>';while($tareas=pg_fetch_row($tar4)){
                        $html.='<p style="margin-left:7px;"><center> 	'; 
                        if($tareas[3] == 1){
                            $html.='★'.'✩'.'✩'.'✩'.'✩';
                        }else if($tareas[3] == 2){
                            $html.='★'.'★'.'✩'.'✩'.'✩';
                        }else if($tareas[3] == 3){
                            $html.='★'.'★'.'★'.'✩'.'✩';
                        }else if($tareas[3] == 4){
                            $html.='★'.'★'.'★'.'★'.'✩';
                        }else if($tareas[3] == 5){
                            $html.='★'.'★'.'★'.'★'.'★';
                        }else if($tareas[3] == null){
                            $html.='Sin calificación';
                        } $html.='</center></p><br>';
                    }
                    $html.='</td>
                    <td>';while($tareas=pg_fetch_row($tar5)){ 
                
                        $agro = "SELECT tarea.cod_tar,utilizar.cod_sto, stock.cod_ins, insumos.des_ins, agroquimicos.nom_agr
                        FROM fitosanitaria 
                        INNER JOIN planificacion ON fitosanitaria.cod_pla = planificacion.cod_pla
                        INNER JOIN tarea ON tarea.cod_tar = fitosanitaria.cod_tar
                        INNER JOIN procesos_fitosanitarios ON procesos_fitosanitarios.cod_pfi = planificacion.cod_pfi
                        INNER JOIN afeccion ON afeccion.cod_afe = procesos_fitosanitarios.cod_afe
                        INNER JOIN efectuar ON efectuar.cod_tar= tarea.cod_tar
                        INNER JOIN utilizar ON utilizar.cod_tar = tarea.cod_tar
                        INNER JOIN stock ON utilizar.cod_sto = stock.cod_sto
                        INNER JOIN insumos ON insumos.cod_ins = stock.cod_ins
                        INNER JOIN agroquimicos ON insumos.cod_ins = agroquimicos.cod_ins
                        WHERE (procesos_fitosanitarios.cod_pfi LIKE '1-%' OR procesos_fitosanitarios.cod_pfi LIKE '$like%')
                        AND tarea.cod_tar = '$tareas[5]'";

                        $quimicos=pg_query($conexion,$agro);
                        $listado=""; 
                        
                        while($ragro=pg_fetch_row($quimicos)){ 

                            $listado = $listado."<br />• ".$ragro[4];                           

                            }
                            $html.='<p style="margin-left:7px;"> 	'.$listado; $html.='</p>';
                        }
                    $html.='</td>
                </tr>
            </tbody>
        </table>
        <div style="width:100%; text-align:center;">
        <p style="font-weight:bold"></p>
        <p style="font-weight:bold">COMENTARIOS</p>
        </div>
        <div>';
            $sql1="SELECT cod_pfi, com_pfi, fec_com
            FROM public.comentarios_pfi
            WHERE cod_pfi = '$cod_pfi'";

            $resp=pg_query($conexion,$sql1);
            while($ver1=pg_fetch_row($resp)){ 

                $sep = explode(":",$ver1[1]);
                if(trim($sep[0]) == $nom_cul){
                $html.='<h5 class="text-white">'. $ver1[2].":"; $html.='</h5>
                <p style="margin-left:7px;">'.$sep[1];'</p>';
            }
        }

$html.='<div>
    </div>
</body>
</html>';


$nombre='AgrosystCo - Proceso Fitosanitario '.$info[6].' en el cultivo: '.$nom_cul.'.pdf';

$mpdf=new mPDF('c','A4');

$mpdf->writeHTML($html);
$mpdf->Output($nombre,'I');
?>