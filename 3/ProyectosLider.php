<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 3){
	header ("Location: ../index.php"); 
}
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

$CodGrupoXX=$row_data['IdGrupo'];
?>
<?php include("includes/head.php");?>

                <p align="left" class="textotitulos">&nbsp;</p>
                <table width="20%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr>
                    <td><form name="form1" method="post" action="ProyectosLider2.php">
                      <div align="center"><span class="texto_btgris">Seleccione el Lider: </span><br>
                        <span class="texto_btgris"><?php echo $row_supervisor['Nombre']; ?></span>
                        <input name="Submit" type="submit" class="texto_btgris" value="&gt;&gt;">
                        <input name="IdLider" type="hidden" id="IdLider" value="<?php echo $row_supervisor['IdUsuario']; ?>">
                      </div>
                    </form></td>
                  </tr>
                </table>
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

@mysql_free_result($lider);

mysql_close($marambio);
?>