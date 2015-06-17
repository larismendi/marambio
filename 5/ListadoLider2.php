<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 5){
	header ("Location: ../index.php"); 
}
?>
<?php
extract($_REQUEST);
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

$colname_tar = "1";
if (isset($_GET['IdLider'])) {
  $colname_tar = (get_magic_quotes_gpc()) ? $_GET['IdLider'] : addslashes($_GET['IdLider']);
}

$query_lider = "SELECT u.IdUsuario, u.Nombre FROM usuarios u WHERE u.IdUsuario='".$IdLider."'";
$lider = mysql_query($query_lider, $marambio) or die(mysql_error());
$row_lider = mysql_fetch_assoc($lider);
?>
<?php include("includes/head.php"); ?>
<link href="../includes/facebox/src/facebox.css" rel="stylesheet" type="text/css"/>
<link href="../includes/facebox/css/demo.css" rel="stylesheet" type="text/css"/>
<style type="text/css" title="currentStyle">
	@import "../includes/datatables/media/css/demo_page.css";
	@import "../includes/datatables/media/css/demo_table.css";
	@import "../includes/datatables/media/css/TableTools.css";
</style>
<style type="text/css">
.textList tr td {
    color: #666;
    font-size: 12px;
    font-family: Arial, Helvetica, sans-serif;
}
</style>
<script src="../includes/facebox/lib/jquery.js" type="text/javascript"></script>
<script src="../includes/facebox/src/facebox.js" type="text/javascript"></script>
<script src="../includes/datatables/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../includes/datatables/media/js/ZeroClipboard.js" type="text/javascript"></script>
<script src="../includes/datatables/media/js/TableTools.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('a[rel*=facebox]').facebox({
    loadingImage : '../includes/facebox/src/loading.gif',
    closeImage   : '../includes/facebox/src/closelabel.png'
  });
  $('.datatable').dataTable({
	"sDom": 'T<"clear">lfrtip'
  });  
})
</script>
Lider: <?=$row_lider['Nombre']?><br />

                <p align="center" class="titulo"><br>
                REPORTE DE HORAS TOTALES POR PROYECTO </p>
                <table border="0" align="center">
                  <tr>
                    <td width="872">					
						<table width="914" border="0" class="datatable">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Codigo de tarea</th>
                                    <th>Servicio</th>
                                    <th>Fecha</th>
                                    <th>Horas Cargadas</th>
                                    <th>Horas Encargadas</th>
                                    <th>Porcentaje de avance</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $ff = 0;
							$query_tar = "SELECT e.Nombre, t.* FROM empresas e, tareas t WHERE e.CodEmp=t.IdEmpresa AND t.IdLider = '$IdLider' ORDER BY e.Nombre, t.IdEmpresa ASC";
							$tar = mysql_query($query_tar, $marambio) or die(mysql_error());
							$row_tar = mysql_fetch_assoc($tar);
							if(mysql_num_rows($tar) >= 1) {
								
								do { 
								
								  $IdServicioTT=$row_tar['IdServicio'];
								  $query_serTT = "SELECT * FROM servicios WHERE IdServicio = '".$row_tar['IdServicio']."'";
								  $serTT = mysql_query($query_serTT, $marambio) or die(mysql_error());
								  $row_serTT = mysql_fetch_assoc($serTT);
								  
								  $IdTarea2000=$row_tar['IdTarea'];
								  $query_subTar = "SELECT * FROM quincenasub WHERE CodificacionComp = '".$row_tar['IdTarea']."'";
								  $subTar = mysql_query($query_subTar, $marambio) or die(mysql_error());
								  $row_subTar = mysql_fetch_assoc($subTar);
																	  
								  do{ 
									  $Subtotal=0;
									  $Subtotal=$row_subTar['D01']+$row_subTar['D02']+$row_subTar['D03']+$row_subTar['D04']+$row_subTar['D05']+$row_subTar['D06']+$row_subTar['D07']+$row_subTar['D08']+$row_subTar['D09']+$row_subTar['D10']+$row_subTar['D11']+$row_subTar['D12']+$row_subTar['D13']+$row_subTar['D14']+$row_subTar['D15']+$row_subTar['D16']+$row_subTar['D17']+$row_subTar['D18']+$row_subTar['D19']+$row_subTar['D20']+$row_subTar['D21']+$row_subTar['D22']+$row_subTar['D23']+$row_subTar['D24']+$row_subTar['D25']+$row_subTar['D26']+$row_subTar['D27']+$row_subTar['D28']+$row_subTar['D29']+$row_subTar['D30']+$row_subTar['D31'];
									  $TotalTotal=$TotalTotal+$Subtotal;
								  } while ($row_subTar = mysql_fetch_assoc($subTar));
								  $totalPresupuesto = ($row_tar['HorasEstimadas']?$row_tar['HorasEstimadas']:0);
								  $porRealizadas=$totalPresupuesto?($TotalTotal*100)/$totalPresupuesto:$TotalTotal;
							?>                            
                            <tr onMouseOver="cambiar_color_over(this)" onMouseOut="cambiar_color_out(this)">
                            	<td><?=$row_tar['Nombre']; ?></td>
                            	<td><?=$row_tar['CodificacionComp']; ?></td>
                                <td><?=$row_serTT['Servicio']; ?></td>
                                <td><?=$row_tar['MesEjecucion']."-".$row_tar['AnnoEjecucion']; ?></td>
                                <td><?=$TotalTotal." Horas."; ?></td>
                                <td><?=$totalPresupuesto.' Horas.';?></td>
                                <td><?=$porRealizadas.' %.';?></td>
							</tr>                            
							<?php
								 $TotalTotal=0;
								 @mysql_free_result($subTar);
								 $ff ++;
							  }while ($row_tar = mysql_fetch_assoc($tar));
							  @mysql_free_result($tar);
						  	}
							if($ff == 0){
							?>
							<tr>
                            	<td colspan="7" align="center">&nbsp;</td>
							</tr>
                            <tr>
                            	<td colspan="7" align="center">No se encontraron reportes asociados.</td>
							</tr>
							<?php	  
							}
							?>
                             </tbody>
             			</table>
                    </td>
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