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
if (isset($_GET['IdGrupo'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}

$query_data = sprintf("SELECT * FROM grupos WHERE IdGrupo = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$CodGrupoXX=$row_data['IdGrupo'];
$query_empresas = "SELECT * FROM empresas WHERE CodGrupo = '$CodGrupoXX'";
$empresas = mysql_query($query_empresas, $marambio) or die(mysql_error());
$row_empresas = mysql_fetch_assoc($empresas);
$totalRows_empresas = mysql_num_rows($empresas);

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="left" class="textotitulos">&nbsp;</p>
              <p align="center" class="textotitulos">                  <span class="titulo">GRUPOS </span></p>
                <p class="titulo"><span class="textogris"><a href="grupos.php" class="texto_gris">&lt;&lt; Volver </a></span></p>
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
                </table>
                <p>&nbsp;</p>
                <table width="88%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td><div align="center">Cod Contable </div></td>
                    <td><div align="center">Empresa</div></td>
                    <td><div align="center">Direccion</div></td>
                    <td><div align="center">Telefonos</div></td>
                    <td><div align="center">Fax</div></td>
                    <td><div align="center">Contacto</div></td>
                    <td><div align="center">Email</div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="texto_gris">
                    <td><?php echo $row_empresas['CodCont']; ?></td>
                    <td><?php echo $row_empresas['Nombre']; ?></td>
                    <td><?php echo $row_empresas['Direccion']; ?></td>
                    <td><?php echo $row_empresas['Telefonos']; ?></td>
                    <td><?php echo $row_empresas['Fax']; ?></td>
                    <td><?php echo $row_empresas['PersonaEnc']; ?></td>
                    <td><?php echo $row_empresas['email']; ?></td>
                  </tr>
                  <?php } while ($row_empresas = mysql_fetch_assoc($empresas)); ?>
                </table>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
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

@mysql_free_result($empresas);

mysql_close($marambio);
?>