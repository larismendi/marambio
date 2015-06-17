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

mysql_select_db($database_marambio, $marambio);

$_POST['monto']=$_POST['tasa'] * $_POST['horas'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$insertSQL = sprintf("INSERT INTO orden_fact (IdTarea, IdGrupo, IdEmpresa, fechaEsp, fechaIng, concepto, monto, horas) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['IdTarea'], "int"),
                       GetSQLValueString($_POST['IdGrupo'], "int"),
                       GetSQLValueString($_POST['IdEmpresa'], "int"),
                       GetSQLValueString($_POST['fechaEsp'], "text"),
                       GetSQLValueString($_POST['fechaIng'], "text"),
                       GetSQLValueString($_POST['concepto'], "text"),
                       GetSQLValueString($_POST['monto'], "double"),
                       GetSQLValueString($_POST['horas'], "int"));

	$Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());

	$query_ofact = "SELECT * FROM orden_fact ORDER BY idOP DESC";
	$ofact = mysql_query($query_ofact, $marambio) or die(mysql_error());
	$row_ofact = mysql_fetch_assoc($ofact);
	$totalRows_ofact = mysql_num_rows($ofact);

	$insertGoTo = "o_fact3.php?idOP=" . $row_ofact['idOP'];
	if (isset($_SERVER['QUERY_STRING'])) {
    	$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    	$insertGoTo .= $_SERVER['QUERY_STRING'];
	}
	header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php
// QUIEN EN LA  SESSION
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

$query_tareasClientesList = "SELECT * FROM tareas WHERE /*activo = 1 AND*/ IdEmpresa='$IdEmpresa' ORDER BY IdTarea DESC";
$tareasClientesList = mysql_query($query_tareasClientesList, $marambio) or die(mysql_error());
$row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);

// BUSQUEDA DE HORAS TOTALES
$query_totalHorasTarea = "SELECT * FROM quincenasub WHERE CodificacionComp = '$IdTareaSelect'";
$totalHorasTarea = mysql_query($query_totalHorasTarea, $marambio) or die(mysql_error());
$row_totalHorasTarea = mysql_fetch_assoc($totalHorasTarea);
$totalRows_totalHorasTarea = mysql_num_rows($totalHorasTarea);

do { 
	$totalHorasRealizadas=$totalHorasRealizadas+$row_totalHorasTarea['D01']+$row_totalHorasTarea['D02']+$row_totalHorasTarea['D03']+$row_totalHorasTarea['D04']+$row_totalHorasTarea['D05']+$row_totalHorasTarea['D06']+$row_totalHorasTarea['D07']+$row_totalHorasTarea['D08']+$row_totalHorasTarea['D09']+$row_totalHorasTarea['D10']+$row_totalHorasTarea['D11']+$row_totalHorasTarea['D12']+$row_totalHorasTarea['D13']+$row_totalHorasTarea['D14']+$row_totalHorasTarea['D15']+$row_totalHorasTarea['D16']+$row_totalHorasTarea['D17']+$row_totalHorasTarea['D18']+$row_totalHorasTarea['D19']+$row_totalHorasTarea['D20']+$row_totalHorasTarea['D21']+$row_totalHorasTarea['D22']+$row_totalHorasTarea['D23']+$row_totalHorasTarea['D24']+$row_totalHorasTarea['D25']+$row_totalHorasTarea['D26']+$row_totalHorasTarea['D27']+$row_totalHorasTarea['D28']+$row_totalHorasTarea['D29']+$row_totalHorasTarea['D30']+$row_totalHorasTarea['D31'];
} while ($row_totalHorasTarea = mysql_fetch_assoc($totalHorasTarea)); 

