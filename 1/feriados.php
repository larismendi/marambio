<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
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

$query_fer = "SELECT * FROM feriados ORDER BY ORDEN ASC";
$fer = mysql_query($query_fer, $marambio) or die(mysql_error());
$row_fer = mysql_fetch_assoc($fer);
$totalRows_fer = mysql_num_rows($fer);

$CodGrupoXX=$row_data['IdGrupo'];
?>

<?php include("includes/head.php"); ?>
                <p align="left" class="textotitulos">&nbsp;</p>
              <p class="titulo">FERIADOS</p>
                <p><a href="agregarFeriado.php" class="texto_btgris">Agregar Feriado &gt;&gt; </a></p>
                <table width="49%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="11%"><div align="center" class="Estilo1">D&iacute;a</div></td>
                    <td width="15%"><div align="center" class="Estilo1">Mes</div></td>
                    <td width="56%"><div align="center" class="Estilo1">Descripci&oacute;n</div></td>
                    <td width="9%"><div align="center"><span class="Estilo1">Editar</span></div></td>
                    <td width="9%"><div align="center"><span class="Estilo1">Eliminar</span></div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="textogrande">
                    <td class="texto_gris"><div align="center"><?php echo $row_fer['Dia']; ?></div></td>
                    <td class="texto_gris"><div align="center"><?php echo $row_fer['Mes']; ?></div></td>
                    <td class="texto_gris"><div align="left"><?php echo $row_fer['NombreFeriado']; ?></div></td>
                    <td><a href="editarFeriado.php?Id=<?php echo $row_fer['Id']; ?>"><img src="images/edit_off.jpg" alt="Editar" width="34" height="35" border="0"></a></td>
                    <td><a href="eliminarFeriado.php?Id=<?php echo $row_fer['Id']; ?>"><img src="images/elim_on.jpg" alt="Eliminar" width="34" height="35" border="0"></a></td>
                  </tr>
                  <?php } while ($row_fer = mysql_fetch_assoc($fer)); ?>
                </table>
                <p></p>
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

@mysql_free_result($fer);

mysql_close($marambio);
?>