<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
	header ("Location: ../index.php"); 
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tareas SET porcAvance=%s WHERE IdTarea=%s",
                       GetSQLValueString($_POST['porcAvance'], "int"),
                       GetSQLValueString($_POST['IdTarea'], "int"));

  mysql_select_db($database_marambio, $marambio);
  mysql_query($updateSQL, $marambio) or die(mysql_error());
}
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

$colname_tarea = "1";
if (isset($_GET['IdTarea'])) {
  $colname_tarea = (get_magic_quotes_gpc()) ? $_GET['IdTarea'] : addslashes($_GET['IdTarea']);
}
$IdTarea2000=$IdTarea;
$query_tarea = "SELECT t.*, u.Nombre NombreLider FROM tareas t LEFT JOIN usuarios u ON t.IdLider=u.IdUsuario WHERE t.IdTarea = '$IdTarea2000'";
$tarea = mysql_query($query_tarea, $marambio) or die(mysql_error());
$row_tarea = mysql_fetch_assoc($tarea);

$IdServicio2000=$row_tarea['IdServicio'];
$query_serv = "SELECT * FROM servicios WHERE IdServicio = '$IdServicio2000'";
$serv = mysql_query($query_serv, $marambio) or die(mysql_error());
$row_serv = mysql_fetch_assoc($serv);

$CodEmp2000=$row_tarea['IdEmpresa'];
$query_empresa = "SELECT * FROM empresas WHERE CodEmp = '$CodEmp2000'";
$empresa = mysql_query($query_empresa, $marambio) or die(mysql_error());
$row_empresa = mysql_fetch_assoc($empresa);

// BUSQUEDA DE HORAS TOTALES
$query_totalHorasTarea = "SELECT * FROM quincenasub WHERE CodificacionComp = '$IdTarea2000'";
$totalHorasTarea = mysql_query($query_totalHorasTarea, $marambio) or die(mysql_error());
$row_totalHorasTarea = mysql_fetch_assoc($totalHorasTarea);

do { 
	$totalHorasRealizadas=$totalHorasRealizadas+$row_totalHorasTarea['D01']+$row_totalHorasTarea['D02']+$row_totalHorasTarea['D03']+$row_totalHorasTarea['D04']+$row_totalHorasTarea['D05']+$row_totalHorasTarea['D06']+$row_totalHorasTarea['D07']+$row_totalHorasTarea['D08']+$row_totalHorasTarea['D09']+$row_totalHorasTarea['D10']+$row_totalHorasTarea['D11']+$row_totalHorasTarea['D12']+$row_totalHorasTarea['D13']+$row_totalHorasTarea['D14']+$row_totalHorasTarea['D15']+$row_totalHorasTarea['D16']+$row_totalHorasTarea['D17']+$row_totalHorasTarea['D18']+$row_totalHorasTarea['D19']+$row_totalHorasTarea['D20']+$row_totalHorasTarea['D21']+$row_totalHorasTarea['D22']+$row_totalHorasTarea['D23']+$row_totalHorasTarea['D24']+$row_totalHorasTarea['D25']+$row_totalHorasTarea['D26']+$row_totalHorasTarea['D27']+$row_totalHorasTarea['D28']+$row_totalHorasTarea['D29']+$row_totalHorasTarea['D30']+$row_totalHorasTarea['D31'];
} while ($row_totalHorasTarea = mysql_fetch_assoc($totalHorasTarea));

// BUSQUEDA DE HORAS DISCRIMINADAS POR SOCIO / GERENTE / ENCARGADO / ASISTENTE
$query_totalHorasDisc = "SELECT * FROM quincenasub WHERE CodificacionComp = '$IdTarea2000'";
$totalHorasDisc = mysql_query($query_totalHorasDisc, $marambio) or die(mysql_error());
$row_totalHorasDisc = mysql_fetch_assoc($totalHorasDisc);

