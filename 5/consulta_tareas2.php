<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 5){
	header ("Location: ../index.php"); 
}

$currentPage = $_SERVER["PHP_SELF"];

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE tareas SET activo=%s, cerradoPor=%s WHERE IdTarea=%s",
                       GetSQLValueString($_POST['activo'], "int"),
					   GetSQLValueString($_POST['cerradoPor'], "int"),
                       GetSQLValueString($_POST['IdTarea'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
}
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);


if($_GET['IdTarea'] && $_GET['elim']==1){
  $query_elim = "DELETE FROM tareas WHERE IdTarea = '".$_GET['IdTarea']."'";
  $elim = mysql_query($query_elim, $marambio) or die(mysql_error());
  if($elim){ $mensaje = "Se elimino satisfactoriamente la tarea"; }
  else{ $mensaje = "No se pudo eliminar la tarea, intente nuevamente";}
}

$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$totalRows_quienEs = mysql_num_rows($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

$maxRows_tareas = 10;
$pageNum_tareas = 0;
if (isset($_GET['pageNum_tareas'])) {
  $pageNum_tareas = $_GET['pageNum_tareas'];
}
$startRow_tareas = $pageNum_tareas * $maxRows_tareas;

$query_tareas = "SELECT * FROM tareas ORDER BY activo DESC";
$query_limit_tareas = sprintf("%s LIMIT %d, %d", $query_tareas, $startRow_tareas, $maxRows_tareas);
$tareas = mysql_query($query_limit_tareas, $marambio) or die(mysql_error());
$row_tareas = mysql_fetch_assoc($tareas);

if (isset($_GET['totalRows_tareas'])) {
  $totalRows_tareas = $_GET['totalRows_tareas'];
} else {
  $all_tareas = mysql_query($query_tareas);
  $totalRows_tareas = mysql_num_rows($all_tareas);
}
$totalPages_tareas = ceil($totalRows_tareas/$maxRows_tareas)-1;

$queryString_tareas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_tareas") == false && 
        stristr($param, "totalRows_tareas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_tareas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_tareas = sprintf("&totalRows_tareas=%d%s", $totalRows_tareas, $queryString_tareas);

$query_grupo = "SELECT IdGrupo, Nombre FROM grupos ORDER BY Nombre ASC";
$grupo = mysql_query($query_grupo, $marambio) or die(mysql_error());
$row_grupo = mysql_fetch_assoc($grupo);

$colname_GrupoList = "1";
if (isset($_GET['IdGrupo'])) {
  $colname_GrupoList = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}

$query_GrupoList = sprintf("SELECT * FROM grupos WHERE IdGrupo = %s", $colname_GrupoList);
$GrupoList = mysql_query($query_GrupoList, $marambio) or die(mysql_error());
$row_GrupoList = mysql_fetch_assoc($GrupoList);

$colname_empresaList = "1";
if (isset($_GET['IdGrupo'])) {
  $colname_empresaList = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}
/*
$query_empresaList = sprintf("SELECT * FROM empresas WHERE CodGrupo = %s", $colname_empresaList);
$empresaList = mysql_query($query_empresaList, $marambio) or die(mysql_error());
$row_empresaList = mysql_fetch_assoc($empresaList);
*/
?>
<?php include("includes/head.php"); ?>
<style type="text/css">
<!--
.Estilo1 {color: #000000}
-->
</style>
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
<script>
function eliminar(id){
  if(confirm("¿Desea eliminar la tarea?")){
    document.location.href="consulta_tareas2.php?IdTarea="+id+"&elim=1";
  }

}
</script>
<div align="center">
<br />
<p class="titulo"><a href="tareas.php" class="titulo"><< Regresar</a></p>
<p class="titulo">TAREAS</p>
<table width="425" align="center" border="1" cellpadding="1" cellspacing="1" bordercolor="#EAF1FB">
  <tr>
    <td width="417" bordercolor="#EAF1FB" bgcolor="#EAF1FB"><div align="center" class="texto_btgris">Buscar para Filtrar Tareas por Grupos </div></td>
  </tr>
  <tr>
    <td height="29">
    <form name="form3" method="get" action="tareasFiltradasBox.php">
      <div align="center">
        <select name="IdGrupo" class="texto_btgris" id="IdGrupo">
          <option value="0">Seleccione</option>
          <?php
            do {  
            ?>
          <option value="<?php echo $row_grupo['IdGrupo']?>"><?php echo $row_grupo['Nombre']?></option>
          <?php
            } while ($row_grupo = mysql_fetch_assoc($grupo));
              $rows = mysql_num_rows($grupo);
              if($rows > 0) {
                  mysql_data_seek($grupo, 0);
                  $row_grupo = mysql_fetch_assoc($grupo);
              }
            ?>
        </select>
        <input name="Submit" type="submit" class="texto_btgris" value="Listar &gt;&gt;">
      </div>
    </form></td>
  </tr>
</table>
<br>
<table width="96%" class="sortable" border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
  <thead>
  <tr>
    <td width="17%" align="center" class="texto_btgris">C&oacute;digo</td>
    <td width="17%" align="center" class="texto_btgris">Grupo</td>
    <td width="17%" align="center" class="texto_btgris">Empresa</td>
    <td width="15%" align="center" class="texto_btgris">Unidad</td>
    <td width="18%" align="center" class="texto_btgris">Servicio</td>
    <td width="18%" align="center" class="texto_btgris">Fecha de Cierre</td>
    <td width="5%" align="center" class="texto_btgris">Estado</td>
    <td width="5%" align="center" class="texto_btgris">Personal</td>
    <td width="5%" align="center" class="texto_btgris">Detalles</td>
    <td width="5%" align="center" class="texto_btgris">Editar</td>
    <td width="5%" align="center" class="texto_btgris">Eliminar</td>
  </tr>
  </thead>
  <tbody>
  <?php 
    do { 
        
        $rre = "SELECT g.Nombre AS 'nombre1', e.Nombre AS 'nombre2', u.Nombre AS 'nombre3', s.Servicio FROM grupos AS g, empresas AS e, unidades AS u, servicios AS s WHERE g.IdGrupo = '".$row_tareas['IdGrupo']."' AND e.CodEmp = '".$row_tareas['IdEmpresa']."' AND u.IdUnidad = '".$row_tareas['IdUnidad']."' AND s.IdServicio = '".$row_tareas['IdServicio']."' ";
        $datosMostrar = mysql_query($rre, $marambio) or die(mysql_error());
        $row_datosMostrar = mysql_fetch_assoc($datosMostrar);

  ?>
  <tr class="textogrande" onMouseOver="cambiar_color_over(this)" onMouseOut="cambiar_color_out(this)">
    <td class="texto_gris"><div align="center"><?php echo $row_tareas['CodificacionComp']; ?></div></td>
    <td class="texto_gris">
  <?php
    echo $row_datosMostrar['nombre1'];
  ?>
    </td>
    <td class="texto_gris">
      <?php 
    echo $row_datosMostrar['nombre2'];
  ?></td>
    <td class="texto_gris"><div align="left">
        <?php 
    echo $row_datosMostrar['nombre3'];
  ?>
    </div></td>
    <td class="texto_gris">
      <?php 
  //  echo utf8_encode( $row_datosMostrar['Servicio'] );
	echo iconv ( "UTF-8", "ISO-8859-1", $row_datosMostrar['Servicio']);
  ?>
    </td>
    <td class="texto_gris">
      <?php 
    echo $row_tareas['MesEjecucion']."-".$row_tareas['AnnoEjecucion'];
  ?>
    </td>
    <td>
    <form action="<?php echo $editFormAction; ?>" name="form2" method="POST">
      <div align="center">
      <?php if($row_tareas['activo']==1) { ?>
        <input name="imageField" type="image" src="images/si.gif" align="middle" width="22" height="24" border="0"> 
        <input name="activo" type="hidden" id="activo" value="0">
     <?php } else { ?>
        <input name="imageField" type="image" src="images/no.gif" align="middle" width="23" height="27" border="0"> 
        <input name="activo" type="hidden" id="activo" value="1">
     <?php }?>
      </div>
        <input type="hidden" name="MM_update" value="form2">
        <input name="cerradoPor" type="hidden" id="cerradoPor" value="<?php echo $row_quienEs['IdUsuario']; ?>">
        <input name="IdTarea" type="hidden" id="IdTarea" value="<?php echo $row_tareas['IdTarea']; ?>">
    </form></td>
    <td><div align="center">
    <?php if($row_tareas['activo']==1) { ?>
        <a href="personalAsignado.php?IdTarea=<?php echo $row_tareas['IdTarea']; ?>"><img src="images/personas.gif" alt="Personal Asignado" width="34" height="35" border="0"></a>
    <?php } ?>
    </div></td>
    <td><div align="center"><a href="verTarea.php?IdTarea=<?php echo $row_tareas['IdTarea']; ?>"><img src="images/bot_verdetalle.gif" alt="Detalles" width="38" height="36" border="0"></a></div></td>
    <td><div align="center"><a href="editarTarea.php?IdTarea=<?php echo $row_tareas['IdTarea']; ?>"><img src="images/edit_on.jpg" alt="Detalles" width="34" height="35" border="0"></a></div></td>
    <td><div align="center"><a href="javascript:eliminar('<?php echo $row_tareas['IdTarea']; ?>')"><img src="images/elim_on.jpg" alt="Detalles" width="34" height="35" border="0"></a></div></td>
  </tr>
  <?php } while ($row_tareas = mysql_fetch_assoc($tareas)); ?>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_tareas > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_tareas=%d%s", $currentPage, 0, $queryString_tareas); ?>" class="texto_btgris">Primero</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_tareas > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_tareas=%d%s", $currentPage, max(0, $pageNum_tareas - 1), $queryString_tareas); ?>" class="texto_btgris">Anterior</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_tareas < $totalPages_tareas) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_tareas=%d%s", $currentPage, min($totalPages_tareas, $pageNum_tareas + 1), $queryString_tareas); ?>" class="texto_btgris">Siguiente</a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_tareas < $totalPages_tareas) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_tareas=%d%s", $currentPage, $totalPages_tareas, $queryString_tareas); ?>" class="texto_btgris">&Uacute;ltimo</a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
  </tbody>
</table>
</div>
<p></p>
<p class="texto_gris">&nbsp; Registros <strong><?php echo ($startRow_tareas + 1) ?></strong> a <strong><?php echo min($startRow_tareas + $maxRows_tareas, $totalRows_tareas) ?></strong> de <strong><?php echo $totalRows_tareas ?></strong> </p>
<p class="textotitulos">&nbsp;</p>
<p class="textotitulos">&nbsp;</p>
</body>
</html>
<?php
@mysql_free_result($quienEs);
@mysql_free_result($supervisor);
@mysql_free_result($tareas);
@mysql_free_result($grupo);
mysql_close($marambio);
?>