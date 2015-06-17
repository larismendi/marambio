<?php 
require_once('Connections/marambio.php'); 
session_start();
$sessionid = session_id();
$tipo_usuario = $_SESSION['tt'];

if($tipo_usuario != 4){
	header ("Location: ../index.php"); 
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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
  $updateSQL = sprintf("UPDATE quincenasub SET D01=%s, D02=%s, D03=%s, D04=%s, D05=%s, D06=%s, D07=%s, D08=%s, D09=%s, D10=%s, D11=%s, D12=%s, D13=%s, D14=%s, D15=%s, D16=%s, D17=%s, D18=%s, D19=%s, D20=%s, D21=%s, D22=%s, D23=%s, D24=%s, D25=%s, D26=%s, D27=%s, D28=%s, D29=%s, D30=%s, D31=%s, A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s WHERE IdQnaSub=%s",
                       GetSQLValueString($_POST['D01'], "double"),
                       GetSQLValueString($_POST['D02'], "double"),
                       GetSQLValueString($_POST['D03'], "double"),
                       GetSQLValueString($_POST['D04'], "double"),
                       GetSQLValueString($_POST['D05'], "double"),
                       GetSQLValueString($_POST['D06'], "double"),
                       GetSQLValueString($_POST['D07'], "double"),
                       GetSQLValueString($_POST['D08'], "double"),
                       GetSQLValueString($_POST['D09'], "double"),
                       GetSQLValueString($_POST['D10'], "double"),
                       GetSQLValueString($_POST['D11'], "double"),
                       GetSQLValueString($_POST['D12'], "double"),
                       GetSQLValueString($_POST['D13'], "double"),
                       GetSQLValueString($_POST['D14'], "double"),
                       GetSQLValueString($_POST['D15'], "double"),
                       GetSQLValueString($_POST['D16'], "double"),
                       GetSQLValueString($_POST['D17'], "double"),
                       GetSQLValueString($_POST['D18'], "double"),
                       GetSQLValueString($_POST['D19'], "double"),
                       GetSQLValueString($_POST['D20'], "double"),
                       GetSQLValueString($_POST['D21'], "double"),
                       GetSQLValueString($_POST['D22'], "double"),
                       GetSQLValueString($_POST['D23'], "double"),
                       GetSQLValueString($_POST['D24'], "double"),
                       GetSQLValueString($_POST['D25'], "double"),
                       GetSQLValueString($_POST['D26'], "double"),
                       GetSQLValueString($_POST['D27'], "double"),
                       GetSQLValueString($_POST['D28'], "double"),
                       GetSQLValueString($_POST['D29'], "double"),
                       GetSQLValueString($_POST['D30'], "double"),
                       GetSQLValueString($_POST['D31'], "double"),
					   GetSQLValueString(isset($_POST['A01']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A02']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A03']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A04']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A05']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A06']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A07']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A08']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A09']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A10']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A11']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A12']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A13']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A14']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A15']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A16']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A17']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A18']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A19']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A20']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A21']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A22']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A23']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A24']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A25']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A26']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A27']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A28']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A29']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A30']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['A31']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString($_POST['IdQnaSub'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
  
  $todas=0;

  $updateGoTo = "verQnaOtros.php?IdQna=" . $IdQna . "&enviado=1" . "&IdUsuario=" . $IdUsuario;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
if($todas==1) {
	if($enviado!=1) {
		$sii=1;
		$updateSQL = sprintf("UPDATE quincenasub SET A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s WHERE IdQnaSub=%s",
					   GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
                       GetSQLValueString($sii, "int"),
					   GetSQLValueString($IdQnaSub, "int"));

  		mysql_select_db($database_marambio, $marambio);
  		$Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());

  		//$updateGoTo = "verQnaOtros.php?IdQna=" . $IdQna;
  		header ("verQnaOtros.php?IdQna=" . $IdQna . "&todas=0" . "&IdUsuario=" . $IdUsuario);
  
  } 

}
?>
<?php
extract($_REQUEST);
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);
$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

$query_super = "SELECT * FROM usuarios WHERE IdUsuario = '$idQuienEs2000'";
$super = mysql_query($query_super, $marambio) or die(mysql_error());
$row_supervisor = mysql_fetch_assoc($super);

$query_supervisor = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuario'";
$supervisor = mysql_query($query_supervisor, $marambio) or die(mysql_error());
$row_super = mysql_fetch_assoc($supervisor);

$colname_Qna = "1";
if (isset($_GET['IdQna'])) {
  $colname_Qna = (get_magic_quotes_gpc()) ? $_GET['IdQna'] : addslashes($_GET['IdQna']);
}

