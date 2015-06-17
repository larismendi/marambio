<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
}

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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
	mysql_select_db($database_marambio, $marambio);
	$ccc = 0;$ccf = 0;
	if($_POST['HorasEstimadas'] > 0 || $_POST['HorasEstimadas2'] > 0 || $_POST['HorasEstimadas3'] > 0 || $_POST['HorasEstimadas4'] > 0 || $_POST['HorasEstimadas5'] > 0){
		if($c){
			while (list ($key,$val) = @each ($c)) {
				$CodificacionCompleta2000=$IdGrupo2 . "." . $val . "." . $IdUnidad . "." . $IdServicio . "." . $_POST['MesEjecucion'] . "." . $_POST['AnnoEjecucion'];
				$query_tarFinal = "SELECT IdTarea FROM tareas WHERE CodificacionComp = '$CodificacionCompleta2000'";
				$tarFinal = mysql_query($query_tarFinal, $marambio) or die(mysql_error());
				$row_tarFinal = mysql_fetch_assoc($tarFinal);
						  
				if(!$row_tarFinal['IdTarea']){
					$insertSQL = sprintf("INSERT INTO tareas (IdGrupo, IdEmpresa, IdUnidad, IdServicio, IdLider, Dia, Mes, Anno, AnnoMes, FEspanol, FIngles, CodificacionComp, IdSupervisor, Tasa, HorasEstimadas, HorasSocio, HorasGerente, HorasEncargado, HorasAsistente, MesEjecucion, AnnoEjecucion, HorasLider) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
									   GetSQLValueString($_POST['IdGrupo2'], "int"),
									   GetSQLValueString($val, "int"),
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
				
				  
					$Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());
					if($Result1){
						$ccc ++;
					}else{
						$ccf ++;
					}
				}else{
					$ccf ++;
				}
			}
			$ccf = $ccc+$ccf;
			$mensaje = "Tarea creada con exito $ccc de $ccf.";
			if($ccc == 0){
				$mensaje = "No se pudo crear las tareas para el grupo, intente nuevamente.";
			}else{
				$redireccion = "tareas.php";
				if (isset($_SERVER['QUERY_STRING'])) {
				  $redireccion .= (strpos($insertGoTo, '?')) ? "&" : "?";
				  $redireccion .= $_SERVER['QUERY_STRING'];
				}
			}	
		}else{
			if($insertar == "Insertar Tarea"){
				$mensaje = "Debe chequear al menos una Empresa";
			}
		}
	}else{
		$mensaje = "Debe al menos ingresar una hora para el calculo de las horas estimadas.";
	}
}
?>
<?php
extract($_REQUEST);
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

$query_grupo = "SELECT IdGrupo, Nombre FROM grupos ORDER BY Nombre ASC";
$grupo = mysql_query($query_grupo, $marambio) or die(mysql_error());
$row_grupo = mysql_fetch_assoc($grupo);

$colname_GrupoList = "1";
if (isset($_POST['IdGrupo'])) {
  $colname_GrupoList = (get_magic_quotes_gpc()) ? $_POST['IdGrupo'] : addslashes($_POST['IdGrupo']);
}
if (isset($_GET['IdGrupo'])) {
  $colname_GrupoList = (get_magic_quotes_gpc()) ? $_GET['IdGrupo'] : addslashes($_GET['IdGrupo']);
}
$query_GrupoList = sprintf("SELECT * FROM grupos WHERE IdGrupo = %s", $colname_GrupoList);
$GrupoList = mysql_query($query_GrupoList, $marambio) or die(mysql_error());
$row_GrupoList = mysql_fetch_assoc($GrupoList);

$query_unidadesList = "SELECT IdUnidad, Nombre FROM unidades ORDER BY Nombre ASC";
$unidadesList = mysql_query($query_unidadesList, $marambio) or die(mysql_error());
$row_unidadesList = mysql_fetch_assoc($unidadesList);

