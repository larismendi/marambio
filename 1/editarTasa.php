<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 1){
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
  $updateSQL = sprintf("UPDATE tasas SET CodCont=%s, Nombre=%s, Monto=%s WHERE IdTasa=%s",
  					   GetSQLValueString($_POST['CodCont'], "text"),
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Monto'], "double"),
                       GetSQLValueString($_POST['IdTasa'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());

  $updateGoTo = "tasas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

$colname_data = "1";
if (isset($_GET['IdTasa'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['IdTasa'] : addslashes($_GET['IdTasa']);
}

$query_data = sprintf("SELECT * FROM tasas WHERE IdTasa = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<STYLE type=text/css>
A:hover {
	COLOR: #AFC4DF
}
BODY {
	SCROLLBAR-FACE-COLOR: #FFFFFF; SCROLLBAR-HIGHLIGHT-COLOR: #AFC4DF; SCROLLBAR-SHADOW-COLOR: #FCEA9A; SCROLLBAR-ARROW-COLOR: #AFC4DF; SCROLLBAR-BASE-COLOR: #FCEA9A; scrollbar-3d-light-color: #AFC4DF; scrollbar-dark-shadow-color: #FFFFFF
}
</STYLE>
<title>Reporte del Tiempo Versi&oacute;n 1.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="stylos.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0704161327_0) return;
  window.mm_menu_0704161327_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704161327_0.addMenuItem("Grupos","location='grupos.php'");
  mm_menu_0704161327_0.addMenuItem("Empresas","location='empresas.php'");
   mm_menu_0704161327_0.hideOnMouseOut=true;
   mm_menu_0704161327_0.bgColor='#555555';
   mm_menu_0704161327_0.menuBorder=0;
   mm_menu_0704161327_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704161327_0.menuBorderBgColor='#777777';

  window.mm_menu_0704161423_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704161423_0.addMenuItem("Unidades","location='unidades.php'");
  mm_menu_0704161423_0.addMenuItem("Servicios","location='servicios.php'");
  mm_menu_0704161423_0.addMenuItem("Administrativas","location='administrativas.php'");
  mm_menu_0704161423_0.addMenuItem("Tasas","location='tasas.php'");
  mm_menu_0704161423_0.addMenuItem("RRHH","location='rrhh.php'");
  mm_menu_0704161423_0.addMenuItem("Feriados","location='feriados.php'");
  mm_menu_0704161423_0.addMenuItem("Quincenas","location='quincenas.php'");
  mm_menu_0704161423_0.addMenuItem("Tareas","location='tareas.php'");
mm_menu_0704161423_0.addMenuItem("Orden de Fact","location='o_fact.php'");
mm_menu_0704161423_0.addMenuItem("Estad&iacute;sticas","location='estadisticas.php'");
   mm_menu_0704161423_0.hideOnMouseOut=true;
   mm_menu_0704161423_0.bgColor='#555555';
   mm_menu_0704161423_0.menuBorder=0;
   mm_menu_0704161423_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704161423_0.menuBorderBgColor='#777777';

  window.mm_menu_0704162558_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704162558_0.addMenuItem("Hoja&nbsp;de&nbsp;Tiempo","location='hojadeTiempo.php'");
   mm_menu_0704162558_0.hideOnMouseOut=true;
   mm_menu_0704162558_0.bgColor='#555555';
   mm_menu_0704162558_0.menuBorder=0;
   mm_menu_0704162558_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704162558_0.menuBorderBgColor='#777777';

  window.mm_menu_0704163337_0 = new Menu("root",102,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704163337_0.addMenuItem("Ver&nbsp;Tiempo","location='hojadeTiempoOtros.php'");
   mm_menu_0704163337_0.hideOnMouseOut=true;
   mm_menu_0704163337_0.bgColor='#555555';
   mm_menu_0704163337_0.menuBorder=0;
   mm_menu_0704163337_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704163337_0.menuBorderBgColor='#777777';

  window.mm_menu_0704163728_0 = new Menu("root",125,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0704163728_0.addMenuItem("Tiempo&nbsp;por&nbsp;Proyecto","location='tiempoxProyecto.php'");
  mm_menu_0704163728_0.addMenuItem("Tiempo&nbsp;por&nbsp;Empleado","location='tiempoxQnaxEmpleado.php'");
  mm_menu_0704163728_0.addMenuItem("Asistente&nbsp;de&nbsp;Proyectos","location='aistentedeProyectos.php'");
  mm_menu_0704163728_0.addMenuItem("Proyectos L&iacute;der","location='ProyectosLider.php'");
   mm_menu_0704163728_0.hideOnMouseOut=true;
   mm_menu_0704163728_0.bgColor='#555555';
   mm_menu_0704163728_0.menuBorder=0;
   mm_menu_0704163728_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704163728_0.menuBorderBgColor='#777777';
   
   window.mm_menu_0704163729_0 = new Menu("root",125,18,"Arial, Helvetica, sans-serif",11,"#333333","#333333","#E5E5E5","#CCCCCC","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
   mm_menu_0704163729_0.addMenuItem("Proyectos","location='ProyectosHistorico.php'");
   mm_menu_0704163729_0.hideOnMouseOut=true;
   mm_menu_0704163729_0.bgColor='#555555';
   mm_menu_0704163729_0.menuBorder=0;
   mm_menu_0704163729_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0704163729_0.menuBorderBgColor='#777777';

mm_menu_0704163728_0.writeMenus();
} // mmLoadMenus()

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener un correo.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' debe contener un numero.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
  } if (errors) alert('Los siguientes errores se han presentado:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" height="128"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="128" valign="top" class="textoazul Estilo1"><table width="103%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
              <tr>
                <td width="760" height="49" background="imagenes/pixel_azul.jpg" bgcolor="#ADC3DB"><table border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="right" class="texto_blanco">Reporte del Tiempo Versi&oacute;n 1.0 </td>
                      <td align="right" class="texto_blanco">&nbsp;</td>
                    </tr>
                </table></td>
                <td width="132" bgcolor="#F0F0F0"><div align="center"><img src="imagenes/logo.jpg" width="48" height="39" /></div></td>
              </tr>
              <tr valign="top">
                <td height="32" colspan="2" class="titulo">
                  <table width="100%" height="30" border="0" align="left" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5" bgcolor="#E5E5E5">
                    <tr>
                      <td width="946" align="right" bgcolor="#FFFFFF" class="texto_gris"><div align="left">&nbsp;Bienvenido: <span class="texto_btgris"><?php echo $row_supervisor['Nombre']; ?></span> &nbsp;<br>
&nbsp;Cargo:&nbsp;&nbsp;<span class="texto_btgris"><?php echo $row_supervisor['Cargo']; ?></span> - &nbsp;Nivel:&nbsp;&nbsp;&nbsp; <span class="texto_btgris"><?php echo $row_supervisor['Nivel']; ?></span></div></td>
                      <td width="164" align="right" bgcolor="#F0F0F0" class="texto_gris"><div align="left"><a href="deslogear.php" class="texto_gris"> Salir &gt;&gt;<br>
                        </a>
					      <a href="../manual/completa.php" target="_blank" class="texto_gris">Ayuda &gt;&gt;</a><br>
                          </div></td>
                    </tr>
                </table></td>
              </tr>
              <tr bgcolor="#E5E5E5">
                <td height="28" colspan="2" valign="middle" class="titulo"><table width="61" height="26"  border="0">
                    <tr>
                      <td width="21%" bgcolor="#FFFFFF"><img src="images/cliente.gif" name="cliente" width="100" height="20" border="0" usemap="#cliente" id="cliente" onMouseOver="MM_showMenu(window.mm_menu_0704161327_0,0,22,null,'cliente')" onMouseOut="MM_startTimeout();"></td>
                      <td width="57%" bgcolor="#FFFFFF"><img src="images/marambio.gif" name="marambio" width="100" height="20" id="marambio" onMouseOver="MM_showMenu(window.mm_menu_0704161423_0,0,22,null,'marambio')" onMouseOut="MM_startTimeout();"></td>
                      <td width="7%" bgcolor="#FFFFFF"><img src="images/misProcesos.gif" name="misprocesos" width="100" height="20" id="misprocesos" onMouseOver="MM_showMenu(window.mm_menu_0704162558_0,0,20,null,'misprocesos')" onMouseOut="MM_startTimeout();"></td>
                      <td width="7%" bgcolor="#FFFFFF"><img src="images/aprobarTiempo.gif" name="tiempo" width="100" height="20" id="tiempo" onMouseOver="MM_showMenu(window.mm_menu_0704163337_0,0,20,null,'tiempo')" onMouseOut="MM_startTimeout();"></td>
                      <td width="8%" bgcolor="#FFFFFF"><img src="images/reportes.gif" name="reportes" width="100" height="20" id="reportes" onMouseOver="MM_showMenu(window.mm_menu_0704163728_0,0,20,null,'reportes')" onMouseOut="MM_startTimeout();"></td>
                      <td width="8%" bgcolor="#FFFFFF"><img src="images/historico.gif" name="historico" width="100" height="20" id="historico" onMouseOver="MM_showMenu(window.mm_menu_0704163729_0,103,20,null,'reportes')" onMouseOut="MM_startTimeout();"></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="392" valign="top" ><div align="center">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p class="titulo">TASAS</p>
                <p><a href="tasas.php" class="texto_btgris">&lt;&lt; Volver</a></p>
                <form action="" method="POST" name="form1" onSubmit="MM_validateForm('CodCont','','R','Nombre','','R','Monto','','R');return document.MM_returnValue">
                  <table width="400" align="center">
                    <tr valign="baseline">
                      <td width="74" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo:</td>
                      <td width="181" class="texto_btgris"><?php echo $row_data['IdTasa']; ?></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo Contable: </td>
                      <td><input name="CodCont" type="text" class="texto_gris" value="<?php echo $row_data['CodCont']; ?>" size="45"></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                      <td><input name="Nombre" type="text" class="texto_gris" value="<?php echo $row_data['Nombre']; ?>" size="45"></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Monto:</td>
                      <td><input name="Monto" type="text" class="texto_gris" value="<?php echo $row_data['Monto']; ?>" size="15"></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                      <td bgcolor="#FFFFFF"><input name="submit" type="submit" class="texto_btgris" value="Guardar &gt;&gt;">
                          <input name="IdTasa" type="hidden" id="IdTasa" value="<?php echo $row_data['IdTasa']; ?>"></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_update" value="form1">
              </form>
                <p>&nbsp;</p>
                <p></p>
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
