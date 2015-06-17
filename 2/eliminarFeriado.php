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

if ((isset($_POST['Id2000'])) && ($_POST['Id2000'] != "")) {
  $deleteSQL = sprintf("DELETE FROM feriados WHERE Id=%s",
                       GetSQLValueString($_POST['Id2000'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($deleteSQL, $marambio) or die(mysql_error());

  $deleteGoTo = "feriados.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$ORDEN2000=$_POST['Mes'] . $_POST['Dia'];
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

$colname_editar = "1";
if (isset($_GET['Id'])) {
  $colname_editar = (get_magic_quotes_gpc()) ? $_GET['Id'] : addslashes($_GET['Id']);
}

$query_editar = sprintf("SELECT * FROM feriados WHERE Id = %s", $colname_editar);
$editar = mysql_query($query_editar, $marambio) or die(mysql_error());
$row_editar = mysql_fetch_assoc($editar);
$totalRows_editar = mysql_num_rows($editar);

$CodGrupoXX=$row_data['IdGrupo'];
?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p class="titulo"><br>
                FERIADOS</p>
                <p><a href="feriados.php" class="texto_btgris">&lt;&lt; Volver</a> </p>
                <form method="POST" name="form1" action="">
                  <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                    <tr valign="baseline">
                      <td width="88" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">D&iacute;a:</td>
                      <td width="212" class="texto_gris"><?php echo $row_editar['Dia']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Mes:</td>
                      <td class="texto_gris"><?php echo $row_editar['Mes']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Descripci&oacute;n:</td>
                      <td class="texto_gris"><?php echo $row_editar['NombreFeriado']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td colspan="2" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="center">&iquest;Esta seguro(a) que desea Eliminar este Registro?</div></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td><input name="submit" type="submit" class="texto_btgris" value="SI &gt;&gt;">
                        <input name="Id2000" type="hidden" id="Id2000" value="<?php echo $row_editar['Id']; ?>">                       </td>
                    </tr>
                  </table>
              </form>
                <p>&nbsp;</p>
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

mysql_close($marambio);
?>