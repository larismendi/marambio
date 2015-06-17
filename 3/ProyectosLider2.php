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
$totalRows_quienEs = mysql_num_rows($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

$colname_tar = "1";
if (isset($_GET['IdLider'])) {
  $colname_tar = (get_magic_quotes_gpc()) ? $_GET['IdLider'] : addslashes($_GET['IdLider']);
}

$query_empresas = "SELECT * FROM empresas ORDER BY Nombre ASC";
$empresas = mysql_query($query_empresas, $marambio) or die(mysql_error());
$row_empresas = mysql_fetch_assoc($empresas);
$totalRows_empresas = mysql_num_rows($empresas);

?>
<?php include("includes/head.php");?>

                <p align="center" class="titulo"><br>
                REPORTE DE HORAS TOTALES POR PROYECTO </p>
                <table width="41%"  border="0" align="center">
                  <tr>
                    <td class="texto_btgris">					<?php do { ?>
					<?php
							$IdEmpresa2000=$row_empresas['CodEmp'];
							mysql_select_db($database_marambio, $marambio);
							$query_tar = sprintf("SELECT * FROM tareas WHERE IdLider = '$IdLider'  AND activo='1' AND IdEmpresa='$IdEmpresa2000'  ORDER BY IdEmpresa ASC", $colname_tar);
							$tar = mysql_query($query_tar, $marambio) or die(mysql_error());
							$row_tar = mysql_fetch_assoc($tar);
							$totalRows_tar = mysql_num_rows($tar);
							
						if($totalRows_tar>=1) {
								echo "------------------------------------------------------------------------------ <br>";
								echo $row_empresas['Nombre'] . "<br>"; // imprimo la empresa
								
							do { 
							
								$IdServicioTT=$row_tar['IdServicio'];
								mysql_select_db($database_marambio, $marambio);
								$query_serTT = "SELECT * FROM servicios WHERE IdServicio = '$IdServicioTT'";
								$serTT = mysql_query($query_serTT, $marambio) or die(mysql_error());
								$row_serTT = mysql_fetch_assoc($serTT);
								$totalRows_serTT = mysql_num_rows($serTT);
								
								
								$IdTarea2000=$row_tar['IdTarea'];
								mysql_select_db($database_marambio, $marambio);
								$query_subTar = "SELECT * FROM quincenasub WHERE CodificacionComp = '$IdTarea2000'";
								$subTar = mysql_query($query_subTar, $marambio) or die(mysql_error());
								$row_subTar = mysql_fetch_assoc($subTar);
								$totalRows_subTar = mysql_num_rows($subTar);
									
									do { 
										$Subtotal=0;
										$Subtotal=$row_subTar['D01']+$row_subTar['D02']+$row_subTar['D03']+$row_subTar['D04']+$row_subTar['D05']+$row_subTar['D06']+$row_subTar['D07']+$row_subTar['D08']+$row_subTar['D09']+$row_subTar['D10']+$row_subTar['D11']+$row_subTar['D12']+$row_subTar['D13']+$row_subTar['D14']+$row_subTar['D15']+$row_subTar['D16']+$row_subTar['D17']+$row_subTar['D18']+$row_subTar['D19']+$row_subTar['D20']+$row_subTar['D21']+$row_subTar['D22']+$row_subTar['D23']+$row_subTar['D24']+$row_subTar['D25']+$row_subTar['D26']+$row_subTar['D27']+$row_subTar['D28']+$row_subTar['D29']+$row_subTar['D30']+$row_subTar['D31'];
										$TotalTotal=$TotalTotal+$Subtotal;
									} while ($row_subTar = mysql_fetch_assoc($subTar));
								
								echo $TotalTotal . " Horas &nbsp;&nbsp;&nbsp;" . $row_tar['CodificacionComp'] . "&nbsp;&nbsp;" . $row_serTT['Servicio'] . "&nbsp;&nbsp;&nbsp;&nbsp;<br>" ; //imprimo la tarea"<br>";
								$TotalTotal=0;
								
								@mysql_free_result($subTar);

							} while ($row_tar = mysql_fetch_assoc($tar));
							@mysql_free_result($tar);
								
						}

					?>
                    <?php } while ($row_empresas = mysql_fetch_assoc($empresas)); ?></td>
                  </tr>
                </table>
              <p>&nbsp;</p>
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

@mysql_free_result($empresas);

@mysql_free_result($serTT);

mysql_close($marambio);
?>