$query_Qna = sprintf("SELECT * FROM quincenas WHERE IdQna = %s", $colname_Qna);
$Qna = mysql_query($query_Qna, $marambio) or die(mysql_error());
$row_Qna = mysql_fetch_assoc($Qna);
$NQda=$row_Qna['Quincena'];
$horlab=$row_Qna['horlab'];

// BUSCA LAS TAREAS A CLIENTES
$IdQnaXX=$row_Qna['IdQna'];
$query_QnaSub = "SELECT * FROM quincenasub WHERE IdQna = '$IdQnaXX' AND TipoTarea='1' AND IdUsuario='$IdUsuario'";
$QnaSub = mysql_query($query_QnaSub, $marambio) or die(mysql_error());
$row_QnaSub = mysql_fetch_assoc($QnaSub);

//BUSCA LAS TAREAS ADMINISTRAVIVAS
$query_QnaSub2 = "SELECT * FROM quincenasub WHERE IdQna = '$IdQnaXX' AND TipoTarea='2' AND IdUsuario='$IdUsuario'";
$QnaSub2 = mysql_query($query_QnaSub2, $marambio) or die(mysql_error());
$row_QnaSub2 = mysql_fetch_assoc($QnaSub2);

?>
<?php
function ultimoDia($mes,$ano){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$ano)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 
//calculo el ?ltimo dia del mes 
$mesX=$row_Qna['Mes'];
$annoX=$row_Qna['Anno'];

$ultimo_dia = ultimoDia("$mesX","$annoX"); 

?>

<?php include("includes/head.php");?>
                <p align="left" class="textotitulos">
				<table width="100%" border="0">
   <tr>
     <td width="33%"><span class="texto_btgris">Usuario:<?php echo $row_super['Nombre']; ?><br>
       Quincena: <?php echo $row_Qna['Quincena']; ?><br>
       Mes / A&ntilde;o:<?php echo $row_Qna['Mes']; ?> / <?php echo $row_Qna['Anno']; ?></span><span class="textoazul"><br>
       </span></td>
     <td width="44%" valign="bottom"><div align="center"></div></td>
     <td width="23%" valign="top"><div align="right"><a href="<?php if(isset($_GET['operacion'])&&$_GET['operacion']){echo 'tiempoxProyecto2.php?proyectoX='.$_GET['operacion'];}else{?>tiempoxQnaxEmpleado.php<?php }?>" class="texto_btgris">&lt;&lt; Volver</a></div></td>
   </tr>
