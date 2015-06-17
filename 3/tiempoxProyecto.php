<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 3){
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

$query_proyecto = "SELECT * FROM tareas WHERE activo = 1 ORDER BY CodificacionComp DESC";
$proyecto = mysql_query($query_proyecto, $marambio) or die(mysql_error());
$row_proyecto = mysql_fetch_assoc($proyecto);

$query_servicio = "SELECT * FROM servicios ORDER BY Servicio";
$servicio = mysql_query($query_servicio, $marambio) or die(mysql_error());
$row_servicio = mysql_fetch_assoc($servicio);
?>
<?php include("includes/head.php"); ?>
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
<?php
if(isset($_GET['buscarPro'])&&isset($_SESSION['grupoTTT'])&&isset($_SESSION['empresaTTT'])&&isset($_SESSION['servicioTTT'])):
?>
$(function(){
	$.get('tablaBuscVar.php', { 'grupo':<?=$_SESSION['grupoTTT']?>, 'empresa':<?=$_SESSION['empresaTTT']?>, 'servicio':<?=$_SESSION['servicioTTT']?> }, function( data ) {
		$("#cargarTabla").html( data );
	});
});
<?php
endif;
?>
function cargarTabla(){
	if(document.val.grupo.value || document.val.empresa.value || document.val.servicio.value ){
		$.get('tablaBuscVar.php', { 'grupo':document.val.grupo.value, 'empresa':document.val.empresa.value, 'servicio':document.val.servicio.value }, function( data ) {
			$("#cargarTabla").html( data );
		});
	}
}
</script>
<script type="text/javascript">
$(function(){
	$(window).keypress(function(e){
		if(e.which == 13){
			cargarTabla();
		}
	});
});
</script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$('#autoSuggestionsList').html("");
			$.post("autoComplete/con_empresas.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				} else {
					$('#suggestions').hide();
				}
			});
		}
	} // lookup
	function lookupGroup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestionsGroup').hide();
		} else {
			$('#autoSuggestionsListGroup').html("");
			$.post("autoComplete/con_gruposS.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestionsGroup').show();
					$('#autoSuggestionsListGroup').html(data);
				} else {
					$('#suggestionsGroup').hide();
				}
			});
		}
	}
	function fill(thisValue) {
		$('#empresa').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	function fillGroup(thisValue) {
		$('#grupo').val(thisValue);
		setTimeout("$('#suggestionsGroup').hide();", 200);
	}
</script>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="texto_gris">Tiempo por Proyecto</p>
                <table width="598" height="217" border="0">
                	<tr>
                    	<td width="592" align="center">
                        	<table width="429" height="60"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                              <tr>
                                <td width="421" height="23" bgcolor="#EAF1FB">
                                    <div align="center" class="texto_btgris">Agregar Tarea&gt;&gt;</div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                <form autocomplete="off" name="val" method="post"> 
                                    <table width="100%" align="center">
                                    <tr valign="baseline">
                                      <td width="55" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris">
                                        <div align="left">Grupo:</div>
                                      </td>
                                      <td width="279">
                                        <input type="text" name="grupo" id="grupo" value="<?=isset($_GET['buscarPro'])&&isset($_SESSION['grupoTTT'])?$_SESSION['grupoTTT']:''?>" onkeyup="lookupGroup(this.value);" onblur="fillGroup();"/>
                                        <div class="suggestionsBox" id="suggestionsGroup" style="display: none;">
                                            <img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow"/>
                                              <div class="suggestionList" id="autoSuggestionsListGroup">
                                                  &nbsp;
                                              </div>
                                        </div>
                                      </td>
                                      <td width="55" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris">
                                        <div align="left">Empresa:</div>
                                      </td>
                                      <td width="279">
                                        <input type="text" name="empresa" id="empresa" value="<?=isset($_GET['buscarPro'])&&isset($_SESSION['empresaTTT'])?$_SESSION['empresaTTT']:''?>" onkeyup="lookup(this.value);" onblur="fill();"/>
                                        <div class="suggestionsBox" id="suggestions" style="display: none;">
                                            <img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow"/>
                                              <div class="suggestionList" id="autoSuggestionsList">
                                                  &nbsp;
                                              </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr valign="baseline">
                                      <td width="55" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris">
                                        <div align="left">Servicio:</div>
                                      </td>
                                      <td width="279">
                                        <select name="servicio" id="servicio">
                                        	<option value="">Seleccione</option>
                                            <?php
                                            do{
												if(isset($_GET['buscarPro'])&&isset($_SESSION['servicioTTT'])&&$row_servicio['IdServicio']==$_SESSION['servicioTTT']){
											?>
                                            <option selected value="<?php echo $row_servicio['IdServicio']; ?>"><?php echo $row_servicio['Servicio']; ?></option>
                                            <?php
												}else{
											?>
											<option value="<?php echo $row_servicio['IdServicio']; ?>"><?php echo $row_servicio['Servicio']; ?></option>
											<?php	
												}
											}while( $row_servicio = mysql_fetch_assoc($servicio) );
											?>
                                        </select>
                                      </td>
                                      <td colspan="2" align="right">
                                        <input type="button" value="Buscar" onClick="javascript:cargarTabla()">
                                      </td>
                                    </tr>
                                  </table>
                                </form>
                                </td>
                              </tr>
                          </table>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<div id="cargarTabla">
                            </div>
                        </td>
                    </tr>
                    <tr><td height="45">&nbsp;</td></tr>
                </table>
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
@mysql_free_result($proyecto);
mysql_close($marambio);
?>
