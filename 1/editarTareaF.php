<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
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
//////////////////////////////////////////////////////////////////////////////////////////////////////
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$Dia=date("d");
	$Mes=$_POST['Mes'];
	$Anno=$_POST['Anno'];
	//$Mes=date("m");
	//$Anno=date("Y");
	$FEspanol2000=$Dia . "/" . $Mes . "/" . $Anno;
	$FIngles2000=$Anno . $Mes . $Dia;
	$CodificacionCompleta2000=$IdGrupo . "." . $IdEmpresa . "." . $IdUnidad . "." . $IdServicio . "." . $Mes . "." . $Anno; 
	
	if($TipoTasa==1) {
			

$Tasa2000=$row_TasaFijaFinal['Monto'];
	} else {
			$Tasa2000=$TasaV;
	}
}

$AnnoMes2000=$Anno . $Mes;
/////////////////////////////////////////////////////////////////////////////////////////////////////
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	if($_POST['HorasSocio'] > 0 || $_POST['HorasGerente'] > 0 || $_POST['HorasEncargado'] > 0 || $_POST['HorasAsistente'] > 0 || $_POST['HorasLider'] > 0){
		$updateSQL = sprintf("UPDATE tareas SET IdGrupo=%s, IdEmpresa=%s, IdUnidad=%s, IdServicio=%s, IdLider=%s, FEspanol=%s, FIngles=%s, CodificacionComp=%s, IdSupervisor=%s, Tasa=%s, HorasEstimadas=%s, HorasSocio=%s, HorasGerente=%s, HorasEncargado=%s, HorasAsistente=%s, HorasLider=%s, MesEjecucion=%s, AnnoEjecucion=%s WHERE IdTarea=%s",
						   GetSQLValueString($_POST['IdGrupo'], "int"),
						   GetSQLValueString($_POST['IdEmpresa'], "int"),
						   GetSQLValueString($_POST['IdUnidad'], "int"),
						   GetSQLValueString($_POST['IdServicio'], "int"),
						   GetSQLValueString($_POST['IdLider'], "int"),
						   GetSQLValueString($FEspanol2000, "text"),
						   GetSQLValueString($FIngles2000, "text"),
						   GetSQLValueString($CodificacionCompleta2000, "text"),
						   GetSQLValueString($_POST['IdSupervisor'], "int"),
						   GetSQLValueString($_POST['Tasa'], "double"),
						   GetSQLValueString($_POST['HorasEstimadas'], "int"),
						   GetSQLValueString($_POST['HorasSocio'], "int"),
						   GetSQLValueString($_POST['HorasGerente'], "int"),
						   GetSQLValueString($_POST['HorasEncargado'], "int"),
						   GetSQLValueString($_POST['HorasAsistente'], "int"),
						   GetSQLValueString($_POST['HorasLider'], "int"),
						   GetSQLValueString($_POST['MesEjecucion'], "text"),
						   GetSQLValueString($_POST['AnnoEjecucion'], "text"),
						   GetSQLValueString($_POST['IdTarea'], "int"));
		
		mysql_select_db($database_marambio, $marambio);
		$Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
		
		$updateGoTo = "tareasFiltradas.php";
		if (isset($_SERVER['QUERY_STRING'])) {
		$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		$updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}else{
		$mensaje = "Debe al menos ingresar una hora para el calculo de las horas estimadas.";
	}
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

$colname_tarea = "1";
if (isset($_GET['IdTarea'])) {
  $colname_tarea = (get_magic_quotes_gpc()) ? $_GET['IdTarea'] : addslashes($_GET['IdTarea']);
}

$query_tarea = sprintf("SELECT * FROM tareas WHERE IdTarea = %s", $colname_tarea);
$tarea = mysql_query($query_tarea, $marambio) or die(mysql_error());
$row_tarea = mysql_fetch_assoc($tarea);
$totalRows_tarea = mysql_num_rows($tarea);

$query_grupoList = "SELECT * FROM grupos ORDER BY Nombre ASC";
$grupoList = mysql_query($query_grupoList, $marambio) or die(mysql_error());
$row_grupoList = mysql_fetch_assoc($grupoList);
$totalRows_grupoList = mysql_num_rows($grupoList);

$query_empresaList = "SELECT CodEmp, Nombre FROM empresas ORDER BY Nombre ASC";
$empresaList = mysql_query($query_empresaList, $marambio) or die(mysql_error());
$row_empresaList = mysql_fetch_assoc($empresaList);
$totalRows_empresaList = mysql_num_rows($empresaList);

$query_unidadList = "SELECT IdUnidad, Nombre FROM unidades ORDER BY Nombre ASC";
$unidadList = mysql_query($query_unidadList, $marambio) or die(mysql_error());
$row_unidadList = mysql_fetch_assoc($unidadList);
$totalRows_unidadList = mysql_num_rows($unidadList);

$query_serviList = "SELECT IdServicio, Servicio FROM servicios ORDER BY Servicio ASC";
$serviList = mysql_query($query_serviList, $marambio) or die(mysql_error());
$row_serviList = mysql_fetch_assoc($serviList);
$totalRows_serviList = mysql_num_rows($serviList);

$query_liderList = "SELECT IdUsuario, Nombre FROM usuarios ORDER BY Nombre ASC";
$liderList = mysql_query($query_liderList, $marambio) or die(mysql_error());
$row_liderList = mysql_fetch_assoc($liderList);
$totalRows_liderList = mysql_num_rows($liderList);
?>
<?php include("includes/head.php"); ?>
<script type="text/javascript" language="javascript" src="autoComplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" language="javascript">
jQuery(function(){
	jQuery('#HorasSocio,#HorasGerente,#HorasEncargado,#HorasAsistente,#HorasLider').change(function(){
		var nn0 = Number(jQuery('#HorasSocio').val()) + Number(jQuery('#HorasGerente').val()) + Number(jQuery('#HorasEncargado').val()) + Number(jQuery('#HorasAsistente').val()) + Number(jQuery('#HorasLider').val());
		jQuery('#TasaV').attr('value',nn0);
	});
});
</script>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="center" class="textotitulos">&nbsp;</p>
                <p align="center" class="titulo">
				TAREAS</p>
            <p><a href="tareasFiltradas.php?IdGrupo=<? echo $IdGrupo; ?>" class="texto_btgris">&lt;&lt; Volver</a></p>
                    <form method="POST" name="form1" action="">
              <table align="center">
                <tr valign="baseline">
                  <td width="120" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Grupo:</div></td>
                  <td width="250" class="texto_gris"><strong>
                    <select name="IdGrupo" class="texto_btgris" id="IdGrupo">
                      <?php
do {  
?>
                      <option value="<?php echo $row_grupoList['IdGrupo']?>"<?php if (!(strcmp($row_grupoList['IdGrupo'], $row_tarea['IdGrupo']))) {echo "SELECTED";} ?>><?php echo $row_grupoList['Nombre']?></option>
                      <?php
} while ($row_grupoList = mysql_fetch_assoc($grupoList));
  $rows = mysql_num_rows($grupoList);
  if($rows > 0) {
      mysql_data_seek($grupoList, 0);
	  $row_grupoList = mysql_fetch_assoc($grupoList);
  }
?>
                    </select>
                  </strong></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Empresa:</div></td>
                  <td class="texto_btgris"><select name="IdEmpresa" class="texto_btgris" id="IdEmpresa">
                    <?php
do {  
?>
                    <option value="<?php echo $row_empresaList['CodEmp']?>"<?php if (!(strcmp($row_empresaList['CodEmp'], $row_tarea['IdEmpresa']))) {echo "SELECTED";} ?>><?php echo $row_empresaList['Nombre']?></option>
                    <?php
} while ($row_empresaList = mysql_fetch_assoc($empresaList));
  $rows = mysql_num_rows($empresaList);
  if($rows > 0) {
      mysql_data_seek($empresaList, 0);
	  $row_empresaList = mysql_fetch_assoc($empresaList);
  }
?>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Monto Tasa:</div></td>
                  <td><input name="Tasa" type="text" class="texto_btgris" id="Tasa32" value="<?php echo $row_tarea['Tasa']; ?>" size="10"></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Unidad:</div></td>
                  <td><select name="IdUnidad" class="texto_btgris" id="IdUnidad">
                    <?php
do {  
?>
                    <option value="<?php echo $row_unidadList['IdUnidad']?>"<?php if (!(strcmp($row_unidadList['IdUnidad'], $row_tarea['IdUnidad']))) {echo "SELECTED";} ?>><?php echo $row_unidadList['Nombre']?></option>
                    <?php
} while ($row_unidadList = mysql_fetch_assoc($unidadList));
  $rows = mysql_num_rows($unidadList);
  if($rows > 0) {
      mysql_data_seek($unidadList, 0);
	  $row_unidadList = mysql_fetch_assoc($unidadList);
  }
?>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Servicio:</div></td>
                  <td><select name="IdServicio" class="texto_btgris" id="IdServicio">
                    <?php
do {  
?>
                    <option value="<?php echo $row_serviList['IdServicio']?>"<?php if (!(strcmp($row_serviList['IdServicio'], $row_tarea['IdServicio']))) {echo "SELECTED";} ?>><?php echo $row_serviList['Servicio']?></option>
                    <?php
} while ($row_serviList = mysql_fetch_assoc($serviList));
  $rows = mysql_num_rows($serviList);
  if($rows > 0) {
      mysql_data_seek($serviList, 0);
	  $row_serviList = mysql_fetch_assoc($serviList);
  }
?>
                  </select></td>
                </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Lider de Proyecto:</div></td>
				  <td><select name="IdLider" class="texto_btgris" id="IdLider">
				    <?php
do {  
?>
				    <option value="<?php echo $row_liderList['IdUsuario']?>"<?php if (!(strcmp($row_liderList['IdUsuario'], $row_tarea['IdLider']))) {echo "SELECTED";} ?>><?php echo $row_liderList['Nombre']?></option>
				    <?php
} while ($row_liderList = mysql_fetch_assoc($liderList));
  $rows = mysql_num_rows($liderList);
  if($rows > 0) {
      mysql_data_seek($liderList, 0);
	  $row_liderList = mysql_fetch_assoc($liderList);
  }
?>
				    </select></td>
				  </tr>
                  <?php 
				  	$mesesArray = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');				  	
				  ?>
                  <tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Fecha de Creaci?n: </div></td>
				  <td><select name="Mes" class="texto_gris" id="Mes">
                  	<?php foreach($mesesArray as $mesArray){?>
					<option <?php if($mesArray==$row_tarea['Mes']){echo 'selected';}?> value="<?php echo $mesArray;?>"><?php echo $mesArray;?></option>
					<?php }?>
				    </select> 
				    <span class="texto_gris">/ </span>
				    <select name="Anno" class="texto_gris" id="Anno" value="<?php echo $row_tarea['Anno'];?>"/></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Fecha de Cierre: </div></td>
				  <td><select name="MesEjecucion" class="texto_btgris" id="MesEjecucion">
				    <option value="<?php echo $row_tarea['MesEjecucion']; ?>"><?php echo $row_tarea['MesEjecucion']; ?></option>
					<option value="01" <?php if (!(strcmp(01, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>01</option>
				    <option value="02" <?php if (!(strcmp(02, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>02</option>
					<option value="03" <?php if (!(strcmp(03, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>03</option>
					<option value="04" <?php if (!(strcmp(04, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>04</option>
					<option value="05" <?php if (!(strcmp(05, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>05</option>
					<option value="06" <?php if (!(strcmp(06, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>06</option>
					<option value="07" <?php if (!(strcmp(07, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>07</option>
					<option value="08" <?php if (!(strcmp(08, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>08</option>
					<option value="09" <?php if (!(strcmp(09, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>09</option>
					<option value="10" <?php if (!(strcmp(10, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>10</option>
					<option value="11" <?php if (!(strcmp(11, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>11</option>
					<option value="12" <?php if (!(strcmp(12, $row_tarea['MesEjecucion']))) {echo "SELECTED";} ?>>12</option>
				    </select> 
				    <span class="texto_gris">/</span>				    <input name="AnnoEjecucion" type="text" class="texto_btgris" id="AnnoEjecucion" value="<?php echo $row_tarea['AnnoEjecucion']; ?>" size="4" maxlength="4"></td>
				</tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Estimadas </div></td>
                  <td bgcolor="#EAF1FB"><input name="HorasEstimadas" type="text" class="texto_btgris" id="TasaV" value="<?=$row_tarea['HorasEstimadas']; ?>" readonly size="10"></td>
                </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Socio </div></td>
				  <td bgcolor="#FFFFFF"><input name="HorasSocio" type="text" class="texto_btgris" id="HorasSocio" value="<?=$row_tarea['HorasSocio']?$row_tarea['HorasSocio']:0; ?>" size="10"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Gerente </div></td>
				  <td bgcolor="#FFFFFF"><input name="HorasGerente" type="text" class="texto_btgris" id="HorasGerente" value="<?=$row_tarea['HorasGerente']?$row_tarea['HorasGerente']:0; ?>" size="10"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Encargado </div></td>
				  <td bgcolor="#FFFFFF"><input name="HorasEncargado" type="text" class="texto_btgris" id="HorasEncargado" value="<?=$row_tarea['HorasEncargado']?$row_tarea['HorasEncargado']:0; ?>" size="10"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Asistente </div></td>
				  <td bgcolor="#FFFFFF"><input name="HorasAsistente" type="text" class="texto_btgris" id="HorasAsistente" value="<?=$row_tarea['HorasAsistente']?$row_tarea['HorasAsistente']:0; ?>" size="10"></td>
				  </tr>
                                <tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Lider </div></td>
				  <td bgcolor="#FFFFFF"><input name="HorasLider" type="text" class="texto_btgris" id="HorasLider" value="<?=$row_tarea['HorasLider']?$row_tarea['HorasLider']:0; ?>" size="10"></td>
				  </tr>
				<tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left"></div></td>
                  <td bgcolor="#EAF1FB">
		    <input type="submit" class="texto_btgris" value="Guardar &gt;&gt;">
                    <input name="IdTarea" type="hidden" id="IdTarea" value="<?php echo $row_tarea['IdTarea']; ?>">
                    <input name="CodificacionComp" type="hidden" id="CodificacionComp">
                    <input name="IdSupervisor" type="hidden" id="IdSupervisor" value="<?php echo $row_supervisor['IdUsuario']; ?>">
                    <input name="FEspanol" type="hidden" id="FEspanol">
                    <input name="FIngles" type="hidden" id="FIngles">                    </td>
                </tr>
              </table>              
              <input type="hidden" name="MM_insert" value="form1">
              <input type="hidden" name="MM_update" value="form1">      
            </form>
            <p>&nbsp;
			  </p>
                <p align="left" class="textotitulos">&nbsp;</p>
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
@mysql_free_result($tarea);
@mysql_free_result($grupoList);
@mysql_free_result($empresaList);
@mysql_free_result($unidadList);
@mysql_free_result($serviList);
@mysql_free_result($liderList);
mysql_close($marambio);
?>