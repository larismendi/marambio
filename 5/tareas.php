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

$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$totalRows_quienEs = mysql_num_rows($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

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

$query_empresaList = sprintf("SELECT * FROM empresas WHERE CodGrupo = %s", $colname_empresaList);
$empresaList = mysql_query($query_empresaList, $marambio) or die(mysql_error());
$row_empresaList = mysql_fetch_assoc($empresaList);

?>
<?php include("includes/head.php");?>

<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
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
<script type="text/javascript">
function vali2(){
	if(document.form2.palabra.value){
		return true;
	}else{
		alert("Debe colocar un nombre de empresa en el campo de texto");
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
			$.post("autoComplete/con_grupoId.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				} else {
					$('#suggestions').hide();
				}
			});
		}
	} // lookup
	
	function fill_(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	function fill(thisId,thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);			
		cargarcon2(thisId);
	}
</script>
<script type="text/javascript">
function cargarcon(Id){
	document.getElementById("fff").style.visibility="visible";
	$("#cargarSelect").load('selectCon.php?id='+Id.value);
	$("#cargarTablaEmpresa").load('tablaEmp.php?id='+Id.value);
	$("#cargarTabla").load('tablaCon.php?id='+Id.value);
}
function cargarcon2(value){
	document.getElementById("fff").style.visibility="visible";
	$("#cargarSelect").load('selectCon.php?id='+value);
	$("#cargarTablaEmpresa").load('tablaEmp.php?id='+value);
	$("#cargarTabla").load('tablaCon.php?id='+value);
}
</script>
<script type="text/javascript">
function cargarTabla(Id){
	$("#cargarTabla").load('tablaConE.php?id='+Id.value);
}
</script>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
           	  <p class="titulo">TAREAS</p>
              <table><tr><td><a href="consulta_tareas2.php" class="texto_gris"><strong>Ver tareas.</strong></a></td></tr></table>
              <table width="996">
              	<tr>
                	<td width="280">&nbsp;</td>
                	<td width="429" valign="top">
                      <table width="429" height="60"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                        <tr>
                          <td width="421" height="23" bgcolor="#EAF1FB">
                              <div align="center" class="texto_btgris">Agregar Tarea&gt;&gt;</div>
                          </td>
                        </tr>
                        <tr>
                          <td align="center">
                            <form name="form2" id="form2" method="post" action="tareas.php" onSubmit="return vali2()">
                             <table>
                             	<tr>
                                    <td><span class="texto_btgris">Busqueda de Grupos:</span></td>
                                </tr>
                                <tr>
                                    <td><input name="palabra" type="text" class="texto_gris" size="30" id="inputString" onkeyup="lookup(this.value);" onblur="fill_();"> 
                                      <div class="suggestionsBox" id="suggestions" style="display: none;">
                                          <img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                          <div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
                                      </div>
                                    </td>
                                </tr>
                              </table>
                             </form>
                          </td>
                        </tr>
                        <tr>
                          <td>
                          <form name="val" id="val" action="" method="post"> 
                              <table width="100%" align="center">
                              <!--
                              <tr valign="baseline">
                                <td width="55" align="right" nowrap bgcolor="#EAF1FB" class="texto_btgris">
                                  <div align="left">Grupo:</div>
                                </td>
                                <td width="279">
                                <select name="IdGrupo" class="texto_gris" id="IdGrupo" onChange="javascript:cargarcon(this)">
                                  <option selected value="0">Seleccione</option>
                                  <?php
								  	  $criterio="";
								  	  if($_POST['palabra']){$criterio=" WHERE Nombre LIKE '%".$_POST['palabra']."%'";}
									  $query_grupo = "SELECT IdGrupo, Nombre FROM grupos ".$criterio." ORDER BY Nombre ASC";
									  $grupo = mysql_query($query_grupo, $marambio) or die(mysql_error());
									  $row_grupo = mysql_fetch_assoc($grupo);
                                      do{
                                          if($IdGrupo == $row_grupo['IdGrupo']){
                                  ?>
                                      <option selected value="<?php echo $row_grupo['IdGrupo']; ?>"><?php echo $row_grupo['Nombre']; ?></option>
                                  <?php
                                          }else{
                                  ?>
                                      <option value="<?php echo $row_grupo['IdGrupo']; ?>"><?php echo $row_grupo['Nombre']; ?></option>				
                                  <?php	
                                          }
                                      } while ($row_grupo = mysql_fetch_assoc($grupo));
                                      $rows = mysql_num_rows($grupo);
                                        if($rows > 0) {
                                            mysql_data_seek($grupo, 0);
                                            $row_grupo = mysql_fetch_assoc($grupo);
                                        }
                                  ?>
                                </select>
                                </td>
                              </tr>
                              -->
                              <tr id="fff" style="visibility:hidden">
                                  <td class="texto_btgris">Empresas:</td>
                                  <td>
                                  <div id="cargarSelect">
                                  <select name="con" class="fondo_formulario1" id="con">
                                      <option value="">Seleccione</option>
                                  </select>
                                  </div>
                                  </td>
                              </tr>
                            </table>
                          </form>
                          </td>
                        </tr>
                    </table>
                  </td>
                  <td width="271" valign="top" align="right">
                  	<div id="cargarTablaEmpresa" align="right">
                               
                    </div>
                  </td>
                </tr>
              </table>
              <table>
              	<tr>
                	<td>
                    	<table border="0">
                          <tr>
                              <td>
                              <div id="cargarTabla" align="center">
                               
                               </div>
                            </td>
                          </tr>
                      	</table>
                   	</td>
                </tr>
              </table>
            </td>
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
@mysql_free_result($tareas);
@mysql_free_result($serviciosMostrar);
@mysql_free_result($grupo);
mysql_close($marambio);
?>

