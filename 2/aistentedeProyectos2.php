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
$colname_proyectoMostar = "1";
if (isset($_GET['proyectoX'])) {
  $colname_proyectoMostar = (get_magic_quotes_gpc()) ? $_GET['proyectoX'] : addslashes($_GET['proyectoX']);
}
mysql_select_db($database_marambio, $marambio);
$query_proyectoMostar = sprintf("SELECT * FROM tareas WHERE IdTarea = %s", $colname_proyectoMostar);
$proyectoMostar = mysql_query($query_proyectoMostar, $marambio) or die(mysql_error());
$row_proyectoMostar = mysql_fetch_assoc($proyectoMostar);
$totalRows_proyectoMostar = mysql_num_rows($proyectoMostar);

$IdTarea7000=$row_proyectoMostar['IdTarea'];
$query_SubT = "SELECT * FROM quincenasub WHERE CodificacionComp = '$IdTarea7000'";
$SubT = mysql_query($query_SubT, $marambio) or die(mysql_error());
$row_SubT = mysql_fetch_assoc($SubT);
$totalRows_SubT = mysql_num_rows($SubT);

$IdGrupoFF=$row_proyectoMostar['IdGrupo'];
$query_mostrarGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupoFF'";
$mostrarGrupo = mysql_query($query_mostrarGrupo, $marambio) or die(mysql_error());
$row_mostrarGrupo = mysql_fetch_assoc($mostrarGrupo);
$totalRows_mostrarGrupo = mysql_num_rows($mostrarGrupo);

