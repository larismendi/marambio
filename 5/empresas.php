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

//Limito la busqueda 
$TAMANO_PAGINA = 20; 

//examino la página a mostrar y el inicio del registro a mostrar 
if($_GET["pagina"] > $_GET["total_paginas"]) {
	$pagina = $_GET["total_paginas"];
}else {
    $pagina = $_GET["pagina"];
}
if (!$pagina) { 	
    $inicio = 0;
    $pagina=1;
}else { 	
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

if($_POST['palabra']){
	$criterio = " WHERE Nombre LIKE '%".$_POST['palabra']."%'";
}
//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
$ssql = "SELECT * FROM empresas".$criterio; 
$rs = mysql_query($ssql, $marambio);
$num_total_registros = mysql_num_rows($rs);
//calculo el total de páginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
//muestro los distintos índices de las páginas, si es que hay varias páginas 

$q_e_board = "SELECT * FROM empresas ".$criterio." ORDER BY Nombre ASC";
$sqw = sprintf("%s LIMIT %d, %d", $q_e_board, $inicio, $TAMANO_PAGINA);
$data = mysql_query($sqw, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>
<?php include("includes/head.php"); ?>
<script>
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
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">EMPRESAS</p>
                <p>
                <form name="form2" id="form2" method="post" action="empresas.php" onSubmit="return vali2()">
                <table>
                	<tr>
                    	<td><span class="texto_btgris">Busqueda de Empresas:</span></td>
                    </tr>
                    <tr>
                    	<td><input name="palabra" type="text" class="texto_gris" size="30" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"> 
                          <div class="suggestionsBox" id="suggestions" style="display: none;">
                              <img src="autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                <div class="suggestionList" id="autoSuggestionsList">
                                    &nbsp;
                                </div>
                          </div>  
                          <input name="Submit3" type="submit" class="texto_gris" value="&gt;&gt;">
                    	</td>
                    </tr>
                </table>
                </form>
                </p>
                <p><a href="agregarEmpresa.php" class="texto_btgris">Agregar Empresa &gt;&gt;</a></p>
                <table width="60%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="17%"><div align="center" class="Estilo1">C&oacute;digo</div></td>
                    <td width="59%"><div align="center" class="Estilo1">Nombre</div></td>
                    <td width="8%"><div align="center" class="Estilo1">Consultar</div></td>
                    <td width="8%"><div align="center" class="Estilo1">Editar</div></td>
                    <td width="8%"><div align="center" class="Estilo1">Eliminar</div></td>
                    <td width="16%"><div align="center" class="Estilo1">Crear tarea</div></td>
                  </tr>
                  <?php 
				  if($totalRows_data){
				  		do { ?>
                  <tr class="textogrande">
                    <td height="40" class="texto_btgris"><div align="center"><?php echo $row_data['CodEmp']; ?></div></td>
                    <td class="texto_btgris"><div align="left"><?php echo $row_data['Nombre']; ?></div></td>
                    <td><div align="center"><a href="verEmpresa.php?CodEmp=<?php echo $row_data['CodEmp']; ?>"><img src="images/bot_verdetalle.gif" alt="Mostrar" width="38" height="36" border="0"></a></div></td>
                    <td><div align="center"><a href="editarEmpresa.php?CodEmp=<?php echo $row_data['CodEmp']; ?>"><img src="images/edit_off.jpg" alt="Editar" width="34" height="35" border="0"></a></div></td>
                    <td><div align="center"><a href="eliminarEmpresa.php?CodEmp=<?php echo $row_data['CodEmp']; ?>"><img src="images/elim_on.jpg" alt="Eliminar" width="34" height="35" border="0"></a></div></td>
                    <td width="16%"><div align="center"><a href="agregarTareasEmpresa.php?IdGrupo=<?php echo $row_data['CodGrupo'];; ?>&IdEmpresa=<?php echo $row_data['CodEmp']; ?>"><img src="images/nueva_pag_on.jpg" alt="Eliminar" width="34" height="35" border="0"></a></div></td>
                  </tr>
                  <?php } while ($row_data = mysql_fetch_assoc($data)); 
				  ?>
                  <tr><td colspan="8">
				  <div align="center">
                    <form name="pag" id="pag" method="get" action="empresas.php">
                        <input type="hidden" name="total_paginas" value="<?php echo $total_paginas;?>">    
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="54" align="center" valign="top"><a href="<?php if($pagina>1) {?>empresas.php?total_paginas=<?=$total_paginas;?>&pagina=<?=$pagina - 1;}else { echo "#";}?>"><img src="images/boton_anterior.jpg" alt="Anterior" border="0" /></a></td>
                                <td width="81" align="center" valign="top">
                                    <div><input type="text" name="pagina" style="text-align:center" value="<?=$pagina; ?>" size="1" />
                                        <span class="cometario_credito">/<?=$total_paginas;?></span>
                                    </div></td>
                                <td width="57" align="center" valign="top"><a href="<?php if($pagina < $total_paginas) { ?>empresas.php?total_paginas=<?=$total_paginas;?>&pagina=<?=$pagina + 1;}else {echo "#";} ?>"><img src="images/siguiente_boton.jpg" alt="Siguiente" border="0"/></a></td>
                            </tr>
                        </table>                      
                    </form>
                  </div>
                  </td></tr>
				  <?php
				  }else{
					 ?>
                     <tr><td colspan="8">&nbsp;</td></tr>
				  <tr><td colspan="8" align="center" class="texto_gris">No existen empresas que mostrar</td></tr>
                     <?php 
				  }
				  ?>
                </table>
            <p>&nbsp;</p>
                <p align="center" class="textotitulos">&nbsp;</p>
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
@mysql_free_result($data);
mysql_close($marambio);
?>