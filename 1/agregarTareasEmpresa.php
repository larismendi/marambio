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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$Dia=$_POST['Dia'];
	$Mes=$_POST['Mes'];
	$Anno=$_POST['Anno'];
	//$Mes=date("m");
	//$Anno=date("Y");
	$FEspanol2000=$Dia . "/" . $Mes . "/" . $Anno;
	$FIngles2000=$Anno . $Mes . $Dia;
	$CodificacionCompleta2000=$IdGrupo2 . "." . $IdEmpresa2 . "." . $IdUnidad . "." . $IdServicio . "." . $_POST['MesEjecucion'] . "." . $_POST['AnnoEjecucion']; 
	
	if($TipoTasa==1) {
			mysql_select_db($database_marambio, $marambio);
			$query_TasaFijaFinal = "SELECT * FROM tasas WHERE IdTasa = '$TasaF'";
			$TasaFijaFinal = mysql_query($query_TasaFijaFinal, $marambio) or die(mysql_error());
			$row_TasaFijaFinal = mysql_fetch_assoc($TasaFijaFinal);
			$totalRows_TasaFijaFinal = mysql_num_rows($TasaFijaFinal);
			$Tasa2000=$row_TasaFijaFinal['Monto'];
	} else {
			$Tasa2000=$TasaV;
	}
}

$AnnoMes2000=$Anno . $Mes;
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	if($_POST['HorasEstimadas'] > 0 || $_POST['HorasEstimadas2'] > 0 || $_POST['HorasEstimadas3'] > 0 || $_POST['HorasEstimadas4'] > 0 || $_POST['HorasEstimadas5'] > 0){
		$query_tarFinal = "SELECT IdTarea FROM tareas WHERE CodificacionComp = '$CodificacionCompleta2000'";
		$tarFinal = mysql_query($query_tarFinal, $marambio) or die(mysql_error());
		$row_tarFinal = mysql_fetch_assoc($tarFinal);
				  
		if(!$row_tarFinal['IdTarea']){	  
			$insertSQL = sprintf("INSERT INTO tareas (IdGrupo, IdEmpresa, IdUnidad, IdServicio, IdLider, Dia, Mes, Anno, AnnoMes, FEspanol, FIngles, CodificacionComp, IdSupervisor, Tasa, HorasEstimadas, HorasSocio, HorasGerente, HorasEncargado, HorasAsistente, MesEjecucion, AnnoEjecucion, HorasLider) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
								 GetSQLValueString($_POST['IdGrupo2'], "int"),
								 GetSQLValueString($_POST['IdEmpresa2'], "int"),
								 GetSQLValueString($_POST['IdUnidad'], "int"),
								 GetSQLValueString($_POST['IdServicio'], "int"),
								 GetSQLValueString($_POST['IdLider'], "int"),
								 GetSQLValueString($Dia, "text"),
								 GetSQLValueString($Mes, "text"),
								 GetSQLValueString($Anno, "text"),
								 GetSQLValueString($AnnoMes2000, "text"),
								 GetSQLValueString($FEspanol2000, "text"),
								 GetSQLValueString($FIngles2000, "text"),
								 GetSQLValueString($CodificacionCompleta2000, "text"),
								 GetSQLValueString($_POST['IdSupervisor'], "int"),
								 GetSQLValueString($Tasa2000, "double"),
								 GetSQLValueString($_POST['HorasEstimadas'], "int"),
								 GetSQLValueString($_POST['HorasSocio'], "int"),
								 GetSQLValueString($_POST['HorasGerente'], "int"),
								 GetSQLValueString($_POST['HorasEncargado'], "int"),
								 GetSQLValueString($_POST['HorasAsistente'], "int"),
								 GetSQLValueString($_POST['MesEjecucion'], "text"),
								 GetSQLValueString($_POST['AnnoEjecucion'], "text"),
															 GetSQLValueString($_POST['HorasLider'], "int"));
		  
			mysql_select_db($database_marambio, $marambio);
			$Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());
			
			if($Result1){
			  $mensaje = "Tarea creada con exito.";
			  $redireccion = "empresas.php";
			  if (isset($_SERVER['QUERY_STRING'])) {
				$redireccion .= (strpos($insertGoTo, '?')) ? "&" : "?";
				$redireccion .= $_SERVER['QUERY_STRING'];
			  }		
			}else{
				$mensaje = "No se pudo crear la tarea, ocurrio un error en el proceso.";
			}
		}else{
			$mensaje = "No se pudo crear la tarea, ya esta registrada en el sistema.";
		}
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

