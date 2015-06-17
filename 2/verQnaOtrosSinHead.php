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
extract($_REQUEST);

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
?>
<?php
session_start();
$sessionid = session_id();
?>
<?php
// QUIEN EN LA  SESSION
mysql_select_db($database_marambio, $marambio);

$query_quienEs = "SELECT * FROM sessiones WHERE session2000 = '$sessionid' ORDER BY id DESC";
$quienEs = mysql_query($query_quienEs, $marambio) or die(mysql_error());
$row_quienEs = mysql_fetch_assoc($quienEs);
$idQuienEs2000=$row_quienEs['IdUsuario'];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE quincenasub SET D01=%s, D02=%s, D03=%s, D04=%s, D05=%s, D06=%s, D07=%s, D08=%s, D09=%s, D10=%s, D11=%s, D12=%s, D13=%s, D14=%s, D15=%s, D16=%s, D17=%s, D18=%s, D19=%s, D20=%s, D21=%s, D22=%s, D23=%s, D24=%s, D25=%s, D26=%s, D27=%s, D28=%s, D29=%s, D30=%s, D31=%s, A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s, APROBADO=%s WHERE IdQnaSub=%s",
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
                       GetSQLValueString($idQuienEs2000, "int"),
		       GetSQLValueString($_POST['IdQnaSub'], "int"));

  mysql_select_db($database_marambio, $marambio);
  $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());
  
  $todas=0;
  $updateGoTo = 'administracion.php';
  header(sprintf("Location: %s", $updateGoTo));
}
if($todas==1) {
    if($enviado!=1) {
        $sii=1;
        $updateSQL = sprintf("UPDATE quincenasub SET A01=%s, A02=%s, A03=%s, A04=%s, A05=%s, A06=%s, A07=%s, A08=%s, A09=%s, A10=%s, A11=%s, A12=%s, A13=%s, A14=%s, A15=%s, A16=%s, A17=%s, A18=%s, A19=%s, A20=%s, A21=%s, A22=%s, A23=%s, A24=%s, A25=%s, A26=%s, A27=%s, A28=%s, A29=%s, A30=%s, A31=%s, APROBADO=%s WHERE IdQnaSub=%s",
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
        GetSQLValueString($idQuienEs2000, "int"),
        GetSQLValueString($IdQnaSub, "int"));

        mysql_select_db($database_marambio, $marambio);
        $Result1 = mysql_query($updateSQL, $marambio) or die(mysql_error());

        header ("administracion.php");
    }
}

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
$totalRows_Qna = mysql_num_rows($Qna);
$NQda=$row_Qna['Quincena'];
$MesQna=$row_Qna['Mes'];
$AnnoQna=$row_Qna['Anno'];
$horlab=$row_Qna['horlab'];

// BUSCA LAS TAREAS A CLIENTES
$IdQnaXX=$row_Qna['IdQna'];

$query_QnaSub = "SELECT * FROM quincenasub WHERE IdQna = '$IdQnaXX' AND TipoTarea='1' AND IdUsuario='$IdUsuario'";
$QnaSub = mysql_query($query_QnaSub, $marambio) or die(mysql_error());
$row_QnaSub = mysql_fetch_assoc($QnaSub);
$totalRows_QnaSub = mysql_num_rows($QnaSub);

//BUSCA LAS TAREAS ADMINISTRAVIVAS
$query_QnaSub2 = "SELECT * FROM quincenasub WHERE IdQna = '$IdQnaXX' AND TipoTarea='2' AND IdUsuario='$IdUsuario'";
$QnaSub2 = mysql_query($query_QnaSub2, $marambio) or die(mysql_error());
$row_QnaSub2 = mysql_fetch_assoc($QnaSub2);
$totalRows_QnaSub2 = mysql_num_rows($QnaSub2);

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
<html>
<head>
<script language="JavaScript" src="mm_menu.js">
function valida(form)
{
	for (i =0 ; form.elements.length > i ; i++)
	{
		cadena = form.elements[i].name.substring(0,1);
		if(cadena == 'D')
		{
			form.elements[i].style.backgroundColor='#ffffff';
		}
	}
	for (i =0 ; form.elements.length > i ; i++)
	{
		cadena = form.elements[i].name.substring(0,1);
		if(form.elements[i].value == "" && cadena == 'D')
		{
			form.elements[i].style.backgroundColor='Pink';			
		}		
	}
	return false;	
}
</script>
<script language="JavaScript1.2">mmLoadMenus();</script>
<script src="../includes/facebox/lib/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
   $('.ApruebaTarea').click(function(){
       var parametros = $(this).attr('href').split('?');       
       $.ajax({
           type: "GET",
           url: parametros[0],
           data: parametros[1],
           success: function(msg){
               $('#status_aprobo').attr('value',1);
               alert("Se Aprobaron las horas de la tarea.");
           }
       });
       return false;
   });
   $('a.close').click(function(){
      if($('#status_aprobo').val())
        document.location.href="administracion.php";
  });
});
</script>
</head>
<body>
<input id="status_aprobo" type="hidden" />
<p align="left" class="textotitulos">
<table width="100%" border="0" align="left">
   <tr>
     <td width="33%"><span class="texto_btgris">Usuario:<?php echo $row_super['Nombre']; ?><br>
      <?php  if ($row_Qna['Quincena'] == '1') {
               echo  $row_Qna['Quincena'].ra;
             } 

             if ($row_Qna['Quincena'] == '2')  {
               echo    $row_Qna['Quincena'].da; 
             }
		?>. Quincena de <?php 
                            switch($row_Qna['Mes']){
                             case '1':
                                    echo "Enero";        
                             break;
                             case '2':
                                    echo "Febrero";   
                             break;
                             case '3':
                                    echo "Marzo";
                             break; 
                             case '4':
                                    echo "Abril";
                             break;
                             case '5':
                                    echo "Mayo";
                             break;
                             case '6':
                                    echo "Junio";
                             break;
                             case '7':
                                    echo "Julio";
                             break;
                             case '8':
                                    echo "Agosto";
                             break;
                             case '9':
                                    echo "Septiembre";
                             break;
                             case '10':
                                    echo "Octubre";
                             break;
                             case '11':
                                    echo "Noviembre";
                             break;
                             case '12':
                                    echo "Diciembre";
                             break; }?> de <?php echo $row_Qna['Anno']; ?></span>
                             <br>
       </td>
     <td width="44%" valign="bottom"><div align="center"></div></td>
     <td width="23%" valign="top"><div align="right"></div></td>
   </tr>
