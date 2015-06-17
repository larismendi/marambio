<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 5){
	header ("Location: ../index.php"); 
}
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

if($_POST['palabra']){
	$part = explode("-", $_POST['palabra']);
	$criterio = " t.IdTarea = '".$part[0]."'";
	echo $criterio;
}else{
	$criterio = " t.CodificacionComp LIKE '$queryString%' OR g.Nombre LIKE '$queryString%' OR e.Nombre LIKE '$queryString%'";
}

//$query_proyecto = "SELECT * FROM tareas WHERE activo = 0 ORDER BY CodificacionComp DESC";
$query_proyecto = "SELECT t.IdTarea, t.CodificacionComp, g.Nombre AS Grupo, e.Nombre AS Empresa FROM tareas AS t LEFT JOIN grupos AS g ON t.IdGrupo = g.IdGrupo LEFT JOIN empresas AS e ON t.IdEmpresa = e.CodEmp WHERE ".$criterio." ORDER BY t.CodificacionComp DESC";
$proyecto = mysql_query($query_proyecto, $marambio) or die(mysql_error());
$row_proyecto = mysql_fetch_assoc($proyecto);
?>
<?php include("includes/head.php"); ?>
<script>
function vali2(){
	if(document.form2.Id.value){
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
			$.post("autoComplete/con_proyectos.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	function fill2(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
		setTimeout("document.form2.submit();", 200);
	}
</script>
<script>

</script>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
              <p align="center" class="textotitulos">&nbsp;</p>
                <p class="texto_gris"><span class="titulo">HOJA DE TIEMPO</span></p>
                <table>
              	  <tr>
                    <td>
                     <form name="form2" id="form2" method="get" action="verQnaPersonal.php" onSubmit="return vali2()">
                        <table>
                            <tr>
                                <td><span class="texto_btgris">Busqueda de Proyectos:</span></td>
                            </tr>
                            <tr>
                                <td><input name="Id" type="text" class="texto_gris" size="30" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"> 
                                  <div class="suggestionsBox" id="suggestions" style="display: none;">
                                      <img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                        <div class="suggestionList" id="autoSuggestionsList">
                                            &nbsp;
                                        </div>
                                  </div>
                                </td>
                            </tr>
                        </table>
                      </form>
                    </td>
                  </tr>
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
