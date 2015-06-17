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
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);

$query_tareasClientesList = "SELECT * FROM tareas WHERE /*activo = 1 AND*/ IdEmpresa='$IdEmpresa' ORDER BY IdTarea DESC";
$tareasClientesList = mysql_query($query_tareasClientesList, $marambio) or die(mysql_error());
$row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);
?>
<?php include("includes/head.php"); ?>
                <p align="left" class="textotitulos">
			  <div align="center">
  <p class="titulo">ESTADISTICAS</p>
  <p><a href="estadisticas.php?IdQna=<?php echo $IdQna; ?>" class="texto_btgris">&lt;&lt; Volver</a></p>
  
    <form method="get" name="form1" action="estadisticas3.php">
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
      <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Grupo:</td>
          <td class="texto_btgris"><? echo $row_verGrupo['Nombre']; ?></td>
        </tr>
        <tr valign="baseline">
          <td width="134" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Empresa:</td>
          <td width="212"><div align="left" class="texto_btgris"><?php echo $row_verEmpresa['Nombre']; ?>
          </div></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tarea Cliente:</td>
          <td>		  <div align="left">
            <select name="IdTarea" class="texto_btgris" id="IdTarea">
              <?php
do {  
?>
              <option value="<?php echo $row_tareasClientesList['IdTarea']?>">
			  <?php 
              
			  	echo $row_tareasClientesList['CodificacionComp']; 
				$IdServicioHH=$row_tareasClientesList['IdServicio']; 
			  	
				$query_servMostrar = "SELECT IdServicio, Servicio FROM servicios WHERE IdServicio = '$IdServicioHH'";
				$servMostrar = mysql_query($query_servMostrar, $marambio) or die(mysql_error());
				$row_servMostrar = mysql_fetch_assoc($servMostrar);
				echo " - " . $row_servMostrar['Servicio'];
			  ?>
			  </option>
              <?php
} while ($row_tareasClientesList = mysql_fetch_assoc($tareasClientesList));
  $rows = mysql_num_rows($tareasClientesList);
  if($rows > 0) {
      mysql_data_seek($tareasClientesList, 0);
	  $row_tareasClientesList = mysql_fetch_assoc($tareasClientesList);
  }
?>
            </select>
          </div></td>
        </tr>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==1) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php if($UDia>=29) { ?>
		<?php } ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php if($UDia>=30) { ?>
		<?php } ?>
		<?php } ?>
		<?php if($Qna==2) { ?>
		<?php if($UDia>=31) { ?>
		<?php } ?>
		<?php } ?>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#E5E5E5">&nbsp;</td>
          <td><input type="submit" class="texto_btgris" value="Ver Estadisticas &gt;&gt;">
            <input name="IdEmpresa" type="hidden" id="IdEmpresa" value="<?php echo $IdEmpresa; ?>"></td>
        </tr>
      </table>
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