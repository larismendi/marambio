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
if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
}
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
?>
<?php include("includes/head.php");?>
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
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top">
            	<div align="center">
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
                                    echo '<tr><td><a href="cargarHoras3.php?IdTarea='.$row_tarea['IdTarea'].'">'.$row_tarea['CodificacionComp'].'</a></td><td>'.$row_tarea['Grupo'].'</td><td>'.$row_tarea['Empresa'].'</td><td>'.utf8_decode($row_tarea['Servicio']).'</a></td></tr>';
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
                  </div>
                  <?php
                    }
					
                    $query_tareas="SELECT DISTINCT q.Quincena,q.Mes,q.Anno,t.IdTarea,t.CodificacionComp,s.Servicio,g.Nombre Grupo,e.Nombre Empresa
                                            FROM tareas t LEFT JOIN empresas e ON t.IdEmpresa=e.CodEmp LEFT JOIN grupos g ON t.IdGrupo=g.IdGrupo, 
											servicios s, 
                                            quincenasub qs LEFT JOIN quincenas q ON q.IdQna=qs.IdQna
                                            WHERE 
											t.IdTarea=qs.CodificacionComp 
											AND t.IdServicio=s.IdServicio 
											AND qs.APROBADO IS NULL 
											AND t.IdSupervisor=".$row_supervisor['IdUsuario']."
											LIMIT 0,150";
                    $tareas = mysql_query($query_tareas, $marambio) or die(mysql_error());
                    if(mysql_num_rows($tareas)){
		  ?>
                  <div>
                  	<h2>Reportes Pendientes por aprobar</h2>
                  	<table border="0" class="datatable">                        
                        <thead>
                            <tr>
                              <td><b>Codificaci&oacute;n</b></td>
                              <td><b>Quincena</b></td>
                              <!--<td><b>Usuario</b></td>-->
                              <td><b>Grupo</b></td>
                              <td><b>Empresa</b></td>
                              <td><b>Servicio</b></td>
                            </tr>
                        </thead>
                        <tbody class="textList">
                  	<?php
                        $months = array ('00'=>"", '01'=>"Enero", '02'=>"Febrero", '03'=>"Marzo", '04'=>"Abril", '05'=>"Mayo", '06'=>"Junio", '07'=>"Julio", '08'=>"Agosto", '09'=>"Septiembre", '10'=>"Octubre", '11'=>"Noviembre", '12'=>"Diciembre");  
						while($row_tarea = mysql_fetch_assoc($tareas)){
							$query_numtareas = "SELECT ".(($row_tarea['Quincena']==1)?"IF(qs.D01>0,1,IF(qs.D02>0,1,IF(qs.D03>0,1,IF(qs.D04>0,1,IF(qs.D05>0,1,IF(qs.D06>0,1,IF(qs.D07>0,1,IF(qs.D08>0,1,IF(qs.D09>0,1,IF(qs.D10>0,1,IF(qs.D11>0,1,IF(qs.D12>0,1,IF(qs.D13>0,1,IF(qs.D14>0,1,IF(qs.D15>0,1,0)))))))))))))))":"IF(qs.D16>0,1,IF(qs.D17>0,1,IF(qs.D18>0,1,IF(qs.D19>0,1,IF(qs.D20>0,1,IF(qs.D21>0,1,IF(qs.D22>0,1,IF(qs.D23>0,1,IF(qs.D24>0,1,IF(qs.D25>0,1,IF(qs.D26>0,1,IF(qs.D27>0,1,IF(qs.D28>0,1,IF(qs.D29>0,1,IF(qs.D30>0,1,IF(qs.D31>0,1,0))))))))))))))))")." as total FROM quincenasub qs WHERE qs.CodificacionComp='".$row_tarea['IdTarea']."' AND qs.APROBADO IS NULL AND qs.TipoTarea='1' HAVING total >= 1;";
							$numtareas = mysql_query($query_numtareas, $marambio) or die(mysql_error());
							$n = mysql_num_rows($numtareas);
							$query_numtareasTT = "SELECT ".(($row_tarea['Quincena']==1)?"IF(qs.D01>0,1,IF(qs.D02>0,1,IF(qs.D03>0,1,IF(qs.D04>0,1,IF(qs.D05>0,1,IF(qs.D06>0,1,IF(qs.D07>0,1,IF(qs.D08>0,1,IF(qs.D09>0,1,IF(qs.D10>0,1,IF(qs.D11>0,1,IF(qs.D12>0,1,IF(qs.D13>0,1,IF(qs.D14>0,1,IF(qs.D15>0,1,0)))))))))))))))":"IF(qs.D16>0,1,IF(qs.D17>0,1,IF(qs.D18>0,1,IF(qs.D19>0,1,IF(qs.D20>0,1,IF(qs.D21>0,1,IF(qs.D22>0,1,IF(qs.D23>0,1,IF(qs.D24>0,1,IF(qs.D25>0,1,IF(qs.D26>0,1,IF(qs.D27>0,1,IF(qs.D28>0,1,IF(qs.D29>0,1,IF(qs.D30>0,1,IF(qs.D31>0,1,0))))))))))))))))")." as total FROM quincenasub qs WHERE qs.CodificacionComp='".$row_tarea['IdTarea']."' AND qs.TipoTarea='1' HAVING total >= 1;";
							$numtareasTT = mysql_query($query_numtareasTT, $marambio) or die(mysql_error());
							$nTT = mysql_num_rows($numtareasTT);
							if($n){
                            	echo '<tr>
									<td><a href="verQnaPersonalSinHead.php?Id='.$row_tarea['IdTarea'].'&Qna='.$row_tarea['Quincena']./*verQnaOtrosSinHead.php?IdQna='.$row_qs['IdQna'].'&IdUsuario='.$row_qs['IdUsuario'].*/'" rel="facebox">'.$row_tarea['CodificacionComp'].'('.$n.' de '.$nTT.')</a></td>
									<td>'.$row_tarea['Quincena'].($row_tarea['Quincena']==1?'ra':'da').' '.$months[$row_tarea['Mes']].' '.$row_tarea['Anno'].'</td>
									<td>'./*$row_tarea['NombreUser'].'</td>
									<td>'.*/$row_tarea['Grupo'].'</td>
									<td>'.$row_tarea['Empresa'].'</td>
									<td>'.$row_tarea['Servicio'].'</a></td></tr>';
							}
						}
					?>
                    	</tbody>
                    	<tfoot>
                            <tr>
                              <td><b>Codificaci&oacute;n</b></td>
                              <td><b>Quincena</b></td>
                              <!--<td><b>Usuario</b></td>-->
                              <td><b>Grupo</b></td>
                              <td><b>Empresa</b></td>
                              <td><b>Servicio</b></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="texto_gris">Se consulta un maximo de 150 registros</div>
                  </div>
                  <?php
                    }
		  		  ?>
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