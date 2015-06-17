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
if (isset($_GET['IdUsuario'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdUsuario'] : addslashes($_GET['IdUsuario']);
}

$query_data = sprintf("SELECT * FROM usuarios WHERE IdUsuario = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="titulo">RRHH</p>
                <p><a href="rrhh.php" class="texto_btgris">&lt;&lt;Volver</a></p>
                <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr valign="baseline">
                    <td width="112" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                    <td width="204" class="texto_gris"><?php echo $row_data['Nombre']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Usuario:</td>
                    <td class="texto_gris"><?php echo $row_data['Usuario']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Unidad:</td>
                    <td class="texto_gris">
                      <?php 
				  	$IdUnidadXX=$row_data['IdUnidad'];
				  	
					$query_unidadMostrar = "SELECT * FROM unidades WHERE IdUnidad = '$IdUnidadXX'";
					$unidadMostrar = mysql_query($query_unidadMostrar, $marambio) or die(mysql_error());
					$row_unidadMostrar = mysql_fetch_assoc($unidadMostrar);
					$totalRows_unidadMostrar = mysql_num_rows($unidadMostrar);
					echo $row_unidadMostrar['Nombre'];
					@mysql_free_result($unidadMostrar);
				  ?>                    </td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nivel:</td>
                    <td class="texto_gris"><?php echo $row_data['Nivel']; ?> </td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Cargo:</td>
                    <td class="texto_gris"><?php echo $row_data['Cargo']; ?> </td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fono:</td>
                    <td class="texto_gris"><?php echo $row_data['Telefono']; ?></td>
                  </tr>
                  <tr valign="baseline">
                    <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Extensi&oacute;n:</td>
                    <td class="texto_gris"><?php echo $row_data['Ext']; ?></td>
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

mysql_close($marambio);
?>
