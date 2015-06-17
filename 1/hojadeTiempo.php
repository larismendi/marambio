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

$IdUsuario2000=$row_supervisor['IdUsuario'];

$query_data = "SELECT * FROM quincenas WHERE activa = 1 ORDER BY CodificacionCompleta DESC";
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$query_data2 = "SELECT * FROM quincenas WHERE activa = 0 ORDER BY CodificacionCompleta DESC";
$data2 = mysql_query($query_data2, $marambio) or die(mysql_error());
$row_data2 = mysql_fetch_assoc($data2);
$totalRows_data2 = mysql_num_rows($data2);

?>
<?php include("includes/head.php"); ?>
<style type="text/css">
<!--
.Estilo1 {color: #E5E5E5}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>

                <p align="center" class="titulo">HOJA DE TIEMPO</p>
                <table width="17%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#ECECEC">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="27%" height="20"><div align="center">Quincenas
                    </div>                      <div align="center" class="Estilo1">.</div></td>
                  </tr>
                  <?php do { ?>
                  <tr class="textogrande">
                    <td><div align="center"><a href="verQna.php?IdQna=<?php echo $row_data['IdQna']; ?>"><span class="texto_gris"><?php echo $row_data['Quincena']; ?>- <?php echo $row_data['Mes']; ?> / <?php echo $row_data['Anno']; ?></span><br>
                      <img src="../calendario.gif" alt="Editar" width="178" height="124" border="0"></a></div></td>
                  </tr>
                  <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
              </table>
                <hr>
				<?php if($totalRows_data2>=1) { ?>
                <table width="27%" height="84" border="0">
                  <?php  $columna=0; ?>
                  <?php do { ?>
                  <?php if($columna==0) { ?>
                  <tr>
                    <?php } ?>
                    <?php  $columna=$columna+1; ?>
                    <td><div align="center">
                        <p align="center"><a href="verQnaCerrada.php?IdQna=<?php echo $row_data2['IdQna']; ?>"><span class="texto_gris"><?php echo $row_data2['Quincena']; ?>- <?php echo $row_data2['Mes']; ?> / <?php echo $row_data2['Anno']; ?></span></a><a href="verQnaCerrada.php?IdQna=<?php echo $row_data2['IdQna']; ?>"><br>
                        <img src="../calendario.gif" width="178" height="124" border="0"></a>&nbsp;&nbsp;&nbsp;<br>
                            <br>
                        </p>
                    </div></td>
                    <?php if($columna==4) {
		$columna=0; ?>
                  </tr>
                  <?php } ?>
                  <?php } while ($row_data2 = mysql_fetch_assoc($data2)); ?>
                </table>
				<?php } ?>
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

@mysql_free_result($data2);

mysql_close($marambio);
?>