// HORAS FACTURADAS	
$query_totalFact = "SELECT * FROM orden_fact WHERE IdTarea = '$IdTareaSelect'";
$totalFact = mysql_query($query_totalFact, $marambio) or die(mysql_error());
$row_totalFact = mysql_fetch_assoc($totalFact);
$totalRows_totalFact = mysql_num_rows($totalFact);	
do {
	$totalFacturado=$totalFacturado+$row_totalFact['horas'];
} while ($row_totalFact = mysql_fetch_assoc($totalFact)); 
?>
<?php include("includes/head.php"); ?>
<script language="JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
  } if (errors) alert('Los siguientes errores se han presentado:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<p align="left" class="textotitulos">
  <div align="center">
  <p class="titulo">ORDEN DE FACTURACION </p>
  <p><a href="o_fact.php?IdQna=<?php echo $IdQna; ?>" class="texto_btgris">&lt;&lt; Volver</a></p>
  <?php if($IdTareaSelect=='') { ?>
    <form method="get" name="form1" action="">
	<?php	
			  $IdGrupoZZ=$row_tareasClientesList['IdGrupo'];
			  $IdEmpresaZZ=$row_tareasClientesList['IdEmpresa'];			  
			  
			  $query_verGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupoZZ'";
              $verGrupo = mysql_query($query_verGrupo, $marambio) or die(mysql_error());
              $row_verGrupo = mysql_fetch_assoc($verGrupo);
              $totalRows_verGrupo = mysql_num_rows($verGrupo);

              $query_verEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$IdEmpresaZZ'";
              $verEmpresa = mysql_query($query_verEmpresa, $marambio) or die(mysql_error());
              $row_verEmpresa = mysql_fetch_assoc($verEmpresa);
              $totalRows_verEmpresa = mysql_num_rows($verEmpresa);
	?>
      <table width="399" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Grupo:</td>
          <td class="texto_btgris"><?php echo $row_verGrupo['Nombre']; ?></td>
        </tr>
        <tr valign="baseline">
          <td width="134" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Empresa:</td>
          <td width="297"><div align="left" class="texto_btgris"><?php echo $row_verEmpresa['Nombre']; ?>
          </div></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tarea Cliente:</td>
          <td>		  <div align="left">
            <select name="IdTareaSelect" class="texto_btgris" id="IdTareaSelect">
              <?php
do {  
?>
              <option value="<?php echo $row_tareasClientesList['IdTarea']?>">
			  <?php              
			  	echo $row_tareasClientesList['CodificacionComp']; 
				$IdServicioHH=$row_tareasClientesList['IdServicio']; 
			  	
				$query_servMostrar = "SELECT IdServicio, Servicio FROM servicios WHERE IdServicio = '$IdServicioHH'";
				$servMostrar = mysql_query($query_servMostrar, $marambio) or die(mysql_error());
				$row_servMostrar = mysql_fetch_assoc($servMostrar);
				$totalRows_servMostrar = mysql_num_rows($servMostrar);

				echo " - " . $row_servMostrar['Servicio'] . " / Horas: " . $row_tareasClientesList['HorasEstimadas'];
			  ?>
			  </option>
              <?php
} while ($row_tareasClientesList = mysql_fetch_assoc($tareasClientesList));
  $rows = mysql_num_rows($tareasClientesList);
  if($rows > 0) {
      mysql_data_seek($tareasClientesList, 0);
	  $row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);
  }
?>
            </select>
          </div></td>
        </tr>
		<tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5">&nbsp;</td>
          <td><input type="submit" class="texto_btgris" value="Siguiente">
            <input name="IdGrupo" type="hidden" id="IdGrupo2" value="<?php echo $row_tareasClientesList['IdGrupo']; ?>">
            <input name="IdEmpresa" type="hidden" id="IdEmpresa" value="<?php echo $row_tareasClientesList['IdEmpresa']; ?>">
            <input name="fechaEsp" type="hidden" id="fechaEsp" value="<?php echo date("d/m/Y"); ?>">
            <input name="fechaIng" type="hidden" id="fechaIng" value="<?php echo date("Ymd"); ?>"></td>
        </tr>
      </table>
        </form>
		<?php } ?>
    </div>