do { 
	$usuarioDisc=$row_totalHorasDisc['IdUsuario'];
	$query_usuDisc = "SELECT * FROM personalasignado WHERE IdUsuario = '$usuarioDisc'";
	$usuDisc = mysql_query($query_usuDisc, $marambio) or die(mysql_error());
	$row_usuDisc = mysql_fetch_assoc($usuDisc);
//echo $row_usuDisc['IdUsuario'].'--<br>';
	if($row_usuDisc['Posicion']=="Socio") {
		$totalSocio=$totalSocio+$row_totalHorasDisc['D01']+$row_totalHorasDisc['D02']+$row_totalHorasDisc['D03']+$row_totalHorasDisc['D04']+$row_totalHorasDisc['D05']+$row_totalHorasDisc['D06']+$row_totalHorasDisc['D07']+$row_totalHorasDisc['D08']+$row_totalHorasDisc['D09']+$row_totalHorasDisc['D10']+$row_totalHorasDisc['D11']+$row_totalHorasDisc['D12']+$row_totalHorasDisc['D13']+$row_totalHorasDisc['D14']+$row_totalHorasDisc['D15']+$row_totalHorasDisc['D16']+$row_totalHorasDisc['D17']+$row_totalHorasDisc['D18']+$row_totalHorasDisc['D19']+$row_totalHorasDisc['D20']+$row_totalHorasDisc['D21']+$row_totalHorasDisc['D22']+$row_totalHorasDisc['D23']+$row_totalHorasDisc['D24']+$row_totalHorasDisc['D25']+$row_totalHorasDisc['D26']+$row_totalHorasDisc['D27']+$row_totalHorasDisc['D28']+$row_totalHorasDisc['D29']+$row_totalHorasDisc['D30']+$row_totalHorasDisc['D31'];
	}
	if($row_usuDisc['Posicion']=="Gerente") {
		$totalGerente=$totalGerente+$row_totalHorasDisc['D01']+$row_totalHorasDisc['D02']+$row_totalHorasDisc['D03']+$row_totalHorasDisc['D04']+$row_totalHorasDisc['D05']+$row_totalHorasDisc['D06']+$row_totalHorasDisc['D07']+$row_totalHorasDisc['D08']+$row_totalHorasDisc['D09']+$row_totalHorasDisc['D10']+$row_totalHorasDisc['D11']+$row_totalHorasDisc['D12']+$row_totalHorasDisc['D13']+$row_totalHorasDisc['D14']+$row_totalHorasDisc['D15']+$row_totalHorasDisc['D16']+$row_totalHorasDisc['D17']+$row_totalHorasDisc['D18']+$row_totalHorasDisc['D19']+$row_totalHorasDisc['D20']+$row_totalHorasDisc['D21']+$row_totalHorasDisc['D22']+$row_totalHorasDisc['D23']+$row_totalHorasDisc['D24']+$row_totalHorasDisc['D25']+$row_totalHorasDisc['D26']+$row_totalHorasDisc['D27']+$row_totalHorasDisc['D28']+$row_totalHorasDisc['D29']+$row_totalHorasDisc['D30']+$row_totalHorasDisc['D31'];
	}
	if($row_usuDisc['Posicion']=="Encargado") {
		$totalEncargado=$totalEncargado+$row_totalHorasDisc['D01']+$row_totalHorasDisc['D02']+$row_totalHorasDisc['D03']+$row_totalHorasDisc['D04']+$row_totalHorasDisc['D05']+$row_totalHorasDisc['D06']+$row_totalHorasDisc['D07']+$row_totalHorasDisc['D08']+$row_totalHorasDisc['D09']+$row_totalHorasDisc['D10']+$row_totalHorasDisc['D11']+$row_totalHorasDisc['D12']+$row_totalHorasDisc['D13']+$row_totalHorasDisc['D14']+$row_totalHorasDisc['D15']+$row_totalHorasDisc['D16']+$row_totalHorasDisc['D17']+$row_totalHorasDisc['D18']+$row_totalHorasDisc['D19']+$row_totalHorasDisc['D20']+$row_totalHorasDisc['D21']+$row_totalHorasDisc['D22']+$row_totalHorasDisc['D23']+$row_totalHorasDisc['D24']+$row_totalHorasDisc['D25']+$row_totalHorasDisc['D26']+$row_totalHorasDisc['D27']+$row_totalHorasDisc['D28']+$row_totalHorasDisc['D29']+$row_totalHorasDisc['D30']+$row_totalHorasDisc['D31'];
	}
	if($row_usuDisc['Posicion']=="Asistente - Auditor") {
		$totalAsistente=$totalAsistente+$row_totalHorasDisc['D01']+$row_totalHorasDisc['D02']+$row_totalHorasDisc['D03']+$row_totalHorasDisc['D04']+$row_totalHorasDisc['D05']+$row_totalHorasDisc['D06']+$row_totalHorasDisc['D07']+$row_totalHorasDisc['D08']+$row_totalHorasDisc['D09']+$row_totalHorasDisc['D10']+$row_totalHorasDisc['D11']+$row_totalHorasDisc['D12']+$row_totalHorasDisc['D13']+$row_totalHorasDisc['D14']+$row_totalHorasDisc['D15']+$row_totalHorasDisc['D16']+$row_totalHorasDisc['D17']+$row_totalHorasDisc['D18']+$row_totalHorasDisc['D19']+$row_totalHorasDisc['D20']+$row_totalHorasDisc['D21']+$row_totalHorasDisc['D22']+$row_totalHorasDisc['D23']+$row_totalHorasDisc['D24']+$row_totalHorasDisc['D25']+$row_totalHorasDisc['D26']+$row_totalHorasDisc['D27']+$row_totalHorasDisc['D28']+$row_totalHorasDisc['D29']+$row_totalHorasDisc['D30']+$row_totalHorasDisc['D31'];
	}
	
} while ($row_totalHorasDisc = mysql_fetch_assoc($totalHorasDisc)); 

