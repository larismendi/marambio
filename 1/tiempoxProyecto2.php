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
extract($_REQUEST);

$colname_proyectoMostar = "1";
if (isset($_GET['proyectoX'])) {
  $colname_proyectoMostar = (get_magic_quotes_gpc()) ? $_GET['proyectoX'] : addslashes($_GET['proyectoX']);
}
mysql_select_db($database_marambio, $marambio);
$query_proyectoMostar = sprintf("SELECT * FROM tareas WHERE IdTarea = %s", $colname_proyectoMostar);
$proyectoMostar = mysql_query($query_proyectoMostar, $marambio) or die(mysql_error());
$row_proyectoMostar = mysql_fetch_assoc($proyectoMostar);

$IdTarea7000=$row_proyectoMostar['IdTarea'];
$query_SubT = "SELECT * FROM quincenasub WHERE CodificacionComp = '$IdTarea7000'";
$SubT = mysql_query($query_SubT, $marambio) or die(mysql_error());
$row_SubT = mysql_fetch_assoc($SubT);

$IdGrupoFF=$row_proyectoMostar['IdGrupo'];
$query_mostrarGrupo = "SELECT IdGrupo, Nombre FROM grupos WHERE IdGrupo = '$IdGrupoFF'";
$mostrarGrupo = mysql_query($query_mostrarGrupo, $marambio) or die(mysql_error());
$row_mostrarGrupo = mysql_fetch_assoc($mostrarGrupo);

$CodEmpFF=$row_proyectoMostar['IdEmpresa'];
$query_mostrarEmpresa = "SELECT CodEmp, Nombre FROM empresas WHERE CodEmp = '$CodEmpFF'";
$mostrarEmpresa = mysql_query($query_mostrarEmpresa, $marambio) or die(mysql_error());
$row_mostrarEmpresa = mysql_fetch_assoc($mostrarEmpresa);

$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($supervisor);
?>

<?php include("includes/head.php");?>
                <p align="left" class="textotitulos"><span class="texto_btgris">Proyecto: <strong><?php echo $row_proyectoMostar['CodificacionComp']; ?><br>
                </strong>Grupo: <strong><?php echo $row_mostrarGrupo['Nombre'];; ?></strong><br>
