<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
	header ("Location: ../index.php"); 
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

//Limito la busqueda 
$TAMANO_PAGINA = 15; 
//examino la página a mostrar y el inicio del registro a mostrar 
$pagina = $_GET["pagina"]; 
if (!$pagina) { 
	$inicio = 0; 
	$pagina=1;
} 
else { 
	$inicio = ($pagina - 1) * $TAMANO_PAGINA; 
} 
if($_POST['palabra']){
	$criterio = " WHERE Nombre LIKE '%".$_POST['palabra']."%'";
}

//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
$ssql = "SELECT * FROM usuarios".$criterio; 
$rs = mysql_query($ssql, $marambio);
$num_total_registros = mysql_num_rows($rs);
//calculo el total de páginas 
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
//muestro los distintos índices de las páginas, si es que hay varias páginas 

$q_e_board = "SELECT * FROM usuarios ".$criterio." ORDER BY Nombre ASC";
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
			$.post("autoComplete/con_rrhh.php", {queryString: ""+inputString+""}, function(data){
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
</script>
<link href="autoComplete/estilo_auto_relativo.css" rel="stylesheet" type="text/css">
                <p align="center" class="textotitulos">&nbsp;</p>
                <p class="titulo">RRHH</p>
                <p>
                <form name="form2" id="form2" method="post" action="rrhh.php" onSubmit="return vali2()">
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
                <p><a href="agregarRRHH.php" class="texto_btgris">Agregar Personal &gt;&gt; </a></p>
                <table width="40%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="66%"><div align="center" class="Estilo1">Nombre</div></td>
                    <td width="12%"><div align="center"><span class="Estilo1">Ver</span></div></td>
                    <td width="11%"><div align="center"><span class="Estilo1">Editar</span></div></td>
                    <td width="11%"><div align="center"><span class="Estilo1">Eliminar</span></div></td>
                  </tr>
                  <?php 
				  do { 
				  ?>
                  <tr class="textogrande">
                    <td><div align="left" class="texto_gris"><?php echo $row_data['Nombre']; ?></div></td>
                    <td><a href="verRRHH.php?IdUsuario=<?php echo $row_data['IdUsuario']; ?>"><img src="images/ver_on.jpg" width="34" height="35" border="0"></a></td>
                    <td><div align="center"><a href="editarRRHH.php?IdUsuario=<?php echo $row_data['IdUsuario']; ?>"><img src="images/edit_off.jpg" alt="Editar" width="34" height="35" border="0"></a></div></td>
                    <td><div align="center"><a href="eliminarRRHH.php?IdUsuario=<?php echo $row_data['IdUsuario']; ?>"><img src="images/elim_on.jpg" alt="Eliminar" width="34" height="35" border="0"></a></div></td>
                  </tr>
                  <?php 
				  } while ($row_data = mysql_fetch_assoc($data)); 
				  if($num_total_registros){					  
				  ?>
                  <tr>
                  	<td colspan="4">
				  		<table border="0" align="right">
                      		<tr>
							  <?php 
                                  if($pagina > 1){
                              ?>
                              <td><div align='center'><a href="rrhh.php?pagina=<?php echo $pagina - 1; ?>"><img src="images/boton_anterior.jpg" alt="Back" name="Back" border="0" id="Anterior" /></a></div></td>
                              <?php
                                  }
                                  $contador=0;
                                  if ($total_paginas > 1){ 
                                    for ($i=1;$i<=$total_paginas;$i++){ 
                                      $contador= $contador+1;
                                      if ($pagina == $i) {
                              ?>
                              <td><div align='center'><span class="Estilo34" style="color: #FF0000"><strong> <?php echo $i; ?></strong></span></div></td>
                              <?php	
                                      }else {
                              ?>
                              <td><div align='center'><span class="Estilo27"><a href="rrhh.php?pagina=<?php echo $i; ?>" class="texto_gris"><?php echo $i; ?></a></span></div></td>
                              <?php
                                      } 
                                    }
                                  } 
                                  if($pagina < $contador){
                              ?>
                                        <td><div align='center'><a href="rrhh.php?pagina=<?php echo $pagina + 1; ?>"><img src="images/siguiente_boton.jpg" alt="Next" name="Next" border="0" id="Siguiente" /></a> </div></td>
                              <?php
                                  }
                              ?>
                      		</tr>
                  		</table>
                  	</td>
                  </tr>
				  <?php				  	
				  }else{
				  ?>
                  <tr><td colspan="4">&nbsp;</td></tr>
				  <tr><td colspan="4" align="center" class="texto_gris">No existen rrhh que mostrar</td></tr>
                  <?php 
				  }
				  ?>
                </table>
            </div>
            </td>
          </tr>
        </table>
      </td>
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