$query_grupo = "SELECT IdGrupo, Nombre FROM grupos ORDER BY Nombre ASC";
$grupo = mysql_query($query_grupo, $marambio) or die(mysql_error());
$row_grupo = mysql_fetch_assoc($grupo);
$totalRows_grupo = mysql_num_rows($grupo);

$colname_GrupoList = "1";
if (isset($_GET['IdGrupo'])) {
  $colname_GrupoList = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}

$query_GrupoList = sprintf("SELECT * FROM grupos WHERE IdGrupo = %s", $colname_GrupoList);
$GrupoList = mysql_query($query_GrupoList, $marambio) or die(mysql_error());
$row_GrupoList = mysql_fetch_assoc($GrupoList);
$totalRows_GrupoList = mysql_num_rows($GrupoList);

$colname_empresaList = "1";
if (isset($_GET['IdEmpresa'])) {
  $colname_empresaList = (get_magic_quotes_gpc()) ? $_GET['IdEmpresa'] : addslashes($_GET['IdEmpresa']);
}

$query_empresaList = sprintf("SELECT * FROM empresas WHERE CodEmp = %s", $colname_empresaList);
$empresaList = mysql_query($query_empresaList, $marambio) or die(mysql_error());
$row_empresaList = mysql_fetch_assoc($empresaList);
$totalRows_empresaList = mysql_num_rows($empresaList);


$query_unidadesList = "SELECT IdUnidad, Nombre FROM unidades ORDER BY Nombre ASC";
$unidadesList = mysql_query($query_unidadesList, $marambio) or die(mysql_error());
$row_unidadesList = mysql_fetch_assoc($unidadesList);
$totalRows_unidadesList = mysql_num_rows($unidadesList);

$query_serviciosList = "SELECT * FROM servicios ORDER BY Servicio ASC";
$serviciosList = mysql_query($query_serviciosList, $marambio) or die(mysql_error());
$row_serviciosList = mysql_fetch_assoc($serviciosList);
$totalRows_serviciosList = mysql_num_rows($serviciosList);

$query_tasaList = "SELECT * FROM tasas ORDER BY Nombre ASC";
$tasaList = mysql_query($query_tasaList, $marambio) or die(mysql_error());
$row_tasaList = mysql_fetch_assoc($tasaList);
$totalRows_tasaList = mysql_num_rows($tasaList);

$query_Lider = "SELECT IdUsuario, Nombre FROM usuarios ORDER BY Nombre ASC";
$Lider = mysql_query($query_Lider, $marambio) or die(mysql_error());
$row_Lider = mysql_fetch_assoc($Lider);
$totalRows_Lider = mysql_num_rows($Lider);

