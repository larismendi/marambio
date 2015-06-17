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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$CodificacionCompleta2000=$_POST['IdUsuario'] . $_POST['Quincena'] . $_POST['Mes'] . $_POST['Anno'];
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO quincenas (Quincena, Mes, Anno, CodificacionCompleta) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Quincena'], "int"),
                       GetSQLValueString($_POST['Mes'], "text"),
                       GetSQLValueString($_POST['Anno'], "text"),
					   GetSQLValueString($_POST['Anno'], "text"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());

  $insertGoTo = "hojadeTiempo.php";
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
$totalRows_quienEs = mysql_num_rows($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];


$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
$totalRows_supervisor = mysql_num_rows($supervisor);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>..:: MARAMBIO ::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo_scroll.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style>
<link href="estilos_admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {color: #000000}
.Estilo4 {color: #003366; font-weight: bold; }
-->
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" height="34"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top" class="textoazul Estilo1">Bienvenido: <?php echo $row_supervisor['Nombre']; ?><br>
          </td>
      </tr>
    </table>
      <table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="145" valign="top" ><table width="145" height="330" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="163" valign="top"><div align="center">
                  <table width="100%"  border="1" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#99CCFF" class="textogrande"><div align="left"><strong>Clientes</strong></div></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"> <a href="grupos.php" class="textogrande">&nbsp;&nbsp;* Grupos</a> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"> <a href="empresas.php" class="textogrande">&nbsp;&nbsp;* Empresas</a> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#99CCFF" class="textogrande"><div align="left"><strong>Marambio</strong></div></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"> <a href="unidades.php" class="textogrande">&nbsp;&nbsp;* Unidades</a> </td>
                    </tr>
                    
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"><a href="tasas.php" class="textogrande">&nbsp;&nbsp;* Tasas </a> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"><a href="rrhh.php" class="textogrande">&nbsp;&nbsp;* RRHH </a></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande">&nbsp;&nbsp;* <a href="tareas.php" class="textogrande">Tareas </a></td>
                    </tr>
                    <tr>
                      <td bgcolor="#99CCFF" class="textogrande"><span class="Estilo4">Mis Procesos</span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande">&nbsp;&nbsp;* <a href="hojadeTiempo.php" class="textogrande">Hoja de Tiempo</a> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#99CCFF" class="textogrande"><span class="Estilo4">Aprobar Tiempo </span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande">&nbsp;&nbsp;* <a href="hojadeTiempoOtros.php" class="textogrande">Ver Tiempo - Aprobar</a> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#99CCFF" class="textogrande"><span class="Estilo4">Reportes</span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"> &nbsp;&nbsp;* <a href="tiempoxProyecto.php" class="textogrande">Tiempo por Proyecto</a> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"><span class="xl24">&nbsp;&nbsp;* <a href="tiempoxQnaxEmpleado.php" class="textogrande">Empleado x Qna </a></span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"><span class="xl22">&nbsp;&nbsp;* <a href="aistentedeProyectosHistorico.php" class="textogrande">Asistente de Proyectos</a></span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#EAF1FB" class="textogrande"><a href="rrhh.php" class="textogrande">&nbsp;</a></td>
                    </tr>
                  </table>
              </div></td>
            </tr>
          </table></td>
          <td width="762" valign="top"><div align="center">
            <p class="textotitulos">HOJA DE TIEMPO        </p>
            <form method="post" name="form1" action="">
              <table align="center">
                <tr valign="baseline">
                  <td width="54" align="right" nowrap bgcolor="#EAF1FB" class="textoazul">Quincena</td>
                  <td width="169"><select name="Quincena" id="Quincena">
                    <option value="1">Primera</option>
                    <option value="2">Segunda</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="textoazul">Mes:</td>
                  <td><select name="Mes" id="Mes">
				  <option value="<?php echo date("m"); ?>"><?php echo date("m"); ?></option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="textoazul">A&ntilde;o:</td>
                  <td><select name="Anno" id="Anno">
				  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                    <option value="2006">2006</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#EAF1FB" class="textoazul">&nbsp;</td>
                  <td bgcolor="#EAF1FB"><input type="submit" value="Insertar Quincena">                    </td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form1">
            </form>
            <p>&nbsp;</p>
          </div></td>
        </tr>
      </table>
      <table width="100%" height="25" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bordergris">
        <tr>
          <td><div align="center"> </div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
@mysql_free_result($quienEs);

@mysql_free_result($supervisor);

mysql_close($marambio);
?>
