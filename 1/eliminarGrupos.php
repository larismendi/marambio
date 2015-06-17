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

if ((isset($_POST['IdGrupo2000'])) && ($_POST['IdGrupo2000'] != "")) {
  $deleteSQL = sprintf("DELETE FROM grupos WHERE IdGrupo=%s",
                       GetSQLValueString($_POST['IdGrupo2000'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($deleteSQL, $marambio) or die(mysql_error());

  $deleteGoTo = "grupos.php";
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
if (isset($_GET['IdGrupo'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}

$query_data = sprintf("SELECT * FROM grupos WHERE IdGrupo = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>

<?php include("includes/head.php"); ?>
                <p align="left" class="textotitulos">&nbsp;</p>
              <p align="center" class="textotitulos">                  <span class="titulo">GRUPOS </span></p>
                <p class="titulo"><span class="textogris"><a href="grupos.php" class="texto_gris">&lt;&lt; Volver </a></span></p>
                <p class="titulo"><form name="form1" method="POST" action="">
              <table width="42%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                <tr>
                  <td width="45%" bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo:</td>
                  <td width="55%" class="texto_gris"><?php echo $row_data['IdGrupo']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                  <td class="texto_gris"><?php echo $row_data['Nombre']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#E5E5E5" class="texto_btgris">Direcci&oacute;n:</td>
                  <td class="texto_gris"><?php echo $row_data['Direccion']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fonos:</td>
                  <td class="texto_gris"><?php echo $row_data['Telefonos']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#E5E5E5" class="texto_btgris">Fax:</td>
                  <td class="texto_gris"><?php echo $row_data['Fax']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#E5E5E5" class="texto_btgris">Persona Contacto: </td>
                  <td class="texto_gris"><?php echo $row_data['PersonaContac']; ?></td>
                </tr>
                <tr>
                  <td colspan="2" bgcolor="#E5E5E5" class="textoazul"><div align="center" class="texto_btgris">&iquest;Esta seguro(a) que desea Eliminar este Registro?</div></td>
                  </tr>
                <tr>
                  <td bgcolor="#E5E5E5" class="textoazul">&nbsp;</td>
                  <td class="textogrande"><input name="Submit" type="submit" class="texto_btgris" value="SI &gt;&gt;">
                    <input name="IdGrupo2000" type="hidden" id="IdGrupo2000" value="<?php echo $row_data['IdGrupo']; ?>"></td>
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

mysql_close($marambio);
?>
