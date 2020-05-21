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

echo $cod_cul.' and '.$cod_pfi;

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
AND fitosanitaria.aoi_fit IS NOT NULL
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
        <p style="font-weight:bold">Fecha de inicio: </p>
        <p style="margin-left:7px;">'.$info[4].'</p>
        <p style="font-weight:bold">Fecha de finalización: </p>
        <p style="margin-left:7px;">'.$info[7].'</p>';

$html.='<table>
            <thead style="width:100%;">
                <tr style="width:100px;">
                    <th style="width:100px;">Nombre Labor</th>
                    <th style="width:100px;">Fecha</th>
                    <th style="width:100px;">Calificación Labor</th>
                    <th style="width:100px;">Agroquímicos Utilizados</th>
                    <th style="width:100px;">Comentarios</th>
                    
                </tr>
            </thead>
            <tbody>';
        $html.='<tr>
                    <td>';while($tareas=pg_fetch_row($tar2)){
                        $html.='<p style="margin-left:7px;"> 	'.$tareas[1]; $html.='</p><br>';
                    }
                    $html.='</td>
                    <td>';while($tareas=pg_fetch_row($tar3)){
                        $html.='<p style="margin-left:7px;"> 	'.$tareas[4]; $html.='</p><br>';
                    }
                    $html.='</td>
                    <td>';while($tareas=pg_fetch_row($tar4)){
                        $html.='<p style="margin-left:7px;"> 	'.$tareas[3]; $html.='</p><br>';
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

                            $listado = $listado.'• '.$ragro[4]."\n";
                            $html.='<p style="margin-left:7px;"> 	'.$listado; $html.='</p><br>';

                            }

                        }
                    $html.='</td>
                    <td>'.'NOO'.'</td>

                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>';


$nombre='AgrosystCo - informe general del cultivo '.$nom_cul.'.pdf';

$mpdf=new mPDF('c','A4');

$mpdf->writeHTML($html);
$mpdf->Output($nombre,'I');
?>