<?php if($IdTareaSelect!='') { ?>
				<form action="" method="POST" name="form1" onSubmit="MM_validateForm('horas','','R','concepto','','R');return document.MM_returnValue">
                  <?php 
	
			  $IdGrupoZZ=$row_tareasClientesList['IdGrupo'];
			  $IdEmpresaZZ=$row_tareasClientesList['IdEmpresa'];			  
			  
			  $query_verGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupoZZ'";
              $verGrupo = mysql_query($query_verGrupo, $marambio) or die(mysql_error());
              $row_verGrupo = mysql_fetch_assoc($verGrupo);

              $query_verEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$IdEmpresaZZ'";
              $verEmpresa = mysql_query($query_verEmpresa, $marambio) or die(mysql_error());
              $row_verEmpresa = mysql_fetch_assoc($verEmpresa);	
				?>
                  
                  <table width="478" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Grupo:</td>
                      <td class="texto_btgris"><?php echo $row_verGrupo['Nombre']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td width="153" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Empresa:</td>
                      <td width="312"><div align="left" class="texto_btgris"><?php echo $row_verEmpresa['Nombre']; ?> </div></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tarea Cliente:</td>
                      <td>
                        <div align="left" class="texto_btgris"> 
						<?php						
						$query_tareaMostrar = "SELECT * FROM tareas WHERE IdTarea = '$IdTareaSelect'";
						$tareaMostrar = mysql_query($query_tareaMostrar, $marambio) or die(mysql_error());
						$row_tareaMostrar = mysql_fetch_assoc($tareaMostrar);
						$idServicioMostrar=$row_tareaMostrar['IdServicio'];
						
						$query_servMostrar2 = "SELECT * FROM servicios WHERE IdServicio = '$idServicioMostrar'";
						$servMostrar2 = mysql_query($query_servMostrar2, $marambio) or die(mysql_error());
						$row_servMostrar2 = mysql_fetch_assoc($servMostrar2);
						echo $row_tareaMostrar['CodificacionComp'] . " " . $row_servMostrar2['Servicio'];
						?>
						
						</div></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris">Horas Presupuestadas </td>
                      <td class="texto_btgris"><?php echo $row_tareaMostrar['HorasEstimadas']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris"> Horas Realizadas </td>
                      <td class="texto_btgris"><?php echo $totalHorasRealizadas ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris">Horas Facturadas </td>
                      <td class="texto_btgris"><?php echo $totalFacturado; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris">Concepto:</td>
                      <td><textarea name="concepto" cols="50" rows="7" class="texto_btgris" id="concepto"></textarea></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tasa:</td>
                      <td><span class="texto_btgris"><?php print (number_format ($row_tareaMostrar['Tasa'],2,chr(44),".")) ; ?> x Hora </span></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="right">Horas a Cobrar: </div></td>
                      <td><div align="left">
                          <input name="horas" type="text" class="texto_btgris" id="horas" size="4">
                      </div></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5">&nbsp;</td>
                      <td><input name="submit" type="submit" class="texto_btgris" value="Orden de Facturacion">
                          <input name="IdGrupo" type="hidden" id="IdGrupo" value="<?php echo $IdGrupo; ?>">
                          <input name="IdEmpresa" type="hidden" id="IdEmpresa" value="<?php echo $IdEmpresa; ?>">
                          <input name="fechaEsp" type="hidden" id="fechaEsp" value="<?php echo date("d/m/Y"); ?>">
                          <input name="fechaIng" type="hidden" id="fechaIng" value="<?php echo date("Ymd"); ?>">
                      <input name="IdTarea" type="hidden" id="IdTarea" value="<?php echo $IdTareaSelect; ?>">
                      <input name="tasa" type="hidden" id="tasa" value="<?php echo $row_tareaMostrar['Tasa'];  ?>"></td>
                    </tr>
                  </table>
                  <input name="MM_insert" type="hidden" id="MM_insert" value="form1">
              </form>
				<?php } ?>
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

@mysql_free_result($tareasClientesList);

@mysql_free_result($servMostrar);

@mysql_free_result($tareaMostrar);

@mysql_free_result($servMostrar2);

@mysql_free_result($ofact);

mysql_close($marambio);
?>