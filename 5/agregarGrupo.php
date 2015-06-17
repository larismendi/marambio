<?php require_once('Connections/marambio.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $nombre = strtoupper($_POST['Nombre']);
	$sss = "SELECT * FROM grupos WHERE Nombre = '$nombre' OR Nombre = '".$_POST['Nombre']."'";
	$e_sss = mysql_query($sss, $marambio) or die (mysql_error());
	$f_sss = mysql_fetch_assoc($e_sss);

	if(!$f_sss){
  $insertSQL = sprintf("INSERT INTO grupos (Nombre, Direccion, Telefonos, Fax, PersonaContac) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Telefonos'], "text"),
                       GetSQLValueString($_POST['Fax'], "text"),
                       GetSQLValueString($_POST['PersonaContac'], "text"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());

  $insertGoTo = "grupos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
	}else{
		$mensaje = "El grupo ya existe, intente con otro nombre";
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

mysql_select_db($database_marambio, $marambio);
$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

?>
<?php include("includes/head.php"); ?>
<STYLE type=text/css>
A:hover {
	COLOR: #AFC4DF
}
BODY {
	SCROLLBAR-FACE-COLOR: #FFFFFF; SCROLLBAR-HIGHLIGHT-COLOR: #AFC4DF; SCROLLBAR-SHADOW-COLOR: #FCEA9A; SCROLLBAR-ARROW-COLOR: #AFC4DF; SCROLLBAR-BASE-COLOR: #FCEA9A; scrollbar-3d-light-color: #AFC4DF; scrollbar-dark-shadow-color: #FFFFFF
}
</STYLE>

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
			$.post("autoComplete/con_grupos.php", {queryString: ""+inputString+""}, function(data){
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

                <p align="center" class="textotitulos"><br>
                  <span class="titulo">GRUPOS </span></p>
                <p class="titulo"><span class="textogris"><a href="grupos.php" class="texto_gris">&lt;&lt; Volver </a></span></p>
                <form action="" method="post" name="form1" onSubmit="MM_validateForm('Nombre','','R');return document.MM_returnValue">
                <table>
                    <tr>
                    	<td width="200" height="194" valign="top">&nbsp;</td>
                    	<td valign="top">
                          <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                            <tr valign="baseline">
                              <td width="130" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                              <td width="247"><input name="Nombre" id="inputString" type="text" class="texto_gris" value="" size="32" onkeyup="lookup(this.value);" onblur="fill();">
                              </td>
                            </tr>
                              
                            <tr valign="baseline">
                              <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris">Direcci&oacute;n:</td>
                              <td><textarea name="Direccion" cols="32" class="texto_gris"></textarea></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fonos:</td>
                              <td><input name="Telefonos" type="text" class="texto_gris" value="" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Fax:</td>
                              <td><input name="Fax" type="text" class="texto_gris" value="" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Persona Contacto:</td>
                              <td><input name="PersonaContac" type="text" class="texto_gris" value="" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                              <td><input name="submit" type="submit" class="texto_btgris" value="Insertar registro"></td>
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
                  <input type="hidden" name="MM_insert" value="form1">
              </form>
                <p class="textogris">&nbsp;</p>
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
var mensaje = "<?php echo $mensaje; ?>";
if(mensaje){
	alert("<?php echo $mensaje; ?>");
}
</script>
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

mysql_close($marambio);
?>

