<?php require_once('Connections/marambio.php'); ?>
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

if ((isset($_POST['idOP'])) && ($_POST['idOP'] != "")) {
  $deleteSQL = sprintf("DELETE FROM orden_fact WHERE idOP=%s",
                       GetSQLValueString($_POST['idOP'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($deleteSQL, $marambio) or die(mysql_error());

  $deleteGoTo = "o_fact.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<?php
session_start();
$sessionid = session_id();
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

$colname_eliminar = "1";
if (isset($_GET['idOP'])) {
  $colname_eliminar = (get_magic_quotes_gpc()) ? $_GET['idOP'] : addslashes($_GET['idOP']);
}

$query_eliminar = sprintf("SELECT * FROM orden_fact WHERE idOP = %s", $colname_eliminar);
$eliminar = mysql_query($query_eliminar, $marambio) or die(mysql_error());
$row_eliminar = mysql_fetch_assoc($eliminar);
$totalRows_eliminar = mysql_num_rows($eliminar);
?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="1094" valign="top" ><div align="center">
                <p align="left" class="textotitulos">
			  <div align="center">
  <p class="titulo">ORDEN DE FACTURACION </p>
  <p><a href="o_fact.php?IdQna=<?php echo $IdQna; ?>" class="texto_btgris">&lt;&lt; Volver</a></p>
  
    <form method="POST" name="form1" action="">
      <table width="281" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
        <tr valign="baseline">
          <td width="136" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Orden de Facturaci&oacute;n: </td>
          <td width="132" class="texto_btgris Estilo1 Estilo2"><?php echo $row_eliminar['idOP']; ?> </td>
        </tr>
		<tr valign="baseline">
          <td colspan="2" align="right" nowrap bgcolor="#E5E5E5"><div align="center">
              <input type="submit" class="texto_btgris" value="Eliminar Orden de Facturacion">
              <input name="idOP" type="hidden" id="idOP" value="<?php echo $row_eliminar['idOP']; ?>">
          </div></td>
          </tr>
      </table>
    </form>
    </div>

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

@mysql_free_result($eliminar);

@mysql_free_result($servMostrar);

@mysql_free_result($ofact);

mysql_close($marambio);
?>