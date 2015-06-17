<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 4){
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

$query_proyecto = "SELECT * FROM tareas ORDER BY CodificacionComp DESC";
$proyecto = mysql_query($query_proyecto, $marambio) or die(mysql_error());
$row_proyecto = mysql_fetch_assoc($proyecto);
$totalRows_proyecto = mysql_num_rows($proyecto);

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="texto_gris">Tiempo por Proyecto</p>
                <table width="240" height="87" border="0">
                  <tr>
                    <td><form name="form1" method="get" action="tiempoxProyecto2.php">
                        <table width="52%"  border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                          <tr bgcolor="#E5E5E5">
                            <td colspan="2" class="textoazul"><div align="center" class="texto_btgris">Seleccione el Proyecto: </div></td>
                          </tr>
                          <tr>
                            <td width="36%" bgcolor="#E5E5E5" class="texto_btgris">Proyecto:</td>
                            <td width="64%"><select name="proyectoX" class="texto_btgris" id="proyectoX">
                                <option value="0">Seleccione >></option>
                                <?php
do {  
?>
  <?php 

			  $tareaZZ=$row_proyecto['IdTarea'];
			  mysql_select_db($database_marambio, $marambio);
              $query_tareasClientesList = "SELECT * FROM tareas WHERE IdTarea = '$tareaZZ'";
              $tareasClientesList = mysql_query($query_tareasClientesList, $marambio) or die(mysql_error());
              $row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);
              $totalRows_tareasClientesList = mysql_num_rows($tareasClientesList);

			  $IdGrupoZZ=$row_tareasClientesList['IdGrupo'];
			  $IdEmpresaZZ=$row_tareasClientesList['IdEmpresa'];
			  
			  mysql_select_db($database_marambio, $marambio);
			  $query_verGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupoZZ'";
              $verGrupo = mysql_query($query_verGrupo, $marambio) or die(mysql_error());
              $row_verGrupo = mysql_fetch_assoc($verGrupo);
              $totalRows_verGrupo = mysql_num_rows($verGrupo);

              mysql_select_db($database_marambio, $marambio);
              $query_verEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$IdEmpresaZZ'";
              $verEmpresa = mysql_query($query_verEmpresa, $marambio) or die(mysql_error());
              $row_verEmpresa = mysql_fetch_assoc($verEmpresa);
              $totalRows_verEmpresa = mysql_num_rows($verEmpresa);?>
                                <option value="<?php echo $row_proyecto['IdTarea']?>">
                              

              
			  <?php echo $row_verGrupo['Nombre'] . " / " . $row_verEmpresa['Nombre']; ?>
                                </option>
                                <?php
} while ($row_proyecto = mysql_fetch_assoc($proyecto));
  $rows = mysql_num_rows($proyecto);
  if($rows > 0) {
      mysql_data_seek($proyecto, 0);
	  $row_proyecto = mysql_fetch_assoc($proyecto);
  }
?>
                            </select></td>
                          </tr>
                          <tr bgcolor="#FFFFFF">
                            <td colspan="2" class="textoazul"><div align="right">
                                <input name="Submit" type="submit" class="texto_btgris" value="Enviar &gt;&gt;">
                            </div></td>
                          </tr>
                        </table>
                    </form></td>
                  </tr>
                </table>
                <p></p>
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

@mysql_free_result($proyecto);

mysql_close($marambio);
?>
