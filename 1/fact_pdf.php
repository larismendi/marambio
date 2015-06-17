<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
}

$colname_ofact = "1";
if (isset($_GET['idOP'])) {
  $colname_ofact = (get_magic_quotes_gpc()) ? $_GET['idOP'] : addslashes($_GET['idOP']);
}
mysql_select_db($database_marambio, $marambio);
$query_ofact = sprintf("SELECT * FROM orden_fact WHERE idOP = %s", $colname_ofact);
$ofact = mysql_query($query_ofact, $marambio) or die(mysql_error());
$row_ofact = mysql_fetch_assoc($ofact);
$IdTareaSelect = $row_ofact['IdTarea'];

$query_tarea = "SELECT * FROM tareas WHERE IdTarea = '$IdTareaSelect'";
$tarea = mysql_query($query_tarea, $marambio) or die(mysql_error());
$row_tarea = mysql_fetch_assoc($tarea);
$IdServicio2000=$row_tarea['IdServicio'];
$CodEmp2000=$row_tarea['IdEmpresa'];

$query_serv = "SELECT * FROM servicios WHERE IdServicio = '$IdServicio2000'";
$serv = mysql_query($query_serv, $marambio) or die(mysql_error());
$row_serv = mysql_fetch_assoc($serv);

$query_empresa = "SELECT * FROM empresas WHERE CodEmp = '$CodEmp2000'";
$empresa = mysql_query($query_empresa, $marambio) or die(mysql_error());
$row_empresa = mysql_fetch_assoc($empresa);

include('crea_pdf/class.ezpdf.php');
$pdf = new Cezpdf('letter');
$pdf->selectFont('crea_pdf/fonts/Times-Roman.afm');
$datacreator = array ('Title'=>'Orden de Facturación', 'Author'=>'Marambio González & Asociados', 'Subject'=>'Orden de Facturación PDF', 'Creator'=>'mgyasoc@mg.com.ve', 'Producer'=>'http://www.mg.com.ve/' );
$pdf->addInfo($datacreator);

$yyy = -80;
$xxx = 10;
//*******************
$pdf->addJpegFromFile("imagenes/logo.jpg",30+$xxx,810+$yyy,40,40);

$pdf->setColor(0,0,0);
$pdf->addText(500+$xxx,795+$yyy,14,"<b>".utf8_decode("$texto N°: ".$row_ofact['idOP']."")."</b>",0,0);

$yyy= -100;
$pdf->addText(230+$xxx,780+$yyy,12,"<b>".utf8_decode("ORDEN DE FACTURACIÓN")."</b>",0,0);
$yyy= -110;
//campos de datos personales
$pdf->setLineStyle(0.5); // defines el estilo de línea y grosor
//fila1
$pdf->addText(480+$xxx,775+$yyy,9,"Fecha:".$row_ofact['fechaEsp']."",0,0);

$pdf->line(30+$xxx,770+$yyy,550+$xxx,770+$yyy);

$pdf->addText(30+$xxx,755+$yyy,8,"Proyectos:",0,0);
$pdf->addText(80+$xxx,755+$yyy,8,"<b>". $row_serv['Servicio']."</b>",0,0);

$pdf->addText(30+$xxx,745+$yyy,8,"Cliente:",0,0);
$pdf->addText(80+$xxx,745+$yyy,8,"<b>". $row_empresa['Nombre']."</b>",0,0);
//fila2
$pdf->ezText("",60);$pdf->ezText("",60);$pdf->ezText("",60);
$data = array( array( 'uno'=> $row_ofact['concepto'] ,'dos'=>number_format ($row_ofact['monto'],2,chr(44),".") ) );
$pdf->ezTable(
			  $data, 
			  array('uno'=>'CONCEPTO','dos'=>'MONTO'), 
			  '', 
			  array( 
					'xOrientation'=>'center',
					'width'=>500,
					'cols'=>array(
								   'uno'=>array('justification'=>'left'),'dos'=>array('width'=>100)  
					) 
			  )
			);


$pdf->line(50+$xxx,380+$yyy,190+$xxx,380+$yyy);
$pdf->addText(60+$xxx,360+$yyy,8,"Autorizado por:",0,0);

//$archivo_pdf = isFile($pdf->ezOutput(), $nom['nombre']);
ob_end_clean();
$pdf->ezStream();
?>