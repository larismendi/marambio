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
if (isset($_GET['IdTarea'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdTarea'] : addslashes($_GET['IdTarea']);
}

$query_data = sprintf("SELECT * FROM tareas WHERE IdTarea = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$IdGrupo2000=$row_data['IdGrupo'];

$query_verGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupo2000'";
$verGrupo = mysql_query($query_verGrupo, $marambio) or die(mysql_error());
$row_verGrupo = mysql_fetch_assoc($verGrupo);
$totalRows_verGrupo = mysql_num_rows($verGrupo);

$CodEmp2000=$row_data['IdEmpresa'];

$query_verEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$CodEmp2000'";
$verEmpresa = mysql_query($query_verEmpresa, $marambio) or die(mysql_error());
$row_verEmpresa = mysql_fetch_assoc($verEmpresa);
$totalRows_verEmpresa = mysql_num_rows($verEmpresa);

$IdUnidad2000=$row_data['IdUnidad'];

$query_verUnidad = "SELECT IdUnidad, Nombre FROM unidades WHERE IdUnidad = '$IdUnidad2000'";
$verUnidad = mysql_query($query_verUnidad, $marambio) or die(mysql_error());
$row_verUnidad = mysql_fetch_assoc($verUnidad);
$totalRows_verUnidad = mysql_num_rows($verUnidad);

$IdServicio2000=$row_data['IdServicio'];

$query_verServicio = "SELECT * FROM servicios WHERE IdServicio = '$IdServicio2000'";
$verServicio = mysql_query($query_verServicio, $marambio) or die(mysql_error());
$row_verServicio = mysql_fetch_assoc($verServicio);
$totalRows_verServicio = mysql_num_rows($verServicio);

$IdUsuarioXX=$row_data['IdLider'];

$query_Lider = "SELECT IdUsuario, Nombre FROM usuarios WHERE IdUsuario = '$IdUsuarioXX'";
$Lider = mysql_query($query_Lider, $marambio) or die(mysql_error());
$row_Lider = mysql_fetch_assoc($Lider);
$totalRows_Lider = mysql_num_rows($Lider);

$IdPA2000=$row_data['IdTarea'];

$query_pers = "SELECT * FROM personalasignado WHERE IdTarea = '$IdPA2000'";
$pers = mysql_query($query_pers, $marambio) or die(mysql_error());
$row_pers = mysql_fetch_assoc($pers);
$totalRows_pers = mysql_num_rows($pers);

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">TAREAS</p>
                <p class="titulo"><a href="tareas.php"  class="texto_gris">&lt;&lt; Volver </a></p>
                <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr valign="baseline">
                    <td width="104" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Grupo:</div></td>
                    <td width="236" class="texto_gris"><?php echo $row_verGrupo['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td height="19" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Empresa:</div></td>
                    <td class="texto_gris"><?php echo $row_verEmpresa['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Unidad:</div></td>
                    <td class="texto_gris"><?php echo $row_verUnidad['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Servicio:</div></td>
                    <td class="texto_gris"><?php echo $row_verServicio['Servicio']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">L&iacute;der Proyecto :</div></td>
                    <td class="texto_gris"><?php echo $row_Lider['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Fecha de Creaci&oacute;n:</div></td>
                    <td class="texto_gris"><?php echo $row_data['FEspanol']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Fecha de Cierre: </div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><?php echo $row_data['MesEjecucion']; ?> / <?php echo $row_data['AnnoEjecucion']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Tasa:</div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><?php echo $row_data['Tasa']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Horas Estimadas </div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><?php echo $row_data['HorasEstimadas']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Horas Socio</div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><div align="left"><?php echo $row_data['HorasSocio']; ?></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Horas Gerente </div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><div align="left"><?php echo $row_data['HorasGerente']; ?></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Horas Encargado </div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><div align="left"><?php echo $row_data['HorasEncargado']; ?></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Horas Asistente </div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><div align="left"><?php echo $row_data['HorasAsistente']; ?></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris"><div align="left">Horas Lider </div></td>
                    <td bgcolor="#FFFFFF" class="texto_gris"><div align="left"><?php echo $row_data['HorasLider']; ?></div></td>
                  </tr>
                </table>
                <br>
                <table width="30%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td><div align="center">Persona</div></td>
                    <td><div align="center">Posici&oacute;n</div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="texto_gris">
                    <td>
					<?php 
						$IdUsuarioVV=$row_pers['IdUsuario']; 
						
						$query_verUsuario = "SELECT IdUsuario, Nombre FROM usuarios WHERE IdUsuario = '$IdUsuarioVV'";
						$verUsuario = mysql_query($query_verUsuario, $marambio) or die(mysql_error());
						$row_verUsuario = mysql_fetch_assoc($verUsuario);
						$totalRows_verUsuario = mysql_num_rows($verUsuario);
						echo $row_verUsuario['Nombre'];
					?>
					</td>
                    <td><?php echo $row_pers['Posicion']; ?></td>
                  </tr>
                  <?php } while ($row_pers = mysql_fetch_assoc($pers)); ?>
                </table>
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

@mysql_free_result($data);

@mysql_free_result($verGrupo);

@mysql_free_result($verEmpresa);

@mysql_free_result($verUnidad);

@mysql_free_result($verServicio);

@mysql_free_result($Lider);

@mysql_free_result($pers);

@mysql_free_result($verUsuario);

mysql_close($marambio);
?>