$query_totalLider = "SELECT * FROM quincenasub WHERE IdUsuario = '".$row_tarea['IdLider']."' AND CodificacionComp = '$IdTarea2000'";
$totalLider = mysql_query($query_totalLider, $marambio) or die(mysql_error());
$row_totalLider = mysql_fetch_assoc($totalLider);
do {
        $totalTiempoLider=$totalTiempoLider+$row_totalLider['D01']+$row_totalLider['D02']+$row_totalLider['D03']+$row_totalLider['D04']+$row_totalLider['D05']+$row_totalLider['D06']+$row_totalLider['D07']+$row_totalLider['D08']+$row_totalLider['D09']+$row_totalLider['D10']+$row_totalLider['D11']+$row_totalLider['D12']+$row_totalLider['D13']+$row_totalLider['D14']+$row_totalLider['D15']+$row_totalLider['D16']+$row_totalLider['D17']+$row_totalLider['D18']+$row_totalLider['D19']+$row_totalLider['D20']+$row_totalLider['D21']+$row_totalLider['D22']+$row_totalLider['D23']+$row_totalLider['D24']+$row_totalLider['D25']+$row_totalLider['D26']+$row_totalLider['D27']+$row_totalLider['D28']+$row_totalLider['D29']+$row_totalLider['D30']+$row_totalLider['D31'];
} while ($row_totalLider = mysql_fetch_assoc($totalLider));

$query_totalFact = "SELECT * FROM orden_fact WHERE IdTarea = '$IdTarea2000'";
$totalFact = mysql_query($query_totalFact, $marambio) or die(mysql_error());
$row_totalFact = mysql_fetch_assoc($totalFact);	
do {
        $totalFacturado=$totalFacturado+$row_totalFact['horas'];
} while ($row_totalFact = mysql_fetch_assoc($totalFact));


////////////////////////////////////////////////////////////////////////////////
//$CodGrupoXX=$row_data['IdGrupo'];

?>