Empresa:<strong><?php echo $row_mostrarEmpresa['Nombre']; ?></strong></span><strong><br>
<br>
<a href="tiempoxProyecto.php?buscarPro=1" class="texto_gris">&lt;&lt; Volver </a></strong></p>
                <table width="100%"  border="1">
  <tr bgcolor="#E5E5E5" class="texto_btgris">
    <td><div align="center"><span class="Estilo5">Aprobado por:</span></div></td>
    <td><div align="center"><span class="Estilo5">Usuario</span></div></td>
    <td><div align="center"><span class="Estilo5">Tarea</span></div></td>
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
	<td><div align="center"><span class="Estilo5">Total Hora Emp.</span></div></td>
  </tr>
  <?php do { ?>
  <tr class="texto_gris">
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13">
	<?php 
		$IdUsuarioApro=$row_SubT['APROBADO']; 
		mysql_select_db($database_marambio, $marambio);
		$query_User_pro = "SELECT Nombre FROM usuarios WHERE IdUsuario = '$IdUsuarioApro'";
		$mostrarUserPro = mysql_query($query_User_pro, $marambio) or die(mysql_error());
		$row_mostrarUserPro = mysql_fetch_assoc($mostrarUserPro);
		echo $row_mostrarUserPro['Nombre'];
	?>	
	</span></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13">
	<?php 
		$IdUsuarioZZ=$row_SubT['IdUsuario']; 
		
		$query_mostrarUser = "SELECT IdUsuario, Nombre FROM usuarios WHERE IdUsuario = '$IdUsuarioZZ'";
		$mostrarUser = mysql_query($query_mostrarUser, $marambio) or die(mysql_error());
		$row_mostrarUser = mysql_fetch_assoc($mostrarUser);
		echo $row_mostrarUser['Nombre'];
	?>	
	</span></div></td>
    <?php
    	$query_mostrarQna = "SELECT Mes, Anno FROM quincenas WHERE IdQna = '".$row_SubT['IdQna']."'";
		$mostrarQna = mysql_query($query_mostrarQna, $marambio) or die(mysql_error());
		$row_mostrarQna = mysql_fetch_assoc($mostrarQna);
	?>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><?php echo $row_proyectoMostar['CodificacionComp']; ?></span></div></td>
    <?php /*<td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><a href="tiempoxQnaxEmpleado2.php?IdQna=<?php echo $row_SubT['IdQna']?>&IdUsuario=<?php echo $row_SubT['IdUsuario']?>&operacion=<?php echo $row_proyectoMostar['IdTarea'];?>"><?php echo substr($row_proyectoMostar['CodificacionComp'],-7,2);//$row_proyectoMostar['Mes']; ?></a></span></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><?php echo substr($row_proyectoMostar['CodificacionComp'],-4);//$row_proyectoMostar['Anno']; ?></span></div></td>*/?>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><a href="tiempoxQnaxEmpleado2.php?IdQna=<?=$row_SubT['IdQna']?>&IdUsuario=<?=$row_SubT['IdUsuario']?>&operacion=<?=$row_proyectoMostar['IdTarea'];?>"><?=$row_mostrarQna['Mes'];?></a></span></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="Estilo13"><?=$row_mostrarQna['Anno'];?></span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG01=$conteoG01+$row_SubT['D01'];
	if($row_SubT['A01']==1) { 
		echo $row_SubT['D01'];
		$conteo01=$conteo01+$row_SubT['D01'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D01']; ?></span>	
	<?php 
	$conteoN01=$conteoN01+$row_SubT['D01'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG02=$conteoG02+$row_SubT['D02'];
	if($row_SubT['A02']==1) { 
		echo $row_SubT['D02'];
		$conteo02=$conteo02+$row_SubT['D02'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D02']; ?></span>	
	<?php 
	$conteoN02=$conteoN02+$row_SubT['D02'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG03=$conteoG03+$row_SubT['D03'];
	if($row_SubT['A03']==1) { 
		echo $row_SubT['D03'];
		$conteo03=$conteo03+$row_SubT['D03'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D03']; ?></span>	
	<?php 
	$conteoN03=$conteoN03+$row_SubT['D03'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG04=$conteoG04+$row_SubT['D04'];
	if($row_SubT['A04']==1) { 
		echo $row_SubT['D04'];
		$conteo04=$conteo04+$row_SubT['D04'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D04']; ?></span>	
	<?php 
	$conteoN04=$conteoN04+$row_SubT['D04'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG05=$conteoG05+$row_SubT['D05'];
	if($row_SubT['A05']==1) { 
		echo $row_SubT['D05'];
		$conteo05=$conteo05+$row_SubT['D05'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D05']; ?></span>	
	<?php 
	$conteoN05=$conteoN05+$row_SubT['D05'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG06=$conteoG06+$row_SubT['D06'];
	if($row_SubT['A06']==1) { 
		echo $row_SubT['D06'];
		$conteo06=$conteo06+$row_SubT['D06'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D06']; ?></span>	
	<?php 
	$conteoN06=$conteoN06+$row_SubT['D06'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG07=$conteoG07+$row_SubT['D07'];
	if($row_SubT['A07']==1) { 
		echo $row_SubT['D07'];
		$conteo07=$conteo07+$row_SubT['D07'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D07']; ?></span>	
	<?php 
	$conteoN07=$conteoN07+$row_SubT['D07'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG08=$conteoG08+$row_SubT['D08'];
	if($row_SubT['A08']==1) { 
		echo $row_SubT['D08'];
		$conteo08=$conteo08+$row_SubT['D08'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D08']; ?></span>	
	<?php 
	$conteoN08=$conteoN08+$row_SubT['D08'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG09=$conteoG09+$row_SubT['D09'];
	if($row_SubT['A09']==1) { 
		echo $row_SubT['D09'];
		$conteo09=$conteo09+$row_SubT['D09'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D09']; ?></span>	
	<?php 
	$conteoN09=$conteoN09+$row_SubT['D09'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG10=$conteoG10+$row_SubT['D10'];
	if($row_SubT['A10']==1) { 
		echo $row_SubT['D10'];
		$conteo10=$conteo10+$row_SubT['D10'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D10']; ?></span>	
	<?php 
	$conteoN10=$conteoN10+$row_SubT['D10'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG11=$conteoG11+$row_SubT['D11'];
	if($row_SubT['A11']==1) { 
		echo $row_SubT['D11'];
		$conteo11=$conteo11+$row_SubT['D11'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D11']; ?></span>	
	<?php 
	$conteoN11=$conteoN11+$row_SubT['D11'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG12=$conteoG12+$row_SubT['D12'];
	if($row_SubT['A12']==1) { 
		echo $row_SubT['D12'];
		$conteo12=$conteo12+$row_SubT['D12'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D12']; ?></span>	
	<?php 
	$conteoN12=$conteoN12+$row_SubT['D12'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG13=$conteoG13+$row_SubT['D13'];
	if($row_SubT['A13']==1) { 
		echo $row_SubT['D13'];
		$conteo13=$conteo13+$row_SubT['D13'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D13']; ?></span>	
	<?php 
	$conteoN13=$conteoN13+$row_SubT['D13'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG14=$conteoG14+$row_SubT['D14'];
	if($row_SubT['A14']==1) { 
		echo $row_SubT['D14'];
		$conteo14=$conteo14+$row_SubT['D14'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D14']; ?></span>	
	<?php 
	$conteoN14=$conteoN14+$row_SubT['D14'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG15=$conteoG15+$row_SubT['D15'];
	if($row_SubT['A15']==1) { 
		echo $row_SubT['D15'];
		$conteo15=$conteo15+$row_SubT['D15'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D15']; ?></span>	
	<?php 
	$conteoN15=$conteoN15+$row_SubT['D15'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG16=$conteoG16+$row_SubT['D16'];
	if($row_SubT['A16']==1) { 
		echo $row_SubT['D16'];
		$conteo16=$conteo16+$row_SubT['D16'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D16']; ?></span>	
	<?php 
	$conteoN16=$conteoN16+$row_SubT['D16'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG17=$conteoG17+$row_SubT['D17'];
	if($row_SubT['A17']==1) { 
		echo $row_SubT['D17'];
		$conteo17=$conteo17+$row_SubT['D17'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D17']; ?></span>	
	<?php 
	$conteoN17=$conteoN17+$row_SubT['D17'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG18=$conteoG18+$row_SubT['D18'];
	if($row_SubT['A18']==1) { 
		echo $row_SubT['D18'];
		$conteo18=$conteo18+$row_SubT['D18'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D18']; ?></span>	
	<?php 
	$conteoN18=$conteoN18+$row_SubT['D18'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG19=$conteoG19+$row_SubT['D19'];
	if($row_SubT['A19']==1) { 
		echo $row_SubT['D19'];
		$conteo19=$conteo19+$row_SubT['D19'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D19']; ?></span>	
	<?php 
	$conteoN19=$conteoN19+$row_SubT['D19'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG20=$conteoG20+$row_SubT['D20'];
	if($row_SubT['A20']==1) { 
		echo $row_SubT['D20'];
		$conteo20=$conteo20+$row_SubT['D20'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D20']; ?></span>	
	<?php 
	$conteoN20=$conteoN20+$row_SubT['D20'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG21=$conteoG21+$row_SubT['D21'];
	if($row_SubT['A21']==1) { 
		echo $row_SubT['D21'];
		$conteo21=$conteo21+$row_SubT['D21'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D21']; ?></span>	
	<?php 
	$conteoN21=$conteoN21+$row_SubT['D21'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG22=$conteoG22+$row_SubT['D22'];
	if($row_SubT['A22']==1) { 
		echo $row_SubT['D22'];
		$conteo22=$conteo22+$row_SubT['D22'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D22']; ?></span>	
	<?php 
	$conteoN22=$conteoN22+$row_SubT['D22'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG23=$conteoG23+$row_SubT['D23'];
	if($row_SubT['A23']==1) { 
		echo $row_SubT['D23'];
		$conteo23=$conteo23+$row_SubT['D23'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D23']; ?></span>	
	<?php 
	$conteoN23=$conteoN23+$row_SubT['D23'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG24=$conteoG24+$row_SubT['D24'];
	if($row_SubT['A24']==1) { 
		echo $row_SubT['D24'];
		$conteo24=$conteo24+$row_SubT['D24'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D24']; ?></span>	
	<?php 
	$conteoN24=$conteoN24+$row_SubT['D24'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG25=$conteoG25+$row_SubT['D25'];
	if($row_SubT['A25']==1) { 
		echo $row_SubT['D25'];
		$conteo25=$conteo25+$row_SubT['D25'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D25']; ?></span>	
	<?php 
	$conteoN25=$conteoN25+$row_SubT['D25'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG26=$conteoG26+$row_SubT['D26'];
	if($row_SubT['A26']==1) { 
		echo $row_SubT['D26'];
		$conteo26=$conteo26+$row_SubT['D26'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D26']; ?></span>	
	<?php 
	$conteoN26=$conteoN26+$row_SubT['D26'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG27=$conteoG27+$row_SubT['D27'];
	if($row_SubT['A27']==1) { 
		echo $row_SubT['D27'];
		$conteo27=$conteo27+$row_SubT['D27'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D27']; ?></span>	
	<?php 
	$conteoN27=$conteoN27+$row_SubT['D27'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG28=$conteoG28+$row_SubT['D28'];
	if($row_SubT['A28']==1) { 
		echo $row_SubT['D28'];
		$conteo28=$conteo28+$row_SubT['D28'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D28']; ?></span>	
	<?php 
	$conteoN28=$conteoN28+$row_SubT['D28'];
	} ?>
	</span></div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG29=$conteoG29+$row_SubT['D29'];
	if($row_SubT['A29']==1) { 
		echo $row_SubT['D29'];
		$conteo29=$conteo29+$row_SubT['D29'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D29']; ?></span>	
	<?php 
	$conteoN29=$conteoN29+$row_SubT['D29'];
	} ?>
	</span></div></td>
    <td><div align="center" class="Estilo13">
	<?php
	$conteoG30=$conteoG30+$row_SubT['D30'];
	if($row_SubT['A30']==1) { 
		echo $row_SubT['D30'];
		$conteo30=$conteo30+$row_SubT['D30'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D30']; ?></span>	
	<?php 
	$conteoN30=$conteoN30+$row_SubT['D30'];
	} ?>
	</div></td>
    <td><div align="center"><span class="Estilo13">
	<?php
	$conteoG31=$conteoG31+$row_SubT['D31'];
	if($row_SubT['A31']==1) { 
		echo $row_SubT['D31'];
		$conteo31=$conteo31+$row_SubT['D31'];
	} else { ?>
	<span class="Estilo18"><?php echo $row_SubT['D31']; ?></span>	
	<?php 
	$conteoN31=$conteoN31+$row_SubT['D31'];
	} ?>
	</span></div></td>
	
	<?php  
           $total =  $row_SubT['D01']+$row_SubT['D02']+$row_SubT['D03']+$row_SubT['D04']+$row_SubT['D05']+$row_SubT['D06']+$row_SubT['D07']+$row_SubT['D08']+$row_SubT['D09']+ $row_SubT['D10']+$row_SubT['D11']+$row_SubT['D12']+$row_SubT['D13']+$row_SubT['D14']+$row_SubT['D15']+$row_SubT['D16']+$row_SubT['D17']+$row_SubT['D18']+$row_SubT['D19']+$row_SubT['D20']+$row_SubT['D21']+$row_SubT['D22']+$row_SubT['D23']+$row_SubT['D24']+$row_SubT['D25']+$row_SubT['D26']+$row_SubT['D27']+$row_SubT['D28']+$row_SubT['D29']+$row_SubT['D30']+$row_SubT['D31']; ?>
	<td align="center"><?php echo $total ?></td>
  </tr>
  <?php } while ($row_SubT = mysql_fetch_assoc($SubT)); ?>
  <tr bgcolor="#EAEAEA">
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td class="texto_btgris"><div align="right"><span class="Estilo14"><span class="Estilo16"></span></span><strong><span class="Estilo16">Aprobadas</span></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo01; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo02; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo03; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo04; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo05; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo06; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo07; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo08; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo09; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo10; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo11; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo12; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo13; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo14; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo15; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo16; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo17; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo18; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo19; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo20; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo21; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo22; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo23; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo24; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo25; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo26; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo27; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo28; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo29; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo30; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteo31; ?></strong></div></td>
    <td class="texto_btgris"><div align="center"><strong>
	<?php echo $conteo01+$conteo02+$conteo03+$conteo04+$conteo05+$conteo06+$conteo07+$conteo08+$conteo09+$conteo10+$conteo11+$conteo12+$conteo13+$conteo14+$conteo15+$conteo16+$conteo17+$conteo18+$conteo19+$conteo20+$conteo21+$conteo22+$conteo23+$conteo24+$conteo25+$conteo26+$conteo27+$conteo28+$conteo29+$conteo30+$conteo31;  ?>
	</strong></div></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td class="texto_btgris"><div align="right"><span class="Estilo14"><span class="Estilo16"></span></span><strong><span class="Estilo16">No Aprobadas</span></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN01; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN02; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN03; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN04; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN05; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN06; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN07; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN08; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN09; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN10; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN11; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN12; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN13; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN14; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN15; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN16; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN17; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN18; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN19; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN20; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN21; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN22; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN23; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN24; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN25; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN26; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN27; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN28; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN29; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN30; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoN31; ?></strong></div></td>
    <td class="titulo"><div align="center" class="texto_btgris"><strong><?php echo $conteoN01+$conteoN02+$conteoN03+$conteoN04+$conteoN05+$conteoN06+$conteoN07+$conteoN08+$conteoN09+$conteoN10+$conteoN11+$conteoN12+$conteoN13+$conteoN14+$conteoN15+$conteoN16+$conteoN17+$conteoN18+$conteoN19+$conteoN20+$conteoN21+$conteoN22+$conteoN23+$conteoN24+$conteoN25+$conteoN26+$conteoN27+$conteoN28+$conteoN29+$conteoN30+$conteoN31;  ?></strong></div></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td><div align="center"><span class="Estilo14"><span class="Estilo16"></span></span></div></td>
    <td class="texto_btgris"><div align="right"><span class="Estilo14"><span class="Estilo16"></span></span><strong><span class="Estilo16">Total</span></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG01; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG02; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG03; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG04; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG05; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG06; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG07; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG08; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG09; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG10; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG11; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG12; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG13; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG14; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG15; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG16; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG17; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG18; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG19; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG20; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG21; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG22; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG23; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG24; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG25; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG26; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG27; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG28; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG29; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG30; ?></strong></div></td>
    <td><div align="center" class="texto_btgris"><strong><?php echo $conteoG31; ?></strong></div></td>
    <td class="titulo"><div align="center" class="texto_btgris"><strong><?php echo $conteoG01+$conteoG02+$conteoG03+$conteoG04+$conteoG05+$conteoG06+$conteoG07+$conteoG08+$conteoG09+$conteoG10+$conteoG11+$conteoG12+$conteoG13+$conteoG14+$conteoG15+$conteoG16+$conteoG17+$conteoG18+$conteoG19+$conteoG20+$conteoG21+$conteoG22+$conteoG23+$conteoG24+$conteoG25+$conteoG26+$conteoG27+$conteoG28+$conteoG29+$conteoG30+$conteoG31;  ?></strong></div></td>
  </tr>
</table>
<p>&nbsp;</p>
				</p>
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
@mysql_free_result($proyectoMostar);

@mysql_free_result($SubT);

@mysql_free_result($mostrarUser);

@mysql_free_result($mostrarEmpresa);

@mysql_free_result($mostrarGrupo);

mysql_close($marambio);

?>
