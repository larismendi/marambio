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
extract($_REQUEST);

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
	if($TipoTarea==1) {
		$condificacionCompletaFinal=$tareaCliente;
	} else {
		$condificacionCompletaFinal=$tareaAdministrativa;
	}
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO quincenasub (IdQna, IdUsuario, TipoTarea, CodificacionComp, token) VALUES (%s, %s, %s, %s, '1')",
                       GetSQLValueString($_POST['IdQna'], "int"),
			     GetSQLValueString($_POST['IdUsuario'], "int"),
                       GetSQLValueString($_POST['TipoTarea'], "text"),
                       GetSQLValueString($condificacionCompletaFinal, "text"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());

  $insertGoTo = "verQna.php";
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

$query_tareasClientesList = "SELECT * FROM tareas WHERE activo = 1 ORDER BY IdTarea DESC";
$tareasClientesList = mysql_query($query_tareasClientesList, $marambio) or die(mysql_error());
$row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);
$totalRows_tareasClientesList = mysql_num_rows($tareasClientesList);

$query_tareasAdmistrativasList = "SELECT * FROM administrativas ORDER BY Nombre ASC";
$tareasAdmistrativasList = mysql_query($query_tareasAdmistrativasList, $marambio) or die(mysql_error());
$row_tareasAdmistrativasList = mysql_fetch_assoc($tareasAdmistrativasList);
$totalRows_tareasAdmistrativasList = mysql_num_rows($tareasAdmistrativasList);

?>
<?php include("includes/head.php"); ?>

                <p align="left" class="textotitulos">
			  <div align="center">
  <p class="titulo">CARGAR HORAS</p>
  <p><a href="verQna.php?IdQna=<?php echo $IdQna; ?>" class="texto_btgris">&lt;&lt; Volver</a></p>
  
    <form method="post" name="form1" action="">
      <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
        <tr valign="baseline">
          <td width="134" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tarea Administrativa:</td>
          <td width="188"><div align="left">
		<?php if($row_tareasAdmistrativasList){ ?>
            <select name="tareaAdministrativa" class="texto_btgris" id="tareaAdministrativa">
              <?php
				do {  
				?>
              <option value="<?php echo $row_tareasAdmistrativasList['IdAdministrativas']?>"><?php echo $row_tareasAdmistrativasList['Nombre']?></option>
              <?php
				} while ($row_tareasAdmistrativasList = mysql_fetch_assoc($tareasAdmistrativasList));
				  $rows = mysql_num_rows($tareasAdmistrativasList);
				  if($rows > 0) {
					  mysql_data_seek($tareasAdmistrativasList, 0);
					  $row_tareasAdmistrativasList = mysql_fetch_assoc($tareasAdmistrativasList);
				  }
				?>
            </select>
		<?php }else{ echo "No existe tareas a cargar."; }?>
		
          </div></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5">&nbsp;</td>
          <td><?php if($row_tareasAdmistrativasList){ ?><input type="submit" class="texto_btgris" value="Insertar registro">
          <input name="IdQna" type="hidden" id="IdQna" value="<?php echo $IdQna; ?>">
          <input name="CodificacionComp" type="hidden" id="CodificacionComp2">
          <input name="IdUsuario" type="hidden" id="IdUsuario" value="<?php echo $row_supervisor['IdUsuario']; ?>">
          <input name="TipoTarea" type="hidden" id="TipoTarea" value="2"><?php } ?></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
    <p>&nbsp;</p>
    <p>&nbsp; </p>
</div>

				</p>
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
@mysql_free_result($tareasClientesList);
@mysql_free_result($tareasAdmistrativasList);
mysql_close($marambio);
?>