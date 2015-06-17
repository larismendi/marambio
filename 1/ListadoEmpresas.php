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
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

$query_emp = "SELECT DISTINCT e.CodEmp,e.Nombre FROM empresas e, tareas t WHERE e.CodEmp=t.IdEmpresa ORDER BY e.Nombre ASC";
$emp = mysql_query($query_emp, $marambio) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
?>
<?php include("includes/head.php");?>
                <p align="left" class="textotitulos">&nbsp;</p>
                <table width="20%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr>
                    <td><form name="form1" method="post" action="ListadoEmpresas2.php">
                      <div align="center"><span class="texto_btgris">Seleccione el Lider: </span><br>
                          <select name="IdEmpresa" class="texto_btgris" id="IdEmpresa">
                            <option value="0">Seleccione</option>
                            <?php
							do {  
							?>
                            <option value="<?=$row_emp['CodEmp']?>"><?=$row_emp['Nombre']?></option>
                            <?php
							} while ($row_emp = mysql_fetch_assoc($emp));
							  $rows = mysql_num_rows($emp);
							  if($rows > 0) {
								  mysql_data_seek($emp, 0);
								  $row_emp = mysql_fetch_assoc($emp);
							  }
							?>
                          </select>
                        <input name="Submit" type="submit" class="texto_btgris" value="&gt;&gt;">
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