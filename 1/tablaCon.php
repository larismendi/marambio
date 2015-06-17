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

$query_f = "SELECT IdServicio, IdEmpresa, IdUnidad, IdEmpresa, CodificacionComp, FEspanol, MesEjecucion, AnnoEjecucion, activo FROM tareas WHERE IdGrupo = '".$_GET['id']."' ";
$rgr = mysql_query($query_f, $marambio) or die(mysql_error());
$row_f = mysql_fetch_assoc($rgr);

  	if ($row_f > 0){
		$con=0;
?>
<table align="center">
	<tr>
    	<td align="right"><input type="button" value="Agregar tarea al Grupo" onclick="javascript: document.location.href='agregarTareasGrupo.php?IdGrupo=<?php echo $_GET['id']; ?>'"></td>
    </tr>
    <tr>
    	<td>
            <table width="96%" align="center" class="sortable" border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
              <thead>
              <tr>
                <td width="17%" align="center" class="texto_btgris">C&oacute;digo</td>
                <td width="17%" align="center" class="texto_btgris">Grupo</td>
                <td width="17%" align="center" class="texto_btgris">Empresa</td>
                <td width="15%" align="center" class="texto_btgris">Unidad</td>
                <td width="18%" align="center" class="texto_btgris">Servicio</td>
                <td width="25%" align="center" class="texto_btgris">Fecha de Cierre</td>
                <!--<td width="5%" align="center" class="texto_btgris">Estado</td>
                <td width="5%" align="center" class="texto_btgris">Personal</td>
                <td width="5%" align="center" class="texto_btgris">Detalles</td>
                <td width="5%" align="center" class="texto_btgris">Editar</td>-->
              </tr>
              </thead>
              <tbody>
              <?php 
                do { 
                    $query_e = "SELECT g.Nombre AS 'nombre1', e.Nombre AS 'nombre2', u.Nombre AS 'nombre3', s.Servicio FROM grupos AS g, empresas AS e, unidades AS u, servicios AS s WHERE g.IdGrupo = '".$_GET['id']."' AND e.CodEmp = '".$row_f['IdEmpresa']."' AND u.IdUnidad = '".$row_f['IdUnidad']."' AND s.IdServicio = '".$row_f['IdServicio']."' ";
                    $ej_e = mysql_query($query_e, $marambio) or die(mysql_error());
                    $row_e = mysql_fetch_assoc($ej_e);
            
              ?>
              <tr class="textogrande" onMouseOver="cambiar_color_over(this)" onMouseOut="cambiar_color_out(this)">
                <td class="texto_gris"><div align="center"><?php echo $row_f['CodificacionComp']; ?></div></td>
                <td class="texto_gris">
              <?php
                echo utf8_encode($row_e['nombre1']);
              ?>
                </td>
                <td class="texto_gris">
                  <?php 
                echo utf8_encode($row_e['nombre2']);
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
                echo $row_f['MesEjecucion']."-".$row_f['AnnoEjecucion'];
              ?>
                </td>
                <!--<td>
                  <div align="center">
                  <?php if($row_f['activo']==1) { ?>
                    <input name="imageField" type="image" src="images/si.gif" align="middle" width="22" height="24" border="0"> 
                 <?php } else { ?>
                    <input name="imageField" type="image" src="images/no.gif" align="middle" width="23" height="27" border="0"> 
                 <?php }?>
                  </div></td>
                <td><div align="center">
                <?php if($row_f['activo']==1) { ?>
                    <a href="personalAsignado.php?IdTarea=<?php echo $row_f['IdTarea']; ?>"><img src="images/personas.gif" alt="Personal Asignado" width="34" height="35" border="0"></a>
                <?php } ?>
                </div></td>
                <td><div align="center"><a href="verTarea.php?IdTarea=<?php echo $row_f['IdTarea']; ?>"><img src="images/bot_verdetalle.gif" alt="Detalles" width="38" height="36" border="0"></a></div></td>
                <td><div align="center"><a href="editarTarea.php?IdTarea=<?php echo $row_f['IdTarea']; ?>"><img src="images/edit_on.jpg" alt="Detalles" width="34" height="35" border="0"></a></div></td>
                -->
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
?>