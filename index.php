<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$_SESSION['tt'] = 00;
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
?>
<?php
if (isset($_POST['Usuario'])) {
	$usuario3500=$_POST['Usuario'];
	$pass3500=$_POST['Pass'];
	mysql_select_db($database_marambio, $marambio);
	$query_quien = "SELECT * FROM usuarios WHERE Usuario = '".mysql_real_escape_string($usuario3500)."' AND Pass='".mysql_real_escape_string($pass3500)."'";
	$quien = mysql_query($query_quien, $marambio) or die(mysql_error());
	$row_quien = mysql_fetch_assoc($quien);
	$totalRows_quien = mysql_num_rows($quien);
	
	if($totalRows_quien>=1) {

   		$IdUsuario2000=$row_quien['IdUsuario'];
   		$FDia2000=date("d");
   		$FMes2000=date("m");
   		$FAnno2000=date("Y");
   		$FEspanol2000=date("d/m/Y");
   		$FIngles2000=date("Ymd");
		$ip2000=$_POST['ip'];
		$nivel2000=$row_quien['Nivel'];
   
   		$insertSQL = sprintf("INSERT INTO sessiones (session2000, IdUsuario, FDia, FMes, Fanno, FEspanol, FIngles, ip, nivel) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($sessionid, "text"),
                       GetSQLValueString($IdUsuario2000, "int"),
					   GetSQLValueString($FDia2000, "text"),
					   GetSQLValueString($FMes2000, "text"),
					   GetSQLValueString($FAnno2000, "text"),
					   GetSQLValueString($FEspanol2000, "text"),
					   GetSQLValueString($FIngles2000, "text"),
					   GetSQLValueString($ip2000, "text"),
					   GetSQLValueString($nivel2000, "int"));

  		//mysql_select_db($database_marambio, $marambio);
  		$Result1 = mysql_query($insertSQL, $marambio) or die(mysql_error());
		
		if($nivel2000==1) { 
			$_SESSION['tt'] = 1;
			header ("Location: 1/administracion.php"); 
		} elseif($nivel2000==2) {
			$_SESSION['tt'] = 2;
			header ("Location: 2/administracion.php"); 
		} elseif($nivel2000==3) {
			$_SESSION['tt'] = 3;
			header ("Location: 3/administracion.php"); 
		} elseif($nivel2000==4) {
			$_SESSION['tt'] = 4;
			header ("Location: 4/administracion.php"); 
		} elseif($nivel2000==5) {
			$_SESSION['tt'] = 5;
			header ("Location: 5/administracion.php"); 
		}
		

  }
  
}
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
<title>Reporte del Tiempo Versi&oacute;n 3.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<link href="1/stylos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo2 {
	color: #000000;
	font-weight: bold;
}
.Estilo3 {color: #000000}
-->
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" height="34"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="103%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
          <tr>
            <td width="760" height="49" background="1/imagenes/pixel_azul.jpg" bgcolor="#ADC3DB"><table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right" class="texto_blanco">Reporte del Tiempo Versi&oacute;n 3.0 </td>
                  <td align="right" class="texto_blanco">&nbsp;</td>
                </tr>
            </table></td>
            <td width="132" bgcolor="#F0F0F0"><div align="center"><img src="1/imagenes/logo.jpg" width="48" height="39" /></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
      <table width="100%" height="28"  border="0" cellpadding="0" cellspacing="0" background="images/fond_bot.gif">
        <tr>
          <td><table width="760"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="167">&nbsp;</td>
              <td width="386">&nbsp;</td>
              <td width="207" align="center" valign="middle" class="fecha"><div align="left" class="fecha">
  </div>
                <div align="left"></div></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="166" valign="top" background="images/fon_botonera.gif"><table width="166" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="76%" valign="top"><table width="85%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><div align="center"></div>                    
                    <div align="center" class="textotitulos"><span class="titulo">ADMIN</span><br>
                      <br>
                    </div></td>
                  </tr>
              </table>
                <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><table width="399" height="227" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                      <tr>
                        <td bgcolor="#B2C3DF"><form name="form1" method="POST">
                          <table width="67%" border="0" align="center" cellpadding="0" cellspacing="2">
                            <tr>
                              <td colspan="2" class="textoblanco"><div align="center" class="texto_btgris Estilo3"><strong>A continuaci&oacute;n Ingrese sus datos de acceso:</strong></div></td>
                            </tr>
                            <tr>
                              <td width="36%">&nbsp;</td>
                              <td width="64%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="texto_btgris"><div align="right" class="Estilo2">Usuario: </div></td>
                              <td>
                                <input name="Usuario" type="text" class="texto_gris" id="Usuario" size="15">
                              </td>
                            </tr>
                            <tr>
                              <td class="texto_btgris"><div align="right" class="textoblanco Estilo3"><strong>Contrase&ntilde;a:</strong></div></td>
                              <td><input name="Pass" type="password" class="texto_gris" id="Pass" size="15"></td>
                            </tr>
                            <tr>
                              <td class="texto_btgris">&nbsp;</td>
                              <td>
                                <input name="Submit" type="submit" class="texto_btgris" value="Ingresar">
								<?php

if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) != "") { 
    $ipFinal=" 
    Se conecto tras un PROXY.<br> 
    Su IP real es: $_SERVER[HTTP_X_FORWARDED_FOR]<br> 
    La ip de su proxy es: $_SERVER[REMOTE_ADDR] 
    "; 
} 

else { $ipFinal="Su IP es: $_SERVER[REMOTE_ADDR]"; } 

?>
                                <input name="ip" type="hidden" id="ip" value="<? echo $ipFinal; ?>">
                              </td>
                            </tr>
                          </table>
                          <table width="65%" height="25" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td class="textoblanco"><div align="center"></div></td>
                            </tr>
                          </table>
                        </form></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              <td width="24%" valign="top"><table width="175" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
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


