<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
	header ("Location: ../index.php"); 
}
?>
<?php
extract($_REQUEST);
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
//$totalRows_quienEs = mysql_num_rows($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
//$totalRows_supervisor = mysql_num_rows($supervisor);

$IdUsuario2000=$row_supervisor['IdUsuario'];
$query_data = "SELECT * FROM quincenas ORDER BY CodificacionCompleta DESC";
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$query_usuario = "SELECT * FROM usuarios WHERE Nivel = 3 OR Nivel = 4 OR Nivel = 5 ORDER BY Nombre ASC";
$usuario = mysql_query($query_usuario, $marambio) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

?>
<?php include("includes/head.php"); ?>
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="titulo">TIEMPO POR EMPLEADO Y QNA </p>
                <table width="36%" height="102"  border="0">
                  <tr>
                    <td><form name="form1" method="get" action="tiempoxQnaxEmpleado2.php">
                        <table width="62%"  border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                          <tr>
                            <td width="34%" bgcolor="#E5E5E5" class="texto_btgris">Quincena</td>
                            <td width="66%"><select name="IdQna" class="texto_btgris" id="IdQna">
                                <?php
do {  
?>
                                <option value="<?php echo $row_data['IdQna']?>"><?php echo $row_data['Quincena'] . "-" . $row_data['Mes'] . "/" . $row_data['Anno']; ?></option>
                                <?php
} while ($row_data = mysql_fetch_assoc($data));
  $rows = mysql_num_rows($data);
  if($rows > 0) {
      mysql_data_seek($data, 0);
	  $row_data = mysql_fetch_assoc($data);
  }
?>
                            </select></td>
                          </tr>
                          <tr>
                            <td bgcolor="#E5E5E5" class="texto_btgris">Usuario</td>
                            <td><select name="IdUsuario" class="texto_btgris" id="IdUsuario">
                                <option value="0">Seleccione >></option>
                                <?php
do {  
?>
                                <option value="<?php echo $row_usuario['IdUsuario']?>"><?php echo $row_usuario['Nombre']?></option>
                                <?php
} while ($row_usuario = mysql_fetch_assoc($usuario));
  $rows = mysql_num_rows($usuario);
  if($rows > 0) {
      mysql_data_seek($usuario, 0);
	  $row_usuario = mysql_fetch_assoc($usuario);
  }
?>
                            </select></td>
                          </tr>
                          <tr bgcolor="#FFFFFF">
                            <td colspan="2"><div align="right">
                              <input name="Submit" type="submit" class="texto_btgris" value="Consultar">
</div></td>
                          </tr>
                      </table>
                    </form></td>
                  </tr>
                </table>
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

@mysql_free_result($usuario);

mysql_close($marambio);
?>