</table>
  <p class="textoazul"><br>
    <br>
    <span class="titulo">HORAS CLIENTE</span></p>
 <?php //TABLA DE TAREAS CLIENTES ?>
 <?php if($totalRows_QnaSub>=1) { ?> 
<table border="1">
   <tr bgcolor="#E5E5E5" class="texto_btgris">
     <td width="216"><div align="center">C&oacute;digo</div></td>
     <td width="173"><div align="center">Empresa</div></td>
     <td width="52"><div align="center">Aprobar</div></td>
     <td width="37"><div align="center">Total<br>
       Horas</div></td>
	 <?php if($NQda==1) { ?> 
	 <?php
                $DiaCelda="01";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">01</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="02";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">02</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="03";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">03</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="04";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">04</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="05";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">05</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="06";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">06</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="07";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">07</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="08";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">08</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
                $DiaCelda="09";
                $diaColor='';
                $ColorCelda=''; 
                $ORDENZZ=$MesQna . $DiaCelda;

                mysql_select_db($database_marambio, $marambio);
                $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                $row_feriado = mysql_fetch_assoc($feriado);
                $totalRows_feriado = mysql_num_rows($feriado);

                $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                        $ColorCelda="#B2C3DF";
                } else {
                        $ColorCelda="#FFFFFF";
                }
                @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">09</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="10";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">10</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="11";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">11</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="12";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">12</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="13";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">13</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="14";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">14</div></td>
	 <?php } ?>
	 <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="15";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">15</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="16";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">16</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="17";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">17</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="18";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">18</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="19";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">19</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="20";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">20</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="21";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">21</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="22";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">22</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="23";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">23</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="24";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">24</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="25";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">25</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="26";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">26</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="27";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">27</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="28";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">28</div></td>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 	<?php if($ultimo_dia>=29) { ?>
		<?php
					$DiaCelda="29";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">29</div></td>
	 	<?php } ?>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 	<?php if($ultimo_dia>=30) { ?>
		<?php
					$DiaCelda="30";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
						@mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">30</div></td>
	 	<?php } ?>
	 <?php } ?>
	 <?php if($NQda==2) { ?>
	 	<?php if($ultimo_dia>=31) { ?>
		<?php
                    $DiaCelda="31";
                    $diaColor='';
                    $ColorCelda=''; 
                    $ORDENZZ=$MesQna . $DiaCelda;

                    mysql_select_db($database_marambio, $marambio);
                    $query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
                    $feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
                    $row_feriado = mysql_fetch_assoc($feriado);
                    $totalRows_feriado = mysql_num_rows($feriado);

                    $diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 

                    if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
                            $ColorCelda="#B2C3DF";
                    } else {
                            $ColorCelda="#FFFFFF";
                    }
                    @mysql_free_result($feriado);
	?>
     <td width="20" bgcolor="#FFFFFF"><div align="center">31</div></td>
	 	<?php } ?>
	 <?php } ?>
     <td width="34" bgcolor="#FFFFFF"><div align="center"></div></td>
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
   
     <?php 
	    $xx = 4;
	    do { ?>
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
	 <?php  $TotalHorasXX=($NQda==1)?$row_QnaSub['D01']+$row_QnaSub['D02']+$row_QnaSub['D03']+$row_QnaSub['D04']+$row_QnaSub['D05']+$row_QnaSub['D06']+$row_QnaSub['D07']+$row_QnaSub['D08']+$row_QnaSub['D09']+$row_QnaSub['D10']+$row_QnaSub['D11']+$row_QnaSub['D12']+$row_QnaSub['D13']+$row_QnaSub['D14']+$row_QnaSub['D15']:$row_QnaSub['D16']+$row_QnaSub['D17']+$row_QnaSub['D18']+$row_QnaSub['D19']+$row_QnaSub['D20']+$row_QnaSub['D21']+$row_QnaSub['D22']+$row_QnaSub['D23']+$row_QnaSub['D24']+$row_QnaSub['D25']+$row_QnaSub['D26']+$row_QnaSub['D27']+$row_QnaSub['D28']+$row_QnaSub['D29']+$row_QnaSub['D30']+$row_QnaSub['D31'];?>
	 <?php if ($TotalHorasXX != '0')  { ?>	 
	 <?php  $xx++; ?>             
      <form name="form<?=$xx ?>" method="POST" action="<?php echo $editFormAction; ?>" onSubmit = "return valida_envia(this)">
	 
     <tr class="texto_gris">
       <td width="216"><div align="center" class="texto_btgris">
          <?php
                $IdTareaA=$row_QnaSub['CodificacionComp'];
                mysql_select_db($database_marambio, $marambio);
                $query_tareaMostrar = "SELECT * FROM tareas WHERE IdTarea = '$IdTareaA'";
                $tareaMostrar = mysql_query($query_tareaMostrar, $marambio) or die(mysql_error());
                $row_tareaMostrar = mysql_fetch_assoc($tareaMostrar);
                $totalRows_tareaMostrar = mysql_num_rows($tareaMostrar);

                $IdS = $row_tareaMostrar['IdServicio'];
                mysql_select_db($database_marambio, $marambio);
                $query_mostrarServicio = "SELECT * FROM servicios WHERE IdServicio = '$IdS'";
                $mostrarServicio = mysql_query($query_mostrarServicio, $marambio) or die(mysql_error());
                $row_grupo = mysql_fetch_assoc($mostrarServicio);
                /*$totalRows_mostrarEmpresa = mysql_num_rows($mostrarEmpresa);*/
                echo $row_grupo['Servicio'];   ?> 			
                </div></td>
       <td width="173"><div align="center" class="texto_btgris">
           <?php
		 $IdEmpresaXX=$row_tareaMostrar['IdEmpresa'];  
                 mysql_select_db($database_marambio, $marambio);
                 $query_mostrarEmpresa = "SELECT * FROM empresas WHERE CodEmp = '$IdEmpresaXX'";
                 $mostrarEmpresa = mysql_query($query_mostrarEmpresa, $marambio) or die(mysql_error());
                 $row_mostrarEmpresa = mysql_fetch_assoc($mostrarEmpresa);
                 $totalRows_mostrarEmpresa = mysql_num_rows($mostrarEmpresa);
                 echo $row_mostrarEmpresa['Nombre']; 
	 ?>
                </div></td>
      <td width="52" class="texto_btgris">         
          <div align="center"><a class="ApruebaTarea" href="verQnaOtrosSinHead.php?IdQnaSub=<?php echo $row_QnaSub['IdQnaSub']; ?>&IdQna=<?php echo $IdQna; ?>&todas=1&IdUsuario=<?php echo $IdUsuario; ?>"><img src="images/CheckCerrado.gif" width="22" height="17" border="0"></a><br>
       </div></td>
       
       <td width="37"><div align="center" class="texto_btgris">
           <?php echo $TotalHorasXX;
	          $totalHorasTotal=$totalHorasTotal+$TotalHorasXX; ?>
                </div></td>
       <?php if($NQda==1) { ?>
       <td>
         <div align="center">
		 <?php if($row_QnaSub['D01']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub['A01'],1))) {echo "checked";} ?> name="A01" type="checkbox" id="A01" value="<?php echo $row_QnaSub['A01']; ?>">
         <?php } ?>
		   <br>
           <input name="D01" type="text" class="texto_btgris" id="D01" value="<?php echo $row_QnaSub['D01']; ?>" size="1">
         </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D02']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A02'],1))) {echo "checked";} ?> name="A02" type="checkbox" id="A02" value="<?php echo $row_QnaSub['A02']; ?>">          
         <?php } ?>
		 <br>
           <input name="D02" type="text" class="texto_btgris" id="D02" value="<?php echo $row_QnaSub['D02']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D03']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A03'],1))) {echo "checked";} ?> name="A03" type="checkbox" id="A03" value="<?php echo $row_QnaSub['A03']; ?>">
           <?php } ?>
		   <br>
           <input name="D03" type="text" class="texto_btgris" id="D03" value="<?php echo $row_QnaSub['D03']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D04']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A04'],1))) {echo "checked";} ?> name="A04" type="checkbox" id="A04" value="<?php echo $row_QnaSub['A04']; ?>">
           <?php } ?>
		   <br>
           <input name="D04" type="text" class="texto_btgris" id="D04" value="<?php echo $row_QnaSub['D04']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D05']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A05'],1))) {echo "checked";} ?> name="A05" type="checkbox" id="A05" value="<?php echo $row_QnaSub['A05']; ?>">
           <?php } ?>
		   <br>
           <input name="D05" type="text" class="texto_btgris" id="D05" value="<?php echo $row_QnaSub['D05']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D06']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A06'],1))) {echo "checked";} ?> name="A06" type="checkbox" id="A06">
           <?php } ?>
		   <br>
           <input name="D06" type="text" class="texto_btgris" id="D06" value="<?php echo $row_QnaSub['D06']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D07']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A07'],1))) {echo "checked";} ?> name="A07" type="checkbox" id="A07">
         <?php } ?>
		   <br>
           <input name="D07" type="text" class="texto_btgris" id="D07" value="<?php echo $row_QnaSub['D07']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D08']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A08'],1))) {echo "checked";} ?> name="A08" type="checkbox" id="A08">
       <?php } ?>    
		   <br>
           <input name="D08" type="text" class="texto_btgris" id="D08" value="<?php echo $row_QnaSub['D08']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D09']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A09'],1))) {echo "checked";} ?> name="A09" type="checkbox" id="A09">
        <?php } ?>   
		   <br>
           <input name="D09" type="text" class="texto_btgris" id="D09" value="<?php echo $row_QnaSub['D09']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D10']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A10'],1))) {echo "checked";} ?> name="A10" type="checkbox" id="A10">
          <?php } ?> 
		   <br>
           <input name="D10" type="text" class="texto_btgris" id="D10" value="<?php echo $row_QnaSub['D10']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D11']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A11'],1))) {echo "checked";} ?> name="A11" type="checkbox" id="A11">
           <?php } ?>
		   <br>
           <input name="D11" type="text" class="texto_btgris" id="D11" value="<?php echo $row_QnaSub['D11']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D12']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A12'],1))) {echo "checked";} ?> name="A12" type="checkbox" id="A12">
          <?php } ?> 
		   <br>
           <input name="D12" type="text" class="texto_btgris" id="D12" value="<?php echo $row_QnaSub['D12']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D13']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A13'],1))) {echo "checked";} ?> name="A13" type="checkbox" id="A13">
         <?php } ?>  
		   <br>
           <input name="D13" type="text" class="texto_btgris" id="D13" value="<?php echo $row_QnaSub['D13']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D14']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A14'],1))) {echo "checked";} ?> name="A14" type="checkbox" id="A14">
         <?php } ?>  
		   <br>
           <input name="D14" type="text" class="texto_btgris" id="D14" value="<?php echo $row_QnaSub['D14']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D15']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A15'],1))) {echo "checked";} ?> name="A15" type="checkbox" id="A15">
           <?php } ?>
		   <br>
           <input name="D15" type="text" class="texto_btgris" id="D15" value="<?php echo $row_QnaSub['D15']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D16']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A16'],1))) {echo "checked";} ?> name="A16" type="checkbox" id="A16">
          <?php } ?>
		   <br>
           <input name="D16" type="text" class="texto_btgris" id="D16" value="<?php echo $row_QnaSub['D16']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub['D17']!='') { ?>
         <input <?php if (!(strcmp($row_QnaSub['A17'],1))) {echo "checked";} ?> name="A17" type="checkbox" id="A17">
         <?php } ?>  
		   <br>
           <input name="D17" type="text" class="texto_btgris" id="D17" value="<?php echo $row_QnaSub['D17']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D18']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A18'],1))) {echo "checked";} ?> name="A18" type="checkbox" id="A18">
           <?php } ?>
		   <br>
           <input name="D18" type="text" class="texto_btgris" id="D18" value="<?php echo $row_QnaSub['D18']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D19']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A19'],1))) {echo "checked";} ?> name="A19" type="checkbox" id="A19">
           <?php } ?>
		   <br>
           <input name="D19" type="text" class="texto_btgris" id="D19" value="<?php echo $row_QnaSub['D19']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D20']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A20'],1))) {echo "checked";} ?> name="A20" type="checkbox" id="A20">

          <?php } ?> 
		   <br>
           <input name="D20" type="text" class="texto_btgris" id="D20" value="<?php echo $row_QnaSub['D20']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D21']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A21'],1))) {echo "checked";} ?> name="A21" type="checkbox" id="A21">
         <?php } ?>  
		   <br>
           <input name="D21" type="text" class="texto_btgris" id="D21" value="<?php echo $row_QnaSub['D21']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D22']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A22'],1))) {echo "checked";} ?> name="A22" type="checkbox" id="A22">
          <?php } ?> 
		   <br>
           <input name="D22" type="text" class="texto_btgris" id="D22" value="<?php echo $row_QnaSub['D22']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D23']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A23'],1))) {echo "checked";} ?> name="A23" type="checkbox" id="A23">
          <?php } ?> 
		   <br>
           <input name="D23" type="text" class="texto_btgris" id="D23" value="<?php echo $row_QnaSub['D23']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D24']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A24'],1))) {echo "checked";} ?> name="A24" type="checkbox" id="A24">
           <?php } ?>
		   <br>
           <input name="D24" type="text" class="texto_btgris" id="D24" value="<?php echo $row_QnaSub['D24']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D25']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A25'],1))) {echo "checked";} ?> name="A25" type="checkbox" id="A25">
           <?php } ?>
		   <br>
           <input name="D25" type="text" class="texto_btgris" id="D25" value="<?php echo $row_QnaSub['D25']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D26']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A26'],1))) {echo "checked";} ?> name="A26" type="checkbox" id="A26">
          <?php } ?> 
		   <br>
           <input name="D26" type="text" class="texto_btgris" id="D26" value="<?php echo $row_QnaSub['D26']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D27']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A27'],1))) {echo "checked";} ?> name="A27" type="checkbox" id="A27">
          <?php } ?> 
		   <br>
           <input name="D27" type="text" class="texto_btgris" id="D27" value="<?php echo $row_QnaSub['D27']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D28']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A28'],1))) {echo "checked";} ?> name="A28" type="checkbox" id="A28">
           <?php } ?>
		   <br>
           <input name="D28" type="text" class="texto_btgris" id="D28" value="<?php echo $row_QnaSub['D28']; ?>" size="1">
                </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=29) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D29']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A29'],1))) {echo "checked";} ?> name="A29" type="checkbox" id="A29">
           <?php } ?>
		   <br>
           <input name="D29" type="text" class="texto_btgris" id="D29" value="<?php echo $row_QnaSub['D29']; ?>" size="1">
                </div></td>
			<?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=30) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D30']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A30'],1))) {echo "checked";} ?> name="A30" type="checkbox" id="A30">
           <?php } ?>
		   <br>
           <input name="D30" type="text" class="texto_btgris" id="D30" value="<?php echo $row_QnaSub['D30']; ?>" size="1">
                </div></td>
			<?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
	   		<?php if($ultimo_dia>=31) { ?>
       <td><div align="center">
         <?php if($row_QnaSub['D31']!='') { ?>
		 <input <?php if (!(strcmp($row_QnaSub['A31'],1))) {echo "checked";} ?> name="A31" type="checkbox" id="A31">
         <?php } ?>  
		   <br>
           <input name="D31" type="text" class="texto_btgris" id="D31" value="<?php echo $row_QnaSub['D31']; ?>" size="1">
                </div></td>
			<?php } ?>
       <?php } ?>
       <td><div align="center">
           <input name="IdQnaSub" type="hidden" id="IdQnaSub" value="<?php echo $row_QnaSub['IdQnaSub']; ?>">
           <input name="enviado" type="hidden" id="enviado" value="1">
            <input name="Submit4" type="submit" class="texto_btgris" value="&gt;&gt;">
                </div></td>
     </tr>
	 <input type="hidden" name="MM_update" value="form1">
	 </form>
	 <?php } ?>
     <?php } while ($row_QnaSub = mysql_fetch_assoc($QnaSub)); ?>
     
   <tr bgcolor="#EEEEEE">
       <td colspan="3"><div align="right" class="titulo"><strong>Total Clientes </strong></div></td>
     <td><div align="center" class="texto_btgris"><strong><?php echo $totalHorasTotal; ?>
       </strong></div></td>
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
       <td><div align="center" class="texto_btgris">
           </div></td>
   </tr>
