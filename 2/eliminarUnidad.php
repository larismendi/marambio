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

if ((isset($_POST['IdUnidad'])) && ($_POST['IdUnidad'] != "")) {
  $deleteSQL = sprintf("DELETE FROM unidades WHERE IdUnidad=%s",
                       GetSQLValueString($_POST['IdUnidad'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($deleteSQL, $marambio) or die(mysql_error());

  $deleteGoTo = "unidades.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
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

$colname_editar = "1";
if (isset($_GET['IdUnidad'])) {
  $colname_editar = (get_magic_quotes_gpc()) ? $_GET['IdUnidad'] : addslashes($_GET['IdUnidad']);
}
mysql_select_db($database_marambio, $marambio);
$query_editar = sprintf("SELECT * FROM unidades WHERE IdUnidad = %s", $colname_editar);
$editar = mysql_query($query_editar, $marambio) or die(mysql_error());
$row_editar = mysql_fetch_assoc($editar);
$totalRows_editar = mysql_num_rows($editar);

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">UNIDADES </p>
                <p><a href="unidades.php" class="texto_btgris">&lt;&lt; Volver</a> </p>
                <form method="POST" name="form1">
                  <table width="324" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                    <tr valign="baseline">
                      <td width="108" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo:</td>
                      <td width="204" class="texto_gris"><?php echo $row_editar['IdUnidad']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre Unidad:</td>
                      <td class="texto_gris"><?php echo $row_editar['Nombre']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td colspan="2" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="center">&iquest;Esta seguro(a) que desea Eliminar este Registro?</div></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td bgcolor="#FFFFFF"><input name="submit" type="submit" class="texto_btgris" value="SI &gt;&gt;">
                          <input name="IdUnidad" type="hidden" id="IdUnidad" value="<?php echo $row_editar['IdUnidad']; ?>"></td>
                    </tr>
                  </table>
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

@mysql_free_result($editar);


?>
