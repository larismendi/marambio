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
$currentPage = $_SERVER["PHP_SELF"];
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

include("includes/head.php");
?>
                <p align="center" class="titulo"><br>
                ESTADISTICAS</p>
                <form name="form2" method="get" action="estadisticas.php">
                  <span class="texto_btgris">Ingrese la palabra clave para buscar al Cliente:</span> <br>
                  <input name="palabra" type="text" class="texto_gris" id="palabra" size="10">
                  <input name="Submit3" type="submit" class="texto_gris" value="&gt;&gt;">
                  <input name="IdQna" type="hidden" id="IdQna" value="<? echo $IdQna; ?>">
              </form>
                <? if($palabra!='') { ?>
                <form name="form2" method="get" action="estadisticas2.php">
                  <span class="texto_btgris">Seleccione el Cliente para ver sus Tareas:</span><br>
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
                <? } ?></div></td>
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