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

if ((isset($_POST['CodEmp2000'])) && ($_POST['CodEmp2000'] != "")) {
  $deleteSQL = sprintf("DELETE FROM empresas WHERE CodEmp=%s",
                       GetSQLValueString($_POST['CodEmp2000'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($deleteSQL, $marambio) or die(mysql_error());

  $deleteGoTo = "empresas.php";
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
if (isset($_GET['CodEmp'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['CodEmp'] : addslashes($_GET['CodEmp']);
}

$query_data = sprintf("SELECT * FROM empresas WHERE CodEmp = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$IdGrupo2000=$row_data['CodGrupo'];

$query_grupoName = "SELECT * FROM grupos WHERE IdGrupo = '$IdGrupo2000'";
$grupoName = mysql_query($query_grupoName, $marambio) or die(mysql_error());
$row_grupoName = mysql_fetch_assoc($grupoName);
$totalRows_grupoName = mysql_num_rows($grupoName);
?>
<?php include("includes/head.php"); ?>
                <p align="left" class="textotitulos">&nbsp;</p>
                <p align="center" class="titulo">EMPRESAS</p>
                <p align="center" class="textotitulos"><a href="empresas.php" class="texto_btgris">&lt;&lt; Volver </a></p>
                <p align="center" class="textotitulos"><form name="form1" method="post" action="">
                <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr valign="baseline">
                    <td width="125" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo:</td>
                    <td width="281" class="texto_gris"><?php echo $row_data['CodEmp']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Grupo:</td>
                    <td class="texto_gris"><?php echo $row_grupoName['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo Contable: </td>
                    <td class="texto_gris"><?php echo $row_data['CodCont']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                    <td class="texto_gris"><?php echo $row_data['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris">Direcci&oacute;n:</td>
                    <td class="texto_gris"><?php echo $row_data['Direccion']; ?> </td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fonos:</td>
                    <td class="texto_gris"><?php echo $row_data['Telefonos']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Fax:</td>
                    <td class="texto_gris"><?php echo $row_data['Fax']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Persona Encargada:</td>
                    <td class="texto_gris"><?php echo $row_data['PersonaEnc']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Email:</td>
                    <td class="texto_gris"><?php echo $row_data['email']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td colspan="2" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="center">&iquest;Esta seguro(a) que desea Eliminar este Registro?</div></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                    <td class="textogrande"><input name="Submit" type="submit" class="texto_btgris" value="SI &gt;&gt;">
                    <input name="CodEmp2000" type="hidden" id="CodEmp2000" value="<?php echo $row_data['CodEmp']; ?>"></td>
                  </tr>
                </table>
              </form></p>
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

@mysql_free_result($grupoName);

mysql_close($marambio);
?>
