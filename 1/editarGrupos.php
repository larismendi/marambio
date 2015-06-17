<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
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
	mysql_select_db($database_marambio, $marambio);	

	if($nom != $_POST['Nombre']){
		$sfs = "SELECT CodEmp FROM grupos WHERE Nombre = '".$_POST['Nombre']."' ";
		$e_var = mysql_query($sfs, $marambio) or die(mysql_error());
		$var = mysql_fetch_array($e_var);
	}
	if(!$var){
	  $updateSQL = sprintf("UPDATE grupos SET Nombre=%s, Direccion=%s, Telefonos=%s, Fax=%s, PersonaContac=%s WHERE IdGrupo=%s",
						   GetSQLValueString($_POST['Nombre'], "text"),
						   GetSQLValueString($_POST['Direccion'], "text"),
						   GetSQLValueString($_POST['Telefonos'], "text"),
						   GetSQLValueString($_POST['Fax'], "text"),
						   GetSQLValueString($_POST['PersonaContac'], "text"),
						   GetSQLValueString($_POST['IdGrupo'], "int"));
	
	  
	  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
	
	  $updateGoTo = "grupos.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		$updateGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  header(sprintf("Location: %s", $updateGoTo));
	}else{
		$mensaje = "Ya existe un grupo diferente con este nombre, intente con otro.";
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
if (isset($_GET['IdGrupo'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}

$query_data = sprintf("SELECT * FROM grupos WHERE IdGrupo = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

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

                <p align="left" class="textotitulos">&nbsp;</p>
              <p align="center" class="textotitulos"><span class="titulo">GRUPOS </span></p>
                <p class="titulo"><span class="textogris"><a href="grupos.php" class="texto_gris">&lt;&lt; Volver </a></span></p>
                <p class="textotitulos">
				<form action="" method="POST" name="form1" onSubmit="MM_validateForm('Nombre','','R');return document.MM_returnValue">
                <table>
                	<tr>
                    	<td width="200">&nbsp;</td>
                    	<td valign="top">
                          <table width="42%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                            <tr>
                              <td width="45%" bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo:</td>
                              <td width="55%" class="texto_btgris"><?php echo $row_data['IdGrupo']; ?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                              <td class="textogrande"><input name="Nombre" type="text" class="texto_gris" value="<?php echo $row_data['Nombre']; ?>" size="32" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E5E5E5" class="texto_btgris">Direcci&oacute;n:</td>
                              <td class="textogrande"><textarea name="Direccion" cols="32" class="texto_gris"><?php echo $row_data['Direccion']; ?></textarea></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fonos:</td>
                              <td class="textogrande"><input name="Telefonos" type="text" class="texto_gris" value="<?php echo $row_data['Telefonos']; ?>" size="32"></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E5E5E5" class="texto_btgris">Fax:</td>
                              <td class="textogrande"><input name="Fax" type="text" class="texto_gris" value="<?php echo $row_data['Fax']; ?>" size="32"></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E5E5E5" class="texto_btgris">Persona Contacto: </td>
                              <td class="textogrande"><input name="PersonaContac" type="text" class="texto_gris" value="<?php echo $row_data['PersonaContac']; ?>" size="32"></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                              <td class="textogrande"><input name="Submit" type="submit" class="texto_btgris" value="Guardar &gt;&gt;">
                                <input name="IdGrupo" type="hidden" id="IdGrupo" value="<?php echo $row_data['IdGrupo']; ?>"></td>
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
				</p>
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
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

@mysql_free_result($data);

mysql_close($marambio);
?>
