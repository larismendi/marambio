<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 5){
	header ("Location: ../index.php"); 
}
?>
<?php
extract($_REQUEST);

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
	if($TipoTarea==1) {
		$condificacionCompletaFinal=$tareaCliente;
	} else {
		$condificacionCompletaFinal=$tareaAdministrativa;
	}
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO quincenasub (IdQna, IdUsuario, TipoTarea, CodificacionComp, token) VALUES (%s, %s, %s, %s, '1')",
                       GetSQLValueString($_POST['IdQna'], "int"),
					   GetSQLValueString($_POST['IdUsuario'], "int"),
                       GetSQLValueString($_POST['TipoTarea'], "text"),
                       GetSQLValueString($condificacionCompletaFinal, "text"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());
  
  $fecha = date("d")."-".date("m")."-".date("Y");
  $insertREF = sprintf("INSERT INTO tareas_registradas (tarea, id_empleado, fecha, id_qna) VALUES (%s, %s, %s, %s)",
					   GetSQLValueString($condificacionCompletaFinal, "text"),
					   GetSQLValueString($_POST['IdUsuario'], "int"),
					   GetSQLValueString($fecha, "text"),
					   GetSQLValueString($_POST['IdQna'], "int"));
  $ResultREF = mysql_query($insertREF, $marambio) or die(mysql_error());
  
  $insertGoTo = "verQna.php?IdQna=".$_POST['IdQna'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

$query_tareasClientesList = "SELECT * FROM tareas WHERE IdTarea='$IdTarea' ORDER BY IdTarea DESC";
$tareasClientesList = mysql_query($query_tareasClientesList, $marambio) or die(mysql_error());
$row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);

$query_quincenasList = "SELECT IdQna, Quincena, Mes, Anno FROM quincenas WHERE activa = 1 ORDER BY CodificacionCompleta DESC";
$quincenasList = mysql_query($query_quincenasList, $marambio) or die(mysql_error());

?>
<?php include("includes/head.php"); ?>

  <p align="left" class="textotitulos">
  <div align="center">
  <p class="titulo">CARGAR HORAS</p>
  <p><a href="administracion.php" class="texto_btgris">&lt;&lt; Volver</a></p>
  <?php
	  $IdGrupoZZ=$row_tareasClientesList['IdGrupo'];
	  $IdEmpresaZZ=$row_tareasClientesList['IdEmpresa'];
	  
	  $query_verGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupoZZ'";
	  $verGrupo = mysql_query($query_verGrupo, $marambio) or die(mysql_error());
	  $row_verGrupo = mysql_fetch_assoc($verGrupo);
	  
	  $query_verEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$IdEmpresaZZ'";
	  $verEmpresa = mysql_query($query_verEmpresa, $marambio) or die(mysql_error());
	  $row_verEmpresa = mysql_fetch_assoc($verEmpresa);
	?>
        <form method="post" name="form1" action="">

          <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
            <tr valign="baseline">
              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Grupo: </td>
              <td class="texto_btgris"><?php echo $row_verGrupo['Nombre']; ?></td>
            </tr>
            <tr valign="baseline">
              <td width="134" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Empresa:</td>
              <td width="212"><div align="left" class="texto_btgris"><?php echo $row_verEmpresa['Nombre']; ?>
              </div></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tarea Cliente:</td>
              <td>		  <div align="left">
                <select name="tareaCliente" class="texto_btgris" id="tareaCliente">
                  <?php
                    $conta=0;
                    do {
                            $query_tarea_reg = "SELECT id_tarea_registrada FROM tareas_registradas WHERE id_qna = '$IdQna' AND tarea='".$row_tareasClientesList['IdTarea']."' AND id_empleado = '".$row_supervisor['IdUsuario']."'";
                            $tarea_reg = mysql_query($query_tarea_reg, $marambio) or die(mysql_error());
                            $row_tarea_reg = mysql_fetch_assoc($tarea_reg);
                            if(!$row_tarea_reg['id_tarea_registrada']){
                                    $conta++;
                    ?>
                    <option value="<?php echo $row_tareasClientesList['IdTarea']; ?>">
                    <?php 
                          echo $row_tareasClientesList['CodificacionComp']; 				
                          $query_servMostrar = "SELECT IdServicio, Servicio FROM servicios WHERE IdServicio = '".$row_tareasClientesList['IdServicio']."'";
                          $servMostrar = mysql_query($query_servMostrar, $marambio) or die(mysql_error());
                          $row_servMostrar = mysql_fetch_assoc($servMostrar);
                          echo " - " . $row_servMostrar['Servicio'] . " - " . $row_tareasClientesList['MesEjecucion']."/".$row_tareasClientesList['AnnoEjecucion'];
                    ?>
                    </option>
                    <?php
                            }
                    } while ($row_tareasClientesList = mysql_fetch_assoc($tareasClientesList));
                    ?>
                </select>
              </div></td>
            </tr>
            <tr>
                <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tarea Cliente:</td>
                <td>                   
                    <select name="IdQna" class="texto_btgris" id="IdQna">
                        <?php while ($row_quincenasList = mysql_fetch_assoc($quincenasList)){?>
                        <option value="<?=$row_quincenasList['IdQna']?>"><?=($row_quincenasList['Quincena']==1?'1era':'2da').' Quincena '.$row_quincenasList['Mes'].'-'.$row_quincenasList['Anno']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr><td nowrap bgcolor="#E5E5E5">&nbsp;</td><td>&nbsp;</td></tr>
            <tr valign="baseline">
              <td align="right" nowrap bgcolor="#E5E5E5">&nbsp;</td>
              <td><?php if($conta){ ?><input type="submit" class="texto_btgris" value="Insertar registro">          
              <input name="CodificacionComp" type="hidden" id="CodificacionComp2">
              <input name="IdUsuario" type="hidden" id="IdUsuario" value="<?php echo $row_supervisor['IdUsuario']; ?>">
              <input name="TipoTarea" type="hidden" id="TipoTarea" value="1"><?php } ?></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1">
        </form>
        </div>
        <p class="textotitulos">&nbsp;</p>
        </div></td>
      </tr>
    </table>
    <table width="100%" height="19" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bordergris">
      <tr>
        <td height="19"><div align="center"> </div></td>
      </tr>
  </table></td>
  </tr>
</table>
</body>
</html>
<?php
@mysql_free_result($quienEs);
@mysql_free_result($supervisor);
@mysql_free_result($tareasClientesList);
@mysql_free_result($servMostrar);
mysql_close($marambio);
?>