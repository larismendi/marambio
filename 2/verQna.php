<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
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
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

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

mysql_select_db($database_marambio, $marambio);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	if($_POST['D01'] || $_POST['D02'] || $_POST['D03'] || $_POST['D04'] || $_POST['D05'] || $_POST['D06'] || $_POST['D07'] || $_POST['D08'] || $_POST['D09'] || $_POST['D10'] || $_POST['D11'] || $_POST['D12'] || $_POST['D13'] || $_POST['D14'] || $_POST['D15'] || $_POST['D16'] || $_POST['D17'] || $_POST['D18'] || $_POST['D19'] || $_POST['D20'] || $_POST['D21'] || $_POST['D22'] || $_POST['D23'] || $_POST['D24'] || $_POST['D25'] || $_POST['D26'] || $_POST['D27'] || $_POST['D28'] || $_POST['D29'] || $_POST['D30'] || $_POST['D31']){
		$updateSQL = sprintf("UPDATE quincenasub SET D01=%s, D02=%s, D03=%s, D04=%s, D05=%s, D06=%s, D07=%s, D08=%s, D09=%s, D10=%s, D11=%s, D12=%s, D13=%s, D14=%s, D15=%s, D16=%s, D17=%s, D18=%s, D19=%s, D20=%s, D21=%s, D22=%s, D23=%s, D24=%s, D25=%s, D26=%s, D27=%s, D28=%s, D29=%s, D30=%s, D31=%s, token='0' WHERE IdQnaSub=%s",
		GetSQLValueString(str_replace(",", ".", $_POST['D01']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D02']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D03']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D04']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D05']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D06']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D07']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D08']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D09']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D10']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D11']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D12']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D13']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D14']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D15']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D16']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D17']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D18']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D19']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D20']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D21']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D22']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D23']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D24']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D25']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D26']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D27']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D28']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D29']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D30']), "double"),
		GetSQLValueString(str_replace(",", ".", $_POST['D31']), "double"),
		GetSQLValueString($_POST['IdQnaSub'], "int"));
	
		$Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
	
		$todas=0;
	
		$updateGoTo = "verQna.php?IdQna=" . $IdQna . "&enviado=1";
		if (isset($_SERVER['QUERY_STRING'])) {
			$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			$updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}else{
	
		$sss = "SELECT * FROM quincenasub WHERE IdQnaSub='".$_POST['IdQnaSub']."' ";
		$ejeRR = mysql_query($sss, $marambio) or die(mysql_error());
		$ffRR = mysql_fetch_array($ejeRR);
	
		$sqw = "DELETE FROM quincenasub WHERE IdQnaSub='".$_POST['IdQnaSub']."' ";
		$Result1 = mysql_query($sqw, $marambio) or die(mysql_error());
		
		$sss = "SELECT id_tarea_registrada FROM tareas_registradas WHERE id_qna='".$ffRR['IdQna']."' AND id_empleado = ".$row_supervisor['IdUsuario']." AND tarea = '".$ffRR['CodificacionComp']."'";
		$ssEE = mysql_query($sss, $marambio) or die(mysql_error());
		$ssRR = mysql_fetch_array($ssEE);
		if($ssRR['id_tarea_registrada']){
			$sqw = "DELETE FROM tareas_registradas WHERE id_qna='".$ffRR['IdQna']."' AND id_empleado = ".$row_supervisor['IdUsuario']." AND tarea = '".$ffRR['CodificacionComp']."' ";
			$Result1 = mysql_query($sqw, $marambio) or die(mysql_error());
		}
		$todas=0;
		if($Result1){
			$mensaje = "Se elimino de forma satisfactoria la hora cargada";
		}else{
			$mensaje = "No se pudo eliminar la hora cargada";
		}
	}
}
if($todas==1) {
	if($enviado!=1) {
		$sii=1;
		header ("verQna.php?IdQna=" . $IdQna . "&todas=0");

	}
}
?>
<?php


$colname_Qna = "1";
if (isset($_GET['IdQna'])) {
	$colname_Qna = (get_magic_quotes_gpc()) ? $_GET['IdQna'] : addslashes($_GET['IdQna']);
}

$query_Qna = sprintf("SELECT * FROM quincenas WHERE IdQna = %s", $colname_Qna);
$Qna = mysql_query($query_Qna, $marambio) or die(mysql_error());
$row_Qna = mysql_fetch_assoc($Qna);
$totalRows_Qna = mysql_num_rows($Qna);
$NQda=$row_Qna['Quincena'];
$MesQna=$row_Qna['Mes'];
$AnnoQna=$row_Qna['Anno'];
$horlab=$row_Qna['horlab'];

// BUSCA LAS TAREAS A CLIENTES
$IdQnaXX=$row_Qna['IdQna'];
$query_QnaSub = "SELECT * FROM quincenasub WHERE IdUsuario = '$idQuienEs2000' AND TipoTarea='1' AND IdQna='$IdQna'";
$QnaSub = mysql_query($query_QnaSub, $marambio) or die(mysql_error());
$row_QnaSub = mysql_fetch_assoc($QnaSub);
$totalRows_QnaSub = mysql_num_rows($QnaSub);

//BUSCA LAS TAREAS ADMINISTRAVIVAS
$query_QnaSub2 = "SELECT * FROM quincenasub WHERE IdUsuario = '$idQuienEs2000' AND TipoTarea='2' AND IdQna='$IdQna'";
$QnaSub2 = mysql_query($query_QnaSub2, $marambio) or die(mysql_error());
$row_QnaSub2 = mysql_fetch_assoc($QnaSub2);
$totalRows_QnaSub2 = mysql_num_rows($QnaSub2);

//BUSQUEDA DEL GRUPO DE EMPRESA
$query_empresasList = "SELECT CodEmp, Nombre FROM empresas WHERE nombre LIKE '%$palabra%' ORDER BY Nombre ASC";
$empresasList = mysql_query($query_empresasList, $marambio) or die(mysql_error());
$row_empresasList = mysql_fetch_assoc($empresasList);
$totalRows_empresasList = mysql_num_rows($empresasList);
if ($totalRows_empresasList>0) {
	$band = 1; }
	else {
		$band = 0;
	}
	?>
	<?php
	function ultimoDia($mes,$ano){
		$ultimo_dia=28;
		while (checkdate($mes,$ultimo_dia + 1,$ano)){
			$ultimo_dia++;
		}
		return $ultimo_dia;
	}
	//calculo el ?ltimo dia del mes 
	$mesX=$row_Qna['Mes'];
	$annoX=$row_Qna['Anno'];

	$ultimo_dia = ultimoDia("$mesX","$annoX");

	?>
<?php include("includes/head.php"); ?>

<STYLE type=text/css>
A:hover {
	COLOR: #AFC4DF
}

