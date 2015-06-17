<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if(isset($_POST['closeTooltip']) && $_POST['closeTooltip']){
	session_register('closeTooltip');
	$_SESSION['closeTooltip']=0;
	exit;
}
if($tipo_usuario != 4){
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
<script src="../includes/datatables/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../includes/datatables/media/js/ZeroClipboard.js" type="text/javascript"></script>
<script src="../includes/datatables/media/js/TableTools.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.datatable').dataTable({
	"sDom": 'T<"clear">lfrtip'
  });  
})
</script>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top">
            	<div align="center">
                  <p class="textotitulos">
                  <?php
                  	$query_tareas = "SELECT pa.*, t.CodificacionComp, s.Servicio, e.Nombre Empresa, g.Nombre Grupo FROM `personalasignado` pa, tareas t LEFT JOIN empresas e ON t.IdEmpresa=e.CodEmp LEFT JOIN grupos g ON t.IdGrupo=g.IdGrupo, servicios s WHERE pa.`IdUsuario`='".$row_supervisor['IdUsuario']."' AND s.IdServicio=t.IdServicio AND t.IdTarea=pa.IdTarea AND pa.IdTarea NOT IN (SELECT tr.tarea FROM tareas_registradas tr WHERE tr.id_empleado ='".$row_supervisor['IdUsuario']."') LIMIT 0,150";
				  	$tareas = mysql_query($query_tareas, $marambio) or die(mysql_error());
					if(mysql_num_rows($tareas)){?>
                  <div>
                    <h2>Reportes Pendientes por cargar</h2>
                    <table border="0" class="datatable">                        
                        <thead>
                            <tr>
                        		<td><b>Codificaci&oacute;n</b></td>
                        		<td><b>Grupo</b></td>
                                <td><b>Empresa</b></td>
                                <td><b>Servicio</b></td>
                            </tr>
                        </thead>
                        <tbody class="textList">
                    <?php
						while($row_tarea = mysql_fetch_assoc($tareas)){
							echo '<tr><td><a href="cargarHoras3.php?IdTarea='.$row_tarea['IdTarea'].'">'.$row_tarea['CodificacionComp'].'</a></td><td>'.$row_tarea['Grupo'].'</td><td>'.$row_tarea['Empresa'].'</td><td>'.$row_tarea['Servicio'].'</a></td></tr>';
						}
				  ?>
                  		</tbody>
                        <tfoot>
                            <tr>
                                <td><b>Codificaci&oacute;n</b></td>
                          		<td><b>Grupo</b></td>
                                <td><b>Empresa</b></td>
                                <td><b>Servicio</b></td>
                            </tr>
                        </tfoot>
                  </table>
                  <div class="texto_gris">Se consulta un maximo de 150 registros</div>
                  <?php
					}
				  ?>
                  </div>
                  </p>
            	</div>
            </td>
          </tr>
        </table>
     </td>
  </tr>
</table>
</body>
</html>
<?php
@mysql_free_result($quienEs);
@mysql_free_result($supervisor);
mysql_close($marambio);
?>