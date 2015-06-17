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

$ORDEN2000=$_POST['Mes'] . $_POST['Dia'];
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE feriados SET Dia=%s, Mes=%s, ORDEN=%s, NombreFeriado=%s WHERE Id=%s",
                       GetSQLValueString($_POST['Dia'], "text"),
                       GetSQLValueString($_POST['Mes'], "text"),
                       GetSQLValueString($ORDEN2000, "text"),
                       GetSQLValueString($_POST['NombreFeriado'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());

  $updateGoTo = "feriados.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
                <p class="titulo"><br>
                FERIADOS</p>
                <p><a href="feriados.php" class="texto_btgris">&lt;&lt; Volver</a> </p>
                <form method="POST" name="form1" action="">
                  <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                    <tr valign="baseline">
                      <td width="88" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">D&iacute;a:</td>
                      <td width="212"><select name="Dia" class="texto_gris" id="Dia">
                        <option value="01" <?=$row_editar['Dia']=='01'?"SELECTED":''?>>01</option>
                        <option value="02" <?=$row_editar['Dia']=='02'?"SELECTED":''?>>02</option>
						<option value="03" <?=$row_editar['Dia']=='03'?"SELECTED":''?>>03</option>
						<option value="04" <?=$row_editar['Dia']=='04'?"SELECTED":''?>>04</option>
						<option value="05" <?=$row_editar['Dia']=='05'?"SELECTED":''?>>05</option>
						<option value="06" <?=$row_editar['Dia']=='06'?"SELECTED":''?>>06</option>
						<option value="07" <?=$row_editar['Dia']=='07'?"SELECTED":''?>>07</option>
						<option value="08" <?=$row_editar['Dia']=='08'?"SELECTED":''?>>08</option>
						<option value="09" <?=$row_editar['Dia']=='09'?"SELECTED":''?>>09</option>
						<option value="10" <?=$row_editar['Dia']=='10'?"SELECTED":''?>>10</option>
						<option value="11" <?=$row_editar['Dia']=='11'?"SELECTED":''?>>11</option>
						<option value="12" <?=$row_editar['Dia']=='12'?"SELECTED":''?>>12</option>
						<option value="13" <?=$row_editar['Dia']=='13'?"SELECTED":''?>>13</option>
						<option value="14" <?=$row_editar['Dia']=='14'?"SELECTED":''?>>14</option>
						<option value="15" <?=$row_editar['Dia']=='15'?"SELECTED":''?>>15</option>
						<option value="16" <?=$row_editar['Dia']=='16'?"SELECTED":''?>>16</option>
						<option value="17" <?=$row_editar['Dia']=='17'?"SELECTED":''?>>17</option>
						<option value="18" <?=$row_editar['Dia']=='18'?"SELECTED":''?>>18</option>
						<option value="19" <?=$row_editar['Dia']=='19'?"SELECTED":''?>>19</option>
						<option value="20" <?=$row_editar['Dia']=='20'?"SELECTED":''?>>20</option>
						<option value="21" <?=$row_editar['Dia']=='21'?"SELECTED":''?>>21</option>
						<option value="22" <?=$row_editar['Dia']=='22'?"SELECTED":''?>>22</option>
						<option value="23" <?=$row_editar['Dia']=='23'?"SELECTED":''?>>23</option>
						<option value="24" <?=$row_editar['Dia']=='24'?"SELECTED":''?>>24</option>
						<option value="25" <?=$row_editar['Dia']=='25'?"SELECTED":''?>>25</option>
						<option value="26" <?=$row_editar['Dia']=='26'?"SELECTED":''?>>26</option>
						<option value="27" <?=$row_editar['Dia']=='27'?"SELECTED":''?>>27</option>
						<option value="28" <?=$row_editar['Dia']=='28'?"SELECTED":''?>>28</option>
						<option value="29" <?=$row_editar['Dia']=='29'?"SELECTED":''?>>29</option>
						<option value="30" <?=$row_editar['Dia']=='30'?"SELECTED":''?>>30</option>
						<option value="31" <?=$row_editar['Dia']=='31'?"SELECTED":''?>>31</option>
                      </select></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Mes:</td>
                      <td><select name="Mes" class="texto_gris" id="Mes">
					    <option value="<?php echo $row_editar['Mes']; ?>"><?php echo $row_editar['Mes']; ?></option>
                        <option value="01" <?=$row_editar['Mes']=='01'?"SELECTED":''?>>01</option>
                        <option value="02" <?=$row_editar['Mes']=='02'?"SELECTED":''?>>02</option>
                        <option value="03" <?=$row_editar['Mes']=='03'?"SELECTED":''?>>03</option>
						<option value="04" <?=$row_editar['Mes']=='04'?"SELECTED":''?>>04</option>
						<option value="05" <?=$row_editar['Mes']=='05'?"SELECTED":''?>>05</option>
						<option value="06" <?=$row_editar['Mes']=='06'?"SELECTED":''?>>06</option>
						<option value="07" <?=$row_editar['Mes']=='07'?"SELECTED":''?>>07</option>
						<option value="08" <?=$row_editar['Mes']=='08'?"SELECTED":''?>>08</option>
						<option value="09" <?=$row_editar['Mes']=='09'?"SELECTED":''?>>09</option>
						<option value="10" <?=$row_editar['Mes']=='10'?"SELECTED":''?>>10</option>
						<option value="11" <?=$row_editar['Mes']=='11'?"SELECTED":''?>>11</option>
						<option value="12" <?=$row_editar['Mes']=='12'?"SELECTED":''?>>12</option>
                      </select></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Descripci&oacute;n:</td>
                      <td><input name="NombreFeriado" type="text" class="texto_gris" id="NombreFeriado" value="<?php echo $row_editar['NombreFeriado']; ?>" size="40"></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td><input name="submit" type="submit" class="texto_btgris" value="Guardar &gt;&gt;">
                        <input name="ORDEN" type="hidden" id="ORDEN" value="<?php echo $row_editar['ORDEN']; ?>">                          
                        <input name="Id" type="hidden" id="Id" value="<?php echo $row_editar['Id']; ?>">
                      </td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1">
                  <input type="hidden" name="MM_update" value="form1">
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