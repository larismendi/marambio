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

mysql_select_db($database_marambio, $marambio);
$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

mysql_select_db($database_marambio, $marambio);
$query_data = "SELECT * FROM tasas ORDER BY Nombre ASC";
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>
<?php include("includes/head.php"); ?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">TASAS</p>
                <p><a href="agregarTasa.php" class="texto_btgris">&lt;&lt; Agregar Tasas </a></p>
                <table width="40%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="41%"><div align="center" class="Estilo1">C&oacute;digo Contable </div></td>
                    <td width="25%"><div align="center" class="Estilo1">Nombre</div></td>
                    <td width="12%"><div align="center" class="Estilo1">Monto</div></td>
                    <td width="11%"><div align="center"><span class="Estilo1"></span></div></td>
                    <td width="11%"><div align="center"><span class="Estilo1"></span></div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="texto_btgris">
                    <td><?php echo $row_data['CodCont']; ?></td>
                    <td><div align="left"><?php echo $row_data['Nombre']; ?></div></td>
                    <td><? print (number_format ($row_data['Monto'],2,chr(44),".")) ; ?></td>
                    <td><div align="center"><a href="editarTasa.php?IdTasa=<?php echo $row_data['IdTasa']; ?>"><img src="images/edit_off.jpg" alt="Editar" width="34" height="35" border="0"></a></div></td>
                    <td><div align="center"><a href="eliminarTasa.php?IdTasa=<?php echo $row_data['IdTasa']; ?>"><img src="images/elim_on.jpg" alt="Eliminar" width="34" height="35" border="0"></a></div></td>
                  </tr>
                  <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
                </table>
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


?>
