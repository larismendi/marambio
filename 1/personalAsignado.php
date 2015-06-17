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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO personalasignado (IdTarea, CodificacionComp, IdUsuario, Posicion) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['IdTarea'], "int"),
					   GetSQLValueString($_POST['CodificacionComp'], "text"),  
                       GetSQLValueString($_POST['IdUsuario'], "int"),
                       GetSQLValueString($_POST['Posicion'], "text"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());
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

$colname_tarea = "1";
if (isset($_GET['IdTarea'])) {
  $colname_tarea = (get_magic_quotes_gpc()) ? $_GET['IdTarea'] : addslashes($_GET['IdTarea']);
}

$query_tarea = sprintf("SELECT * FROM tareas WHERE IdTarea = %s", $colname_tarea);
$tarea = mysql_query($query_tarea, $marambio) or die(mysql_error());
$row_tarea = mysql_fetch_assoc($tarea);
$totalRows_tarea = mysql_num_rows($tarea);

$IdTarea2000=$row_tarea['IdTarea'];

$query_asig = "SELECT * FROM personalasignado WHERE IdTarea = '$IdTarea2000'";
$asig = mysql_query($query_asig, $marambio) or die(mysql_error());
$row_asig = mysql_fetch_assoc($asig);
$totalRows_asig = mysql_num_rows($asig);

$query_userList = "SELECT * FROM usuarios ORDER BY Nombre";
$userList = mysql_query($query_userList, $marambio) or die(mysql_error());
$row_userList = mysql_fetch_assoc($userList);
$totalRows_userList = mysql_num_rows($userList);

?>
<?php include("includes/head.php"); ?>
                <p align="left" class="textotitulos">&nbsp;</p>
                <p><span class="texto_btgris">Personal Asignado a la Tarea:</span><span class="textotitulos"><br>
                                </span><span class="titulo"><?php echo $row_tarea['CodificacionComp']; ?></span> </p>
                <p><a href="tareas.php"  class="texto_gris"><strong>&lt;&lt; Volver </strong></a></p>
                <table width="33%" height="114"  border="0">
                  <tr>
                    <td><form name="form1" method="POST" action="">
                        <table width="85%"  border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                          <tr>
                            <td width="51%" bgcolor="#E5E5E5" class="texto_btgris">Usuario</td>
                            <td width="49%"><select name="IdUsuario" class="texto_btgris" id="IdUsuario">
                              <option value="0">Seleccione >></option>
                              <?php
do {  
?>
                              <option value="<?php echo $row_userList['IdUsuario']?>"><?php echo $row_userList['Nombre']?></option>
                              <?php
} while ($row_userList = mysql_fetch_assoc($userList));
  $rows = mysql_num_rows($userList);
  if($rows > 0) {
      mysql_data_seek($userList, 0);
	  $row_userList = mysql_fetch_assoc($userList);
  }
?>
                            </select></td>
                          </tr>
                          <tr>
                            <td bgcolor="#E5E5E5" class="texto_btgris">Posici&oacute;n</td>
                            <td><select name="Posicion" class="texto_btgris" id="Posicion">
                                <option value="">Seleccione >></option>
                                <option value="Socio">Socio</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Encargado">Encargado</option>
                                <option value="Asistente - Auditor">Asistente - Auditor</option>
                            </select></td>
                          </tr>
                          <tr bgcolor="#FFFFFF">
                            <td colspan="2"><div align="right">
                                <input name="CodificacionComp" type="hidden" id="CodificacionComp" value="<?php echo $row_tarea['CodificacionComp']; ?>">
                                <input name="IdTarea" type="hidden" id="IdTarea" value="<?php echo $row_tarea['IdTarea']; ?>">
                                <input name="Submit" type="submit" class="texto_btgris" value="Asignar">
                            </div></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1">
                    </form></td>
                  </tr>
                </table>
                <br>
                <table width="50%"  border="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="40%"><div align="center">Nombre</div></td>
                    <td width="49%"><div align="center">Posici&oacute;n</div></td>
                    <td width="11%"><div align="center"><span class="Estilo2">.</span></div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="textogrande">
                    <td class="texto_gris">
                      <?php 
				  	$IdUsuario2006=$row_asig['IdUsuario']; 
				  	mysql_select_db($database_marambio, $marambio);
					$query_userMostrar = "SELECT IdUsuario, Nombre FROM usuarios WHERE IdUsuario = '$IdUsuario2006'";
					$userMostrar = mysql_query($query_userMostrar, $marambio) or die(mysql_error());
					$row_userMostrar = mysql_fetch_assoc($userMostrar);
					$totalRows_userMostrar = mysql_num_rows($userMostrar);
					echo $row_userMostrar['Nombre'];
					@mysql_free_result($userMostrar);
				  ?>
                    </td>
                    <td class="texto_gris"><?php echo $row_asig['Posicion']; ?></td>
                    <td><a href="eliminarAsignado.php?IdPA=<?php echo $row_asig['IdPA']; ?>&IdTarea=<? echo $IdTarea; ?>"><img src="images/elim_off.jpg" width="34" height="35" border="0"></a></td>
                  </tr>
                  <?php } while ($row_asig = mysql_fetch_assoc($asig)); ?>
              </table>
                <p class="textotitulos">&nbsp;</p>
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

@mysql_free_result($tarea);

@mysql_free_result($asig);

@mysql_free_result($userList);

mysql_close($marambio);
?>

