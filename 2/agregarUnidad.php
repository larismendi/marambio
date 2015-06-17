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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO unidades (Nombre, Encargado) VALUES (%s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Encargado'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());

  $insertGoTo = "unidades.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

$query_encargadoList = "SELECT IdUsuario, Nombre FROM usuarios ORDER BY Nombre ASC";
$encargadoList = mysql_query($query_encargadoList, $marambio) or die(mysql_error());
$row_encargadoList = mysql_fetch_assoc($encargadoList);
$totalRows_encargadoList = mysql_num_rows($encargadoList);

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

                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">UNIDADES </p>
                <p><a href="unidades.php" class="texto_btgris">&lt;&lt; Volver</a> </p>
                <form action="" method="post" name="form1" onSubmit="MM_validateForm('Nombre','','R');return document.MM_returnValue">
                  <table width="324" align="center">
                    <tr valign="baseline">
                      <td width="108" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre Unidad:</td>
                      <td width="204"><input name="Nombre" type="text" class="texto_gris" value="" size="40"></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Encargado:</td>
                      <td><select name="Encargado" class="texto_btgris" id="Encargado">
                          <option value="0">Seleccione >></option>
                          <?php
							do {  
							?>
                          <option value="<?php echo $row_encargadoList['IdUsuario']?>"><?php echo $row_encargadoList['Nombre']?></option>
                          <?php
							} while ($row_encargadoList = mysql_fetch_assoc($encargadoList));
							  $rows = mysql_num_rows($encargadoList);
							  if($rows > 0) {
								  mysql_data_seek($encargadoList, 0);
								  $row_encargadoList = mysql_fetch_assoc($encargadoList);
							  }
							?>
                      </select></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td bgcolor="#E5E5E5"><input name="submit" type="submit" class="texto_btgris" value="Insertar registro"></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1">
              </form>
                <p>&nbsp;</p>
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
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

@mysql_free_result($encargadoList);

mysql_close($marambio);
?>
