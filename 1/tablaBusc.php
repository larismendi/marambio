<?php  
session_start();
require_once('Connections/marambio.php'); 
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
}
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);

$query_quienEs = "SELECT IdUsuario FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);

$query_f = "SELECT DISTINCT t.IdTarea, t.IdServicio, t.IdEmpresa, t.IdUnidad, g.IdGrupo, t.CodificacionComp, t.MesEjecucion, t.AnnoEjecucion, t.activo, t.FEspanol FROM tareas AS t, grupos AS g, empresas AS e WHERE g.Nombre LIKE '%".$_GET['id']."%' OR t.CodificacionComp LIKE '%".$_GET['id']."%' OR e.Nombre LIKE '%".$_GET['id']."%' AND t.IdGrupo=g.IdGrupo AND t.IdEmpresa=e.CodEmp";

$rgr = mysql_query($query_f, $marambio) or die(mysql_error());
$row_f = mysql_fetch_assoc($rgr);

  	if ($row_f > 0){
		$con=0;
?>
<table align="center">
    <tr>
    	<td>
            <table width="96%" align="center" class="sortable" border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
              <thead>
              <tr>
                <td width="17%" align="center" class="texto_btgris">ID</td>
                <td width="17%" align="center" class="texto_btgris">C&oacute;digo</td>
                <td width="17%" align="center" class="texto_btgris">Grupo</td>
                <td width="17%" align="center" class="texto_btgris">Empresa</td>
                <td width="15%" align="center" class="texto_btgris">Unidad</td>
                <td width="18%" align="center" class="texto_btgris">Servicio</td>
                <td width="25%" align="center" class="texto_btgris">Fecha de Creaci&oacute;n</td>
                <td width="15%" align="center" class="texto_btgris">Consultar</td>
              </tr>
              </thead>
              <tbody>
              <?php 
                do { 
                    $query_e = "SELECT g.Nombre AS 'nombre1', e.Nombre AS 'nombre2', u.Nombre AS 'nombre3', s.Servicio FROM grupos AS g, empresas AS e, unidades AS u, servicios AS s WHERE g.IdGrupo = '".$row_f['IdGrupo']."' AND e.CodEmp = '".$row_f['IdEmpresa']."' AND u.IdUnidad = '".$row_f['IdUnidad']."' AND s.IdServicio = '".$row_f['IdServicio']."' ";
                    $ej_e = mysql_query($query_e, $marambio) or die(mysql_error());
                    $row_e = mysql_fetch_assoc($ej_e);
            
              ?>
              <tr class="textogrande" onMouseOver="cambiar_color_over(this)" onMouseOut="cambiar_color_out(this)">
                <td class="texto_gris"><div align="center"><?php echo $row_f['IdTarea']; ?></div></td>
                <td class="texto_gris"><div align="center"><?php echo $row_f['CodificacionComp']; ?></div></td>
                <td class="texto_gris">
              <?php
                echo $row_e['nombre1'];
              ?>
                </td>
                <td class="texto_gris">
                  <?php 
                echo $row_e['nombre2'];
              ?></td>
                <td class="texto_gris"><div align="left">
                    <?php 
                echo $row_e['nombre3'];
              ?>
                </div></td>
                <td class="texto_gris">
                  <?php 
                echo utf8_encode($row_e['Servicio']);
              ?>
                </td>
                <td class="texto_gris">
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