</table>
 <?php } ?>
 <?php //TABLA TAREAS CLIENTES FINAL ?>
 <p class="textoazul"></p>
 <hr>
 <p class="titulo">HORAS ADMINISTRATIVAS</p>
 <?php //TABLA ADMINISTRATIVA ?>
<table width="100%" border="1">
   <tr bgcolor="#E5E5E5" class="texto_btgris">
     <td><div align="center">Descripci&oacute;n</div></td>
     <td width="10"><div align="center">Aprobar</div></td>
     <td width="10"><div align="center">Total<br>
        Horas</div></td>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="01";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">01</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="02";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">02</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="03";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">03</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="04";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">04</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="05";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">05</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="06";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">06</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="07";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">07</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="08";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">08</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="09";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">09</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="10";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">10</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="11";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">11</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="12";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">12</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="13";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">13</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="14";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">14</div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
	 <?php
					$DiaCelda="15";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">15</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="16";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">16</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="17";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">17</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="18";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">18</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="19";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">19</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="20";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">20</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="21";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">21</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="22";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">22</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="23";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">23</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="24";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">24</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="25";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">25</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="26";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">26</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="27";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">27</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
	 <?php
					$DiaCelda="28";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">28</div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=29) { ?>
	 <?php
					$DiaCelda="29";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">29</div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=30) { ?>
	 <?php
					$DiaCelda="30";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="2%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">30</div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=31) { ?>
	 <?php
					$DiaCelda="31";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$ColorCelda="#B2C3DF";
						} else {
							$ColorCelda="#FFFFFF";
						}
					@mysql_free_result($feriado);
	?>
     <td width="3%" bgcolor="<?php echo $ColorCelda; ?>"><div align="center">31</div></td>
     <?php } ?>
     <?php } ?>
     <td width="6%" bgcolor="#FFFFFF"><div align="center"></div></td>
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
   <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
     <tr>
       <td><div align="center" class="texto_gris">
	     <?php 
	   	$IdAdministrativasXX=$row_QnaSub2['CodificacionComp'];
	   	mysql_select_db($database_marambio, $marambio);
		$query_mostrarAdm = "SELECT * FROM administrativas WHERE IdAdministrativas = '$IdAdministrativasXX'";
		$mostrarAdm = mysql_query($query_mostrarAdm, $marambio) or die(mysql_error());
		$row_mostrarAdm = mysql_fetch_assoc($mostrarAdm);
		$totalRows_mostrarAdm = mysql_num_rows($mostrarAdm);
		echo $row_mostrarAdm['Nombre'];
	    ?>
       </div></td>
       <td width="10" class="texto_btgris">
         <div align="center"><a class="ApruebaTarea" href="verQnaOtrosSinHead.php?IdQnaSub=<?php echo $row_QnaSub2['IdQnaSub']; ?>&IdQna=<?php echo $IdQna; ?>&todas=1&IdUsuario=<?php echo $IdUsuario; ?>"><img src="images/CheckCerrado.gif" width="22" height="17" border="0"></a></div></td>
       <td width="10"><div align="center" class="texto_btgris">
           <?php
	 $TotalHorasXX=$row_QnaSub2['D01']+$row_QnaSub2['D02']+$row_QnaSub2['D03']+$row_QnaSub2['D04']+$row_QnaSub2['D05']+$row_QnaSub2['D06']+$row_QnaSub2['D07']+$row_QnaSub2['D08']+$row_QnaSub2['D09']+$row_QnaSub2['D10']+$row_QnaSub2['D11']+$row_QnaSub2['D12']+$row_QnaSub2['D13']+$row_QnaSub2['D14']+$row_QnaSub2['D15']+$row_QnaSub2['D16']+$row_QnaSub2['D17']+$row_QnaSub2['D18']+$row_QnaSub2['D19']+$row_QnaSub2['D20']+$row_QnaSub2['D21']+$row_QnaSub2['D22']+$row_QnaSub2['D23']+$row_QnaSub2['D24']+$row_QnaSub2['D25']+$row_QnaSub2['D26']+$row_QnaSub2['D27']+$row_QnaSub2['D28']+$row_QnaSub2['D29']+$row_QnaSub2['D30']+$row_QnaSub2['D31'];
	 echo $TotalHorasXX;
	 $totalHorasTotal2=$totalHorasTotal2+$TotalHorasXX;
	 ?>
       </div></td>
       <?php if($NQda==1) { ?>
       <td>
         <div align="center">
           <?php if($row_QnaSub2['D01']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub2['A01'],1))) {echo "checked";} ?> name="A01" type="checkbox" id="A01" value="<?php echo $row_QnaSub2['A01']; ?>">           
           <?php } ?>
           <br>
           <input name="D01" type="text" class="texto_btgris" id="D01" value="<?php echo $row_QnaSub2['D01']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D02']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub2['A02'],1))) {echo "checked";} ?> name="A02" type="checkbox" id="A02" value="<?php echo $row_QnaSub2['A02']; ?>">           
           <?php } ?>
           <br>
           <input name="D02" type="text" class="texto_btgris" id="D02" value="<?php echo $row_QnaSub2['D02']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D03']!='') { ?>
           <input <?php if (!(strcmp($row_QnaSub2['A03'],1))) {echo "checked";} ?> name="A03" type="checkbox" id="A03" value="<?php echo $row_QnaSub2['A03']; ?>">           
           <?php } ?>
           <br>
           <input name="D03" type="text" class="texto_btgris" id="D03" value="<?php echo $row_QnaSub2['D03']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D04']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A04'],1))) {echo "checked";} ?> name="A04" type="checkbox" id="A04" value="<?php echo $row_QnaSub2['A04']; ?>">           
       <?php } ?>
           <br>
           <input name="D04" type="text" class="texto_btgris" id="D04" value="<?php echo $row_QnaSub2['D04']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D05']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A05'],1))) {echo "checked";} ?> name="A05" type="checkbox" id="A05" value="<?php echo $row_QnaSub2['A05']; ?>">           
       <?php } ?>
           <br>
           <input name="D05" type="text" class="texto_btgris" id="D05" value="<?php echo $row_QnaSub2['D05']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D06']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A06'],1))) {echo "checked";} ?> name="A06" type="checkbox" id="A06" value="<?php echo $row_QnaSub2['A06']; ?>">           
       <?php } ?>
           <br>
           <input name="D06" type="text" class="texto_btgris" id="D06" value="<?php echo $row_QnaSub2['D06']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D07']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A07'],1))) {echo "checked";} ?> name="A07" type="checkbox" id="A07" value="<?php echo $row_QnaSub2['A07']; ?>">           
       <?php } ?>
           <br>
           <input name="D07" type="text" class="texto_btgris" id="D07" value="<?php echo $row_QnaSub2['D07']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D08']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A08'],1))) {echo "checked";} ?> name="A08" type="checkbox" id="A08" value="<?php echo $row_QnaSub2['A08']; ?>">           
       <?php } ?>
           <br>
           <input name="D08" type="text" class="texto_btgris" id="D08" value="<?php echo $row_QnaSub2['D08']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D09']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A09'],1))) {echo "checked";} ?> name="A09" type="checkbox" id="A09" value="<?php echo $row_QnaSub2['A09']; ?>">           
       <?php } ?>
           <br>
           <input name="D09" type="text" class="texto_btgris" id="D09" value="<?php echo $row_QnaSub2['D09']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D10']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A10'],1))) {echo "checked";} ?> name="A10" type="checkbox" id="A10" value="<?php echo $row_QnaSub2['A10']; ?>">           
       <?php } ?>
           <br>
           <input name="D10" type="text" class="texto_btgris" id="D10" value="<?php echo $row_QnaSub2['D10']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D11']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A11'],1))) {echo "checked";} ?> name="A11" type="checkbox" id="A11" value="<?php echo $row_QnaSub2['A11']; ?>">           
       <?php } ?>
           <br>
           <input name="D11" type="text" class="texto_btgris" id="D11" value="<?php echo $row_QnaSub2['D11']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D12']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A12'],1))) {echo "checked";} ?> name="A12" type="checkbox" id="A12" value="<?php echo $row_QnaSub2['A12']; ?>">           
       <?php } ?>
           <br>
           <input name="D12" type="text" class="texto_btgris" id="D12" value="<?php echo $row_QnaSub2['D12']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D13']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A13'],1))) {echo "checked";} ?> name="A13" type="checkbox" id="A13" value="<?php echo $row_QnaSub2['A13']; ?>">           
       <?php } ?>
           <br>
           <input name="D13" type="text" class="texto_btgris" id="D13" value="<?php echo $row_QnaSub2['D13']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D14']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A14'],1))) {echo "checked";} ?> name="A14" type="checkbox" id="A14" value="<?php echo $row_QnaSub2['A14']; ?>">           
       <?php } ?>
           <br>
           <input name="D14" type="text" class="texto_btgris" id="D14" value="<?php echo $row_QnaSub2['D14']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==1) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D15']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A15'],1))) {echo "checked";} ?> name="A15" type="checkbox" id="A15" value="<?php echo $row_QnaSub2['A15']; ?>">           
       <?php } ?>
           <br>
           <input name="D15" type="text" class="texto_btgris" id="D15" value="<?php echo $row_QnaSub2['D15']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D16']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A16'],1))) {echo "checked";} ?> name="A16" type="checkbox" id="A16" value="<?php echo $row_QnaSub2['A16']; ?>">           
       <?php } ?>
           <br>
           <input name="D16" type="text" class="texto_btgris" id="D16" value="<?php echo $row_QnaSub2['D16']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D17']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A17'],1))) {echo "checked";} ?> name="A17" type="checkbox" id="A17" value="<?php echo $row_QnaSub2['A17']; ?>">           
       <?php } ?>
           <br>
           <input name="D17" type="text" class="texto_btgris" id="D17" value="<?php echo $row_QnaSub2['D17']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D18']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A18'],1))) {echo "checked";} ?> name="A18" type="checkbox" id="A18" value="<?php echo $row_QnaSub2['A18']; ?>">           
       <?php } ?>
           <br>
           <input name="D18" type="text" class="texto_btgris" id="D18" value="<?php echo $row_QnaSub2['D18']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D19']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A19'],1))) {echo "checked";} ?> name="A19" type="checkbox" id="A19" value="<?php echo $row_QnaSub2['A19']; ?>">           
       <?php } ?>
           <br>
           <input name="D19" type="text" class="texto_btgris" id="D19" value="<?php echo $row_QnaSub2['D19']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D20']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A20'],1))) {echo "checked";} ?> name="A20" type="checkbox" id="A20" value="<?php echo $row_QnaSub2['A20']; ?>">           
       <?php } ?>
           <br>
           <input name="D20" type="text" class="texto_btgris" id="D20" value="<?php echo $row_QnaSub2['D20']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D21']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A21'],1))) {echo "checked";} ?> name="A21" type="checkbox" id="A21" value="<?php echo $row_QnaSub2['A21']; ?>">           
       <?php } ?>
           <br>
           <input name="D21" type="text" class="texto_btgris" id="D21" value="<?php echo $row_QnaSub2['D21']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D22']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A22'],1))) {echo "checked";} ?> name="A22" type="checkbox" id="A22" value="<?php echo $row_QnaSub2['A22']; ?>">           
       <?php } ?>
           <br>
           <input name="D22" type="text" class="texto_btgris" id="D22" value="<?php echo $row_QnaSub2['D22']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D23']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A23'],1))) {echo "checked";} ?> name="A23" type="checkbox" id="A23" value="<?php echo $row_QnaSub2['A23']; ?>">           
       <?php } ?>
           <br>
           <input name="D23" type="text" class="texto_btgris" id="D23" value="<?php echo $row_QnaSub2['D23']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D24']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A24'],1))) {echo "checked";} ?> name="A24" type="checkbox" id="A24" value="<?php echo $row_QnaSub2['A24']; ?>">           
       <?php } ?>
           <br>
           <input name="D24" type="text" class="texto_btgris" id="D24" value="<?php echo $row_QnaSub2['D24']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D25']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A25'],1))) {echo "checked";} ?> name="A25" type="checkbox" id="A25" value="<?php echo $row_QnaSub2['A25']; ?>">           
       <?php } ?>
           <br>
           <input name="D25" type="text" class="texto_btgris" id="D25" value="<?php echo $row_QnaSub2['D25']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D26']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A26'],1))) {echo "checked";} ?> name="A26" type="checkbox" id="A26" value="<?php echo $row_QnaSub2['A26']; ?>">           
       <?php } ?>
           <br>
           <input name="D26" type="text" class="texto_btgris" id="D26" value="<?php echo $row_QnaSub2['D26']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D27']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A27'],1))) {echo "checked";} ?> name="A27" type="checkbox" id="A27" value="<?php echo $row_QnaSub2['A27']; ?>">           
       <?php } ?>
           <br>
           <input name="D27" type="text" class="texto_btgris" id="D27" value="<?php echo $row_QnaSub2['D27']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D28']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A28'],1))) {echo "checked";} ?> name="A28" type="checkbox" id="A28" value="<?php echo $row_QnaSub2['A28']; ?>">           
       <?php } ?>
           <br>
           <input name="D28" type="text" class="texto_btgris" id="D28" value="<?php echo $row_QnaSub2['D28']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <?php if($ultimo_dia>=29) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D29']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A29'],1))) {echo "checked";} ?> name="A29" type="checkbox" id="A29" value="<?php echo $row_QnaSub2['A29']; ?>">           
       <?php } ?>
           <br>
           <input name="D29" type="text" class="texto_btgris" id="D29" value="<?php echo $row_QnaSub2['D29']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <?php if($ultimo_dia>=30) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D30']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A30'],1))) {echo "checked";} ?> name="A30" type="checkbox" id="A30" value="<?php echo $row_QnaSub2['A30']; ?>">           
       <?php } ?>
           <br>
           <input name="D30" type="text" class="texto_btgris" id="D30" value="<?php echo $row_QnaSub2['D30']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php } ?>
       <?php if($NQda==2) { ?>
       <?php if($ultimo_dia>=31) { ?>
       <td><div align="center">
	   <?php if($row_QnaSub2['D31']!='') { ?>
       <input <?php if (!(strcmp($row_QnaSub2['A31'],1))) {echo "checked";} ?> name="A31" type="checkbox" id="A31" value="<?php echo $row_QnaSub2['A31']; ?>">           
       <?php } ?>
           <br>
           <input name="D31" type="text" class="texto_btgris" id="D31" value="<?php echo $row_QnaSub2['D31']; ?>" size="1">
       </div></td>
       <?php } ?>
       <?php } ?>
       <td><div align="center">
          <input name="enviado" type="hidden" id="enviado" value="1">
          <input name="IdQnaSub" type="hidden" id="IdQnaSub" value="<?php echo $row_QnaSub2['IdQnaSub']; ?>">
           <input name="Submit" type="submit" class="texto_btgris" value="&gt;&gt;">
       </div></td>
     </tr>
     <input type="hidden" name="MM_update" value="form1">
   </form>
   <?php } while ($row_QnaSub2 = mysql_fetch_assoc($QnaSub2)); ?>
   <tr bgcolor="#EEEEEE">
     <td colspan="2" class="titulo"><div align="right" class="textoazul"><strong>Total Administrativas </strong></div></td>
     <td><div align="center" class="texto_btgris">
       <div align="center"><strong><strong><?php echo $totalHorasTotal2; ?></strong> </strong></div>
     </div></td>
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
     <td><div align="center" class="texto_btgris"> </div></td>
   </tr>
   <tr bgcolor="#DDDDDD">
     <td colspan="2" class="titulo"><div align="right" class="textoazul"><strong>Total General </strong></div></td>
     <td><div align="center" class="texto_btgris">
       <div align="center"><strong><strong><?php echo $totalHorasTotal+$totalHorasTotal2; ?></strong> </strong></div>
     </div></td>
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
     <td><div align="center" class="texto_btgris"> </div></td>
   </tr>
   <?php //INICIO HORAS LABORABLES ?>
   <tr bgcolor="#DDDDDD">
     <td colspan="2" class="titulo"><div align="right" class="textoazul"><strong>Horas Laborables </strong></div></td>
     <td><div align="center" class="texto_gris">
                        <div align="center"><strong>
                        </strong><strong>
						<?php
						$conteoLaboral = 0;
						if($NQda==1 && true):
							$quincArray = array('01','02','03','04','05','06','07','08','09',10,11,12,13,14,15);
							foreach($quincArray as $n => $d):
								$diaColor=jddayofweek(cal_to_jd(CAL_GREGORIAN,date("$MesQna"),date("$d"),date("$AnnoQna")),1);
								if(($diaColor!="Saturday") AND ($diaColor!="Sunday")) {
									$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '".($MesQna.$d)."'";
									$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
									if(mysql_num_rows($feriado)<1){
										$conteoLaboral=$conteoLaboral+$horlab;
									}
								}
							endforeach;
						else:
							for($d=16;$d<=date("t",$MesQna);$d++):
								$diaColor=jddayofweek(cal_to_jd(CAL_GREGORIAN,date("$MesQna"),date("$d"),date("$AnnoQna")),1);
								if(($diaColor!="Saturday") AND ($diaColor!="Sunday")) {
									$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '".($MesQna.$d)."'";
									$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
									if(mysql_num_rows($feriado)<1){
										$conteoLaboral=$conteoLaboral+$horlab;
									}
								}
							endfor;
						endif;
						
						echo $conteoLaboral;
						 ?>
						 </strong></div>
                    </div></td>
                    <?php if($NQda==1) { ?>
					<?php // 1 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
				<?php
					$DiaCelda="01";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD01<=$horlab) {
					  	 		echo $totalD01;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					 </strong></div></td>
                    <?php } ?>
                    <?php if($NQda==1) { ?>
					<?php // 2 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="02";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD02<=$horlab) {
					  	 		echo $totalD02;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
							
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 3 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="03";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD03<=$horlab) {
					  	 		echo $totalD03;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							 echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 4 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="04";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
					$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD04<=$horlab) {
					  	 		echo $totalD04;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							    echo $horlab;
							
						}
					@mysql_free_result($feriado);

					  ?>
					  </strong></div></td>
                    <?php } ?>
					
					<?php if($NQda==1) { ?>
                    <?php // 5 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					<?php
					$DiaCelda="05";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD05<=$horlab) {
					  	 		echo $totalD05;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
					 ?>
					  </strong></div></td>
                    <?php } ?>
					
					<?php if($NQda==1) { ?>
                    <?php // 6 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="06";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD06<=$horlab) {
					  	 		echo $totalD06;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
							
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
					<?php if($NQda==1) { ?>
                    <?php // 7 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					 <?php
					$DiaCelda="07";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD07<=$horlab) {
					  	 		echo $totalD07;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
							
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
					<?php if($NQda==1) { ?>
                    <?php // 8 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					 <?php
					$DiaCelda="08";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD08<=$horlab) {
					  	 		echo $totalD08;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
					<?php if($NQda==1) { ?>
                    <?php // 9 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="09";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD09<=$horlab) {
					  	 		echo $totalD09;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
							
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 10 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					 <?php
					$DiaCelda="10";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD10<=$horlab) {
					  	 		echo $totalD10;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 11 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="11";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD11<=$horlab) {
					  	 		echo $totalD11;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 12 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="12";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD12<=$horlab) {
					  	 		echo $totalD12;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 13 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="13";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD13<=$horlab) {
					  	 		echo $totalD13;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 14 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="14";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD14<=$horlab) {
					  	 		echo $totalD14;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
					<?php // 15 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="15";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD15<=$horlab) {
					  	 		echo $totalD15;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 16 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="16";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD16<=$horlab) {
					  	 		echo $totalD16;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 17 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="17";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD17<=$horlab) {
					  	 		echo $totalD17;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 18 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="18";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD18<=$horlab) {
					  	 		echo $totalD18;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 19 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="19";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD19<=$horlab) {
					  	 		echo $totalD19;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 20 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="20";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD20<=$horlab) {
					  	 		echo $totalD20;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 21 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="21";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD21<=$horlab) {
					  	 		echo $totalD21;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 22 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="22";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD22<=$horlab) {
					  	 		echo $totalD22;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 23 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="23";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD23<=$horlab) {
					  	 		echo $totalD23;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 24 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="24";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD24<=$horlab) {
					  	 		echo $totalD24;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 25 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="25";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD25<=$horlab) {
					  	 		echo $totalD25;
					  		} else {
					  	 		echo $horlab;
								
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 26 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="26";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD26<=$horlab) {
					  	 		echo $totalD26;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 27 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="27";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD27<=$horlab) {
					  	 		echo $totalD27;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
					<?php // 28 ?>
                    <td>
                      <div align="center" class="texto_btgris"><strong>
					  <?php
					$DiaCelda="28";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD28<=$horlab) {
					  	 		echo $totalD28;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					  </strong></div></td>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
                    <?php if($ultimo_dia>=29) { ?>
                    <td><div align="center" class="texto_btgris">
					<?php
					$DiaCelda="29";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD29<=$horlab) {
					  	 		echo $totalD29;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					</div></td>
                    <?php } ?>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
                    <?php if($ultimo_dia>=30) { ?>
                    <td><div align="center" class="texto_btgris">
					<?php
					$DiaCelda="30";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD30<=$horlab) {
					  	 		echo $totalD30;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					</div></td>
                    <?php } ?>
                    <?php } ?>
					
                    <?php if($NQda==2) { ?>
                    <?php if($ultimo_dia>=31) { ?>
                    <td><div align="center" class="texto_btgris">
					<?php
					$DiaCelda="31";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							echo "0";
						} else {
							/*if($totalD31<=$horlab) {
					  	 		echo $totalD31;
					  		} else {
					  	 		echo $horlab;
					  		}*/
							echo $horlab;
						}
					@mysql_free_result($feriado);
				 ?>
					</div></td>
                    <?php } ?>
                    <?php } ?>
					
					
                    <td><div align="center" class="texto_gris"><strong> </strong></div></td>
   </tr>
<?php // HORAS EXTRAS ?>

<?php //INICIO HORAS EXTRAS ?>
   <tr bgcolor="#DDDDDD">
     <td colspan="2" class="titulo"><div align="right" class="textoazul"><strong>Horas Extras </strong></div></td>
     <td><div align="center" class="texto_btgris">
       <div align="center"><strong>
         <?php  $totalHorasExtras=0;
                             if($NQda==1) { ?>
                    
                         <?php
							$DiaCelda="01";
							$diaColor='';
							$ColorCelda=''; 
							$ORDENZZ=$MesQna . $DiaCelda;
										
							mysql_select_db($database_marambio, $marambio);
							$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
							$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
							$row_feriado = mysql_fetch_assoc($feriado);
							$totalRows_feriado = mysql_num_rows($feriado);
						
							$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
							if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD01;
							} else {
								if($T1>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T1-$horlab);
								}
							}
							@mysql_free_result($feriado);
						 ?>
                    <?php } ?>
                    <?php if($NQda==1) { ?>
                       <?php
							$DiaCelda="02";
							$diaColor='';
							$ColorCelda=''; 
							$ORDENZZ=$MesQna . $DiaCelda;
										
							mysql_select_db($database_marambio, $marambio);
							$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
							$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
							$row_feriado = mysql_fetch_assoc($feriado);
							$totalRows_feriado = mysql_num_rows($feriado);
						
							$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
							if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD02;
							} else {
								if($T2>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T2-$horlab);
								}
							}
							@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
				 <?php if($NQda==1) { ?>
                    <?php
							$DiaCelda="03";
							$diaColor='';
							$ColorCelda=''; 
							$ORDENZZ=$MesQna . $DiaCelda;
										
							mysql_select_db($database_marambio, $marambio);
							$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
							$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
							$row_feriado = mysql_fetch_assoc($feriado);
							$totalRows_feriado = mysql_num_rows($feriado);
						
							$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
							if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								 $totalHorasExtras=$totalHorasExtras+$totalD03;
							} else {
								if($T3>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T3-$horlab);
								}
							}
							@mysql_free_result($feriado);
				 	?>
                    <?php } ?>
					
                    <?php if($NQda==1) { ?>
                    <?php
							$DiaCelda="04";
							$diaColor='';
							$ColorCelda=''; 
							$ORDENZZ=$MesQna . $DiaCelda;
										
							mysql_select_db($database_marambio, $marambio);
							$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
							$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
							$row_feriado = mysql_fetch_assoc($feriado);
							$totalRows_feriado = mysql_num_rows($feriado);
						
							$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
							if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD04;
							} else {
								if($T4>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T4-$horlab);;
								}
							}
							@mysql_free_result($feriado);
				   ?>
                   <?php } ?>
				 
                   <?php if($NQda==1) { ?>
                   <?php
							$DiaCelda="05";
							$diaColor='';

							$ColorCelda=''; 
							$ORDENZZ=$MesQna . $DiaCelda;
										
							mysql_select_db($database_marambio, $marambio);
							$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
							$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
							$row_feriado = mysql_fetch_assoc($feriado);
							$totalRows_feriado = mysql_num_rows($feriado);
						
							$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
							if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD05;
							} else {
								if($T5>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T5-$horlab);
								}
							}
							@mysql_free_result($feriado);
				   ?>						
                   <?php } ?>
                   <?php if($NQda==1) { ?>
                   <?php
							$DiaCelda="06";
							$diaColor='';
							$ColorCelda=''; 
							$ORDENZZ=$MesQna . $DiaCelda;
										
							mysql_select_db($database_marambio, $marambio);
							$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
							$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
							$row_feriado = mysql_fetch_assoc($feriado);
							$totalRows_feriado = mysql_num_rows($feriado);
						
							$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
							if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD06;
							} else {
								if($T6>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T6-$horlab);
									}
							}
							@mysql_free_result($feriado);
				   ?>
                   <?php } ?>

				   <?php if($NQda==1) { ?>
                   <?php
						$DiaCelda="07";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD07;
						} else {
								if($T7>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T7-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="08";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+ $totalD08;
						} else {
								if($T8>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T8-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="09";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD09;
						} else {
								if($T9>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T9-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="10";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD10;
						} else {
								if($T10>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T10-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="11";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD11;
						} else {
								if($T11>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T11-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="12";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD12;
						} else {
								if($T12>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T12-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="13";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD13;
						} else {
								if($T13>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T13-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="14";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
							$totalHorasExtras=$totalHorasExtras+$totalD14;
						} else {
								if($T14>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T14-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==1) { ?>
                 <?php
						$DiaCelda="15";
						$diaColor='';
						$ColorCelda=''; 
						$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD15;
						} else {
								if($T15>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T15-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                 <?php } ?>
                 <?php if($NQda==2) { ?>
                    
                      <?php
					$DiaCelda="16";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD16;
						} else {
								if($T16>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T16-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                   
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                                            <?php
					$DiaCelda="17";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD17;
						} else {
								if($T17>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T17-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                        <?php
					$DiaCelda="18";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD18;
						} else {
								if($T18>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T18-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                   
                        <?php
					$DiaCelda="19";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD19;
						} else {
								if($T19>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T19-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                   
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                        <?php
					$DiaCelda="20";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD20;
						} else {
								if($T20>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T20-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                   
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                         <?php
					$DiaCelda="21";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD21;
						} else {
								if($T21>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T21-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                   
                         <?php
					$DiaCelda="22";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD22;
						} else {
								if($T22>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T22-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                   
                         <?php
					$DiaCelda="23";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD23;
						} else {
								if($T23>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T23-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
               
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                         <?php
					$DiaCelda="24";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD24;
						} else {
								if($T24>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T24-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                         <?php
					$DiaCelda="25";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD25;
						} else {
								if($T25>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T25-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                         <?php
					$DiaCelda="26";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD26;
						} else {
								if($T26>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T26-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    
                         <?php
					$DiaCelda="27";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD27;
						} else {
								if($T27>$horlab) {
								 $totalHorasExtras=$totalHorasExtras+($T27-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                   
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                   
                        <?php
					$DiaCelda="28";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD28;
						} else {
								if($T28>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T28-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                   
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    <?php if($ultimo_dia>=29) { ?>
                    
                     <?php
					$DiaCelda="29";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD29;
						} else {
								if($T29>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T29-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    <?php if($ultimo_dia>=30) { ?>
                    
                    <?php
					$DiaCelda="30";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD30;
						} else {
								if($T30>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T30-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>
                    
                    <?php } ?>
                    <?php } ?>
                    <?php if($NQda==2) { ?>
                    <?php if($ultimo_dia>=31) { ?>
                    
                     <?php
					$DiaCelda="31";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								$totalHorasExtras=$totalHorasExtras+$totalD31;
						} else {
								if($T31>$horlab) {
									$totalHorasExtras=$totalHorasExtras+($T31-$horlab);
								}
						}
						@mysql_free_result($feriado);
				 ?>

                   
                    <?php } ?>
                    <?php } ?>


<?php
/*$totalHorasExtras=$total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10+$total11+$total12+$total13+$total14+$total15+$total16+$total17+$total18+$total19+$total20+$total21+$total22+$total23+$total24+$total25+$total26+$total27+$total28+$total29+$total30+$total31;*/
echo $totalHorasExtras;

?>
        </strong></div>
     </div></td>
     <?php if($NQda==1) { ?>
     <td>
     <div align="center" class="texto_btgris"><strong>
       <?php
					$DiaCelda="01";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD01;
						} else {
								if($T1>$horlab) {
									echo $T1-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="02";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD02;
						} else {
								if($T2>$horlab) {
									echo $T2-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="03";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD03;
						} else {
								if($T3>$horlab) {
									echo $T3-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="04";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD04;
						} else {
								if($T4>$horlab) {
									echo $T4-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="05";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD05;
						} else {
								if($T5>$horlab) {
									echo $T5-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="06";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD06;
						} else {
								if($T6>$horlab) {
									echo $T6-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="07";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD07;
						} else {
								if($T7>$horlab) {
									echo $T7-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="08";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD08;
						} else {
								if($T8>$horlab) {
									echo $T8-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="09";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD09;
						} else {
								if($T9>$horlab) {
									echo $T9-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="10";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD10;
						} else {
								if($T10>$horlab) {
									echo $T10-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
      <?php
					$DiaCelda="11";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD11;
						} else {
								if($T11>$horlab) {
									echo $T11-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="12";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD12;
						} else {
								if($T12>$horlab) {
									echo $T12-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center"><span class="texto_btgris"><strong>
       <?php
					$DiaCelda="13";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD13;
						} else {
								if($T13>$horlab) {
									echo $T13-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></span></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="14";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD14;
						} else {
								if($T14>$horlab) {
									echo $T14-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==1) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="15";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD15;
						} else {
								if($T15>$horlab) {
									echo $T15-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="16";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD16;
						} else {
								if($T16>$horlab) {
									echo $T16-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="17";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD17;
						} else {
								if($T17>$horlab) {
									echo $T17-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
      <?php
					$DiaCelda="18";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD18;
						} else {
								if($T18>$horlab) {
									echo $T18-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
      <?php
					$DiaCelda="19";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD19;
						} else {
								if($T19>$horlab) {
									echo $T19-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong>
       <?php
					$DiaCelda="20";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD20;
						} else {
								if($T20>$horlab) {
									echo $T20-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="21";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD21;
						} else {
								if($T21>$horlab) {
									echo $T21-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="22";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD22;
						} else {
								if($T22>$horlab) {
									echo $T22-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="23";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD23;
						} else {
								if($T23>$horlab) {
									echo $T23-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
      <?php
					$DiaCelda="24";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD24;
						} else {
								if($T24>$horlab) {
									echo $T24-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="25";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD25;
						} else {
								if($T25>$horlab) {
									echo $T25-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="26";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD26;
						} else {
								if($T26>$horlab) {
									echo $T26-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="27";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD27;
						} else {
								if($T27>$horlab) {
									echo $T27-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="28";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD28;
						} else {
								if($T28>$horlab) {
									echo $T28-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=29) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="29";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD29;
						} else {
								if($T29>$horlab) {
									echo $T29-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=30) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
      <?php
					$DiaCelda="30";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD30;
						} else {
								if($T30>$horlab) {
									echo $T30-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <?php if($NQda==2) { ?>
     <?php if($ultimo_dia>=31) { ?>
     <td><div align="center" class="texto_btgris"><strong><strong><strong>
       <?php
					$DiaCelda="31";
					$diaColor='';
					$ColorCelda=''; 
					$ORDENZZ=$MesQna . $DiaCelda;
										
						mysql_select_db($database_marambio, $marambio);
						$query_feriado = "SELECT * FROM feriados WHERE ORDEN = '$ORDENZZ'";
						$feriado = mysql_query($query_feriado, $marambio) or die(mysql_error());
						$row_feriado = mysql_fetch_assoc($feriado);
						$totalRows_feriado = mysql_num_rows($feriado);
						
						$diaColor=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("$MesQna"),date("$DiaCelda"), date("$AnnoQna")) , 1 ); 
						
						if(($diaColor=="Saturday") OR ($diaColor=="Sunday") OR ($totalRows_feriado>=1)) {
								echo $totalD31;
						} else {
								if($T31>$horlab) {
									echo $T31-$horlab;
								}
						}
						@mysql_free_result($feriado);
				 ?>
     </strong></strong> </strong></div></td>
     <?php } ?>
     <?php } ?>
     <td><div align="center" class="texto_btgris"> </div></td>
   </tr>
<?php // HORAS EXTRAS ?>
</table>
 <?php //TABLA ASMINISTRATIVA FINAL ?>
 <hr>
				</p>
                <p align="left" class="textotitulos">&nbsp;</p>
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
mysql_close($marambio);
?>