<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
	header ("Location: ../index.php"); 
}

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
	mysql_select_db($database_marambio, $marambio);
	
	if($rrr != $_POST['RIF'] && $rrr != ""){
		$sfs = "SELECT CodEmp FROM empresas WHERE rif='".$_POST['RIF']."'";
		$e_va = mysql_query($sfs, $marambio) or die(mysql_error());
		$vaar = mysql_fetch_array($e_va);
	}
	if(!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ,.-_]+$/i", $_POST['Nombre'])){
		$nopaso=true;
	}
	$vaar2 = "";
	if($nombre_viejo != $_POST['Nombre']){
		$sfs = "SELECT CodEmp FROM empresas WHERE Nombre LIKE '".$_POST['Nombre']."' ";
		$e_vaar2 = mysql_query($sfs, $marambio) or die(mysql_error());
		$vaar2 = mysql_fetch_array($e_vaar2);
	}
	
	if(!$vaar && !$vaar2 && !isset($nopaso)){
  		$updateSQL = sprintf("UPDATE empresas SET CodGrupo=%s, CodCont=%s, rif = %s, Nombre=%s, Direccion=%s, Telefonos=%s, Fax=%s, PersonaEnc=%s, email=%s WHERE CodEmp=%s",
                       GetSQLValueString($_POST['CodGrupo'], "int"),
					   GetSQLValueString($_POST['CodCont'], "text"),
                       GetSQLValueString($_POST['RIF'], "text"),
					   GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Telefonos'], "text"),
                       GetSQLValueString($_POST['Fax'], "text"),
                       GetSQLValueString($_POST['PersonaEnc'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['CodEmpresa2000'], "int"));
  
		$Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
		
		$updateGoTo = "empresas.php";
		if (isset($_SERVER['QUERY_STRING'])) {
		  $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		  $updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}else{
		if(!isset($nopaso))
			$mensaje = "El rif o el nombre ingresado corresponde a una empresa diferente ya existente. Intente con otro.";
		else
			$mensaje = "El Nombre solo admite letras, numeros, puntos, comas y guión.";
	}
}

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

$query_grupoList = "SELECT * FROM grupos ORDER BY Nombre ASC";
$grupoList = mysql_query($query_grupoList, $marambio) or die(mysql_error());
$row_grupoList = mysql_fetch_assoc($grupoList);
$totalRows_grupoList = mysql_num_rows($grupoList);

$colname_data = "1";
if (isset($_GET['CodEmp'])) {
  $colname_data = (get_magic_quotes_gpc()) ? $_GET['CodEmp'] : addslashes($_GET['CodEmp']);
}

$query_data = sprintf("SELECT * FROM empresas WHERE CodEmp = %s", $colname_data);
$data = mysql_query($query_data, $marambio) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

?>
<?php include("includes/head.php"); ?>
<script language="JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',_elRIF=/^[VEJG]+[-]+[0-9]+$/,args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { 
  		test=args[i+2]; 
		val=MM_findObj(args[i]);
    	if (val) { 
	  		nm=val.name; 
			if ((val=val.value)!="") {
				
				if (test.indexOf('isEmail')!=-1) { 
					p=val.indexOf('@');
					if (p<1 || p==(val.length-1)) 
						errors+='- '+nm+' debe contener un correo.\n';
				}else 
					if(nm == "RIF" && !_elRIF.test(val) ){
						errors+='- '+nm+' debe contener un RIF valido.\n';
					}else
						if (test!='R') { 
							num = parseFloat(val);
							if (isNaN(val)) 
								errors+='- '+nm+' debe contener un numero.\n';
							if (test.indexOf('inRange') != -1) { 
								p=test.indexOf(':');
								min=test.substring(8,p); max=test.substring(p+1);
								if (num<min || max<num) 
									errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
							} 
						} 
			} else 
				if (test.charAt(0) == 'R') 
					errors += '- '+nm+' es requerido.\n'; 
		}
	} 
	if (errors) 
		alert('Los siguientes errores se han presentado:\n'+errors);
	document.MM_returnValue = (errors == '');
	
}
//-->
</script>
<script language="JavaScript" src="mascara.js"></script>
<script language="JavaScript" src="validar_inputs.js"></script>
<script type="text/javascript" src="autoComplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("autoComplete/con_empresas.php", {queryString: ""+inputString+""}, function(data){
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
<link href="autoComplete/estilo_auto.css" rel="stylesheet" type="text/css">
                <p align="left" class="textotitulos">&nbsp;</p>
                <p align="center" class="titulo">EMPRESAS</p>
                <p align="center" class="textotitulos"><a href="empresas.php" class="texto_btgris">&lt;&lt; Volver </a></p>
                <p align="center" class="textotitulos">
                <form action="" method="POST" name="form1" onSubmit="MM_validateForm('CodCont','','R','Nombre','','R', 'email','','NisEmail','RIF','','R');return document.MM_returnValue">
                <input type="hidden" name="rrr" value="<?php echo $row_data['rif']; ?>">
                <input type="hidden" name="nombre_viejo" value="<?php echo $row_data['Nombre']; ?>">
                <table>
                	<tr>
                    	<td width="200">&nbsp;</td>
                        <td valign="top">
                          <table border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#E5E5E5">
                            <tr valign="baseline">
                              <td width="125" align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo:</td>
                              <td width="297" class="texto_btgris"><?php echo $row_data['CodEmp']; ?></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Grupo:</td>
                              <td><select name="CodGrupo" class="texto_gris" id="CodGrupo">
                                <?php
                                do {  
                                ?>
                                <option value="<?php echo $row_grupoList['IdGrupo']?>"<?php if (!(strcmp($row_grupoList['IdGrupo'], $row_data['CodGrupo']))) {echo "SELECTED";} ?>><?php echo $row_grupoList['Nombre']?></option>
                                <?php
                                } while ($row_grupoList = mysql_fetch_assoc($grupoList));
                                  $rows = mysql_num_rows($grupoList);
                                  if($rows > 0) {
                                      mysql_data_seek($grupoList, 0);
                                      $row_grupoList = mysql_fetch_assoc($grupoList);
                                  }
                                ?>
                              </select></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">C&oacute;digo de Grupo: </td>
                              <td><input name="CodCont" type="text" class="texto_gris" id="CodCont" value="<?php echo $row_data['CodCont']; ?>"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Nombre:</td>
                              <td><input name="Nombre" type="text" class="texto_gris" value="<?php echo $row_data['Nombre']; ?>" size="32" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">RIF:</td>
                              <td><input name="RIF" type="text" class="texto_gris" value="<?php echo $row_data['rif']; ?>" size="32" onKeyPress="return(formato_campo(this,event,12))" onKeyDown="return mascara(this,'rif')" onBlur="this.value=this.value.toUpperCase()"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" valign="top" nowrap bgcolor="#E5E5E5" class="texto_btgris">Direcci&oacute;n:</td>
                              <td>
                                <textarea name="Direccion" cols="45" rows="3" class="texto_gris"><?php echo $row_data['Direccion']; ?></textarea>
                              </td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Tel&eacute;fonos:</td>
                              <td><input name="Telefonos" type="text" class="texto_gris" value="<?php echo $row_data['Telefonos']; ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Fax:</td>
                              <td><input name="Fax" type="text" class="texto_gris" value="<?php echo $row_data['Fax']; ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Persona Encargada:</td>
                              <td><input name="PersonaEnc" type="text" class="texto_gris" value="<?php echo $row_data['PersonaEnc']; ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">Email:</td>
                              <td><input name="email" type="text" class="texto_gris" value="<?php echo $row_data['email']; ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline">
                              <td align="right" nowrap bgcolor="#E5E5E5" class="texto_btgris">&nbsp;</td>
                              <td><input type="submit" class="texto_btgris" value="Guardar &gt;&gt;">
                                <input name="CodEmpresa2000" type="hidden" id="CodEmpresa2000" value="<?php echo $row_data['CodEmp']; ?>"></td>
                            </tr>
                          </table>
              			</td>
                        <td width="200">
                        	<div class="suggestionsBox" id="suggestions" style="display: none;">
                                  <div class="suggestionList" id="autoSuggestionsList">
                                      &nbsp;
                                  </div>
                            </div>
                        </td>
              		</tr>
                </table>
              <input type="hidden" name="MM_update" value="form1">
            </form></p>
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
<script>
var mensaje = "<?php echo $mensaje; ?>";
if(mensaje){
	alert("<?php echo $mensaje; ?>");
}
</script>
</body>
</html>
<?php
@mysql_free_result($quienEs);
@mysql_free_result($supervisor);
@mysql_free_result($grupoList);
@mysql_free_result($data);
mysql_close($marambio);
?>