$CodEmpFF=$row_proyectoMostar['IdEmpresa'];
$query_mostrarEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$CodEmpFF'";
$mostrarEmpresa = mysql_query($query_mostrarEmpresa, $marambio) or die(mysql_error());
$row_mostrarEmpresa = mysql_fetch_assoc($mostrarEmpresa);
$totalRows_mostrarEmpresa = mysql_num_rows($mostrarEmpresa);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>..:: MARAMBIO ::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; font-weight: bold; }
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; }
.Estilo14 {color: #CCCCCC}
.Estilo16 {color: #000000}
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; color: #000000; }
-->
</style>
</head>

<body>
<p class="Estilo13">Proyecto: <strong><?php echo $row_proyectoMostar['CodificacionComp']; ?><br>
</strong>Grupo: <strong><?php echo $row_mostrarGrupo['Nombre'];; ?></strong><br>
Empresa:<strong><?php echo $row_mostrarEmpresa['Nombre']; ?><br>
<br>
<a href="aistentedeProyectosHistorico.php" class="Estilo13">&lt;&lt; Volver </a></strong></p>
<table width="100%"  border="1">
  <tr>
    <td><div align="center"><span class="Estilo5">Usuario</span></div></td>
    <td><div align="center"><span class="Estilo5">Mes</span></div></td>
    <td><div align="center"><span class="Estilo5">A&ntilde;o</span></div></td>
    <td><div align="center"><span class="Estilo5">01</span></div></td>
    <td><div align="center"><span class="Estilo5">02</span></div></td>
    <td><div align="center"><span class="Estilo5">03</span></div></td>
    <td><div align="center"><span class="Estilo5">04</span></div></td>
    <td><div align="center"><span class="Estilo5">05</span></div></td>
    <td><div align="center"><span class="Estilo5">06</span></div></td>
    <td><div align="center"><span class="Estilo5">07</span></div></td>
    <td><div align="center"><span class="Estilo5">08</span></div></td>
    <td><div align="center"><span class="Estilo5">09</span></div></td>
    <td><div align="center"><span class="Estilo5">10</span></div></td>
    <td><div align="center"><span class="Estilo5">11</span></div></td>
    <td><div align="center"><span class="Estilo5">12</span></div></td>
    <td><div align="center"><span class="Estilo5">13</span></div></td>
    <td><div align="center"><span class="Estilo5">14</span></div></td>
    <td><div align="center"><span class="Estilo5">15</span></div></td>
    <td><div align="center"><span class="Estilo5">16</span></div></td>
    <td><div align="center"><span class="Estilo5">17</span></div></td>
    <td><div align="center"><span class="Estilo5">18</span></div></td>
    <td><div align="center"><span class="Estilo5">19</span></div></td>
    <td><div align="center"><span class="Estilo5">20</span></div></td>
    <td><div align="center"><span class="Estilo5">21</span></div></td>
    <td><div align="center"><span class="Estilo5">22</span></div></td>
    <td><div align="center"><span class="Estilo5">23</span></div></td>
    <td><div align="center"><span class="Estilo5">24</span></div></td>
    <td><div align="center"><span class="Estilo5">25</span></div></td>
    <td><div align="center"><span class="Estilo5">26</span></div></td>
    <td><div align="center"><span class="Estilo5">27</span></div></td>
    <td><div align="center"><span class="Estilo5">28</span></div></td>
    <td><div align="center"><span class="Estilo5">29</span></div></td>
    <td><div align="center"><span class="Estilo5">30</span></div></td>
    <td><div align="center"><span class="Estilo5">31</span></div></td>
  </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13">
	<?php 
		$IdUsuarioZZ=$row_SubT['IdUsuario']; 
		mysql_select_db($database_marambio, $marambio);
		$query_mostrarUser = "SELECT IdUsuario, Nombre FROM usuarios WHERE IdUsuario = '$IdUsuarioZZ'";
		$mostrarUser = mysql_query($query_mostrarUser, $marambio) or die(mysql_error());
		$row_mostrarUser = mysql_fetch_assoc($mostrarUser);
		$totalRows_mostrarUser = mysql_num_rows($mostrarUser);
		echo $row_mostrarUser['Nombre'];
	?>	
	</span></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><?php echo $row_proyectoMostar['Mes']; ?></span></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><?php echo $row_proyectoMostar['Anno']; ?></span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A01']==1) { 
		echo $row_SubT['D01'];
		$conteo1=$conteo1+$row_SubT['D01'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A02']==1) { 
		echo $row_SubT['D02'];
		$conteo2=$conteo2+$row_SubT['D02'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A03']==1) { 
		echo $row_SubT['D03'];
		$conteo3=$conteo3+$row_SubT['D03'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A04']==1) { 
		echo $row_SubT['D04'];
		$conteo4=$conteo4+$row_SubT['D04'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A05']==1) { 
		echo $row_SubT['D05'];
		$conteo5=$conteo5+$row_SubT['D05'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A06']==1) { 
		echo $row_SubT['D06'];
		$conteo6=$conteo6+$row_SubT['D06'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A07']==1) { 
		echo $row_SubT['D07'];
		$conteo7=$conteo7+$row_SubT['D07'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A08']==1) { 
		echo $row_SubT['D08'];
		$conteo8=$conteo8+$row_SubT['D08'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A09']==1) { 
		echo $row_SubT['D09'];
		$conteo9=$conteo9+$row_SubT['D09'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A10']==1) { 
		echo $row_SubT['D10'];
		$conteo10=$conteo10+$row_SubT['D10'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A11']==1) { 
		echo $row_SubT['D11'];
		$conteo11=$conteo11+$row_SubT['D11'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A12']==1) { 
		echo $row_SubT['D12'];
		$conteo12=$conteo12+$row_SubT['D12'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A13']==1) { 
		echo $row_SubT['D13'];
		$conteo13=$conteo13+$row_SubT['D13'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A14']==1) { 
		echo $row_SubT['D14'];
		$conteo14=$conteo14+$row_SubT['D14'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A15']==1) { 
		echo $row_SubT['D15'];
		$conteo15=$conteo15+$row_SubT['D15'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A16']==1) { 
		echo $row_SubT['D16'];
		$conteo16=$conteo16+$row_SubT['D16'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A17']==1) { 
		echo $row_SubT['D17'];
		$conteo17=$conteo17+$row_SubT['D17'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A18']==1) { 
		echo $row_SubT['D18'];
		$conteo18=$conteo18+$row_SubT['D18'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A19']==1) { 
		echo $row_SubT['D19'];
		$conteo19=$conteo19+$row_SubT['D19'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A20']==1) { 
		echo $row_SubT['D20'];
		$conteo20=$conteo20+$row_SubT['D20'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A21']==1) { 
		echo $row_SubT['D21'];
		$conteo21=$conteo21+$row_SubT['D21'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A22']==1) { 
		echo $row_SubT['D22'];
		$conteo22=$conteo22+$row_SubT['D22'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A23']==1) { 
		echo $row_SubT['D23'];
		$conteo23=$conteo23+$row_SubT['D23'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A24']==1) { 
		echo $row_SubT['D24'];
		$conteo24=$conteo24+$row_SubT['D24'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A25']==1) { 
		echo $row_SubT['D25'];
		$conteo25=$conteo25+$row_SubT['D25'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A26']==1) { 
		echo $row_SubT['D26'];
		$conteo26=$conteo26+$row_SubT['D26'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A27']==1) { 
		echo $row_SubT['D27'];
		$conteo27=$conteo27+$row_SubT['D27'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A28']==1) { 
		echo $row_SubT['D28'];
		$conteo28=$conteo28+$row_SubT['D28'];
	} 
	?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A29']==1) { 
		echo $row_SubT['D29'];
		$conteo29=$conteo29+$row_SubT['D29'];
	} 
	?>
	</span></div></td>
    <td><div align="center" class="Estilo13">
	<?php 
	if($row_SubT['A30']==1) { 
		echo $row_SubT['D30'];
		$conteo30=$conteo30+$row_SubT['D30'];
	} 
	?>
	</div></td>
    <td><div align="center"><span class="Estilo13">
	<?php 
	if($row_SubT['A31']==1) { 
		echo $row_SubT['D31'];
		$conteo31=$conteo31+$row_SubT['D31'];
	} 
	?>
	</span></div></td>
  </tr>
  <?php } while ($row_SubT = mysql_fetch_assoc($SubT)); ?>
  <tr bgcolor="#EAEAEA">
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo1; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo2; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo3; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo4; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo5; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo6; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo7; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo8; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo9; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo10; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo11; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo12; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo13; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo14; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo15; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo16; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo17; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo18; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo19; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo20; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo21; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo22; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo23; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo24; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo25; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo26; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo27; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo28; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo29; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo30; ?></strong></div></td>
    <td><div align="center" class="Estilo17"><strong><?php echo $conteo31; ?></strong></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
@mysql_free_result($proyectoMostar);

@mysql_free_result($SubT);

@mysql_free_result($mostrarUser);

@mysql_free_result($mostrarEmpresa);

@mysql_free_result($mostrarGrupo);

mysql_close($marambio);

?>