<?php include("includes/head.php");?>
<style type="text/css">
<!--
.Estilo1 {color: #000000}
.Estilo3 {color: #000000; font-size: x-small; }
-->
</style>
              <p align="center" class="titulo"><br>
                ESTADISTICAS</p>
              <p><a href="estadisticas2.php?IdEmpresa=<? echo $IdEmpresa;?>" class="texto_btgris">&lt;&lt; Volver</a></p>
              <table width="95%"  border="0" cellspacing="0" cellpadding="0">
                <tr class="texto_btgris">
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="2" bordercolor="#CCCCCC">
                    <tr class="texto_gris">
                      <td height="16" colspan="2" bgcolor="#F3F3F3"><div align="center" class="texto_btgris Estilo1">DATOS DEL CLIENTE </div></td>
                      </tr>
                    <tr class="texto_gris">
                      <td width="18%" class="texto_btgris"><span class="Estilo1">Cliente:</span></td>
                      <td width="82%" class="texto_btgris Estilo1"><?php echo $row_empresa['Nombre']; ?></td>
                    </tr>
                    <tr class="texto_gris">
                      <td width="18%" class="texto_btgris"><span class="Estilo1">Supervisor:</span></td>
                      <td width="82%" class="texto_btgris Estilo1"><?php echo $row_supervisor['Nombre']; ?></td>
                    </tr>
                    <tr class="texto_gris">
                      <td class="texto_btgris"><span class="Estilo1">Direcci&oacute;n:</span></td>
                      <td class="texto_btgris Estilo1"><?php echo $row_empresa['Direccion']; ?></td>
                    </tr>
                    <tr class="texto_gris">
                      <td class="texto_btgris"><span class="Estilo1">Tel&eacute;fonos:</span></td>
                      <td class="texto_btgris Estilo1"><?php echo $row_empresa['Telefonos']; ?></td>
                    </tr>
                  </table></td>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                    <tr bgcolor="#F3F3F3" class="texto_btgris">
                      <td colspan="2"><div align="center" class="Estilo1">DATOS DE LA TAREA </div></td>
                      </tr>
                    <tr class="texto_btgris">
                      <td width="40%"><span class="Estilo1 Estilo1">Tarea:</span></td>
                      <td width="60%"><span class="texto_btgris Estilo1 Estilo1"><?php echo $row_serv['Servicio']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1 Estilo1">Fecha:</span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['FEspanol']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">L&iacute;der de Proyecto: </span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['NombreLider']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Tasa:</span></td>
                      <td><span class="Estilo1"><?php print (number_format ( $row_tarea['Tasa'],2,chr(44),".")); ?></span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr class="texto_btgris">
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                    <tr class="texto_btgris">
                      <td colspan="2"><hr></td>
                      </tr>
                    <tr bgcolor="#F3F3F3" class="texto_btgris">
                      <td colspan="2"><div align="center" class="Estilo1">HORAS PRESUPUESTADAS</div></td>
                      </tr>
                    <tr class="texto_btgris">
                      <td width="42%"><span class="Estilo1">Horas Presupuestadas: </span></td>
                      <td width="58%"><span class="Estilo1"><?php echo $row_tarea['HorasEstimadas']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Horas Socio: </span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['HorasSocio']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Horas Gerente: </span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['HorasGerente']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Horas Encargado: </span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['HorasEncargado']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1 Estilo1">Horas Asistente: </span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['HorasAsistente']; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1 Estilo1">Horas Lider: </span></td>
                      <td><span class="Estilo1"><?php echo $row_tarea['HorasLider']; ?></span></td>
                    </tr>
                  </table>
                  </td>
                  <td colspan="2"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                    <tr class="texto_btgris">
                      <td colspan="2"><hr></td>
                    </tr>
                    <tr bgcolor="#F3F3F3" class="texto_btgris">
                      <td colspan="2"><div align="center" class="Estilo1">HORAS REALIZADAS </div></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td width="42%"><span class="Estilo1">Horas Presupuestadas: </span></td>
                      <td width="58%"><span class="Estilo1"><? echo $totalHorasRealizadas; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Horas Socio: </span></td>
                      <td><span class="Estilo1"><?=$totalSocio; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Horas Gerente: </span></td>
                      <td><span class="Estilo1"><?=$totalGerente; ?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1">Horas Encargado: </span></td>
                      <td><span class="Estilo1"><?=$totalEncargado;?></span></td>
                    </tr>
                    <tr class="texto_btgris">
                      <td><span class="Estilo1 Estilo1">Horas Asistente: </span></td>
                      <td><span class="Estilo1"><?=$totalAsistente;?></span></td>
                    </tr>                    
                    <tr class="texto_btgris">
                      <td><span class="Estilo1 Estilo1">Horas Lider: </span></td>
                      <td><span class="Estilo1"><?=$totalTiempoLider; ?></span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr bgcolor="#FFFFFF" class="texto_btgris">
                  <td colspan="4"><div align="center"><span class="Estilo1"><br>
                    HORAS PRESUPUESTADAS vs HORAS REALIZADAS </span><br>
                  </div>                    <table width="100"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td bgcolor="#F3F3F3"><div align="center" class="texto_btgris Estilo1">Horas Total</div></td>
                      <td bgcolor="#CCCCCC">&nbsp;</td>
                      <td bgcolor="#F3F3F3"><div align="center" class="texto_btgris Estilo1">Horas Socio</div></td>
                      <td bgcolor="#CCCCCC">&nbsp;</td>
                      <td bgcolor="#F3F3F3"><div align="center"><span class="texto_btgris Estilo1">Horas Gerente </span></div></td>
                      <td bgcolor="#CCCCCC">&nbsp;</td>
                      <td bgcolor="#F3F3F3"><div align="center" class="texto_btgris Estilo1">Horas Encargado</div></td>
                      <td bgcolor="#CCCCCC">&nbsp;</td>
                      <td bgcolor="#F3F3F3"><div align="center" class="texto_btgris Estilo1">Horas Asistente</div></td>
                      <td bgcolor="#CCCCCC">&nbsp;</td>
                      <td bgcolor="#F3F3F3"><div align="center" class="texto_btgris Estilo1">Horas Lider</div></td>
                    </tr>
                    <tr>
                      <td width="25%" valign="bottom"><div align="center">
                        <table width="141"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="86" valign="bottom"><div align="center"><span class="Estilo3"><?=$row_tarea['HorasEstimadas']; ?></span><br>
                              <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasEstimadas']?$row_tarea['HorasEstimadas']:0; ?>"></div></td>
                            <td width="81" valign="bottom"><div align="center"><span class="Estilo3"><?=$totalHorasRealizadas; ?></span><br>
                              <img src="images/<?=$row_tarea['HorasEstimadas']>$totalHorasRealizadas?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalHorasRealizadas?$totalHorasRealizadas:0; ?>"></div></td>
                          </tr>
                          <tr class="texto_btgris">
                            <td><div align="center"><span class="Estilo1">HP</span></div></td>
                            <td><div align="center"><span class="Estilo1">HR</span></div></td>
                          </tr>
                          <tr>
                            <td class="texto_gris"><div align="center" class="Estilo1">Horas<br>
                                Presupuesto</div></td>
                            <td><div align="center" class="texto_gris Estilo1">Horas<br>
                              Realizadas</div></td>
                          </tr>
                        </table>
                      </div></td>
                      <td width="3%" bgcolor="#CCCCCC">&nbsp;</td>
                      <td width="25%" valign="bottom"><table width="141"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="70" valign="bottom"><div align="center"><span class="Estilo3"><?=$row_tarea['HorasSocio']; ?></span><br>
                                  <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasSocio']?$row_tarea['HorasSocio']:0?>"></div></td>
                          <td width="69" valign="bottom"><div align="center"><span class="Estilo3"><?=$totalSocio ?></span><br>
                                  <img src="images/<?=$row_tarea['HorasSocio']>$totalSocio?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalSocio?$totalSocio:0 ?>"></div></td>
                        </tr>
                        <tr class="texto_btgris">
                          <td><div align="center"><span class="Estilo1">HP Socio </span></div></td>
                          <td><div align="center"><span class="Estilo1">HR Socio </span></div></td>
                        </tr>
                        <tr>
                          <td class="texto_gris"><div align="center" class="Estilo1">Horas<br>
        Presupuesto</div></td>
                          <td><div align="center" class="texto_gris Estilo1">Horas<br>
        Realizadas</div></td>
                        </tr>
                      </table></td>
                      <td width="3%" bgcolor="#CCCCCC">&nbsp;</td>
                      <td width="25%" valign="bottom"><div align="center">
                        <table width="141"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="75" valign="bottom"><div align="center"><span class="Estilo3"><?=$row_tarea['HorasGerente']; ?></span><br>
                                    <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasGerente']?$row_tarea['HorasGerente']:0; ?>"></div></td>
                            <td width="80" valign="bottom"><div align="center"><span class="Estilo3"><?=$totalGerente; ?></span><br>
                                    <img src="images/<?=$row_tarea['HorasGerente']>$totalGerente?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalGerente?$totalGerente:0; ?>"></div></td>
                          </tr>
                          <tr class="texto_btgris">
                            <td><div align="center"><span class="Estilo1">HP Gerente</span></div></td>
                            <td><div align="center"><span class="Estilo1">HR Gerente </span></div></td>
                          </tr>
                          <tr>
                            <td class="texto_gris"><div align="center" class="Estilo1">Horas<br>
        Presupuesto</div></td>
                            <td><div align="center" class="texto_gris Estilo1">Horas<br>
        Realizadas</div></td>
                          </tr>
                        </table>
                      </div></td>
                      <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
                      <td width="4%" valign="bottom"><table width="141"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="75" valign="bottom"><div align="center"><span class="Estilo3"><?=$row_tarea['HorasEncargado']; ?></span><br>
                                  <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasEncargado']?$row_tarea['HorasEncargado']:0; ?>"></div></td>
                          <td width="80" valign="bottom"><div align="center"><span class="Estilo3"><?=$totalEncargado; ?></span><br>
                                  <img src="images/<?=$row_tarea['HorasEncargado']>$totalEncargado?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalEncargado?$totalEncargado:0; ?>"></div></td>
                        </tr>
                        <tr class="texto_btgris">
                          <td><div align="center"><span class="Estilo1">HP Encargado</span></div></td>
                          <td><div align="center"><span class="Estilo1">HR Encargado</span></div></td>
                        </tr>
                        <tr>
                          <td class="texto_gris"><div align="center" class="Estilo1">Horas<br>
        Presupuesto</div></td>
                          <td><div align="center" class="texto_gris Estilo1">Horas<br>
        Realizadas</div></td>
                        </tr>
                      </table></td>
                      <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
                      <td width="15%" valign="bottom"><table width="141"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="75" valign="bottom"><div align="center"><span class="Estilo3"><?=$row_tarea['HorasAsistente']; ?></span><br>
                                  <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasAsistente']?$row_tarea['HorasAsistente']:0; ?>"></div></td>
                          <td width="80" valign="bottom"><div align="center"><span class="Estilo3"><?=$totalAsistente; ?></span><br>
                                  <img src="images/<?=$row_tarea['HorasAsistente']>$totalAsistente?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalAsistente?$totalAsistente:0; ?>"></div></td>
                        </tr>
                        <tr class="texto_btgris">
                          <td><div align="center"><span class="Estilo1">HP Asistente</span></div></td>
                          <td><div align="center"><span class="Estilo1">HR Asistente</span></div></td>
                        </tr>
                        <tr>
                          <td class="texto_gris"><div align="center" class="Estilo1">Horas<br>
        Presupuesto</div></td>
                          <td><div align="center" class="texto_gris Estilo1">Horas<br>
        Realizadas</div></td>
                        </tr>
                      </table></td>
                      <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
                      <td width="15%" valign="bottom"><table width="141"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="75" valign="bottom"><div align="center"><span class="Estilo3"><?=$row_tarea['HorasLider']; ?></span><br>
                                  <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasLider']?$row_tarea['HorasLider']:0; ?>"></div></td>
                          <td width="80" valign="bottom"><div align="center"><span class="Estilo3"><?=$totalTiempoLider; ?></span><br>
                                  <img src="images/<?=$row_tarea['HorasLider']>$totalTiempoLider?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalTiempoLider?$totalTiempoLider:0; ?>"></div></td>
                        </tr>
                        <tr class="texto_btgris">
                          <td><div align="center"><span class="Estilo1">HP Lider</span></div></td>
                          <td><div align="center"><span class="Estilo1">HR Lider</span></div></td>
                        </tr>
                        <tr>
                          <td class="texto_gris"><div align="center" class="Estilo1">Horas<br>Presupuesto</div></td>
                          <td><div align="center" class="texto_gris Estilo1">Horas<br>Realizadas</div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
                <tr class="texto_btgris">
                  <td colspan="4">&nbsp;</td>
                </tr>
                <tr class="texto_btgris">
                  <td height="50" colspan="2" valign="top"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#CCCCCC">
                      <td colspan="3" class="texto_btgris"><div align="center" class="Estilo1">PRESUPUESTADO vs REALIZADO vs FACTURADO </div></td>
                      </tr>
                    <tr>
                      <td height="24" valign="bottom">&nbsp;</td>
                      <td valign="bottom">&nbsp;</td>
                      <td valign="bottom">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="32%" valign="bottom"><div align="center"><span class="Estilo3"><?php echo "" . $row_tarea['HorasEstimadas']; ?></span><br>
                          <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="<?=$row_tarea['HorasEstimadas']?$row_tarea['HorasEstimadas']:0; ?>"></div></td>
                      <td width="31%" valign="bottom"><div align="center"><span class="Estilo3"><? echo $totalHorasRealizadas; ?></span><br>
                          <img src="images/<?=$row_tarea['HorasEstimadas']>$totalHorasRealizadas?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<?=$totalHorasRealizadas?$totalHorasRealizadas:0; ?>"></div></td>
                      <td width="37%" valign="bottom"><div align="center"><span class="Estilo3"><? echo $totalFacturado; ?></span><br>
                          <img src="images/3.gif" alt="Horas Realizadas" width="39" height="<?=$totalFacturado?$totalFacturado:0; ?>"></div></td>
                    </tr>
                    <tr bgcolor="#F3F3F3" class="texto_btgris">
                      <td><div align="center" class="Estilo1">Presupuestado</div></td>
                      <td><div align="center" class="Estilo1">Realizado</div></td>
                      <td><div align="center" class="Estilo1">Facturado</div></td>
                    </tr>
                  </table></td>
                  <td colspan="2"><form name="form1" method="POST" action="">
                    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr bgcolor="#CCCCCC">
                        <td colspan="3" class="texto_btgris"><div align="center" class="Estilo1">PORCENTAJE DE AVANCE </div></td>
                      </tr>
                      <tr>
                        <td colspan="3" valign="bottom"><div align="center">
                          <input name="porcAvance" type="text" class="texto_gris" id="porcAvance" value="<?php echo $row_tarea['porcAvance']; ?>" size="2" maxlength="3">
                          <span class="texto_gris">                          %</span>                          
                          <input name="Submit" type="submit" class="texto_gris" value="&gt;&gt;">
                          <input name="IdTarea" type="hidden" id="IdTarea" value="<?php echo $row_tarea['IdTarea']; ?>">
                          <input name="IdEmpresa" type="hidden" id="IdEmpresa" value="<? echo IdEmpresa; ?>">
</div></td>
                        </tr>
                      <tr>
                        <td width="32%" valign="bottom"><div align="center"><span class="Estilo3"><?php echo "100 %"; ?></span><br>
                                <img src="images/1.gif" alt="Horas Presupuestadas" width="39" height="100"></div></td>
								<?
								$totalPresupuesto=$row_tarea['HorasEstimadas'];
								$porRealizadas=$totalPresupuesto?($totalHorasRealizadas*100)/$totalPresupuesto:$totalHorasRealizadas;
								?>
                        <td width="31%" valign="bottom"><div align="center"><span class="Estilo3"><? echo $porRealizadas; ?></span><br>
                                <img src="images/<?=$porRealizadas<100?'2.gif':'4.png'?>" alt="Horas Realizadas" width="39" height="<? echo $porRealizadas; ?>"></div></td>
                        <td width="37%" valign="bottom"><div align="center"><span class="Estilo3"><? echo $row_tarea['porcAvance']; ?></span><br>
                                <img src="images/3.gif" alt="Horas Realizadas" width="39" height="<? echo $row_tarea['porcAvance']; ?>"></div></td>
                      </tr>
                      <tr bgcolor="#F3F3F3" class="texto_btgris">
                        <td><div align="center" class="Estilo1">Presupuestado</div></td>
                        <td><div align="center" class="Estilo1">Realizado</div></td>
                        <td><div align="center" class="Estilo1">% de Avance </div></td>
                      </tr>
                    </table>
                      <input type="hidden" name="MM_update" value="form1">
                  </form></td>
                </tr>
                <tr class="texto_btgris">
                  <td width="13%">&nbsp;</td>
                  <td width="37%">&nbsp;</td>
                  <td width="25%">&nbsp;</td>
                  <td width="25%">&nbsp;</td>
                </tr>
              </table>
              <p class="textotitulos">&nbsp;</p>
            </div></td>
          </tr>
        </table>
        <table width="100%" height="19" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bordergris">
          <tr>
            <td height="19"><div align="center"> </div></td>
          </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

@mysql_free_result($tarea);

@mysql_free_result($serv);

@mysql_free_result($empresa);

@mysql_free_result($totalHorasTarea);

@mysql_free_result($usuDisc);

@mysql_free_result($totalFact);

mysql_close($marambio);
?>