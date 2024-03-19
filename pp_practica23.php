<?php
session_start();
if(!isset($_SESSION['gid_usuario'])){
    ?>
        <script type="text/javascript">
            alert("La sesion ha finalizado. \nIngrese nuevamente");
            window.open('blanco.html','_self',''); 
            window.close(); 
        </script>
    <?php
}
require('fpdf.php');
include('pp_funciones.php');
$link=conectarbd();
//include('php/conexion.php');
//include('php/conexiones_g.php');
//include('funciones_impre.php');


/*$consultatot=mysql_query("SELECT ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,cmod_fac,SUM(df.cant_dfa*df.valu_dfa) AS total FROM detalle_factura AS df 
                          INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
                          WHERE ef.iden_fac='$iden_fac' GROUP BY ef.iden_fac");
if(mysql_num_rows($consultatot)){
  $rowtot=mysql_fetch_array($consultatot);
  $vlcopa=$rowtot[vcop_fac];
  //$vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),-1);
  $vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),0);
}
*/
$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(132,132,132);
//$pdf->SetFillColor(164,164,164);
$pdf->SetFillColor(210,207,207);

$consulta="SELECT id_practica,fecha_inscripcion,tipo_practica,CONCAT(nombres,' ',apellidos) AS nombre,nombre_prog,nombre_ins,direccion,telefono_ins,director,nombre_acompa
     FROM vw_practica WHERE id_practica='$_GET[id_practica]'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
$row=$consulta->fetch_array();
$fila=20;
$col=20;
$pdf->SetXY(5,$fila);
$pdf->Cell(35,6,'Práctica Nro: '.$row['id_practica'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(80,6,'Fecha de Ingreso a la Práctica: '.$row['fecha_inscripcion'],0,0,'L');
$pdf->SetXY(180,$fila);
$pdf->Cell(25,6,'Práctica: '.$row['tipo_practica'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(160,6,'Nombre del Practicante: '.$row['nombre'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(160,6,'Programa de Licenciatura: '.$row['nombre_prog'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(160,6,'Nombre Institución: '.$row['nombre_ins'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(140,6,'Dirección: '.$row['direccion'],0,0,'L');
$pdf->SetXY(145,$fila);
$pdf->Cell(60,6,'Teléfono: '.$row['telefono_ins'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(160,6,'Nombre del Director: '.$row['director'],0,0,'L');

$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(160,6,'Nombre del Asesor: '.$row['nombre_acompa'],0,0,'L');

$fila+=8;
$pdf->SetXY(5,$fila);
$pdf->Cell(200,6,'HORARIO',0,0,'C',true);

$consultahor="SELECT id_dia,hora,nombre_asig,grado,grupo,jornada FROM vw_horario WHERE id_practica='$_GET[id_practica]' ORDER BY id_dia";
//echo "<br>".$consultahor;
$consultahor=$link->query($consultahor);
$fila+=6;
$pdf->SetXY(5,$fila);
$pdf->Cell(20,6,'Hora',1,0,'C');
$pdf->SetXY(25,$fila);
$pdf->Cell(80,6,'Asignatra',1,0,'C');
$pdf->SetXY(105,$fila);
$pdf->Cell(15,6,'Grado',1,0,'C');    
$pdf->SetXY(120,$fila);
$pdf->Cell(25,6,'Jornada',1,0,'C');    
$pdf->SetXY(145,$fila);
$pdf->Cell(10,6,'Lun',1,0,'C');
$pdf->SetXY(155,$fila);
$pdf->Cell(10,6,'Mar',1,0,'C');
$pdf->SetXY(165,$fila);
$pdf->Cell(10,6,'Mie',1,0,'C');
$pdf->SetXY(175,$fila);
$pdf->Cell(10,6,'Jue',1,0,'C');
$pdf->SetXY(185,$fila);
$pdf->Cell(10,6,'Vie',1,0,'C');
$pdf->SetXY(195,$fila);
$pdf->Cell(10,6,'Sab',1,0,'C');

while($rowhor=$consultahor->fetch_array()){
    $fila+=6;
    $pdf->SetXY(5,$fila);
    $pdf->Cell(20,6,$rowhor['hora'],1,0,'L');
    $pdf->SetXY(25,$fila);
    $pdf->Cell(80,6,$rowhor['nombre_asig'],1,0,'L');
    $pdf->SetXY(105,$fila);
    $pdf->Cell(15,6,$rowhor['grado'].'-'.$rowhor['grupo'],1,0,'L');    
    $pdf->SetXY(120,$fila);
    $pdf->Cell(25,6,$rowhor['jornada'],1,0,'L');

    $pdf->SetXY(145,$fila);
    $pdf->Cell(10,6,'',1,0,'C');
    $pdf->SetXY(155,$fila);
    $pdf->Cell(10,6,'',1,0,'C');
    $pdf->SetXY(165,$fila);
    $pdf->Cell(10,6,'',1,0,'C');
    $pdf->SetXY(175,$fila);
    $pdf->Cell(10,6,'',1,0,'C');
    $pdf->SetXY(185,$fila);
    $pdf->Cell(10,6,'',1,0,'C');
    $pdf->SetXY(195,$fila);
    $pdf->Cell(10,6,'',1,0,'C');

    switch($rowhor['id_dia']){
    case '1':
	  $col=145;
	  break;
    case '2':
	  $col=155;
	  break;
    case '3':
	  $col=165;
	  break;
    case '4':
	  $col=175;
	  break;
    case '5':
	  $col=185;
	  break;
    case '6':
	  $col=195;
	  break;
    }
    $pdf->SetXY($col,$fila);
    $pdf->Cell(10,6,'X',0,0,'C');
    //$pdf->SetXY(145,$fila);
    //$pdf->Cell(10,6,$rowhor['id_dia'],1,0,'L');
}


//$conenca=mysql_query("SELECT codi_emp, nume_fac, nite_emp,razo_emp, dire_emp, tele_emp, enca_emp, pie_emp 
//                      FROM empresa WHERE nite_emp='800176807-4'");
//$rowenca=mysql_fetch_array($conenca);
/*$razo_emp=$rowenca[razo_emp];
$nite_emp=$rowenca[nite_emp];
$dire_emp=$rowenca[dire_emp];
$tele_emp=$rowenca[tele_emp];
$enca_emp=$rowenca[enca_emp];
$fila=increm($fila,$pdf,4);
//$nu=date("Y-m-d"); 
//$ho=strftime("%I:%M:%S");
//estos datos hay que trerlos de la tabla creada el viernes

$pag_=1;
imprefac($iden_fac,$pdf);*/

$pdf->Output();
mysql_close();
?>
