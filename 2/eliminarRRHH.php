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

if ((isset($_POST['IdUsuario'])) && ($_POST['IdUsuario'] != "")) {
  $deleteSQL = sprintf("DELETE FROM usuarios WHERE IdUsuario=%s",
                       GetSQLValueString($_POST['IdUsuario'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($deleteSQL, $marambio) or die(mysql_error());

  $deleteGoTo = "rrhh.php";
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

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="titulo">RRHH</p>
                <p><a href="rrhh.php" class="texto_btgris">&lt;&lt; Volver</a></p>
                <form method="POST" name="form1">
                  <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                    <tr valign="baseline">
                      <td width="112" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                      <td width="204" class="texto_gris"><?php echo $row_data['Nombre']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Usuario:</td>
                      <td class="texto_gris"><?php echo $row_data['Usuario']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td colspan="2" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="center">&iquest;Esta seguro(a) que desea Eliminar este Registro?</div></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td><input name="submit" type="submit" class="texto_btgris" value="SI &gt;&gt;">
                          <input name="IdUsuario" type="hidden" id="IdUsuario" value="<?php echo $row_data['IdUsuario']; ?>"></td>
                    </tr>
                  </table>
                </form>
                <p>&nbsp;</p>
                <p align="center" class="textotitulos">&nbsp;</p>
                <p align="left" class="textotitulos">&nbsp;</p>
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

@mysql_free_result($data);

mysql_close($marambio);
?>