?>
<?php include("includes/head.php"); ?>
<script language="JavaScript" src="mm_menu.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript" type="text/javascript" src="autoComplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" language="javascript">
jQuery(function(){
	jQuery('#HorasEstimadas,#HorasEstimadas2,#HorasEstimadas3,#HorasEstimadas4,#HorasEstimadas5').change(function(){
		var nn0 = Number(jQuery('#HorasEstimadas').val()) + Number(jQuery('#HorasEstimadas2').val()) + Number(jQuery('#HorasEstimadas3').val()) + Number(jQuery('#HorasEstimadas4').val()) + Number(jQuery('#HorasEstimadas5').val());
		jQuery('#TasaV').attr('value',nn0);
	});
});
</script>
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
-->
</style>
                <p align="center" class="textotitulos">&nbsp;</p>
                <p align="center" class="titulo">
				TAREAS</p>
            <p><a href="empresas.php" class="texto_btgris">&lt;&lt; Volver</a></p>
                    <form method="POST" name="form1" action="">
              <table align="center">
                <tr valign="baseline">
                  <td width="144" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Grupo:</div></td>
                  <td width="275" class="texto_gris"><strong><?php echo $row_GrupoList['Nombre']; ?></strong></td>
                </tr>
				<?php if($IdGrupo!='') { ?>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Empresa:</div></td>
                  <td class="texto_btgris"><?php echo $row_empresaList['Nombre']; ?></td>
                </tr>
				<?php } ?>
                <?php if($TipoTasa==''){$TipoTasa=1;} ?>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Tipo Tasa:</div></td>
                  <td><select name="TipoTasa" class="texto_gris" id="TipoTasa" onChange="MM_jumpMenu('parent',this,0)">
                    <?php if($TipoTasa==1) { ?>
					<option value="1">Fija</option>
					<?php } elseif($TipoTasa==2) { ?>
					<option value="2">Variable</option>
					<?php } else { ?>
					<option value="0">Seleccione</option>
					<?php } ?>
                    <option value="agregarTareas.php?IdGrupo=<?php echo $IdGrupo; ?>&IdEmpresa=<?php echo $IdEmpresa; ?>&TipoTasa=1">Fija</option>
                    <option value="agregarTareas.php?IdGrupo=<?php echo $IdGrupo; ?>&IdEmpresa=<?php echo $IdEmpresa; ?>&TipoTasa=2">Variable</option>
                  </select></td>
                </tr>
				<?php if($TipoTasa!='') { ?>
				<?php if($TipoTasa==1) { ?>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Tasa Fija: </div></td>
                  <td>
				 <select name="TasaF" class="texto_gris" id="TasaF">
                    <?php
					do {  
					?>
                    <option value="<?php echo $row_tasaList['IdTasa']?>"><?php echo $row_tasaList['Nombre']?> Bs. <?php echo $row_tasaList['Monto']; ?></option>
                    <?php
					} while ($row_tasaList = mysql_fetch_assoc($tasaList));
					  $rows = mysql_num_rows($tasaList);
					  if($rows > 0) {
						  mysql_data_seek($tasaList, 0);
						  $row_tasaList = mysql_fetch_assoc($tasaList);
					  }
					?>
                  </select></td>
                </tr>
				<?php } ?>
				<?php } ?>
				<?php if($TipoTasa!='') { ?>
				<?php if($TipoTasa==2) { ?>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Tasa Variable </div></td>
                  <td><input name="TasaV" type="text" class="texto_gris" id="Tasa32" size="10"></td>
                </tr>
				<?php } ?>
				<?php } ?>
				<?php if($TipoTasa!='') { ?>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Unidad:</div></td>
                  <td><select name="IdUnidad" class="texto_gris" id="IdUnidad">
                    <?php
					do {  
					?>
                    <option value="<?php echo $row_unidadesList['IdUnidad']?>"><?php echo $row_unidadesList['Nombre']?></option>
                    <?php
					} while ($row_unidadesList = mysql_fetch_assoc($unidadesList));
					  $rows = mysql_num_rows($unidadesList);
					  if($rows > 0) {
						  mysql_data_seek($unidadesList, 0);
						  $row_unidadesList = mysql_fetch_assoc($unidadesList);
					  }
					?>
                  </select></td>
                </tr>
				<?php } ?>
				<?php if($TipoTasa!='') { ?>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Servicio:</div></td>
                  <td><select name="IdServicio" class="texto_gris" id="IdServicio">
                    <?php
					do {  
					?>
                    <option value="<?php echo $row_serviciosList['IdServicio']?>"><?php echo $row_serviciosList['Servicio']?></option>
                    <?php
					} while ($row_serviciosList = mysql_fetch_assoc($serviciosList));
					  $rows = mysql_num_rows($serviciosList);
					  if($rows > 0) {
						  mysql_data_seek($serviciosList, 0);
						  $row_serviciosList = mysql_fetch_assoc($serviciosList);
					  }
					?>
                  </select></td>
                </tr>
				<?php } ?>
                <?php  if($TipoTasa!='') { ?>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">L&iacute;der de Proyecto:</div></td>
				  <td><select name="IdLider" class="texto_gris" id="IdLider">
				    <?php
					do {  
					?>
				    <option value="<?php echo $row_Lider['IdUsuario']?>"<?php if (!(strcmp($row_Lider['IdUsuario'], $row_quienEs['IdUsuario']))) {echo "SELECTED";} ?>><?php echo $row_Lider['Nombre']?></option>
				    <?php
					} while ($row_Lider = mysql_fetch_assoc($Lider));
					  $rows = mysql_num_rows($Lider);
					  if($rows > 0) {
						  mysql_data_seek($Lider, 0);
						  $row_Lider = mysql_fetch_assoc($Lider);
					  }
					?>
				    </select></td>
				  </tr>
				  <?php } ?>
                  <?php 
				    $diasArray = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
				  	$mesesArray = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');				  	
				  ?>
                  <tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Fecha de Creaci&oacute;n: </div></td>
				  <td>
                    <select name="Dia" class="texto_gris" id="Dia" disabled="disabled">
                  	<?php foreach($diasArray as $diaArray){?>
					<option <?php if($diaArray==date('d')){echo 'selected';}?> value="<?php echo $diaArray;?>"><?php echo $diaArray;?></option>
					<?php }?>
				    </select>
				    <span class="texto_gris">/ </span>
                    <select name="Mes" class="texto_gris" id="Mes" disabled="disabled">
                  	<?php foreach($mesesArray as $mesArray){?>
					<option <?php if($mesArray==date('m')){echo 'selected';}?> value="<?php echo $mesArray;?>"><?php echo $mesArray;?></option>
					<?php }?>
				    </select> 
				    <span class="texto_gris">/ </span>
				    <select name="Anno" class="texto_gris" id="Anno" disabled="disabled">
                      <?php for($f = 0;$f < 2;$f++){?>
				      <option value="<?php echo date("Y")-$f; ?>"><?php echo date("Y")-$f; ?></option>
                      <?php } ?>
			        </select></td>
				  </tr>
			<?php  if($TipoTasa!='') { ?>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Fecha de Cierre: </div></td>
				  <td><select name="MesEjecucion" class="texto_gris" id="MesEjecucion">
				    <option value="<?php echo date("m"); ?>"><?php echo date("m"); ?></option>
					<option value="01">01</option>
				    <option value="02">02</option>
				    <option value="03">03</option>
				    <option value="04">04</option>
				    <option value="05">05</option>
				    <option value="06">06</option>
				    <option value="07">07</option>
				    <option value="08">08</option>
				    <option value="09">09</option>
				    <option value="10">10</option>
				    <option value="11">11</option>
				    <option value="12">12</option>
				    </select> 
				    <span class="texto_gris">/ </span>
				    <select name="AnnoEjecucion" class="texto_gris" id="AnnoEjecucion">
				      <?php for($f = -1;$f < 6;$f++){?>
				      <option value="<?=date("Y")-$f; ?>"><?=date("Y")-$f; ?></option>
                      <?php } ?>
			        </select></td>
				  </tr>
				<?php  } ?> 
				<?php  if($TipoTasa!='') { ?>    
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Estimadas Totales:</div></td>
                  <td bgcolor="#EAF1FB"><input name="HorasEstimadas" type="text" class="texto_gris" id="TasaV" readonly size="10"></td>
                </tr>
				<?php  } ?>
                <?php  if($TipoTasa!='') { ?> 
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Socio:</div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasSocio" type="text" class="texto_gris" id="HorasEstimadas" value="0" size="10"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Gerente: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasGerente" type="text" class="texto_gris" id="HorasEstimadas2" value="0" size="10"></td>
				</tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Encargado: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasEncargado" type="text" class="texto_gris" id="HorasEstimadas3" value="0" size="10"></td>
				</tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Asistente: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasAsistente" type="text" class="texto_gris" id="HorasEstimadas4" value="0" size="10"></td>
				</tr>
                                <tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Lider: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasLider" type="text" class="texto_gris" id="HorasEstimadas5" value="0" size="10"></td>
				</tr>
				<tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left"></div></td>
                  <td bgcolor="#EAF1FB">
				  	<input type="submit" class="texto_btgris" value="Insertar Tarea">
                    <input name="CodificacionComp" type="hidden" id="CodificacionComp">
                    <input name="IdSupervisor" type="hidden" id="IdSupervisor" value="<?php echo $row_supervisor['IdUsuario']; ?>">
                    <input name="FEspanol" type="hidden" id="FEspanol">
                    <input name="FIngles" type="hidden" id="FIngles">
                    <input name="Tasa" type="hidden" id="Tasa">
                    <input name="IdGrupo2" type="hidden" id="IdGrupo2" value="<?php echo $IdGrupo; ?>">
                    <input name="IdEmpresa2" type="hidden" id="IdEmpresa2" value="<?php echo $IdEmpresa; ?>"></td>
                </tr>
				<?php  } ?>
              </table>
              
              <input type="hidden" name="MM_insert" value="form1">      </form>
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
<script type="text/javascript">
var mensaje = "<?php echo $mensaje; ?>";
if(mensaje){ alert("<?php echo $mensaje; ?>");}
var redireccion = "<?php echo $redireccion; ?>";
if(redireccion){location.href = "<?php echo $redireccion; ?>";}
</script>
</body>
</html>
<?php
@mysql_free_result($quienEs);
@mysql_free_result($supervisor);
@mysql_free_result($grupo);
@mysql_free_result($GrupoList);
@mysql_free_result($empresaList);
@mysql_free_result($unidadesList);
@mysql_free_result($serviciosList);
@mysql_free_result($tasaList);
@mysql_free_result($Lider);
@mysql_free_result($TasaFijaFinal);
mysql_close($marambio);
?>