BODY {
	SCROLLBAR-FACE-COLOR: #FFFFFF;
	SCROLLBAR-HIGHLIGHT-COLOR: #AFC4DF;
	SCROLLBAR-SHADOW-COLOR: #FCEA9A;
	SCROLLBAR-ARROW-COLOR: #AFC4DF;
	SCROLLBAR-BASE-COLOR: #FCEA9A;
	scrollbar-3d-light-color: #AFC4DF;
	scrollbar-dark-shadow-color: #FFFFFF
}
</STYLE>
<script language="javascript" type="text/javascript">
function valida(form)
{
	band = false;
	band1 = 0;
	
	for (i =0 ; form.elements.length > i ; i++)
	{
		cadena = form.elements[i].name.substring(0,1);
		if(cadena == 'D')
		{
			band1++;
			if(form.elements[i].value != "")
				band = true;
		}
	}
	if(!band && band1 > 0)
	{
		alert('No puede dejar todos los campos vacios. Revise');
		return false;
	}
	else
		return true;
}
</script>
<script>
function vali(){
	if(document.form2.IdEmpresa.value){
		return true;
	}else{
		alert("Debe indicar el nombre de la empresa y seleccionar una empresa de la lista de sugerencias");
	}
	return false
}
</script>
<script type="text/javascript" src="autoComplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$('#autoSuggestionsList').html("");
			$.post("autoComplete/con_empresaId.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				} else {
					$('#suggestions').hide();
				}
			});
		}
	} // lookup
	
	function fill(thisValue,thisNombre) {
		$('#inputString').val(thisNombre);
		$('#IdEmpresa').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
				<table width="100%" border="1" cellpadding="0" cellspacing="0"
					bordercolor="#E5E5E5">
					<tr>
						<td width="33%" height="49" valign="top"><span
							class="texto_btgris">Usuario:<?php echo $row_supervisor['Nombre']; ?><br>
							<?php  if ($row_Qna['Quincena'] == '1') {
								echo  $row_Qna['Quincena'].ra;
							}

							if ($row_Qna['Quincena'] == '2')  {
								echo    $row_Qna['Quincena'].da;
							}
							?>. Quincena de <?php
							switch($row_Qna['Mes']){
								case '1':
									echo "Enero";
									break;
								case '2':
									echo "Febrero";
									break;
								case '3':
									echo "Marzo";
									break;
								case '4':
									echo "Abril";
									break;
								case '5':
									echo "Mayo";
									break;
								case '6':
									echo "Junio";
									break;
								case '7':
									echo "Julio";
									break;
								case '8':
									echo "Agosto";
									break;
								case '9':
									echo "Septiembre";
									break;
								case '10':
									echo "Octubre";
									break;
								case '11':
									echo "Noviembre";
									break;
								case '12':
									echo "Diciembre";
									break; }?> de <?php echo $row_Qna['Anno']; ?></span><span
							class="textoazul"><br>
						</span></td>
						<td width="28%" valign="top">
						<div align="center" class="texto_btgris"><a
							href="hojadeTiempo.php" class="texto_btgris"><strong>&lt;&lt;
						Volver</strong></a></div>
						</td>
						<td width="39%" valign="top" bgcolor="#FFFFFF">
						<div align="center">
						<table width="100%" border="1" cellpadding="0" cellspacing="0"
							bordercolor="#F0F0F0">
							<tr>
								<td width="63%" valign="top">
								<form autocomplete="off" name="form2" method="get" action="cargarHoras2.php" onSubmit="return vali()">
								  <span
									class="texto_btgris">Busqueda de Cliente para cargar horas:</span> <br>
									<input name="palabra" type="text" class="texto_gris" size="30" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"> 
                                    <div class="suggestionsBox" id="suggestions" style="display: none;">
                                    	<img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                          <div class="suggestionList" id="autoSuggestionsList">
                                              &nbsp;
                                          </div>
                                    </div>
                                    <input name="IdQna" type="hidden" id="IdQna" value="<?php echo $IdQna; ?>">
                                    <input name="Qna" type="hidden" id="Qna" value="<?php echo $row_Qna['Quincena']; ?>"> 
	                                <input name="UDia" type="hidden" id="UDia" value="<?php echo $ultimo_dia; ?>">
                                	<input name="IdEmpresa" type="hidden" id="IdEmpresa" value="">
	                                <input name="Submit2" type="submit" class="texto_gris" value="&gt;&gt;">
                                </form>
								</td>
								<td width="37%" valign="top">
								<div align="center"><a
									href="cargarHoras.php?IdQna=<?php echo $row_Qna['IdQna']; ?>&Qna=<?php echo $row_Qna['Quincena']; ?>&UDia=<?php echo $ultimo_dia; ?>"
									class="texto_btgris">Cargar <br>
								Administrativas &gt;&gt; </a></div>
								</td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>

				<p class="titulo">HORAS CLIENTE</p>
				<?php //TABLA DE TAREAS CLIENTES ?>
				<?php if($totalRows_QnaSub>=1) { ?>
				<table width="100%" border="1">
					<tr class="textoazul">
                    	<td width="10" bgcolor="#E5E5E5" class="texto_btgris">
							<div align="center">Tarea</div>
						</td>
						<td width="10" bgcolor="#E5E5E5" class="texto_btgris">
							<div align="center">Servicio</div>
						</td>
						<td width="90" bgcolor="#E5E5E5" class="texto_btgris">
							<div align="center">Empresa</div>
						</td>
						<td width="10" bgcolor="#E5E5E5" class="texto_btgris">
							<div align="center">Total<br>Horas</div>
						</td>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="01";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);


						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>

						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">01</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="02";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);


						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">02</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="03";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">03</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="04";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">04</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="05";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">05</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="06";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">06</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="07";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">07</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="08";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">08</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="09";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">09</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="10";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">10</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="11";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">11</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="12";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">12</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="13";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">13</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="14";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">14</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="15";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">15</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="16";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">16</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="17";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">17</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="18";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">18</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="19";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">19</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="20";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						//$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>" class="texto_btgris">
						<div align="center">20</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="21";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">21</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="22";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">22</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="23";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">23</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="24";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">24</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="25";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">25</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="26";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">26</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="27";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">27</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="28";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">28</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="29";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<?php if($ultimo_dia>=29) { ?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">29</div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="30";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {

							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<?php if($ultimo_dia>=30) { ?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">30</div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="31";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<?php if($ultimo_dia>=31) { ?>
						<td width="3%" bgcolor="<?php echo $ColorCelda; ?>"
							class="texto_btgris">
						<div align="center">31</div>
						</td>
						<?php } ?>
						<?php } ?>
						<td width="6%" bgcolor="#FFFFFF" class="texto_btgris">
						<div align="center"></div>
						</td>
					</tr>
					<?php
					$totalD01='';
					$totalD02='';
					$totalD03='';
					$totalD04='';
					$totalD05='';
					$totalD06='';
					$totalD07='';
					$totalD08='';
					$totalD09='';
					$totalD10='';
					$totalD11='';
					$totalD12='';
					$totalD13='';
					$totalD14='';
					$totalD15='';
					$totalD16='';
					$totalD17='';
					$totalD18='';
					$totalD19='';
					$totalD20='';
					$totalD21='';
					$totalD22='';
					$totalD23='';
					$totalD24='';
					$totalD25='';
					$totalD26='';
					$totalD27='';
					$totalD28='';
					$totalD29='';
					$totalD30='';
					$totalD31='';
					$totalHorasTotal='';
					?>
					<?php
					$xx = 4;
					do { ?>
					<?php
					$totalD01=$totalD01+$row_QnaSub['D01'];
					$totalD02=$totalD02+$row_QnaSub['D02'];
					$totalD03=$totalD03+$row_QnaSub['D03'];
					$totalD04=$totalD04+$row_QnaSub['D04'];
					$totalD05=$totalD05+$row_QnaSub['D05'];
					$totalD06=$totalD06+$row_QnaSub['D06'];
					$totalD07=$totalD07+$row_QnaSub['D07'];
					$totalD08=$totalD08+$row_QnaSub['D08'];
					$totalD09=$totalD09+$row_QnaSub['D09'];
					$totalD10=$totalD10+$row_QnaSub['D10'];
					$totalD11=$totalD11+$row_QnaSub['D11'];
					$totalD12=$totalD12+$row_QnaSub['D12'];
					$totalD13=$totalD13+$row_QnaSub['D13'];
					$totalD14=$totalD14+$row_QnaSub['D14'];
					$totalD15=$totalD15+$row_QnaSub['D15'];
					$totalD16=$totalD16+$row_QnaSub['D16'];
					$totalD17=$totalD17+$row_QnaSub['D17'];
					$totalD18=$totalD18+$row_QnaSub['D18'];
					$totalD19=$totalD19+$row_QnaSub['D19'];
					$totalD20=$totalD20+$row_QnaSub['D20'];
					$totalD21=$totalD21+$row_QnaSub['D21'];
					$totalD22=$totalD22+$row_QnaSub['D22'];
					$totalD23=$totalD23+$row_QnaSub['D23'];
					$totalD24=$totalD24+$row_QnaSub['D24'];
					$totalD25=$totalD25+$row_QnaSub['D25'];
					$totalD26=$totalD26+$row_QnaSub['D26'];
					$totalD27=$totalD27+$row_QnaSub['D27'];
					$totalD28=$totalD28+$row_QnaSub['D28'];
					$totalD29=$totalD29+$row_QnaSub['D29'];
					$totalD30=$totalD30+$row_QnaSub['D30'];
					$totalD31=$totalD31+$row_QnaSub['D31'];

					?>

					<?php $TotalHorasXX=$row_QnaSub['D01']+$row_QnaSub['D02']+$row_QnaSub['D03']+$row_QnaSub['D04']+$row_QnaSub['D05']+$row_QnaSub['D06']+$row_QnaSub['D07']+$row_QnaSub['D08']+$row_QnaSub['D09']+$row_QnaSub['D10']+$row_QnaSub['D11']+$row_QnaSub['D12']+$row_QnaSub['D13']+$row_QnaSub['D14']+$row_QnaSub['D15']+$row_QnaSub['D16']+$row_QnaSub['D17']+$row_QnaSub['D18']+$row_QnaSub['D19']+$row_QnaSub['D20']+$row_QnaSub['D21']+$row_QnaSub['D22']+$row_QnaSub['D23']+$row_QnaSub['D24']+$row_QnaSub['D25']+$row_QnaSub['D26']+$row_QnaSub['D27']+$row_QnaSub['D28']+$row_QnaSub['D29']+$row_QnaSub['D30']+$row_QnaSub['D31'];   ?>


					<?php if ( ($TotalHorasXX != '0' || $row_QnaSub['token']=='1' ) && ($band == '1') ) { 
							//if ( $band == '1' ) {
							$band = 1; $xx++; ?>

					<form name="form<?=$xx ?>" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return valida(this)">					
					
					<tr>
                    	<td class="texto_btgris Estilo1">
                        <?php 
						$IdTareaA=$row_QnaSub['CodificacionComp'];
						$query_tareaMostrar = "SELECT * FROM tareas WHERE IdTarea = '$IdTareaA'";
						$tareaMostrar = mysql_query($query_tareaMostrar, $marambio) or die(mysql_error());
						$row_tareaMostrar = mysql_fetch_assoc($tareaMostrar);
						
						echo $row_tareaMostrar['CodificacionComp']; ?>
                        </td>
						<td width="100" class="texto_gris">
						<div align="center" class="texto_btgris Estilo1" width="120px">
						<?php
																			
						$IdS = $row_tareaMostrar['IdServicio'];
						$query_mostrarServicio = "SELECT * FROM servicios WHERE IdServicio = '$IdS'";
						$mostrarServicio = mysql_query($query_mostrarServicio, $marambio) or die(mysql_error());
						$row_grupo = mysql_fetch_assoc($mostrarServicio);
						echo $row_grupo['Servicio'];   ?></div>
						</td>
						<td width="150" class="texto_gris">
						<div align="center" class="texto_btgris Estilo1"><?php $IdEmpresaXX=$row_tareaMostrar['IdEmpresa'];  
						$query_mostrarEmpresa = "SELECT * FROM empresas WHERE CodEmp = '$IdEmpresaXX'";
						$mostrarEmpresa = mysql_query($query_mostrarEmpresa, $marambio) or die(mysql_error());
						$row_mostrarEmpresa = mysql_fetch_assoc($mostrarEmpresa);
						echo $row_mostrarEmpresa['Nombre']; ?></div>
						</td>
						<td class="texto_btgris">
						<div align="center" class="texto_btgris Estilo1"><strong><?php  echo $TotalHorasXX; ?>
						</strong></div>
						</td>

						<?php $totalHorasTotal=$totalHorasTotal+$TotalHorasXX;?>

						<?php if($NQda==1) { ?>
						<td>
							<div align="center">
							<?php if($row_QnaSub['A01']==0) { ?> 
								<input name="D01" type="text" class="texto_gris" id="D01" value="<?php echo $row_QnaSub['D01']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
							<?php } else { ?>
								<input name="D01" type="text" class="texto_gris" id="D01" value="<?php echo $row_QnaSub['D01']; ?>" size="1" readonly="true">				
							<?php } ?>
							</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
							<div align="center">
							<?php if($row_QnaSub['A02']==0) { ?> 
								<input	name="D02" type="text" class="texto_gris" id="D02" value="<?php echo $row_QnaSub['D02']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
							<?php } else { ?>
								<input name="D02" type="text" class="texto_gris" id="D02" value="<?php echo $row_QnaSub['D02']; ?>" size="1" readonly="true">
							<?php } ?>
							</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center">
						<?php if($row_QnaSub['A03']==0) { ?> 
                        <input name="D03" type="text" class="texto_gris" id="D03" value="<?php echo $row_QnaSub['D03']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
						<?php } else { ?>
							<input name="D03" type="text" class="texto_gris" id="D03" value="<?php echo $row_QnaSub['D03']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center">
						<?php if($row_QnaSub['A04']==0) { ?> 
                        <input name="D04" type="text" class="texto_gris" id="D04" value="<?php echo $row_QnaSub['D04']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
						<?php } else { ?>
							<input name="D04" type="text" class="texto_gris" id="D04" value="<?php echo $row_QnaSub['D04']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center">
						<?php if($row_QnaSub['A05']==0) { ?> 
                        <input name="D05" type="text" class="texto_gris" id="D05" value="<?php echo $row_QnaSub['D05']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
						<?php } else { ?>
							<input name="D05" type="text" class="texto_gris" id="D05" value="<?php echo $row_QnaSub['D05']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center">
						<?php if($row_QnaSub['A06']==0) { ?> 
                        <input name="D06" type="text" class="texto_gris" id="D06" value="<?php echo $row_QnaSub['D06']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
						<?php } else { ?>
							<input name="D06" type="text" class="texto_gris" id="D06" value="<?php echo $row_QnaSub['D06']; ?>" size="1" readonly="true">
						<?php } ?>
						</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center">
						<?php if($row_QnaSub['A07']==0) { ?> 
                        <input name="D07" type="text" class="texto_gris" id="D07" value="<?php echo $row_QnaSub['D07']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
						<?php } else { ?>
							<input name="D07" type="text" class="texto_gris" id="D07" value="<?php echo $row_QnaSub['D07']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A08']==0) { ?> 
                        <input name="D08" type="text" class="texto_gris" id="D08" value="<?php echo $row_QnaSub['D08']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
                        <?php } else { ?>
							<input name="D08" type="text" class="texto_gris" id="D08" value="<?php echo $row_QnaSub['D08']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A09']==0) { ?> 
                        <input name="D09" type="text" class="texto_gris" id="D09" value="<?php echo $row_QnaSub['D09']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D09" type="text" class="texto_gris" id="D09" value="<?php echo $row_QnaSub['D09']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A10']==0) { ?> 
                        <input name="D10" type="text" class="texto_gris" id="D10" value="<?php echo $row_QnaSub['D10']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
                        <?php } else { ?>
							<input name="D10" type="text" class="texto_gris" id="D10" value="<?php echo $row_QnaSub['D10']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A11']==0) { ?> 
                        <input name="D11" type="text" class="texto_gris" id="D11" value="<?php echo $row_QnaSub['D11']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
                        <?php } else { ?>
							<input name="D11" type="text" class="texto_gris" id="D11" value="<?php echo $row_QnaSub['D11']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A12']==0) { ?> 
                        <input name="D12" type="text" class="texto_gris" id="D12" value="<?php echo $row_QnaSub['D12']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
                        <?php } else { ?>
							<input name="D12" type="text" class="texto_gris" id="D12" value="<?php echo $row_QnaSub['D12']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A13']==0) { ?> 
                        <input name="D13" type="text" class="texto_gris" id="D13" value="<?php echo $row_QnaSub['D13']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
                        <?php } else { ?>
							<input name="D13" type="text" class="texto_gris" id="D13" value="<?php echo $row_QnaSub['D13']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A14']==0) { ?> 
                        <input name="D14" type="text" class="texto_gris" id="D14" value="<?php echo $row_QnaSub['D14']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
                        <?php } else { ?>
							<input name="D14" type="text" class="texto_gris" id="D14" value="<?php echo $row_QnaSub['D14']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A15']==0) { ?> 
                        <input name="D15" type="text" class="texto_gris" id="D15" value="<?php echo $row_QnaSub['D15']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D15" type="text" class="texto_gris" id="D15" value="<?php echo $row_QnaSub['D15']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A16']==0) { ?> 
                        <input name="D16" type="text" class="texto_gris" id="D16" value="<?php echo $row_QnaSub['D16']; ?>" size="1" maxlength="3" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>>
							<?php } else { ?>
							<input name="D16" type="text" class="texto_gris" id="D16" value="<?php echo $row_QnaSub['D16']; ?>" size="1" readonly="true">
							<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A17']==0) { ?> 
                        <input name="D17" type="text" class="texto_gris" id="D17" value="<?php echo $row_QnaSub['D17']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D17" type="text" class="texto_gris" id="D17" value="<?php echo $row_QnaSub['D17']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A18']==0) { ?> 
                        <input name="D18" type="text" class="texto_gris" id="D18" value="<?php echo $row_QnaSub['D18']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
						<input name="D18" type="text" class="texto_gris" id="D18" value="<?php echo $row_QnaSub['D18']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A19']==0) { ?> 
                        <input name="D19" type="text" class="texto_gris" id="D19" value="<?php echo $row_QnaSub['D19']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
						<input name="D19" type="text" class="texto_gris" id="D19" value="<?php echo $row_QnaSub['D19']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A20']==0) { ?> 
                        <input name="D20" type="text" class="texto_gris" id="D20" value="<?php echo $row_QnaSub['D20']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
						<input name="D20" type="text" class="texto_gris" id="D20" value="<?php echo $row_QnaSub['D20']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A21']==0) { ?> 
                        <input name="D21" type="text" class="texto_gris" id="D21" value="<?php echo $row_QnaSub['D21']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D21" type="text" class="texto_gris" id="D21" value="<?php echo $row_QnaSub['D21']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A22']==0) { ?> 
                        <input name="D22" type="text" class="texto_gris" id="D22" value="<?php echo $row_QnaSub['D22']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D22" type="text" class="texto_gris" id="D22" value="<?php echo $row_QnaSub['D22']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A23']==0) { ?> 
                        <input name="D23" type="text" class="texto_gris" id="D23" value="<?php echo $row_QnaSub['D23']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
							<input name="D23" type="text" class="texto_gris" id="D23" value="<?php echo $row_QnaSub['D23']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A24']==0) { ?> 
                        <input name="D24" type="text" class="texto_gris" id="D24" value="<?php echo $row_QnaSub['D24']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D24" type="text" class="texto_gris" id="D24" value="<?php echo $row_QnaSub['D24']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A25']==0) { ?> 
                        <input name="D25" type="text" class="texto_gris" id="D25" value="<?php echo $row_QnaSub['D25']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D25" type="text" class="texto_gris" id="D25" value="<?php echo $row_QnaSub['D25']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A26']==0) { ?> 
                        <input name="D26" type="text" class="texto_gris" id="D26" value="<?php echo $row_QnaSub['D26']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D26" type="text" class="texto_gris" id="D26" value="<?php echo $row_QnaSub['D26']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A27']==0) { ?> 
                        <input name="D27" type="text" class="texto_gris" id="D27" value="<?php echo $row_QnaSub['D27']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D27" type="text" class="texto_gris" id="D27" value="<?php echo $row_QnaSub['D27']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A28']==0) { ?> 
                        <input name="D28" type="text" class="texto_gris" id="D28" value="<?php echo $row_QnaSub['D28']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D28" type="text" class="texto_gris" id="D28" value="<?php echo $row_QnaSub['D28']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A29']==0) { ?> 
                        <input name="D29" type="text" class="texto_gris" id="D29" value="<?php echo $row_QnaSub['D29']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D29" type="text" class="texto_gris" id="D29" value="<?php echo $row_QnaSub['D29']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A30']==0) { ?> 
                        <input name="D30" type="text" class="texto_gris" id="D30" value="<?php echo $row_QnaSub['D30']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D30" type="text" class="texto_gris" id="D30" value="<?php echo $row_QnaSub['D30']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub['A31']==0) { ?> 
                        <input name="D31" type="text" class="texto_gris" id="D31" value="<?php echo $row_QnaSub['D31']; ?>" size="1" <?php if($row_grupo['Servicio']==""){ echo "readonly='true'"; }?>> 
						<?php } else { ?>
							<input name="D31" type="text" class="texto_gris" id="D31" value="<?php echo $row_QnaSub['D31']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php } ?>

						<td>
						<div align="center">
							<input name="IdQnaSub" type="hidden" id="IdQnaSub" value="<?php echo $row_QnaSub['IdQnaSub']; ?>">
							<input name="enviado" type="hidden" id="enviado" value="1">
							<?php if($row_grupo['Servicio']){ ?><input name="Submit4" type="submit" class="texto_btgris" value="&gt;&gt;"><?php }?>
						</div>
						</td>
					</tr>
					<input type="hidden" name="MM_update" value="form1">
					</form>
					<?php } ?>



					<?php }  while($row_QnaSub = mysql_fetch_assoc($QnaSub) );?>


					<tr bgcolor="#EEEEEE">
						<td colspan="3">
						<div align="right" class="titulo"><strong>Total Cliente<span
							class="texto_btgris Estilo1"> <?php 
							$IdTareaA=$row_QnaSub['CodificacionComp'];
							$query_tareaMostrar = "SELECT * FROM tareas WHERE IdTarea = '$IdTareaA'";
							$tareaMostrar = mysql_query($query_tareaMostrar, $marambio) or die(mysql_error());
							$row_grupo = mysql_fetch_assoc($tareaMostrar);
							//$totalRows_Qna = mysql_num_rows($Qna);
							$grupo=$row_grupo['IdServicio'];
							$query_grupo = "SELECT Servicio FROM servicios WHERE IdServicio = '$grupo'";
							$nombreGrupo = mysql_query($query_grupo, $marambio) or die(mysql_error());
							$row_nombre = mysql_fetch_assoc($nombreGrupo);
							$servicio = $row_nombre['Servicio'];
							echo $servicio;

							//echo $row_tareaMostrar['CodificacionComp'];

							?> </span> </strong></div>
						</td>
						<td>
						<div align="center" class="texto_gris"><strong><?php 
						echo $totalHorasTotal; ?> </strong></div>
						</td>
						<?php if($NQda==1) { ?>
						<td bgcolor="#EEEEEE">
						<div align="center" class="texto_gris"><strong><?php echo $totalD01; ?></strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD02; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD03; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD04; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD05; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD06; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD07; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD08; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD09; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD10; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD11; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD12; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris">
						<div align="center"><strong><?php echo $totalD13; ?> </strong></div>
						</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD14; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD15; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD16; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD17; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD18; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD19; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD20; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD21; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD22; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD23; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD24; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD25; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD26; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD27; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD28; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD29; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD30; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD31; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<td>
						<div align="center" class="texto_btgris Estilo1"></div>
						</td>
					</tr>
				</table>
				<?php } ?> <?php //TABLA TAREAS CLIENTES FINAL ?>
				<p class="textoazul"></p>
				<hr>
				<p class="titulo">HORAS ADMINISTRATIVAS</p>
				<?php //TABLA ADMINISTRATIVA ?>
				<table width="100%" border="1">
					<tr bgcolor="#EEEEEE" class="texto_btgris">
						<td>
						<div align="left">Descripci&oacute;n</div>
						</td>
						<td width="10">
						<div align="center">Total<br>
						Horas</div>
						</td>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="01";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">01</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="02";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">02</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="03";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">03</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="04";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">04</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="05";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">05</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="06";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;
						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">06</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="07";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">07</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="08";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">08</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="09";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">09</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="10";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">10</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="11";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">11</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="12";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">12</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="13";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">13</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="14";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">14</div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php
						$DiaCelda="15";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">15</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="16";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">16</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="17";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">17</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="18";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">18</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="19";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">19</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="20";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">20</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="21";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">21</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="22";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">22</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="23";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">23</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="24";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">24</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="25";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">25</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="26";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">26</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="27";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">27</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="28";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">28</div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="29";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<?php if($ultimo_dia>=29) { ?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">29</div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="30";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<?php if($ultimo_dia>=30) { ?>
						<td width="2%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">30</div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php
						$DiaCelda="31";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
						?>
						<?php if($ultimo_dia>=31) { ?>
						<td width="3%" bgcolor="<?php echo $ColorCelda; ?>">
						<div align="center">31</div>
						</td>
						<?php } ?>
						<?php } ?>
						<td width="6%" bgcolor="#FFFFFF">
						<div align="center"></div>
						</td>
					</tr>
					<?php
					$totalD01X='';
					$totalD02X='';
					$totalD03X='';
					$totalD04X='';
					$totalD05X='';
					$totalD06X='';
					$totalD07X='';
					$totalD08X='';
					$totalD09X='';
					$totalD10X='';
					$totalD11X='';
					$totalD12X='';
					$totalD13X='';
					$totalD14X='';
					$totalD15X='';
					$totalD16X='';
					$totalD17X='';
					$totalD18X='';
					$totalD19X='';
					$totalD20X='';
					$totalD21X='';
					$totalD22X='';
					$totalD23X='';
					$totalD24X='';
					$totalD25X='';
					$totalD26X='';
					$totalD27X='';
					$totalD28X='';
					$totalD29X='';
					$totalD30X='';
					$totalD31X='';
					$totalHorasTotalX='';
					
					?>
					<?php 
					
					$yy = 100;
					do { ?>
					<?php
					$totalD01X=$totalD01X+$row_QnaSub2['D01'];
					$totalD02X=$totalD02X+$row_QnaSub2['D02'];
					$totalD03X=$totalD03X+$row_QnaSub2['D03'];
					$totalD04X=$totalD04X+$row_QnaSub2['D04'];
					$totalD05X=$totalD05X+$row_QnaSub2['D05'];
					$totalD06X=$totalD06X+$row_QnaSub2['D06'];
					$totalD07X=$totalD07X+$row_QnaSub2['D07'];
					$totalD08X=$totalD08X+$row_QnaSub2['D08'];
					$totalD09X=$totalD09X+$row_QnaSub2['D09'];
					$totalD10X=$totalD10X+$row_QnaSub2['D10'];
					$totalD11X=$totalD11X+$row_QnaSub2['D11'];
					$totalD12X=$totalD12X+$row_QnaSub2['D12'];
					$totalD13X=$totalD13X+$row_QnaSub2['D13'];
					$totalD14X=$totalD14X+$row_QnaSub2['D14'];
					$totalD15X=$totalD15X+$row_QnaSub2['D15'];
					$totalD16X=$totalD16X+$row_QnaSub2['D16'];
					$totalD17X=$totalD17X+$row_QnaSub2['D17'];
					$totalD18X=$totalD18X+$row_QnaSub2['D18'];
					$totalD19X=$totalD19X+$row_QnaSub2['D19'];
					$totalD20X=$totalD20X+$row_QnaSub2['D20'];
					$totalD21X=$totalD21X+$row_QnaSub2['D21'];
					$totalD22X=$totalD22X+$row_QnaSub2['D22'];
					$totalD23X=$totalD23X+$row_QnaSub2['D23'];
					$totalD24X=$totalD24X+$row_QnaSub2['D24'];
					$totalD25X=$totalD25X+$row_QnaSub2['D25'];
					$totalD26X=$totalD26X+$row_QnaSub2['D26'];
					$totalD27X=$totalD27X+$row_QnaSub2['D27'];
					$totalD28X=$totalD28X+$row_QnaSub2['D28'];
					$totalD29X=$totalD29X+$row_QnaSub2['D29'];
					$totalD30X=$totalD30X+$row_QnaSub2['D30'];
					$totalD31X=$totalD31X+$row_QnaSub2['D31'];
								
					?>
					<form name="form<?=$yy?>" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return valida(this)">
					<tr>
						<td class="texto_gris">
						<div align="center" class="texto_btgris Estilo1">
						<div align="left"><?php 
						$IdAdministrativasXX=$row_QnaSub2['CodificacionComp'];
						
						$query_mostrarAdm = "SELECT * FROM administrativas WHERE IdAdministrativas = '$IdAdministrativasXX'";
						$mostrarAdm = mysql_query($query_mostrarAdm, $marambio) or die(mysql_error());
						$row_mostrarAdm = mysql_fetch_assoc($mostrarAdm);
						echo $row_mostrarAdm['Nombre'];
						?></div>
						</div>
						</td>
						<td class="texto_gris">
						<div align="center" class="texto_btgris Estilo1"><strong> <?php
						$TotalHorasXX=$row_QnaSub2['D01']+$row_QnaSub2['D02']+$row_QnaSub2['D03']+$row_QnaSub2['D04']+$row_QnaSub2['D05']+$row_QnaSub2['D06']+$row_QnaSub2['D07']+$row_QnaSub2['D08']+$row_QnaSub2['D09']+$row_QnaSub2['D10']+$row_QnaSub2['D11']+$row_QnaSub2['D12']+$row_QnaSub2['D13']+$row_QnaSub2['D14']+$row_QnaSub2['D15']+$row_QnaSub2['D16']+$row_QnaSub2['D17']+$row_QnaSub2['D18']+$row_QnaSub2['D19']+$row_QnaSub2['D20']+$row_QnaSub2['D21']+$row_QnaSub2['D22']+$row_QnaSub2['D23']+$row_QnaSub2['D24']+$row_QnaSub2['D25']+$row_QnaSub2['D26']+$row_QnaSub2['D27']+$row_QnaSub2['D28']+$row_QnaSub2['D29']+$row_QnaSub2['D30']+$row_QnaSub2['D31'];
						echo $TotalHorasXX;
						$totalHorasTotal2=$totalHorasTotal2+$TotalHorasXX;
						?> </strong></div>
						</td>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center">
						<?php if($row_QnaSub2['A01']==0) { ?> 
							<input name="D01" type="text" class="texto_gris" id="D01" value="<?php echo $row_QnaSub2['D01']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > 
						<?php } else { ?>
							<input name="D01" type="text" class="texto_gris" id="D01" value="<?php echo $row_QnaSub2['D01']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A02']==0) { ?> 
                        <input name="D02" type="text" class="texto_gris" id="D02" value="<?php echo $row_QnaSub2['D02']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D02" type="text" class="texto_gris" id="D02" value="<?php echo $row_QnaSub2['D02']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A03']==0) { ?> 
                        <input name="D03" type="text" class="texto_gris" id="D03" value="<?php echo $row_QnaSub2['D03']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D03" type="text" class="texto_gris" id="D03" value="<?php echo $row_QnaSub2['D03']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A04']==0) { ?> 
                        <input name="D04" type="text" class="texto_gris" id="D04" value="<?php echo $row_QnaSub2['D04']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D04" type="text" class="texto_gris" id="D04" value="<?php echo $row_QnaSub2['D04']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A05']==0) { ?> 
                        <input name="D05" type="text" class="texto_gris" id="D05" value="<?php echo $row_QnaSub2['D05']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D05" type="text" class="texto_gris" id="D05" value="<?php echo $row_QnaSub2['D05']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A06']==0) { ?> 
                        <input name="D06" type="text" class="texto_gris" id="D06" value="<?php echo $row_QnaSub2['D06']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D06" type="text" class="texto_gris" id="D06" value="<?php echo $row_QnaSub2['D06']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A07']==0) { ?> 
                        <input name="D07" type="text" class="texto_gris" id="D07" value="<?php echo $row_QnaSub2['D07']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D07" type="text" class="texto_gris" id="D07" value="<?php echo $row_QnaSub2['D07']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A08']==0) { ?> 
                        <input name="D08" type="text" class="texto_gris" id="D08" value="<?php echo $row_QnaSub2['D08']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D08" type="text" class="texto_gris" id="D08" value="<?php echo $row_QnaSub2['D08']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A09']==0) { ?> 
                        <input name="D09" type="text" class="texto_gris" id="D09" value="<?php echo $row_QnaSub2['D09']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D09" type="text" class="texto_gris" id="D09" value="<?php echo $row_QnaSub2['D09']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A10']==0) { ?> 
                        <input name="D10" type="text" class="texto_gris" id="D10" value="<?php echo $row_QnaSub2['D10']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D10" type="text" class="texto_gris" id="D10" value="<?php echo $row_QnaSub2['D10']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A11']==0) { ?> 
                        <input name="D11" type="text" class="texto_gris" id="D11" value="<?php echo $row_QnaSub2['D11']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D11" type="text" class="texto_gris" id="D11" value="<?php echo $row_QnaSub2['D11']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A12']==0) { ?> 
                        <input name="D12" type="text" class="texto_gris" id="D12" value="<?php echo $row_QnaSub2['D12']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D12" type="text" class="texto_gris" id="D12" value="<?php echo $row_QnaSub2['D12']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A13']==0) { ?> 
                        <input name="D13" type="text" class="texto_gris" id="D13" value="<?php echo $row_QnaSub2['D13']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D13" type="text" class="texto_gris" id="D13" value="<?php echo $row_QnaSub2['D13']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A14']==0) { ?> 
                        <input name="D14" type="text" class="texto_gris" id="D14" value="<?php echo $row_QnaSub2['D14']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?> > <?php } else { ?>
						<input name="D14" type="text" class="texto_gris" id="D14" value="<?php echo $row_QnaSub2['D14']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A15']==0) { ?> 
                        <input name="D15" type="text" class="texto_gris" id="D15" value="<?php echo $row_QnaSub2['D15']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D15" type="text" class="texto_gris" id="D15" value="<?php echo $row_QnaSub2['D15']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A16']==0) { ?> 
                        <input name="D16" type="text" class="texto_gris" id="D16" value="<?php echo $row_QnaSub2['D16']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D16" type="text" class="texto_gris" id="D16" value="<?php echo $row_QnaSub2['D16']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A17']==0) { ?> 
                        <input name="D17" type="text" class="texto_gris" id="D17" value="<?php echo $row_QnaSub2['D17']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D17" type="text" class="texto_gris" id="D17" value="<?php echo $row_QnaSub2['D17']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A18']==0) { ?> 
                        <input name="D18" type="text" class="texto_gris" id="D18" value="<?php echo $row_QnaSub2['D18']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D18" type="text" class="texto_gris" id="D18" value="<?php echo $row_QnaSub2['D18']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A19']==0) { ?> 
                        <input name="D19" type="text" class="texto_gris" id="D19" value="<?php echo $row_QnaSub2['D19']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D19" type="text" class="texto_gris" id="D19" value="<?php echo $row_QnaSub2['D19']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A20']==0) { ?> 
                        <input name="D20" type="text" class="texto_gris" id="D20" value="<?php echo $row_QnaSub2['D20']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D20" type="text" class="texto_gris" id="D20" value="<?php echo $row_QnaSub2['D20']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A21']==0) { ?> 
                        <input name="D21" type="text" class="texto_gris" id="D21" value="<?php echo $row_QnaSub2['D21']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D21" type="text" class="texto_gris" id="D21" value="<?php echo $row_QnaSub2['D21']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A22']==0) { ?> 
                        <input name="D22" type="text" class="texto_gris" id="D22" value="<?php echo $row_QnaSub2['D22']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D22" type="text" class="texto_gris" id="D22" value="<?php echo $row_QnaSub2['D22']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A23']==0) { ?> 
                        <input name="D23" type="text" class="texto_gris" id="D23" value="<?php echo $row_QnaSub2['D23']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D23" type="text" class="texto_gris" id="D23" value="<?php echo $row_QnaSub2['D23']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A24']==0) { ?> 
                        <input name="D24" type="text" class="texto_gris" id="D24" value="<?php echo $row_QnaSub2['D24']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D24" type="text" class="texto_gris" id="D24" value="<?php echo $row_QnaSub2['D24']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A25']==0) { ?> 
                        <input name="D25" type="text" class="texto_gris" id="D25" value="<?php echo $row_QnaSub2['D25']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D25" type="text" class="texto_gris" id="D25" value="<?php echo $row_QnaSub2['D25']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A26']==0) { ?> 
                        <input name="D26" type="text" class="texto_gris" id="D26" value="<?php echo $row_QnaSub2['D26']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D26" type="text" class="texto_gris" id="D26" value="<?php echo $row_QnaSub2['D26']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A27']==0) { ?> 
                        <input name="D27" type="text" class="texto_gris" id="D27" value="<?php echo $row_QnaSub2['D27']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D27" type="text" class="texto_gris" id="D27" value="<?php echo $row_QnaSub2['D27']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A28']==0) { ?> 
                        <input name="D28" type="text" class="texto_gris" id="D28" value="<?php echo $row_QnaSub2['D28']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D28" type="text" class="texto_gris" id="D28" value="<?php echo $row_QnaSub2['D28']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A29']==0) { ?> 
                        <input name="D29" type="text" class="texto_gris" id="D29" value="<?php echo $row_QnaSub2['D29']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D29" type="text" class="texto_gris" id="D29" value="<?php echo $row_QnaSub2['D29']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A20']==0) { ?> 
                        <input name="D30" type="text" class="texto_gris" id="D30" value="<?php echo $row_QnaSub2['D30']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D30" type="text" class="texto_gris" id="D30" value="<?php echo $row_QnaSub2['D30']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center"><?php if($row_QnaSub2['A31']==0) { ?> 
                        <input name="D31" type="text" class="texto_gris" id="D31" value="<?php echo $row_QnaSub2['D31']; ?>" size="1" <?php if($row_mostrarAdm['Nombre']==""){ echo "readonly='true'"; }?>> <?php } else { ?>
						<input name="D31" type="text" class="texto_gris" id="D31" value="<?php echo $row_QnaSub2['D31']; ?>" size="1" readonly="true">
						<?php } ?></div>
						</td>
						<?php } ?>
						<?php } ?>
						<td>
						<div align="center">
							<input name="enviado" type="hidden" id="enviado" value="1">
							<input name="IdQnaSub" type="hidden" id="IdQnaSub" value="<?php echo $row_QnaSub2['IdQnaSub']; ?>">
							<?php if($row_mostrarAdm['Nombre']){ ?><input name="Submit" type="submit" class="texto_btgris" value="&gt;&gt;"><?php } ?>
						</div>
						</td>
					</tr>
					<input type="hidden" name="MM_update" value="form1">
					</form>
					<?php 
					$yy++;
					} while ($row_QnaSub2 = mysql_fetch_assoc($QnaSub2)); ?>
					<tr bgcolor="#EEEEEE">
						<td class="titulo">
						<div align="right"><strong>Total Administrativas </strong></div>
						</td>
						<td>
						<div align="center" class="texto_gris">
						<div align="center"><strong><strong><?php echo $totalHorasTotal2; ?></strong>
						</strong></div>
						</div>
						</td>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD01X; ?></strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD02X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD03X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD04X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD05X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD06X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD07X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD08X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD09X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD10X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD11X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD12X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><span class="texto_gris"><strong><?php echo $totalD13X; ?></strong></span></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD14X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD15X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD16X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $totalD17X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD18X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD19X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD20X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD21X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD22X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD23X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD24X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD25X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD26X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD27X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD28X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD29X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD30X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $totalD31X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<td>
						<div align="center" class="texto_btgris Estilo1"></div>
						</td>
					</tr>
					<tr bgcolor="#DDDDDD">
						<td class="titulo">
						<div align="right"><strong>Total General </strong></div>
						</td>
						<td>
						<div align="center" class="texto_gris">
						<div align="center"><strong><strong><?php echo $totalHorasTotal+$totalHorasTotal2; ?></strong>
						</strong></div>
						</div>
						</td>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T1=$totalD01+$totalD01X; ?></strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T2=$totalD02+$totalD02X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T3=$totalD03+$totalD03X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T4=$totalD04+$totalD04X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T5=$totalD05+$totalD05X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T6=$totalD06+$totalD06X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T7=$totalD07+$totalD07X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T8=$totalD08+$totalD08X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T9=$totalD09+$totalD09X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T10=$totalD10+$totalD10X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T11=$totalD11+$totalD11X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T12=$totalD12+$totalD12X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><span class="texto_gris"><strong><?php echo $T13=$totalD13+$totalD13X; ?></strong></span></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T14=$totalD14+$totalD14X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T15=$totalD15+$totalD15X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T16=$totalD16+$totalD16X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><?php echo $T17=$totalD17+$totalD17X; ?></strong>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T18=$totalD18+$totalD18X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T19=$totalD19+$totalD19X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T20=$totalD20+$totalD20X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T21=$totalD21+$totalD21X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T22=$totalD22+$totalD22X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T23=$totalD23+$totalD23X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T24=$totalD24+$totalD24X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T25=$totalD25+$totalD25X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T26=$totalD26+$totalD26X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T27=$totalD27+$totalD27X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T28=$totalD28+$totalD28X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T29=$totalD29+$totalD29X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T30=$totalD30+$totalD30X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><?php echo $T31=$totalD31+$totalD31X; ?>
						</strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<td>
						<div align="center" class="texto_btgris Estilo1"></div>
						</td>
					</tr>
					<?php // HORAS LABORABLES ?>
					<tr bgcolor="#DDDDDD">
						<td class="titulo">
						<div align="right"><strong>Horas Laborables </strong></div>
						</td>
						<td>
						<div align="center" class="texto_gris">
						<div align="center"><strong> </strong><strong> <?php 
						$conteoLaboral=0;
						/*// 1
						 if($totalD01<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD01;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 2
							if($totalD02<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD02;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 3
							if($totalD03<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD03;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 3
							if($totalD03<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD03;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 4
							if($totalD04<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD04;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 5
							if($totalD05<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD05;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 6
							if($totalD06<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD06;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 7
							if($totalD07<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD07;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 8
							if($totalD08<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD08;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 9
							if($totalD09<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD09;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 10
							if($totalD10<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD10;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 11
							if($totalD11<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD11;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 12
							if($totalD12<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD12;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 13
							if($totalD13<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD13;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 14
							if($totalD14<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD14;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 15
							if($totalD15<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD15;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 16
							if($totalD16<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD16;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 17
							if($totalD17<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD17;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 18
							if($totalD18<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD18;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 19
							if($totalD19<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD19;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 20
							if($totalD20<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD20;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 21
							if($totalD21<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD21;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 22
							if($totalD22<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD22;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 23
							if($totalD23<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD23;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 24
							if($totalD24<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD24;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 25
							if($totalD25<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD25;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 26
							if($totalD26<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD26;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 27
							if($totalD27<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD27;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 28
							if($totalD28<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD28;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 29
							if($totalD29<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD29;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 30
							if($totalD30<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD30;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}
							// 31
							if($totalD31<=$horlab) {
							$conteoLaboral=$conteoLaboral+$totalD31;
							} else {
							$conteoLaboral=$conteoLaboral+$horlab;
							}*/
						//$conteoLaboral = 85;
						if($NQda==1 && true):
							$quincArray = array('01','02','03','04','05','06','07','08','09',10,11,12,13,14,15);
							foreach($quincArray as $n => $d):
								$diaColor=jddayofweek(cal_to_jd(CAL_GREGORIAN,date("$MesQna"),date("$d"),date("$AnnoQna")),1);
								if(($diaColor!="Saturday") AND ($diaColor!="Sunday")) {
									$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '".($MesQna.$d)."'";
									$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
									if(mysql_num_rows($feriado)<1){
										$conteoLaboral=$conteoLaboral+$horlab;
									}
								}
							endforeach;
						else:
							for($d=16;$d<=date("t",$MesQna);$d++):
								$diaColor=jddayofweek(cal_to_jd(CAL_GREGORIAN,date("$MesQna"),date("$d"),date("$AnnoQna")),1);
								if(($diaColor!="Saturday") AND ($diaColor!="Sunday")) {
									$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '".($MesQna.$d)."'";
									$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
									if(mysql_num_rows($feriado)<1){
										$conteoLaboral=$conteoLaboral+$horlab;
									}
								}
							endfor;
						endif;
						
						echo $conteoLaboral;
						?> </strong></div>
						</div>
						</td>
						<?php if($NQda==1) { ?>
						<?php // 1 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="01";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD01<=$horlab) {
							 echo $totalD01;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<?php // 2 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="02";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD02<=$horlab) {
							 echo $totalD02;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;

						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 3 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="03";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD03<=$horlab) {
							 echo $totalD03;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 4 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="04";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD04<=$horlab) {
							 echo $totalD04;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;

						}
						@mysql_free_result($feriado);

						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 5 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="05";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD05<=$horlab) {
							 echo $totalD05;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
					 ?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 6 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="06";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD06<=$horlab) {
							 echo $totalD06;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;

						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 7 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="07";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD07<=$horlab) {
							 echo $totalD07;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;

						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 8 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="08";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD08<=$horlab) {
							 echo $totalD08;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 9 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="09";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD09<=$horlab) {
							 echo $totalD09;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;

						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 10 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="10";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD10<=$horlab) {
							 echo $totalD10;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 11 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="11";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD11<=$horlab) {
							 echo $totalD11;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 12 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="12";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD12<=$horlab) {
							 echo $totalD12;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 13 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="13";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD13<=$horlab) {
							 echo $totalD13;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 14 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="14";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD14<=$horlab) {
							 echo $totalD14;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==1) { ?>
						<?php // 15 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="15";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD15<=$horlab) {
							 echo $totalD15;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 16 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="16";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD16<=$horlab) {
							 echo $totalD16;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 17 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="17";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD17<=$horlab) {
							 echo $totalD17;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 18 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="18";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD18<=$horlab) {
							 echo $totalD18;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 19 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="19";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD19<=$horlab) {
							 echo $totalD19;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 20 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="20";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD20<=$horlab) {
							 echo $totalD20;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 21 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="21";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD21<=$horlab) {
							 echo $totalD21;
							 } else {
							 echo $horlab;
							 }*/

							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 22 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="22";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD22<=$horlab) {
							 echo $totalD22;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 23 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="23";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD23<=$horlab) {
							 echo $totalD23;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 24 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="24";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD24<=$horlab) {
							 echo $totalD24;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 25 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="25";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD25<=$horlab) {
							 echo $totalD25;
							 } else {
							 echo $horlab;

							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 26 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="26";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD26<=$horlab) {
							 echo $totalD26;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 27 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="27";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD27<=$horlab) {
							 echo $totalD27;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php // 28 ?>
						<td>
						<div align="center" class="texto_btgris"><strong> <?php
						$DiaCelda="28";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD28<=$horlab) {
							 echo $totalD28;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center" class="texto_btgris"><?php
						$DiaCelda="29";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD29<=$horlab) {
							 echo $totalD29;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?></div>
						</td>
						<?php } ?>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center" class="texto_btgris"><?php
						$DiaCelda="30";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD30<=$horlab) {
							 echo $totalD30;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?></div>
						</td>
						<?php } ?>
						<?php } ?>

						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center" class="texto_btgris"><?php
						$DiaCelda="31";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD31<=$horlab) {
							 echo $totalD31;
							 } else {
							 echo $horlab;
							 }*/
							echo $horlab;
						}
						@mysql_free_result($feriado);
						?></div>
						</td>
						<?php } ?>
						<?php } ?>

						<td>
						<div align="center" class="texto_gris"><strong> </strong></div>
						</td>
					</tr>
					<?php // FIN HORAS LABORABLES ?>

					<tr bgcolor="#DDDDDD">
						<td class="titulo">
						<div align="right"><strong>Horas Extras </strong></div>
						</td>
						<td>
						<div align="center" class="texto_gris">
						<div align="center"><strong> <?php $totalHorasExtras=0;
						if($NQda==1) { ?> <?php
						$DiaCelda="01";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD01;
						} else {
							if($T1>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T1-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="02";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD02;
						} else {
							if($T2>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T2-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="03";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD03;
						} else {
							if($T3>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T3-$horlab);
							}
						}
						@mysql_free_result($feriado);
				 	?> <?php } ?> <?php if($NQda==1) { ?> <?php
				 	$DiaCelda="04";
				 	$diaColor='';
				 	$ColorCelda='';
				 	$ORDENZZ=$MesQna . $DiaCelda;

				 	
				 	$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
				 	$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
				 	$row_feriado = mysql_fetch_assoc($feriado);
				 	$totalRows_feriado = mysql_num_rows($feriado);

				 	$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

				 	if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
				 		$totalHorasExtras=$totalHorasExtras+$totalD04;
				 	} else {
				 		if($T4>$horlab) {
				 			$totalHorasExtras=$totalHorasExtras+($T4-$horlab);;
				 		}
				 	}
				 	@mysql_free_result($feriado);
				 	?> <?php } ?> <?php if($NQda==1) { ?> <?php
				 	$DiaCelda="05";
				 	$diaColor='';
				 	$ColorCelda='';
				 	$ORDENZZ=$MesQna . $DiaCelda;

				 	
				 	$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
				 	$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
				 	$row_feriado = mysql_fetch_assoc($feriado);
				 	$totalRows_feriado = mysql_num_rows($feriado);

				 	$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

				 	if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
				 		$totalHorasExtras=$totalHorasExtras+$totalD05;
				 	} else {
				 		if($T5>$horlab) {
				 			$totalHorasExtras=$totalHorasExtras+($T5-$horlab);
				 		}
				 	}
				 	@mysql_free_result($feriado);
				 	?> <?php } ?> <?php if($NQda==1) { ?> <?php
				 	$DiaCelda="06";
				 	$diaColor='';
				 	$ColorCelda='';
				 	$ORDENZZ=$MesQna . $DiaCelda;

				 	
				 	$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
				 	$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
				 	$row_feriado = mysql_fetch_assoc($feriado);
				 	$totalRows_feriado = mysql_num_rows($feriado);

				 	$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

				 	if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
				 		$totalHorasExtras=$totalHorasExtras+$totalD06;
				 	} else {
				 		if($T6>$horlab) {
				 			$totalHorasExtras=$totalHorasExtras+($T6-$horlab);
				 		}
				 	}
				 	@mysql_free_result($feriado);
				 	?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="07";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD07;
						} else {
							if($T7>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T7-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="08";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+ $totalD08;
						} else {
							if($T8>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T8-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="09";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD09;
						} else {
							if($T9>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T9-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="10";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD10;
						} else {
							if($T10>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T10-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="11";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD11;
						} else {
							if($T11>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T11-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="12";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD12;
						} else {
							if($T12>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T12-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="13";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD13;
						} else {
							if($T13>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T13-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="14";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD14;
						} else {
							if($T14>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T14-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==1) { ?> <?php
						$DiaCelda="15";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD15;
						} else {
							if($T15>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T15-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="16";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD16;
						} else {
							if($T16>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T16-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="17";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD17;
						} else {
							if($T17>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T17-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="18";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD18;
						} else {
							if($T18>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T18-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="19";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD19;
						} else {
							if($T19>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T19-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="20";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD20;
						} else {
							if($T20>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T20-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="21";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD21;
						} else {
							if($T21>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T21-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="22";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD22;
						} else {
							if($T22>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T22-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="23";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD23;
						} else {
							if($T23>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T23-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="24";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD24;
						} else {
							if($T24>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T24-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="25";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD25;
						} else {
							if($T25>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T25-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="26";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD26;
						} else {
							if($T26>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T26-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="27";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD27;
						} else {
							if($T27>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T27-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php
						$DiaCelda="28";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD28;
						} else {
							if($T28>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T28-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php if($NQda==2) { ?> <?php if($ultimo_dia>=29) { ?> <?php
						$DiaCelda="29";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD29;
						} else {
							if($T29>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T29-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php } ?> <?php if($NQda==2) { ?> <?php if($ultimo_dia>=30) { ?>

						<?php
						$DiaCelda="30";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD30;
						} else {
							if($T30>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T30-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php } ?> <?php if($NQda==2) { ?> <?php if($ultimo_dia>=31) { ?>

						<?php
						$DiaCelda="31";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD31;
						} else {
							if($T31>$horlab) {
								$totalHorasExtras=$totalHorasExtras+($T31-$horlab);
							}
						}
						@mysql_free_result($feriado);
						?> <?php } ?> <?php } ?> <?php
						/*$totalHorasExtras=$total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10+$total11+$total12+$total13+$total14+$total15+$total16+$total17+$total18+$total19+$total20+$total21+$total22+$total23+$total24+$total25+$total26+$total27+$total28+$total29+$total30+$total31;*/
						echo $totalHorasExtras;

						?> </strong></div>
						</div>
						</td>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong> <?php
						$DiaCelda="01";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD01;
						} else {
							if($T1>$horlab) {
								echo $T1-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong> <?php
						$DiaCelda="02";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD02;
						} else {
							if($T2>$horlab) {
								echo $T2-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong> <?php
						$DiaCelda="03";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD03;
						} else {
							if($T3>$horlab) {
								echo $T3-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong> <?php
						$DiaCelda="04";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD04;
						} else {
							if($T4>$horlab) {
								echo $T4-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong> <?php
						$DiaCelda="05";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD05;
						} else {
							if($T5>$horlab) {
								echo $T5-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong> <?php
						$DiaCelda="06";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD06;
						} else {
							if($T6>$horlab) {
								echo $T6-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong> <?php
						$DiaCelda="07";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD07;
						} else {
							if($T7>$horlab) {
								echo $T7-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong> <?php
						$DiaCelda="08";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD08;
						} else {
							if($T8>$horlab) {
								echo $T8-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong> <?php
						$DiaCelda="09";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD09;
						} else {
							if($T9>$horlab) {
								echo $T9-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong> <?php
						$DiaCelda="10";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD10;
						} else {
							if($T10>$horlab) {
								echo $T10-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong> <?php
						$DiaCelda="11";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD11;
						} else {
							if($T11>$horlab) {
								echo $T11-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="12";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD12;
						} else {
							if($T12>$horlab) {
								echo $T12-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center"><span class="texto_gris"><strong><strong><strong>
						<?php
						$DiaCelda="13";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD13;
						} else {
							if($T13>$horlab) {
								echo $T13-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong></span></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="14";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD14;
						} else {
							if($T14>$horlab) {
								echo $T14-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==1) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="15";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD15;
						} else {
							if($T15>$horlab) {
								echo $T15-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong> <?php
						$DiaCelda="16";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD16;
						} else {
							if($T16>$horlab) {
								echo $T16-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="17";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD17;
						} else {
							if($T17>$horlab) {
								echo $T17-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="18";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD18;
						} else {
							if($T18>$horlab) {
								echo $T18-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="19";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD19;
						} else {
							if($T19>$horlab) {
								echo $T19-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="20";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD20;
						} else {
							if($T20>$horlab) {
								echo $T20-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="21";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD21;
						} else {
							if($T21>$horlab) {
								echo $T21-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="22";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD22;
						} else {
							if($T22>$horlab) {
								echo $T22-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="23";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD23;
						} else {
							if($T23>$horlab) {
								echo $T23-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="24";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD24;
						} else {
							if($T24>$horlab) {
								echo $T24-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="25";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD25;
						} else {
							if($T25>$horlab) {
								echo $T25-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="26";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD26;
						} else {
							if($T26>$horlab) {
								echo $T26-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="27";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD27;
						} else {
							if($T27>$horlab) {
								echo $T27-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="28";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD28;
						} else {
							if($T28>$horlab) {
								echo $T28-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=29) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="29";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD29;
						} else {
							if($T29>$horlab) {
								echo $T29-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=30) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="30";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD30;
						} else {
							if($T30>$horlab) {
								echo $T30-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<?php if($NQda==2) { ?>
						<?php if($ultimo_dia>=31) { ?>
						<td>
						<div align="center" class="texto_gris"><strong><strong><strong><strong>
						<?php
						$DiaCelda="31";
						$diaColor='';
						$ColorCelda='';
						$ORDENZZ=$MesQna . $DiaCelda;

						
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);

						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 );

						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo $totalD31;
						} else {
							if($T31>$horlab) {
								echo $T31-$horlab;
							}
						}
						@mysql_free_result($feriado);
						?> </strong></strong></strong> </strong></div>
						</td>
						<?php } ?>
						<?php } ?>
						<td>
						<div align="center" class="texto_gris"><strong> </strong></div>
						</td>
					</tr>
				</table>
				<?php //TABLA ASMINISTRATIVA FINAL ?>
				<hr>
				<p class="textotitulos">&nbsp;</p>
				<p class="textotitulos">&nbsp;</p>
				</div>
				</td>
			</tr>
		</table>
		<table width="100%" height="19" border="0" cellpadding="0"
			cellspacing="0" bgcolor="#FFFFFF" class="bordergris">
			<tr>
				<td height="19">
				<div align="center"></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<script>
var mensaje = "<?php echo $mensaje; ?>";
if(mensaje){
	alert("<?php echo $mensaje; ?>");
}
</script>
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

@mysql_free_result($Qna);

@mysql_free_result($QnaSub);
	
@mysql_free_result($empresasList);

mysql_close($marambio);
?>
