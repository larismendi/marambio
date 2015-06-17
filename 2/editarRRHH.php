<?php 
require_once('Connections/marambio.php');
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
	header ("Location: ../index.php"); 
}

mysql_select_db($database_marambio, $marambio);

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
	if($_POST['Cargo']=='Socio') {
		$Nivel2000=1;
	} elseif($_POST['Cargo']=='Gerente') {
		$Nivel2000=2;
	} elseif($_POST['Cargo']=='Encargado') {
		$Nivel2000=3;
	} elseif($_POST['Cargo']=='Auditor') {
		$Nivel2000=4;
	} elseif($_POST['Cargo']=='Supervisor') {
		$Nivel2000=5;
	}
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$validate = "";
	if($_POST['nombre_viejo'] != $_POST['Nombre']){
		$sqq = "SELECT Nombre FROM usuarios WHERE Nombre LIKE '".$_POST['Nombre']."'";
		$RES = mysql_query($sqq, $marambio) or die(mysql_error());
		if($RES){
			$validate = "falso";
		}
	}
	if($validate == ""){
		$updateSQL = sprintf("UPDATE usuarios SET IdUnidad=%s, Nombre=%s, Usuario=%s, Pass=%s, Nivel=%s, Cargo=%s, Telefono=%s, Ext=%s WHERE IdUsuario=%s",
							 GetSQLValueString($_POST['IdUnidad'], "int"),
							 GetSQLValueString($_POST['Nombre'], "text"),
							 GetSQLValueString($_POST['Usuario'], "text"),
							 GetSQLValueString($_POST['Pass'], "text"),
							 GetSQLValueString($Nivel2000, "int"),
							 GetSQLValueString($_POST['Cargo'], "text"),
							 GetSQLValueString($_POST['Telefono'], "text"),
							 GetSQLValueString($_POST['Ext'], "text"),
							 GetSQLValueString($_POST['IdUsuario'], "int"));
	  
		
		$Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
	  
		$updateGoTo = "rrhh.php";
		if (isset($_SERVER['QUERY_STRING'])) {
		  $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		  $updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}else{
		$mensaje = "El cambio no se puede realizar, intente con otro nombre";	
	}
}
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$totalRows_quienEs = mysql_num_rows($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

$colname_data = "1";
if (isset($_GET['IdUsuario'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdUsuario'] : addslashes($_GET['IdUsuario']);
}

$query_data = sprintf("SELECT * FROM usuarios WHERE IdUsuario = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$query_unidadList = "SELECT * FROM unidades ORDER BY Nombre ASC";
$unidadList = mysql_query($query_unidadList, $marambio) or die(mysql_error());
$row_unidadList = mysql_fetch_assoc($unidadList);
$totalRows_unidadList = mysql_num_rows($unidadList);

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
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener un correo.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' debe contener un numero.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
  } if (errors) alert('Los siguientes errores se han presentado:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<script type="text/javascript" src="autoComplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("autoComplete/con_usuarios.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>
<link href="autoComplete/estilo_auto.css" rel="stylesheet" type="text/css">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">RRHH</p>
                <p><a href="rrhh.php" class="texto_btgris">&lt;&lt; Volver</a></p>
                <form action="" method="POST" name="form1" onSubmit="MM_validateForm('Nombre', '', 'R', 'Usuario', '', 'R', 'Pass', '', 'R');return document.MM_returnValue">
                <input type="hidden" name="nombre_viejo" value="<?php echo $row_data['Nombre']; ?>">
                <table>
                	<tr>
                    	<td width="200">&nbsp;</td>
                        <td valign="top">
                          <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                            <tr valign="baseline">
                              <td width="112" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                              <td width="204"><input name="Nombre" type="text" class="texto_gris" value="<?php echo $row_data['Nombre']; ?>" size="45" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Usuario:</td>
                              <td><input name="Usuario" type="text" class="texto_gris" value="<?php echo $row_data['Usuario']; ?>" size="20"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Password:</td>
                              <td><input name="Pass" type="password" class="texto_gris" value="<?php echo $row_data['Pass']; ?>" size="20"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Cargo:</td>
                              <td>
                                <select name="Cargo" class="texto_gris" id="Cargo">
                                  <option value="Socio" <?php if (!(strcmp("Socio", $row_data['Cargo']))) {echo "SELECTED";} ?>>Socio</option>
                                  <option value="Gerente" <?php if (!(strcmp("Gerente", $row_data['Cargo']))) {echo "SELECTED";} ?>>Gerente</option>
                                  <option value="Supervisor" <?php if (!(strcmp("Supervisor", $row_data['Cargo']))) {echo "SELECTED";} ?>>Supervisor</option>
                                  <option value="Encargado" <?php if (!(strcmp("Encargado", $row_data['Cargo']))) {echo "SELECTED";} ?>>Encargado</option>
                                  <option value="Auditor" <?php if (!(strcmp("Auditor", $row_data['Cargo']))) {echo "SELECTED";} ?>>Auditor</option>
                              </select></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Unidad</td>
                              <td><select name="IdUnidad" class="texto_gris" id="IdUnidad">
                                  <?php
                                    do {  
                                    ?>
                                  <option value="<?php echo $row_unidadList['IdUnidad']?>"<?php if (!(strcmp($row_unidadList['IdUnidad'], $row_data['IdUnidad']))) {echo "SELECTED";} ?>><?php echo $row_unidadList['Nombre']?></option>
                                  <?php
                                    } while ($row_unidadList = mysql_fetch_assoc($unidadList));
                                      $rows = mysql_num_rows($unidadList);
                                      if($rows > 0) {
                                          mysql_data_seek($unidadList, 0);
                                          $row_unidadList = mysql_fetch_assoc($unidadList);
                                      }
                                    ?>
                              </select></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fono:</td>
                              <td><input name="Telefono" type="text" class="texto_gris" value="<?php echo $row_data['Telefono']; ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Ext:</td>
                              <td><input name="Ext" type="text" class="texto_gris" value="<?php echo $row_data['Ext']; ?>" size="10"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                              <td><input name="submit" type="submit" class="texto_btgris" value="Guardar &gt;&gt;">
                                  <input name="IdUsuario" type="hidden" id="IdUsuario" value="<?php echo $row_data['IdUsuario']; ?>">
                                  <input name="Nivel" type="hidden" id="Nivel"></td>
                            </tr>
                          </table>
                  			</td>
                           <td width="200" valign="top">
                           	<div class="suggestionsBox" id="suggestions" style="display: none;">
                                  <div class="suggestionList" id="autoSuggestionsList">
                                      &nbsp;
                                  </div>
                            </div>
                           </td>
                        </tr>
                    </table>
                  <input type="hidden" name="MM_update" value="form1">
              </form>
                <p></p>
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="textotitulos">&nbsp;</p>
                <p class="textotitulos">&nbsp;</p>
            </div></td>
          </tr>
        </table>
        <table width="100%" height="39" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bordergris">
          <tr>
            <td height="37"><div align="center"> </div></td>
          </tr>
      </table></td>
  </tr>
</table>
<script>
var mensaje = "<?php echo $mensaje;?>";
if(mensaje){
	alert("<?php echo $mensaje;?>");
}

</script>
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

@mysql_free_result($data);

@mysql_free_result($unidadList);

mysql_close($marambio);
?>
