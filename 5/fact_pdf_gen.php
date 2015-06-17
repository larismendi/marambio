<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 5){
	header ("Location: ../index.php"); 
}

?>
<?php
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

?>
<?php
// We'll be outputting a PDF
header('Content-type: application/pdf');
// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');
// The PDF source is in original.pdf
readfile('original.pdf');
?>
<html>
<head>
<title>Reporte del Tiempo Versi&oacute;n 1.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: large;
}
.Estilo3 {font-size: x-small}
.Estilo4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; }
.Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
.Estilo8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; font-weight: bold; }
.Estilo9 {font-size: small}
-->
</style></head>

<body>
<table width="87%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="53" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><div align="right" class="Estilo1">N&ordm;: <?php echo $row_ofact['idOP']; ?></div></td>
  </tr>
  <tr>
    <td colspan="4"><div align="center" class="Estilo1">ORDEN DE FACTURACION </div></td>
  </tr>
  <tr>
    <td><span class="Estilo3"><a href="o_fact.php">&lt;&lt; Volver </a></span></td>
    <td width="30%"><span class="Estilo3"></span></td>
    <td width="29%"><span class="Estilo3"></span></td>
    <td><div align="right" class="Estilo6">Fecha:<?php echo $row_ofact['fechaEsp']; ?></div></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td><span class="Estilo6">Proyecto:</span></td>
    <td><span class="Estilo8"><?php echo $row_serv['Servicio']; ?></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
  </tr>
  <tr>
    <td width="11%"><span class="Estilo6">Cliente:</span></td>
    <td colspan="2"><div align="left"><span class="Estilo8"><?php echo $row_empresa['Nombre']; ?></span><span class="Estilo3"></span></div></td>
    <td width="30%"><span class="Estilo3"></span></td>
  </tr>
  <tr>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr bgcolor="#E4E4E4" class="Estilo6">
    <td colspan="3"><div align="center" class="Estilo6"><strong>CONCEPTO</strong></div></td>
    <td><div align="center" class="Estilo4 Estilo9"><strong>MONTO</strong></div></td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo3"></span><span class="Estilo3"></span><span class="Estilo6"><?php echo $row_ofact['concepto']; ?></span></td>
    <td><div align="center" class="Estilo6"><?php print (number_format ($row_ofact['monto'],2,chr(44),".")); ?></div></td>
  </tr>
  <tr>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo3">    </span><span class="Estilo4">Autorizado por: </span></td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3"></span></td>
  </tr>
</table>
</body>
</html>
<?php
@mysql_free_result($ofact);
@mysql_free_result($tarea);
@mysql_free_result($serv);
@mysql_free_result($empresa);
mysql_close($marambio);
?>
