<?php require_once('Connections/marambio.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
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

$CodGrupoXX=$row_data['IdGrupo'];

$query_empresasList = "SELECT CodEmp, Nombre FROM empresas WHERE nombre LIKE '%$palabra%' ORDER BY Nombre ASC";
$empresasList = mysql_query($query_empresasList, $marambio) or die(mysql_error());
$row_empresasList = mysql_fetch_assoc($empresasList);
$totalRows_empresasList = mysql_num_rows($empresasList);

$maxRows_ofact = 10;
$pageNum_ofact = 0;
if (isset($_GET['pageNum_ofact'])) {
  $pageNum_ofact = $_GET['pageNum_ofact'];
}
$startRow_ofact = $pageNum_ofact * $maxRows_ofact;

$query_ofact = "SELECT * FROM orden_fact ORDER BY idOP DESC";
$query_limit_ofact = sprintf("%s LIMIT %d, %d", $query_ofact, $startRow_ofact, $maxRows_ofact);
$ofact = mysql_query($query_limit_ofact, $marambio) or die(mysql_error());
$row_ofact = mysql_fetch_assoc($ofact);

if (isset($_GET['totalRows_ofact'])) {
  $totalRows_ofact = $_GET['totalRows_ofact'];
} else {
  $all_ofact = mysql_query($query_ofact);
  $totalRows_ofact = mysql_num_rows($all_ofact);
}
$totalPages_ofact = ceil($totalRows_ofact/$maxRows_ofact)-1;

$queryString_ofact = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ofact") == false && 
        stristr($param, "totalRows_ofact") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ofact = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ofact = sprintf("&totalRows_ofact=%d%s", $totalRows_ofact, $queryString_ofact);

?>

<?php include("includes/head.php");?>
                <p align="center" class="titulo"><br>
                ORDEN DE FACTURACION</p>
                <form name="form2" method="get" action="o_fact.php">
                  <span class="texto_btgris">Ingrese la palabra clave para buscar un cliente y agregar nueva orden:</span> <br>
                  <input name="palabra" type="text" class="texto_gris" id="palabra" size="10">
                  <input name="Submit3" type="submit" class="texto_gris" value="&gt;&gt;">
                  <input name="IdQna" type="hidden" id="IdQna" value="<? echo $IdQna; ?>">
                </form>
                <?php if($palabra!='') { ?>
                <form name="form2" method="get" action="o_fact2.php">
                  <span class="texto_btgris">Seleccione el Cliente para realizar la Orden de Facturaci&oacute;n:</span><br>
                  <select name="IdEmpresa" class="texto_gris" id="IdEmpresa">
                    <option value="0">Seleccione</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_empresasList['CodEmp']?>"><?php echo $row_empresasList['Nombre']?></option>
                    <?php
} while ($row_empresasList = mysql_fetch_assoc($empresasList));
  $rows = mysql_num_rows($empresasList);
  if($rows > 0) {
      mysql_data_seek($empresasList, 0);
	  $row_empresasList = mysql_fetch_assoc($empresasList);
  }
?>
                  </select>
                  <input name="Submit2" type="submit" class="texto_gris" value="&gt;&gt;">
              </form>
                <?php } ?>
                <form name="form1" id="form1" method="post" action="fact_pdf_generate.php" target="_blank">
                <table width="71%"  border="0" cellspacing="0" cellpadding="0">
                  <tr bgcolor="#ADC3DB" class="texto_btgris">
                    <td width="14%"><div align="center">Orden</div></td>
                    <td width="14%"><div align="center">Fecha</div></td>
                    <td width="41%"><div align="center">Empresa</div></td>
                    <td width="9%"><div align="center">Ver</div></td>
                    <td width="14%"><div align="center">Exportar</div></td>
                    <td width="8%"><div align="center">Eliminar</div></td>
                    <td width="16%"><div align="center">Generar WORD</div></td>
                  </tr>
                  <?php 
				  		$r = 0;
				  		do { ?>
                  <tr>
                    <td class="texto_btgris"><div align="center"><?php echo $row_ofact['idOP']; ?></div></td>
                    <td class="texto_btgris"><div align="center"><?php echo $row_ofact['fechaEsp']; ?></div></td>
                    <td class="texto_btgris">
					<?php 
					$CodEmp2000=$row_ofact['IdEmpresa']; 
					mysql_select_db($database_marambio, $marambio);
					$query_empre = "SELECT * FROM empresas WHERE CodEmp = '$CodEmp2000'";
					$empre = mysql_query($query_empre, $marambio) or die(mysql_error());
					$row_empre = mysql_fetch_assoc($empre);
					$totalRows_empre = mysql_num_rows($empre);
					echo $row_empre['Nombre'];
					?>					</td>
                    <td><div align="center"><a href="o_fact3.php?idOP=<?php echo $row_ofact['idOP']; ?>" target="_blank"><img src="images/bot_verdetalle.gif" width="38" height="36" border="0"></a></div></td>
                    <td><div align="center"><a href="fact_word.php?idOP=<?php echo $row_ofact['idOP']; ?>"><img src="images/icono-word.jpg" width="34" height="35" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="fact_pdf.php?idOP=<?php echo $row_ofact['idOP']; ?>" target="_blank"><img src="images/pdf.jpg" width="34" height="35" border="0"></a></div></td>
                    <td><div align="center"><a href="eiliminar_o_fact3.php?idOP=<?php echo $row_ofact['idOP']; ?>"><img src="images/elim_on.jpg" width="34" height="35" border="0"></a></div></td>
                    <td><div align="center"><input type="checkbox" name="c[<?php echo $r; ?>]" value="<?php echo $row_ofact['idOP']; ?>" checked></div></td>
                  </tr>
                  <?php 
				  		$r++;
				  		} while ( $row_ofact = mysql_fetch_assoc($ofact) ); ?>
                  <tr><td colspan="6"><td align="center"><input type="submit" name="generar" value="Generar"></td></tr>
                </table>
                <input type="hidden" name="MM_insert_o" value="form1">
                </form>
              <p>
              <table border="0" width="50%" align="center">
                <tr>
                  <td width="23%" align="center">
                    <?php if ($pageNum_ofact > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_ofact=%d%s", $currentPage, 0, $queryString_ofact); ?>" class="texto_gris">Primero</a>
                  <?php } // Show if not first page ?>                  </td>
                  <td width="31%" align="center">
                    <?php if ($pageNum_ofact > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_ofact=%d%s", $currentPage, max(0, $pageNum_ofact - 1), $queryString_ofact); ?>" class="texto_gris">Anterior</a>
                  <?php } // Show if not first page ?>                  </td>
                  <td width="23%" align="center">
                    <?php if ($pageNum_ofact < $totalPages_ofact) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_ofact=%d%s", $currentPage, min($totalPages_ofact, $pageNum_ofact + 1), $queryString_ofact); ?>" class="texto_gris">Siguiente</a>
                  <?php } // Show if not last page ?>                  </td>
                  <td width="23%" align="center">
                    <?php if ($pageNum_ofact < $totalPages_ofact) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_ofact=%d%s", $currentPage, $totalPages_ofact, $queryString_ofact); ?>" class="texto_gris">&Uacute;ltimo</a>
                  <?php } // Show if not last page ?>                  </td>
                </tr>
              </table>
              </p>
              <br>
              <span class="texto_gris">&nbsp; Registros <strong><?php echo ($startRow_ofact + 1) ?></strong> a <strong><?php echo min($startRow_ofact + $maxRows_ofact, $totalRows_ofact) ?></strong> de <strong><?php echo $totalRows_ofact ?></strong></span>
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

@mysql_free_result($ofact);

@mysql_free_result($empre);

mysql_close($marambio);
?>