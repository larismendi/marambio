<?php require_once('Connections/marambio.php'); ?>
<?php
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 2){
	header ("Location: ../index.php"); 
}
mysql_select_db($database_marambio, $marambio);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table>
	<tr>
        <td width="100"></td>
    	<td>
            <table width="313" border="1" align="right" bordercolor="#E5E5E5">
                <tr><td class="texto_gris" colspan="4"  bgcolor="#EAF1FB"><strong>Seleccione la empresa para agregar tarea.</strong></td></tr>
                <tr>
                    <td width="170" class="texto_gris"><strong>Empresas</strong></td>
                    <td width="105" class="texto_gris"><strong>Agregar tarea</strong></td>
                </tr>
                <?php
                    $con_empres = "SELECT CodEmp, Nombre FROM empresas WHERE CodGrupo = '".$_GET['id']."'";
                    $e_empres = mysql_query($con_empres, $marambio) or die(mysql_error());
                    
                    while($f_empres = mysql_fetch_array($e_empres)){
                    
                ?>
                <tr>
                    <td height="26" class="texto_gris"><?php echo utf8_encode($f_empres['Nombre']); ?>&nbsp;&nbsp;&nbsp;</td>
                    <td align="center"><a href="agregarTareas.php?IdGrupo=<?php echo $_GET['id']; ?>&IdEmpresa=<?php echo $f_empres['CodEmp']; ?>"><img src="images/edit_on.jpg" alt="Detalles" width="22" height="22" border="0"></a></td>
                </tr>
                <?php
                    }
                ?>
            </table>
	  </td>
	</tr>
</table>
</body>
</html>