</table>
  <p class="titulo">HORAS CLIENTE</p>
  <?php 
  	$srt = "SELECT Nombre FROM usuarios WHERE IdUsuario = '".$row_QnaSub['APROBADO']."'";
  	$e_srt = mysql_query($srt, $marambio) or die (mysql_error());
	$f_srt = mysql_fetch_array($e_srt);
	
  ?>
  <table align="left">
  	<?php if($f_srt){ ?>
  	<tr>
    	<td class="texto_btgris">Aprobado por:</td>
    	<td class="texto_btgris"><?php echo $f_srt['Nombre']; ?></td>
    </tr>
    <?php }else{?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php } ?>
  </table><br />
 <?php //TABLA DE TAREAS CLIENTES ?>
 <table width="85%" border="1">
   <tr bgcolor="#E5E5E5" class="texto_btgris">
     <td width="12%"><div align="center">C&oacute;digo</div></td>
     <td width="22%"><div align="center">Empresa</div></td>
     <td><div align="center">Mes</div></td>
     <td><div align="center">A&ntilde;o</div></td>
	 <?php if($NQda==1) { ?> 
     <td width="4%"><div align="center">01</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">02</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">03</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">04</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">05</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">06</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">07</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">08</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">09</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">10</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">11</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">12</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">13</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">14</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">15</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">16</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">17</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">18</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">19</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">20</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">21</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">22</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">23</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">24</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">25</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">26</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">27</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">28</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 	<?php if($ultimo_dia>=29) { ?>
     <td width="4%"><div align="center">29</div></td>
	 	<?php } ?>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 	<?php if($ultimo_dia>=30) { ?>
     <td width="4%"><div align="center">30</div></td>
	 	<?php } ?>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 	<?php if($ultimo_dia>=31) { ?>
     <td width="4%"><div align="center">31</div></td>
	 	<?php } ?>
	 <?php } ?>
     <td width="6%"><div align="center">Total<br>
       Horas</div></td>
     </tr>
   <?php
   	 $totalD01='';
	 $totalD02='';
	 $totalD03='';
	 $totalD04='';
	 $totalD05='';
	 $totalD06='';
	 $totalD07='';
	 $totalD08='';
	 $totalD09='';
	 $totalD10='';
	 $totalD11='';
	 $totalD12='';
	 $totalD13='';
	 $totalD14='';
	 $totalD15='';
	 $totalD16='';
	 $totalD17='';
	 $totalD18='';
	 $totalD19='';
	 $totalD20='';
	 $totalD21='';
	 $totalD22='';
	 $totalD23='';
	 $totalD24='';
	 $totalD25='';
	 $totalD26='';
	 $totalD27='';
	 $totalD28='';
	 $totalD29='';
	 $totalD30='';
	 $totalD31='';
	 $totalHorasTotal='';
   ?>
   
     <?php do { ?>
	 <?php
	 $totalD01=$totalD01+$row_QnaSub['D01'];
	 $totalD02=$totalD02+$row_QnaSub['D02'];
	 $totalD03=$totalD03+$row_QnaSub['D03'];
	 $totalD04=$totalD04+$row_QnaSub['D04'];
	 $totalD05=$totalD05+$row_QnaSub['D05'];
	 $totalD06=$totalD06+$row_QnaSub['D06'];
	 $totalD07=$totalD07+$row_QnaSub['D07'];
	 $totalD08=$totalD08+$row_QnaSub['D08'];
	 $totalD09=$totalD09+$row_QnaSub['D09'];
	 $totalD10=$totalD10+$row_QnaSub['D10'];
	 $totalD11=$totalD11+$row_QnaSub['D11'];
	 $totalD12=$totalD12+$row_QnaSub['D12'];
	 $totalD13=$totalD13+$row_QnaSub['D13'];
	 $totalD14=$totalD14+$row_QnaSub['D14'];
	 $totalD15=$totalD15+$row_QnaSub['D15'];
	 $totalD16=$totalD16+$row_QnaSub['D16'];
	 $totalD17=$totalD17+$row_QnaSub['D17'];
	 $totalD18=$totalD18+$row_QnaSub['D18'];
	 $totalD19=$totalD19+$row_QnaSub['D19'];
	 $totalD20=$totalD20+$row_QnaSub['D20'];
	 $totalD21=$totalD21+$row_QnaSub['D21'];
	 $totalD22=$totalD22+$row_QnaSub['D22'];
	 $totalD23=$totalD23+$row_QnaSub['D23'];
	 $totalD24=$totalD24+$row_QnaSub['D24'];
	 $totalD25=$totalD25+$row_QnaSub['D25'];
	 $totalD26=$totalD26+$row_QnaSub['D26'];
	 $totalD27=$totalD27+$row_QnaSub['D27'];
	 $totalD28=$totalD28+$row_QnaSub['D28'];
	 $totalD29=$totalD29+$row_QnaSub['D29'];
	 $totalD30=$totalD30+$row_QnaSub['D30'];
	 $totalD31=$totalD31+$row_QnaSub['D31'];
	 
	 ?>
     <tr class="texto_gris">
       <td class="textogris Estilo1"><div align="center" >
           <?php 
	 	$IdTareaA=$row_QnaSub['CodificacionComp'];
	 	mysql_select_db($database_marambio, $marambio);
		$query_tareaMostrar = "SELECT * FROM tareas WHERE IdTarea = '$IdTareaA'";
		$tareaMostrar = mysql_query($query_tareaMostrar, $marambio) or die(mysql_error());
		$row_tareaMostrar = mysql_fetch_assoc($tareaMostrar);
		echo $row_tareaMostrar['CodificacionComp'];
	  ?>
                </div></td>
       <td class="textogris Estilo1"><div align="center" >
           <?php
		$IdEmpresaXX=$row_tareaMostrar['IdEmpresa'];  
		$query_mostrarEmpresa = "SELECT * FROM empresas WHERE CodEmp = '$IdEmpresaXX'";
		$mostrarEmpresa = mysql_query($query_mostrarEmpresa, $marambio) or die(mysql_error());
		$row_mostrarEmpresa = mysql_fetch_assoc($mostrarEmpresa);
		echo $row_mostrarEmpresa['Nombre'];
	 ?>
                </div></td>
       <td><div align="center"><?php echo $row_Qna['Mes']; ?></div></td>
	   <td><div align="center"><?php echo $row_Qna['Anno']; ?></div></td>
       <?php if($NQda==1) { ?>
       <td>
         <div align="center" class="textogrande"><?php echo $row_QnaSub['D01']; ?>
         </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D02']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D03']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D04']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D05']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D06']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D07']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D08']; ?>
	                   </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D09']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D10']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D11']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D12']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D13']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D14']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D15']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D16']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D17']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D18']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D19']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D20']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D21']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D22']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D23']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D24']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D25']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D26']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D27']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D28']; ?>
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=29) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D29']; ?>
                </div></td>
			<?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=30) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D30']; ?>
                </div></td>
			<?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=31) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub['D31']; ?>
                </div></td>
			<?php } ?>
       <?php } ?>
       <td class="textogris Estilo1"><div align="center" >
           <?php
	 $TotalHorasXX=$row_QnaSub['D01']+$row_QnaSub['D02']+$row_QnaSub['D03']+$row_QnaSub['D04']+$row_QnaSub['D05']+$row_QnaSub['D06']+$row_QnaSub['D07']+$row_QnaSub['D08']+$row_QnaSub['D09']+$row_QnaSub['D10']+$row_QnaSub['D11']+$row_QnaSub['D12']+$row_QnaSub['D13']+$row_QnaSub['D14']+$row_QnaSub['D15']+$row_QnaSub['D16']+$row_QnaSub['D17']+$row_QnaSub['D18']+$row_QnaSub['D19']+$row_QnaSub['D20']+$row_QnaSub['D21']+$row_QnaSub['D22']+$row_QnaSub['D23']+$row_QnaSub['D24']+$row_QnaSub['D25']+$row_QnaSub['D26']+$row_QnaSub['D27']+$row_QnaSub['D28']+$row_QnaSub['D29']+$row_QnaSub['D30']+$row_QnaSub['D31'];
	 echo $TotalHorasXX;
	 $totalHorasTotal=$totalHorasTotal+$TotalHorasXX;
	 ?>
                </div></td>
       </tr>
     <?php } while ($row_QnaSub = mysql_fetch_assoc($QnaSub)); ?>
   <tr bgcolor="#EEEEEE">
       <td colspan="4"><div align="right" class="titulo"><strong>Total Clientes </strong></div></td>
     
       <?php if($NQda==1) { ?>
       <td>
         <div align="center" class="texto_btgris"><strong><?php echo $totalD01; ?></strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD02; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD03; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD04; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD05; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD06; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD07; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD08; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD09; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD10; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD11; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD12; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris">
         <div align="center"><strong><?php echo $totalD13; ?>
          </strong></div>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD14; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD15; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD16; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD17; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD18; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD19; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD20; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD21; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD22; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD23; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD24; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD25; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD26; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD27; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD28; ?>
          </strong></div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=29) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD29; ?>
          </strong></div></td>
		   	<?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=30) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD30; ?>
          </strong></div></td>
		   <?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=31) { ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalD31; ?>
          </strong></div></td>
		   	<?php } ?>
       <?php } ?>
       <td><div align="center" class="texto_btgris"><strong><?php echo $totalHorasTotal; ?>
       </strong></div></td>
       </tr>
 </table>
 <?php //TABLA TAREAS CLIENTES FINAL ?>
 <p class="textoazul"></p>
 <hr>
 <p class="titulo">HORAS ADMINISTRATIVAS</p>
 <?php 
  	$srt2 = "SELECT Nombre FROM usuarios WHERE IdUsuario = '".$row_QnaSub2['Aprobado_por']."'";
  	$e_srt2 = mysql_query($srt2, $marambio) or die (mysql_error());
	$f_srt2 = mysql_fetch_array($e_srt2);
	
  ?>
  <table align="left">
  	<?php if($f_srt2){ ?>
  	<tr>
    	<td class="texto_btgris">Aprobado por:</td>
    	<td class="texto_btgris"><?php echo $f_srt2['Nombre']; ?></td>
    </tr>
    <?php }else{?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php } ?>
  </table><br />
 <?php //TABLA ADMINISTRATIVA ?>
 <table width="85%" border="1" align="center">
   <tr bgcolor="#E5E5E5" class="texto_btgris">
     <td width="500"><div align="center">Descripci&oacute;n</div></td>
     
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">01</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">02</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">03</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">04</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">05</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">06</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">07</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">08</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">09</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">10</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">11</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">12</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">13</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">14</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td width="4%"><div align="center">15</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">16</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">17</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">18</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">19</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">20</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">21</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">22</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">23</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">24</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">25</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">26</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">27</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td width="4%"><div align="center">28</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=29) { ?>
     <td width="4%"><div align="center">29</div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=30) { ?>
     <td width="4%"><div align="center">30</div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=31) { ?>
     <td width="4%"><div align="center">31</div></td>
     <?php } ?>
     <?php } ?>
     <td width="6%"><div align="center">Total<br>
        Horas</div></td>
     </tr>
   <?php
   	 $totalD01X='';
	 $totalD02X='';
	 $totalD03X='';
	 $totalD04X='';
	 $totalD05X='';
	 $totalD06X='';
	 $totalD07X='';
	 $totalD08X='';
	 $totalD09X='';
	 $totalD10X='';
	 $totalD11X='';
	 $totalD12X='';
	 $totalD13X='';
	 $totalD14X='';
	 $totalD15X='';
	 $totalD16X='';
	 $totalD17X='';
	 $totalD18X='';
	 $totalD19X='';
	 $totalD20X='';
	 $totalD21X='';
	 $totalD22X='';
	 $totalD23X='';
	 $totalD24X='';
	 $totalD25X='';
	 $totalD26X='';
	 $totalD27X='';
	 $totalD28X='';
	 $totalD29X='';
	 $totalD30X='';
	 $totalD31X='';
	 $totalHorasTotalX='';
   ?>
   <?php do { ?>
   <?php
	 $totalD01X=$totalD01X+$row_QnaSub2['D01'];
	 $totalD02X=$totalD02X+$row_QnaSub2['D02'];
	 $totalD03X=$totalD03X+$row_QnaSub2['D03'];
	 $totalD04X=$totalD04X+$row_QnaSub2['D04'];
	 $totalD05X=$totalD05X+$row_QnaSub2['D05'];
	 $totalD06X=$totalD06X+$row_QnaSub2['D06'];
	 $totalD07X=$totalD07X+$row_QnaSub2['D07'];
	 $totalD08X=$totalD08X+$row_QnaSub2['D08'];
	 $totalD09X=$totalD09X+$row_QnaSub2['D09'];
	 $totalD10X=$totalD10X+$row_QnaSub2['D10'];
	 $totalD11X=$totalD11X+$row_QnaSub2['D11'];
	 $totalD12X=$totalD12X+$row_QnaSub2['D12'];
	 $totalD13X=$totalD13X+$row_QnaSub2['D13'];
	 $totalD14X=$totalD14X+$row_QnaSub2['D14'];
	 $totalD15X=$totalD15X+$row_QnaSub2['D15'];
	 $totalD16X=$totalD16X+$row_QnaSub2['D16'];
	 $totalD17X=$totalD17X+$row_QnaSub2['D17'];
	 $totalD18X=$totalD18X+$row_QnaSub2['D18'];
	 $totalD19X=$totalD19X+$row_QnaSub2['D19'];
	 $totalD20X=$totalD20X+$row_QnaSub2['D20'];
	 $totalD21X=$totalD21X+$row_QnaSub2['D21'];
	 $totalD22X=$totalD22X+$row_QnaSub2['D22'];
	 $totalD23X=$totalD23X+$row_QnaSub2['D23'];
	 $totalD24X=$totalD24X+$row_QnaSub2['D24'];
	 $totalD25X=$totalD25X+$row_QnaSub2['D25'];
	 $totalD26X=$totalD26X+$row_QnaSub2['D26'];
	 $totalD27X=$totalD27X+$row_QnaSub2['D27'];
	 $totalD28X=$totalD28X+$row_QnaSub2['D28'];
	 $totalD29X=$totalD29X+$row_QnaSub2['D29'];
	 $totalD30X=$totalD30X+$row_QnaSub2['D30'];
	 $totalD31X=$totalD31X+$row_QnaSub2['D31'];
	 
	 ?>
     <tr class="texto_gris">
       <td class="textogris Estilo1"><div align="center" >
	     <?php 
	   	$IdAdministrativasXX=$row_QnaSub2['CodificacionComp'];
	   	//mysql_select_db($database_marambio, $marambio);
		$query_mostrarAdm = "SELECT * FROM administrativas WHERE IdAdministrativas = '$IdAdministrativasXX'";
		$mostrarAdm = mysql_query($query_mostrarAdm, $marambio) or die(mysql_error());
		$row_mostrarAdm = mysql_fetch_assoc($mostrarAdm);
		//$totalRows_mostrarAdm = mysql_num_rows($mostrarAdm);
		echo $row_mostrarAdm['Nombre'];
	    ?>
       </div></td>

       <?php if($NQda==1) { ?>
       <td>
         <div align="center" class="textogrande"><?php echo $row_QnaSub2['D01']; ?>       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D02']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D03']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D04']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D05']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D06']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D07']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D08']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D09']; ?>       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D10']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande">
          								<?php echo $row_QnaSub2['D11']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D12']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D13']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D14']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D15']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D16']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D17']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D18']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D19']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D20']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D21']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D22']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D23']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D24']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D25']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D26']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D27']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D28']; ?>
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <?php if($ultimo_dia>=29) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D29']; ?>
       </div></td>
       <?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <?php if($ultimo_dia>=30) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D30']; ?>       
	   </div></td>
       <?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <?php if($ultimo_dia>=31) { ?>
       <td><div align="center" class="textogrande"><?php echo $row_QnaSub2['D31']; ?>
       </div></td>
       <?php } ?>
       <?php } ?>
       <?php $TotalHorasXX=$row_QnaSub2['D01']+$row_QnaSub2['D02']+$row_QnaSub2['D03']+$row_QnaSub2['D04']+$row_QnaSub2['D05']+$row_QnaSub2['D06']+$row_QnaSub2['D07']+$row_QnaSub2['D08']+$row_QnaSub2['D09']+$row_QnaSub2['D10']+$row_QnaSub2['D11']+$row_QnaSub2['D12']+$row_QnaSub2['D13']+$row_QnaSub2['D14']+$row_QnaSub2['D15']+$row_QnaSub2['D16']+$row_QnaSub2['D17']+$row_QnaSub2['D18']+$row_QnaSub2['D19']+$row_QnaSub2['D20']+$row_QnaSub2['D21']+$row_QnaSub2['D22']+$row_QnaSub2['D23']+$row_QnaSub2['D24']+$row_QnaSub2['D25']+$row_QnaSub2['D26']+$row_QnaSub2['D27']+$row_QnaSub2['D28']+$row_QnaSub2['D29']+$row_QnaSub2['D30']+$row_QnaSub2['D31'];
	   ?>
       <td class="textogris Estilo1"><div align="center">
           <?php echo $TotalHorasXX; ?>
       </div></td>
       </tr>
       <?php $totalHorasTotal2=$totalHorasTotal2+$TotalHorasXX; ?>
   <?php } while ($row_QnaSub2 = mysql_fetch_assoc($QnaSub2)); ?>
   <tr bgcolor="#EEEEEE">
     <td class="titulo"><div align="right" class="textoazul"><strong>Total Administrativas </strong></div></td>
     <?php if($NQda==1) { ?>
     <td>
       <div align="center" class="texto_btgris"><strong><?php echo $totalD01X; ?></strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD02X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD03X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD04X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD05X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD06X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD07X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD08X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD09X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD10X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD11X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD12X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center"><span class="texto_btgris"><strong><?php echo $totalD13X; ?></strong></span></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD14X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD15X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD16X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $totalD17X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD18X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD19X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD20X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD21X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD22X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD23X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD24X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD25X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD26X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD27X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD28X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=29) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD29X; ?> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=30) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD30X; ?> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=31) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalD31X; ?> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <td><div align="center" class="texto_btgris">
       <div align="center"><strong><strong><?php echo $totalHorasTotal2; ?></strong> </strong></div>
     </div></td>
   </tr>
   <tr bgcolor="#DDDDDD">
     <td class="titulo"><div align="right" class="textoazul"><strong>Total General </strong></div></td>
     <?php if($NQda==1) { ?>
     <td>
     <div align="center" class="texto_btgris"><strong><?php echo $T1=$totalD01+$totalD01X; ?></strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T2=$totalD02+$totalD02X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T3=$totalD03+$totalD03X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T4=$totalD04+$totalD04X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T5=$totalD05+$totalD05X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T6=$totalD06+$totalD06X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T7=$totalD07+$totalD07X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T8=$totalD08+$totalD08X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T9=$totalD09+$totalD09X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T10=$totalD10+$totalD10X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T11=$totalD11+$totalD11X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T12=$totalD12+$totalD12X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center"><span class="texto_btgris"><strong><?php echo $T13=$totalD13+$totalD13X; ?></strong></span></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T14=$totalD14+$totalD14X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T15=$totalD15+$totalD15X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong><?php echo $T16=$totalD16+$totalD16X; ?></strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><?php echo $T17=$totalD17+$totalD17X; ?></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T18=$totalD18+$totalD18X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T19=$totalD19+$totalD19X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T20=$totalD20+$totalD20X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T21=$totalD21+$totalD21X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T22=$totalD22+$totalD22X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T23=$totalD23+$totalD23X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T24=$totalD24+$totalD24X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T25=$totalD25+$totalD25X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T26=$totalD26+$totalD26X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T27=$totalD27+$totalD27X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T28=$totalD28+$totalD28X; ?> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=29) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T29=$totalD29+$totalD29X; ?> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=30) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T30=$totalD30+$totalD30X; ?> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=31) { ?>
     <td><div align="center" class="texto_btgris"><strong><?php echo $T31=$totalD31+$totalD31X; ?> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <td><div align="center" class="texto_btgris">
       <div align="center"><strong><strong><?php echo $totalHorasTotal+$totalHorasTotal2; ?></strong> </strong></div>
     </div></td>
   </tr>
	 <?php // HORAS LABORABLES ?>
   <tr bgcolor="#DDDDDD">
      <td class="titulo"><div align="right"><strong>Horas Laborables </strong></div></td>
      
      <?php if($NQda==1) { ?>
      <?php // 1 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD01==$horlab) {
           echo $totalD01;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 2 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD02==$horlab) {
           echo $totalD02;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 3 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD03==$horlab) {
           echo $totalD03;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 4 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD04==$horlab) {
           echo $totalD04;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 5 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD05==$horlab) {
           echo $totalD05;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 6 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD06==$horlab) {
           echo $totalD06;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 7 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD07==$horlab) {
           echo $totalD07;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 8 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD08==$horlab) {
           echo $totalD08;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 9 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD09==$horlab) {
           echo $totalD09;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 10 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD10==$horlab) {
           echo $totalD10;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==1) { ?>
      <?php // 11 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD11==$horlab) {
           echo $totalD11;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>
      <?php if($NQda==1) { ?>
      <?php // 12 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD12==$horlab) {
           echo $totalD12;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==1) { ?>
      <?php // 13 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD13==$horlab) {
           echo $totalD13;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==1) { ?>
      <?php // 14 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD14==$horlab) {
           echo $totalD14;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==1) { ?>
      <?php // 15 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD15==$horlab) {
           echo $totalD15;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 16 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD16==$horlab) {
           echo $totalD16;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 17 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD17==$horlab) {
           echo $totalD17;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 18 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD18==$horlab) {
           echo $totalD18;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 19 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD19==$horlab) {
           echo $totalD19;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 20 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD20==$horlab) {
           echo $totalD20;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 21 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD21==$horlab) {
           echo $totalD21;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 22 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD22==$horlab) {
           echo $totalD22;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 23 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD23==$horlab) {
           echo $totalD23;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 24 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD24==$horlab) {
           echo $totalD24;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 25 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD25==$horlab) {
           echo $totalD25;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 26 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD26==$horlab) {
           echo $totalD26;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 27 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD27==$horlab) {
           echo $totalD27;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php // 28 ?>
      <td>
        <div align="center" class="texto_btgris"><strong>
        <?php 
        if($totalD28==$horlab) {
           echo $totalD28;
        } else {
           echo $horlab;
        }
        ?></strong></div></td>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php if($ultimo_dia>=29) { ?>
      <td><div align="center" class="texto_btgris">
      <?php 
        if($totalD29==$horlab) {
           echo $totalD29;
        } else {
           echo $horlab;
        }
        ?>
      </div></td>
      <?php } ?>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php if($ultimo_dia>=30) { ?>
      <td><div align="center" class="texto_btgris">
      <?php 
        if($totalD30==$horlab) {
           echo $totalD30;
        } else {
           echo $horlab;
        }
        ?>
      </div></td>
      <?php } ?>
      <?php } ?>      
      <?php if($NQda==2) { ?>
      <?php if($ultimo_dia>=31) { ?>
      <td><div align="center" class="texto_btgris">
      <?php 
        if($totalD31==$horlab) {
           echo $totalD31;
        } else {
           echo $horlab;
        }
        ?>
      </div></td>
      <?php } ?>
      <?php } ?>
      <td><div align="center" class="texto_gris">
          <div align="center"><strong>
          </strong><strong>
          <?php 
          $conteoLaboral=0;
          // 1
          if($totalD01==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD01;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 2
          if($totalD02==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD02;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 3
          if($totalD03==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD03;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 4
          if($totalD04==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD04;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 5
          if($totalD05==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD05;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 6
          if($totalD06==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD06;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 7
          if($totalD07==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD07;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 8
          if($totalD08==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD08;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 9
          if($totalD09==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD09;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 10
          if($totalD10==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD10;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 11
          if($totalD11==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD11;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 12
          if($totalD12==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD12;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 13
          if($totalD13==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD13;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 14
          if($totalD14==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD14;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 15
          if($totalD15==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD15;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 16
          if($totalD16==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD16;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 17
          if($totalD17==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD17;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 18
          if($totalD18==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD18;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 19
          if($totalD19==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD19;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 20
          if($totalD20==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD20;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 21
          if($totalD21==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD21;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 22
          if($totalD22==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD22;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 23
          if($totalD23==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD23;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 24
          if($totalD24==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD24;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 25
          if($totalD25==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD25;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 26
          if($totalD26==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD26;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 27
          if($totalD27==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD27;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 28
          if($totalD28==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD28;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 29
          if($totalD29==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD29;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 30
          if($totalD30==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD30;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          // 31
          if($totalD31==$horlab) {
              $conteoLaboral=$conteoLaboral+$totalD31;
          } else {
              $conteoLaboral=$conteoLaboral+$horlab;
          }
          echo $conteoLaboral;
           ?>
           </strong></div>
      </div></td>
    </tr>
<?php // FIN HORAS LABORABLES ?>

   <tr bgcolor="#DDDDDD">
     <td class="titulo"><div align="right" class="textoazul"><strong>Horas Extras </strong></div></td>
     
     <?php if($NQda==1) { ?>
     <td>
     <div align="center" class="texto_btgris"><strong>
       <?php if($T1>$horlab) {
				echo $T1-$horlab;				
			}
		?>
     </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T2>$horlab) {
				echo $T2-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T3>$horlab) {
				echo $T3-$horlab;
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T4>$horlab) {
				echo $T4-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T5>$horlab) {
				echo $T5-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T6>$horlab) {
				echo $T6-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T7>$horlab) {
				echo $T7-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T8>$horlab) {
				echo $T8-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T9>$horlab) {
				echo $T9-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T10>$horlab) {
				echo $T10-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T11>$horlab) {
				echo $T11-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T12>$horlab) {
				echo $T12-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center"><span class="texto_btgris"><strong>
       <?php if($T13>$horlab) {
				echo $T13-$horlab;				
			}
		?>
     </strong></span></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T14>$horlab) {
				echo $T14-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T15>$horlab) {
				echo $T15-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T16>$horlab) {
				echo $T16-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T17>$horlab) {
				echo $T17-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T18>$horlab) {
				echo $T18-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T19>$horlab) {
				echo $T19-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php if($T20>$horlab) {
				echo $T20-$horlab;				
			}
		?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T21>$horlab) {
				echo $T21-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>

     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T22>$horlab) {
				echo $T22-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T23>$horlab) {
				echo $T23-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T24>$horlab) {
				echo $T24-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T25>$horlab) {
				echo $T25-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T26>$horlab) {
				echo $T26-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T27>$horlab) {
				echo $T27-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T28>$horlab) {
				echo $T28-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=29) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T29>$horlab) {
				echo $T29-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=30) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T30>$horlab) {
				echo $T30-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=31) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php if($T31>$horlab) {
				echo $T31-$horlab;				
			}
		?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <td><div align="center" class="texto_btgris">
       <div align="center"><strong>
         <?php
		  $totalHorasExtras='';
		  if($T1>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T1-$horlab);
		  }
		  if($T2>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T2-$horlab);
		  }
		  if($T3>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T3-$horlab);
		  }
		  if($T4>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T4-$horlab);
		  }
		  if($T5>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T5-$horlab);
		  }
		  if($T6>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T6-$horlab);
		  }
		  if($T7>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T7-$horlab);
		  }
		  if($T8>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T8-$horlab);
		  }
		  if($T9>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T9-$horlab);
		  }
		  if($T10>$horlab){		  
			  $totalHorasExtras=$totalHorasExtras+($T10-$horlab);
		  }
		  if($T11>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T11-$horlab);
		  }
		  if($T12>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T12-$horlab);
		  }
		  if($T13>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T13-$horlab);
		  }
		  if($T14>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T14-$horlab);
		  }
		  if($T15>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T15-$horlab);
		  }
		  if($T16>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T16-$horlab);
		  }
		  if($T17>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T17-$horlab);
		  }
		  if($T18>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T18-$horlab);
		  }
		  if($T19>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T19-$horlab);
		  }
		  if($T20>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T20-$horlab);
		  }
		  if($T21>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T21-$horlab);
		  }
		  if($T22>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T22-$horlab);
		  }
		  if($T23>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T23-$horlab);
		  }
		  if($T24>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T24-$horlab);
		  }
		  if($T25>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T25-$horlab);
		  }
		  if($T26>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T26-$horlab);
		  }
		  if($T27>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T27-$horlab);
		  }
		  if($T28>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T28-$horlab);
		  }
		  if($T29>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T29-$horlab);
		  }
		  if($T30>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T30-$horlab);
		  }
		  if($T31>$horlab) {		  
			  $totalHorasExtras=$totalHorasExtras+($T31-$horlab);
		  }
		  echo $totalHorasExtras;
		  ?> 
        </strong></div>
     </div></td>
     </tr>
 </table>
 <?php //TABLA ASMINISTRATIVA FINAL ?>
 <hr>
 <p>  </p>
 <p>   <br>
</p>
				</p>
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
@mysql_free_result($Qna);
@mysql_free_result($QnaSub);
@mysql_free_result($tareaMostrar);
@mysql_free_result($mostrarEmpresa);
@mysql_free_result($mostrarAdm);
mysql_close($marambio);
?>