$query_serviciosList = "SELECT * FROM servicios ORDER BY Servicio ASC";
$serviciosList = mysql_query($query_serviciosList, $marambio) or die(mysql_error());
$row_serviciosList = mysql_fetch_assoc($serviciosList);

$query_tasaList = "SELECT * FROM tasas ORDER BY Nombre ASC";
$tasaList = mysql_query($query_tasaList, $marambio) or die(mysql_error());
$row_tasaList = mysql_fetch_assoc($tasaList);

$query_Lider = "SELECT IdUsuario, Nombre FROM usuarios ORDER BY Nombre ASC";
$Lider = mysql_query($query_Lider, $marambio) or die(mysql_error());
$row_Lider = mysql_fetch_assoc($Lider);
?>
<?php include("includes/head.php");?>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
-->
</style>
<script>
function validate(){
	var alerta = "";
	if(document.form1.TipoTasa.value == ""){
		alerta += " Tipo de Tasa \n";		
	}
	if(document.form1.TipoTasa.value == 1 && document.form1.TasaF.value == ""){
		alerta += " Tasa Fija \n";
	}else{
		if(document.form1.TipoTasa.value == 2 && document.form1.TasaV.value == ""){
			alerta += " Tasa Variable \n";
		}
	}
	if(document.form1.IdUnidad.value == ""){
		alerta += " Unidad\n";
	}
	if(document.form1.IdServicio.value == ""){
		alerta += " Servicio\n";
	}
	if(document.form1.IdLider.value == ""){
		alerta += " Lider de Proyecto\n";
	}
	if(document.form1.MesEjecucion.value == ""){
		alerta += " Mes de Ejecución\n";
	}
	if(document.form1.AnnoEjecucion.value == ""){
		alerta += " Año de Ejecución\n";
	}
	if(alerta == ""){
		return true;
	}else{
		alert("Debe ingresar información en los siguientes campos: "+alerta);
		return false;
	}		
}
</script>
<script language="javascript" type="text/javascript" src="autoComplete/jquery-1.2.1.pack.js"></script>
<script language="javascript" type="text/javascript">
jQuery(function(){
	jQuery('#HorasEstimadas,#HorasEstimadas2,#HorasEstimadas3,#HorasEstimadas4,#HorasEstimadas5').change(function(){
		var nn0 = Number(jQuery('#HorasEstimadas').val()) + Number(jQuery('#HorasEstimadas2').val()) + Number(jQuery('#HorasEstimadas3').val()) + Number(jQuery('#HorasEstimadas4').val()) + Number(jQuery('#HorasEstimadas5').val());
		jQuery('#TasaV').attr('value',nn0);
	});
});
</script>
            <form method="POST" name="form1" action="" onSubmit="return validate()">
              <table align="right">
                  <tr>
                      <td class="texto_gris"><strong>Empresas</strong></td>
                      <td class="texto_gris"><strong>Seleccione</strong></td>
                      <td width="50">&nbsp;</td>
                  </tr>
                  <?php
                      $con_empres = "SELECT CodEmp, Nombre FROM empresas WHERE CodGrupo = '".$_GET['IdGrupo']."'";
                      $e_empres = mysql_query($con_empres, $marambio) or die(mysql_error());
                      
                      while($f_empres = mysql_fetch_array($e_empres)){
                      
                  ?>
                  <tr>
                      <td class="texto_gris"><?php echo $f_empres['Nombre']; ?></td>
                      <td><input name="c[<?php echo $f_empres['CodEmp']; ?>]" type="checkbox" checked value="<?php echo $f_empres['CodEmp']; ?>"></td>
                      <td>&nbsp;</td>
                  </tr>
                  <?php
                      }
                  ?>
              </table>

                <p align="center" class="titulo">
				TAREAS</p>
            <p><a href="tareas.php" class="texto_btgris">&lt;&lt; Volver</a></p>
                    
              <table align="center">
                <tr valign="baseline">
                  <td width="144" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Grupo:</div></td>
                  <td width="275" class="texto_gris"><strong><?php echo $row_GrupoList['Nombre']; ?></strong></td>
                </tr>
                <?php if($TipoTasa==''){$TipoTasa=1;} ?>
				<tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Tipo Tasa:</div></td>
                  <td>
                  <select name="TipoTasa" class="texto_gris" id="TipoTasa" onChange="MM_jumpMenu('parent',this,0)">
                    <?php if($TipoTasa==1) { ?>
					<option value="1">Fija</option>
					<?php } elseif($TipoTasa==2) { ?>
					<option value="2">Variable</option>
					<?php } else { ?>
					<option value="0">Seleccione</option>
					<?php } ?>
                    <option value="agregarTareasGrupo.php?IdGrupo=<?php echo $IdGrupo; ?>&TipoTasa=1">Fija</option>
                    <option value="agregarTareasGrupo.php?IdGrupo=<?php echo $IdGrupo; ?>&TipoTasa=2">Variable</option>
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
				    <option value="<?php echo $row_Lider['IdUsuario']?>" <?php if (!(strcmp($row_Lider['IdUsuario'], $row_quienEs['IdUsuario']))) {echo "SELECTED";} ?>><?php echo $row_Lider['Nombre']?></option>
				    <?php
						} while ($row_Lider = mysql_fetch_assoc($Lider));
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
				      <option value="<?=date("Y")-$f;?>"><?=date("Y")-$f; ?></option>
                      <?php } ?>
			        </select></td>
				  </tr>
				<?php  } ?> 
				<?php  if($TipoTasa!='') { ?>    
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Estimadas Totales:</div></td>
                  <td bgcolor="#EAF1FB"><input name="HorasEstimadas" type="text" class="texto_gris" value="<?php echo $_POST['HorasEstimadas']; ?>" readonly id="TasaV" size="10"></td>
                </tr>
				<?php  } ?>
                <?php  if($TipoTasa!='') { ?> 
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Socio:</div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasSocio" type="text" class="texto_gris" id="HorasEstimadas" size="10" value="<?=$_POST['HorasSocio']?$_POST['HorasSocio']:0; ?>"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Gerente: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasGerente" type="text" class="texto_gris" id="HorasEstimadas2" size="10" value="<?=$_POST['HorasGerente']?$_POST['HorasGerente']:0; ?>"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Encargado: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasEncargado" type="text" class="texto_gris" id="HorasEstimadas3" value="<?=$_POST['HorasEncargado']?$_POST['HorasEncargado']:0; ?>" size="10"></td>
				  </tr>
				<tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Asistente: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasAsistente" type="text" class="texto_gris" id="HorasEstimadas4" value="<?=$_POST['HorasAsistente']?$_POST['HorasAsistente']:0; ?>" size="10"></td>
				  </tr>
                                <tr valign="baseline">
				  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left">Horas Lider: </div></td>
				  <td bgcolor="#EAF1FB"><input name="HorasLider" type="text" class="texto_gris" id="HorasEstimadas5" value="<?=$_POST['HorasLider']?$_POST['HorasLider']:0; ?>" size="10"></td>
				  </tr>
				<tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris"><div align="left"></div></td>
                  <td bgcolor="#EAF1FB">
				  	<input type="submit" class="texto_btgris" name="insertar" value="Insertar Tarea">
                    <input name="CodificacionComp" type="hidden" id="CodificacionComp">
                    <input name="IdSupervisor" type="hidden" id="IdSupervisor" value="<?php echo $row_supervisor['IdUsuario']; ?>">
                    <input name="FEspanol" type="hidden" id="FEspanol">
                    <input name="FIngles" type="hidden" id="FIngles">
                    <input name="Tasa" type="hidden" id="Tasa">
                    <input name="IdGrupo2" type="hidden" id="IdGrupo2" value="<?php echo $IdGrupo; ?>"></td>
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
