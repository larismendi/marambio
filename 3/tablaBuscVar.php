<?php  
session_start();
require_once('Connections/marambio.php'); 
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 3){
	header ("Location: ../index.php"); 
}
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);

$query_quienEs = "SELECT IdUsuario FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);

//$query_f = "SELECT DISTINCT t.IdTarea, t.IdServicio, t.IdEmpresa, t.IdUnidad, g.IdGrupo, t.CodificacionComp, t.MesEjecucion, t.AnnoEjecucion, t.activo FROM tareas AS t, grupos AS g, empresas AS e WHERE g.Nombre LIKE '%".$_GET['id']."%' OR t.CodificacionComp LIKE '%".$_GET['id']."%' OR e.Nombre LIKE '%".$_GET['id']."%' AND t.IdGrupo=g.IdGrupo AND t.IdEmpresa=e.CodEmp";
$_SESSION['grupoTTT']    = (isset($_GET['grupo'])&&$_GET['grupo'])?$_GET['grupo']:'';
$_SESSION['empresaTTT']  = (isset($_GET['empresa'])&&$_GET['empresa'])?$_GET['empresa']:'';
$_SESSION['servicioTTT'] = (isset($_GET['servicio'])&&$_GET['servicio'])?$_GET['servicio']:'';

$criterio = "";

if($_GET['grupo']){
	$criterio = " g.Nombre LIKE '%".$_GET['grupo']."%' ";
}

if($_GET['empresa'] && $criterio == ""){
	$criterio .= " e.Nombre LIKE '%".$_GET['empresa']."%' ";
}else{
	if($_GET['empresa']){
		$criterio .= " AND e.Nombre LIKE '%".$_GET['empresa']."%' ";
	}
}

if($_GET['servicio'] && $criterio == ""){
	$criterio .= " t.IdServicio LIKE '%".$_GET['servicio']."%' ";
}else{
	if($_GET['servicio']){
		$criterio .= " AND t.IdServicio LIKE '%".$_GET['servicio']."%' ";
	}
}

$criterio .= " AND t.IdGrupo=g.IdGrupo AND t.IdEmpresa=e.CodEmp";

$query_f = "SELECT DISTINCT t.IdTarea, t.IdServicio, t.IdEmpresa, t.IdUnidad, g.IdGrupo, t.CodificacionComp, t.MesEjecucion, t.AnnoEjecucion, t.activo, t.FEspanol FROM tareas AS t, grupos AS g, empresas AS e WHERE ".$criterio;
$rgr = mysql_query($query_f, $marambio) or die(mysql_error());
$row_f = mysql_fetch_assoc($rgr);

  	if ($row_f > 0){
		$con=0;
?>
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
<table align="center">
    <tr>
    	<td>
            <table width="96%" align="center" border="0" class="datatable">
              <thead>
                  <tr>
                    <td>ID</td>
                    <td>C&oacute;digo</td>
                    <td>Grupo</td>
                    <td>Empresa</td>
                    <td>Unidad</td>
                    <td>Servicio</td>
                    <td>Fecha de Creaci&oacute;n</td>
                    <td>Consultar</td>
                  </tr>
              </thead>
              <tbody>
              <?php 
                do { 
                    $query_e = "SELECT g.Nombre AS 'nombre1', e.Nombre AS 'nombre2', u.Nombre AS 'nombre3', s.Servicio FROM grupos AS g, empresas AS e, unidades AS u, servicios AS s WHERE g.IdGrupo = '".$row_f['IdGrupo']."' AND e.CodEmp = '".$row_f['IdEmpresa']."' AND u.IdUnidad = '".$row_f['IdUnidad']."' AND s.IdServicio = '".$row_f['IdServicio']."' ";
                    $ej_e = mysql_query($query_e, $marambio) or die(mysql_error());
                    $row_e = mysql_fetch_assoc($ej_e);
            
              ?>
              <tr>
                <td><div align="center"><?php echo $row_f['IdTarea']; ?></div></td>
                <td><div align="center"><?php echo $row_f['CodificacionComp']; ?></div></td>
                <td>
              <?php
                echo $row_e['nombre1'];
              ?>
                </td>
                <td>
                  <?php 
                echo $row_e['nombre2'];
              ?></td>
                <td><div align="left">
                    <?php 
                echo $row_e['nombre3'];
              ?>
                </div></td>
                <td>
                  <?php 
                echo utf8_encode($row_e['Servicio']);
              ?>
                </td>
                <td>
                  <?php 
                echo $row_f['FEspanol']/*."-".$row_f['AnnoEjecucion']*/;
              ?>
                </td>
                <td><div align="center"><a href="tiempoxProyecto2.php?proyectoX=<?php echo $row_f['IdTarea']; ?>"><img src="images/bot_verdetalle.gif" alt="Detalles" width="38" height="36" border="0"></a></div></td>
              </tr>
              <?php } while ( $row_f = mysql_fetch_assoc($rgr) ); ?>
            </table>
		</tbody>
        </td>
	</tr> 
</table>

<?php		
}else{
?>
No existen tareas relacionadas a la consulta
<?php	 
}
@mysql_free_result($row_f);
?>