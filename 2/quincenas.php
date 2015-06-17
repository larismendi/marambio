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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE quincenas SET activa=%s WHERE IdQna=%s",
                       GetSQLValueString($_POST['activa'], "int"),
                       GetSQLValueString($_POST['IdQna'], "int"));

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

//Limito la busqueda 
$TAMANO_PAGINA = 20; 

//examino la página a mostrar y el inicio del registro a mostrar 
if($_GET["pagina"] > $_GET["total_paginas"]) {
	$pagina = $_GET["total_paginas"];
}else {
    $pagina = $_GET["pagina"];
}
if (!isset($pagina)) { 	
    $inicio = 0;
    $pagina=1;
} 
else { 	
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

$query_qna = "SELECT * FROM quincenas ORDER BY CodificacionCompleta DESC";
$rs = mysql_query($query_qna, $marambio);
$num_total_registros = mysql_num_rows($rs);
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

$query_qna = sprintf("%s LIMIT %d, %d", $query_qna, $inicio, $TAMANO_PAGINA);
$qna = mysql_query($query_qna, $marambio) or die(mysql_error());
$row_qna = mysql_fetch_assoc($qna);
$totalRows_qna = mysql_num_rows($qna);

$CodGrupoXX=$row_data['IdGrupo'];
?>
<?php include("includes/head.php"); ?>
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
.Estilo2 {color: #E5E5E5}
.Estilo3 {color: #666666}
-->
</style>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="left" class="textotitulos">&nbsp;</p>
                  <p class="titulo">QUINCENAS</p>
                <p><a href="agregarQna.php" class="texto_btgris">Agregar Quincena &gt;&gt;</a></p>
                <p>&nbsp;</p>
                <table width="33%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                  <tr bgcolor="#E5E5E5" class="texto_btgris">
                    <td width="23%"><div align="center"><strong>N&ordm;</strong></div></td>
                    <td width="55%"><div align="center"><strong>Mes / A&ntilde;o </strong></div></td>
                    <td width="22%"><div align="center" class="Estilo2">.<span class="Estilo3">Estado</span></div></td>
                  </tr>
                  <?php 
				  if($totalRows_qna){
                  	do { ?>
                  <tr class="texto_gris">
                    <td height="32"><div align="center"><?php echo $row_qna['Quincena']; ?></div></td>
                    <td><div align="center"><?php echo $row_qna['Mes']; ?> / <?php echo $row_qna['Anno']; ?></div></td>
                    <td>
                      <div align="center"></div>                      <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
                        <? if($row_qna['activa']==1) { ?>
							
					    <div align="center">
						  <input name="imageField" type="image" src="images/si.gif" width="22" height="24" border="0">
						  <input name="activa" type="hidden" id="activa" value="0">
                          <? } else { ?>
						  <div align="center">
						  <input name="imageField" type="image" src="images/no.gif" width="23" height="27" border="0">
						  <input name="activa" type="hidden" id="activa" value="1">
                   	      <? } ?>
				  		  <input name="IdQna" type="hidden" id="IdQna" value="<?php echo $row_qna['IdQna']; ?>">
                       	  <input type="hidden" name="MM_update" value="form1">
</div>
                      </form> 
                    </td>
                  </tr>
                  <?php } while ($row_qna = mysql_fetch_assoc($qna)); ?>
                  <tr><td colspan="3">
                  <div align="center">
                    <form name="pag" id="pag" method="get" action="quincenas.php">
                        <input type="hidden" name="total_paginas" value="<?=$total_paginas;?>">    
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="54" align="center" valign="top"><a href="<?php if($pagina>1) {?>quincenas.php?total_paginas=<?=$total_paginas;?>&pagina=<?=$pagina - 1;}else { echo "#";}?>"><img src="images/boton_anterior.jpg" alt="Anterior" border="0" /></a></td>
                                <td width="81" align="center" valign="top">
                                    <div><input type="text" name="pagina" style="text-align:center" value="<?=$pagina; ?>" size="1" />
                                        <span class="cometario_credito">/<?=$total_paginas;?></span>
                                    </div></td>
                                <td width="57" align="center" valign="top"><a href="<?php if($pagina < $total_paginas) { ?>quincenas.php?total_paginas=<?=$total_paginas;?>&pagina=<?=$pagina + 1;}else {echo "#";} ?>"><img src="images/siguiente_boton.jpg" alt="Siguiente" border="0"/></a></td>
                            </tr>
                        </table>                      
                    </form>
                  </div>
                  </td></tr>
				  <?php
				  }else{
					 ?>
                    <tr><td colspan="3">&nbsp;</td></tr>
				  	<tr><td colspan="3" align="center" class="texto_gris">No existen empresas que mostrar</td></tr>
                     <?php 
				  }
				  ?>
              </table>
                
                <p>&nbsp;</p>
              <p align="center" class="textotitulos">&nbsp;                  </p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
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

@mysql_free_result($qna);

mysql_close($marambio);
?>