<?php require_once('Connections/marambio.php'); ?>
<?php
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

$codCompleta=$_POST['Anno'] . $_POST['Mes'] . $_POST['Quincena'];
mysql_select_db($database_marambio, $marambio);
$query_verifica = "SELECT * FROM quincenas WHERE CodificacionCompleta = '$codCompleta'";
$verifica = mysql_query($query_verifica, $marambio) or die(mysql_error());
$row_verifica = mysql_fetch_assoc($verifica);
$totalRows_verifica = mysql_num_rows($verifica);

if($totalRows_verifica=='') { 
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  		$insertSQL = sprintf("INSERT INTO quincenas (Quincena, Mes, Anno, CodificacionCompleta, horlab, activa) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Quincena'], "int"),
                       GetSQLValueString($_POST['Mes'], "text"),
                       GetSQLValueString($_POST['Anno'], "text"),
                       GetSQLValueString($codCompleta, "text"),
					   GetSQLValueString($_POST['horlab'], "text"),
                       GetSQLValueString($_POST['activa'], "int"));

		  mysql_select_db($database_marambio, $marambio);
		  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());
		
		  $insertGoTo = "quincenas.php";
		  if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= $_SERVER['QUERY_STRING'];
		  }
		  header(sprintf("Location: %s", $insertGoTo));
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
?>
<?php include("includes/head.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
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
<script language="JavaScript" src="mm_menu.js"></script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #FF0000}
-->
</style>
                <p align="left" class="textotitulos">&nbsp;</p>
                  <p class="titulo">QUINCENAS</p>
                <p><a href="quincenas.php" class="texto_btgris">&lt;&lt; Volver</a> </p>
                <p>
				<?php 	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { 
							if($totalRows_verifica!='') { 
				?>
						<span class="titulo Estilo2">La quincena ya esta registrada en el sistema. </span>
				<?php 		} 
						} 
				?>
				</p>
                <form action="" method="post" name="form1" onSubmit="MM_validateForm('Anno','','R');return document.MM_returnValue">
                  <table width="277" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                    <tr valign="baseline">
                      <td width="92" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Quincena:</td>
                      <td width="195">
                      <select name="Quincena" class="texto_btgris" id="Quincena">
                        <option value="01">1ra</option>
                        <option value="02">2da</option>
                      </select></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Mes:</td>
                      <td><select name="Mes" class="texto_btgris" id="Mes">
					  <option value="<?php echo date("m") ?>"><?php echo date("m") ?></option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">A&ntilde;o:</td>
                      <td><input name="Anno" type="text" class="texto_btgris" id="Anno" value="<?php echo date("Y") ?>" size="4" maxlength="4"></td>
                    </tr>
                    <tr>
                    	<td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Hora Laborable:</td>
                        <td><input name="horlab" type="text" class="texto_btgris" id="horlab" value="" size="4" maxlength="4"></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td><input type="submit" class="texto_btgris" value="Insertar registro">
                        <input name="activa" type="hidden" id="activa" value="1">
                      <input name="CodificacionCompleta" type="hidden" id="CodificacionCompleta"></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1">
              </form>
                <p>&nbsp;</p>
              <p align="center" class="textotitulos">&nbsp;                  </p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
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
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

@mysql_free_result($verifica);

mysql_close($marambio);
?>