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

$query_data = "SELECT * FROM unidades ORDER BY Nombre ASC";
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>
<?php include("includes/head.php"); ?>

                <p class="textotitulos">&nbsp;</p>
                <p class="titulo">UNIDADES</p>
                <p><a href="agregarUnidad.php" class="texto_btgris">Agregar Unidad &gt;&gt;</a></p>
                <table width="62%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="19%"><div align="center" class="Estilo1">C&oacute;digo</div></td>
                    <td width="30%"><div align="center" class="Estilo1">Nombre</div></td>
                    <td width="36%"><div align="center" class="Estilo1">Encargado</div></td>
                    <td width="8%"><div align="center"><span class="Estilo1"></span></div></td>
                    <td width="7%"><div align="center"><span class="Estilo1"></span></div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="textogrande">
                    <td height="39" class="texto_btgris"><div align="center"><?php echo $row_data['IdUnidad']; ?></div></td>
                    <td class="texto_btgris"><div align="left"><?php echo $row_data['Nombre']; ?></div></td>
                    <td class="texto_btgris">
                      <?php 
				  	$IdUsuarioXXCC=$row_data['Encargado']; 
				  	mysql_select_db($database_marambio, $marambio);
					$query_userMostar = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuarioXXCC'";
					$userMostar = mysql_query($query_userMostar, $marambio) or die(mysql_error());
					$row_userMostar = mysql_fetch_assoc($userMostar);
					$totalRows_userMostar = mysql_num_rows($userMostar);
					echo $row_userMostar['Nombre'];
					@mysql_free_result($userMostar);
				  ?>&nbsp;
                    </td>
                    <td><div align="center"><a href="editarUnidad.php?IdUnidad=<?php echo $row_data['IdUnidad']; ?>"><img src="images/edit_off.jpg" alt="Editar" width="34" height="35" border="0"></a></div></td>
                    <td><div align="center"><a href="eliminarUnidad.php?IdUnidad=<?php echo $row_data['IdUnidad']; ?>"><img src="images/elim_on.jpg" alt="Eliminar" width="34" height="35" border="0"></a></div></td>
                  </tr>
                  <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
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

@mysql_free_result($data);

mysql_close($marambio);
?>
