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
<?php include("includes/head.php"); ?>
<script src="sorttable/sorttable.js" type="text/javascript"></script>
<style type="text/css">
body{font-family:"Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#555555;}
div.main{margin:30px auto; width:600px;}
table.sortable{border:0; padding:0; margin:0;}
table.sortable td{padding:4px; width:120px; border-bottom:solid 1px #DEDEDE;}
table.sortable th{padding:4px;}
table.sortable thead{background:#ADC3DB; color:#333333; text-align:left;}
table.sortable tfoot{font-weight:bold; }
table.sortable tfoot td{border:none;}
</style>
<script>
function cambiar_color_over(celda){ 
   celda.style.backgroundColor="#F0F0F0" 
} 
function cambiar_color_out(celda){ 
   celda.style.backgroundColor="#FFFFFF" 
} 
</script>

                <p align="center" class="titulo"><br>
                REPORTE DE HORAS TOTALES POR PROYECTO </p>
                <table border="0" align="center">
                  <tr>
                    <td width="872">					
						<table width="914" class="sortable">
                        	<?php 
							if($row_empresas){ 
							?>
                            <thead>
                        	<tr>
                            	<th width="204" class="titulo">Codigo de tarea</th>
                                <th width="242" class="titulo">Empresa</th>
                                <th width="120" class="titulo">Fecha</th>
                                <th width="125" class="titulo">Horas</th>
                                <th width="199" class="titulo">Servicio</th>
							</tr>
                            </thead>
                            <tbody>
                            <?php $ff = 0;
								do{
									$query_tar = "SELECT * FROM tareas WHERE IdLider = '$IdLider'  AND activo='1' AND IdEmpresa='".$row_empresas['CodEmp']."' ORDER BY IdEmpresa ASC";
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
							?>
                            
                            <tr onMouseOver="cambiar_color_over(this)" onMouseOut="cambiar_color_out(this)">
                            	<td class="texto_btgris"><?php echo $row_tar['CodificacionComp']; ?></td>
                            	<td class="texto_btgris"><?php echo $row_empresas['Nombre']; ?></td>
                                <td class="texto_btgris"><?php echo $row_tar['MesEjecucion']."-".$row_tar['AnnoEjecucion']; ?></td>
                                <td class="texto_btgris"><?php echo $TotalTotal." Horas."; ?></td>
                                <td class="texto_btgris"><?php echo $row_serTT['Servicio']; ?></td>
							</tr>
                            
							<?php
                            			 $TotalTotal=0;
										 @mysql_free_result($subTar);
										 $ff ++;
									  }while ($row_tar = mysql_fetch_assoc($tar));
									  @mysql_free_result($tar);
								  }
							  } while ($row_empresas = mysql_fetch_assoc($empresas)); 
							  if($ff == 0){
							?>
							<tr>
                            	<td colspan="6" align="center" class="texto_btgris">&nbsp;</td>
							</tr>
                            <tr>
                            	<td colspan="6" align="center" class="texto_btgris">No se encontraron reportes asociados.</td>
							</tr>
							<?php	  
							  }
							}else{
							?>
                            <tr>
                            	<td colspan="6" align="center" class="texto_btgris">&nbsp;</td>
							</tr>
							<tr>
                            	<td colspan="6" align="center" class="texto_btgris">No se encontraron reportes asociados.</td>
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